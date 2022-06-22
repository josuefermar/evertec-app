<?php

namespace App\Http\Controllers;

use App\Models\Order;
use App\Models\Product;
use App\Models\User;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Redirect;

class OrderController extends Controller
{

    public function track()
    {
        return view('order.track');
    }

    public function search(Request $request)
    {
        $params = $request->all();
        $user = User::where('email', '=', $params['email'])->first();
        if(is_null($user))
        {
            return Redirect::back()->withErrors([
                'msg' => 'No se encontro informacion con los datos suministrados.'
            ]);
        }
       
        $hash = base64_encode($user->email);
        return redirect()->route('order.index', $hash);
    }

    public function index($hash = null)
    {
        $orders = Order::orderBy('created_at', 'desc');
        if(isset($hash) && $hash !=  null)
        {
            $email = base64_decode($hash);
            $user = User::where('email', $email)->first();
            $orders = Order::where('user_id',$user->id);
        }elseif(!Auth::user())
        {
            return redirect()->route('login');
        }

        $orders = $orders->paginate(10);

        return view('order/index')->with('orders', $orders);
        
    }

    public function detail($hash)
    {
        $hash = base64_decode($hash);

        $datos = explode(";", $hash);

        $user = User::where('id', $datos[2])->first();
        $order = Order::where('id', $datos[0])->first();
        $product = Product::where('id', $order->product_id)->first();

        if(!is_null($order->request_id))
        {
            $statusRequest = $this->checkOrderStatus($order);
    
            if($statusRequest->status->status != $order->status)
            {
                $order->status = $statusRequest->status->status;
                if($statusRequest->status->status == 'APPROVED' || 
                $statusRequest->status->status == 'PAYED')
                {
                    $order->status = 'PAYED';
                }
                $order->save();
            }
        }
        
        $viewName = 'order.detail'; 
        return view($viewName)->with('data', 
        [
            "user" => $user,
            "order" => $order,
            "product" => $product,
            "viewName" => $viewName
        ]);
    }

    public function create(Request $request)
    {
        $params = $request->all();
        $user = User::where('email', '=', $params['email'])->first();
        $product = Product::find($params['product_id'])->first();

        if(is_null($user))
        {
            $user = UserController::createNewUser($params);
        }

        $order = $this->createNewOrder($params, $user, $product);

        $newRequest = $this->makePlaceToPayRequest($order, $user);

        if($newRequest->status->status == "OK")
        {
            $url = $newRequest->processUrl;
            $order->request_id = $newRequest->requestId;
            $order->save();
            return Redirect::to($url);
        }  
        $hash = base64_encode($order->id.";".$order->created_at.";".$order->user_id);

        return redirect()->route('order.detail', $hash)->withErrors([
            'popup' => 'Hubo un problema al intentar pagar, intentelo nuevamente.'
        ]);

    }

    public function pay(Request $request)
    {
        $params = $request->all();
        $order = Order::where('id', $params['order_id'])->first();
        $user = User::where('id', $order->user_id)->first();

        $order->status = 'CREATED';
        $order->save();

        $newRequest = $this->makePlaceToPayRequest($order, $user);

        if($newRequest->status->status == "OK")
        {
            $url = $newRequest->processUrl;
            $order->request_id = $newRequest->requestId;
            $order->save();
            return Redirect::to($url);
        }  
        $hash = base64_encode($order->id.";".$order->created_at.";".$order->user_id);

        return redirect()->route('order.detail', $hash)->withErrors([
            'popup' => 'Hubo un problema al intentar pagar, intentelo nuevamente.'
        ]);
    }

    public static function checkOrderStatus($order)
    {
        $login     = ENV('PLACE_TO_PAY_LOGIN');
        $secretKey = ENV('PLACE_TO_PAY_SECRET_KEY');
        $seed = date('c');

        if (function_exists('random_bytes'))
        {
            $nonce = bin2hex(random_bytes(16));
        } elseif (function_exists('openssl_random_pseudo_bytes'))
        {
            $nonce = bin2hex(openssl_random_pseudo_bytes(16));
        } else {
            $nonce = mt_rand();
        }
        
        $nonceBase64 = base64_encode($nonce);

        $tranKey = base64_encode(sha1($nonce . $seed . $secretKey, true));

        $auth = 
        [
            "login"   => $login,
            "tranKey" => $tranKey,
            "seed"    => $seed,
            "nonce"   => $nonceBase64,
        ];

        $data = 
        [
            "locale" => "es_CO",
            "auth" => $auth,
        ];
        
        $newRequest = Http::post(
            ENV('PLACE_TO_PAY_URL')."/api/session/$order->request_id", 
            $data
        );
        $newRequest = json_decode($newRequest);

        return $newRequest;
    }

    protected function createNewOrder($params, $user, $product)
    {
        $order = new Order;
        $order->user_id = $user->id;
        $order->product_id = $product->id;
        $order->quantity = $params['quantity'];
        $order->product_price = $product->price;
        $order->status = "CREATED";
        $order->save();

        return $order;
    }

    protected function makePlaceToPayRequest($order, $user)
    {
        $login     = ENV('PLACE_TO_PAY_LOGIN');
        $secretKey = ENV('PLACE_TO_PAY_SECRET_KEY');
        $seed = date('c');

        if (function_exists('random_bytes')) 
        {
            $nonce = bin2hex(random_bytes(16));
        } elseif (function_exists('openssl_random_pseudo_bytes')) 
        {
            $nonce = bin2hex(openssl_random_pseudo_bytes(16));
        } else 
        {
            $nonce = mt_rand();
        }
        
        $nonceBase64 = base64_encode($nonce);

        $tranKey = base64_encode(sha1($nonce . $seed . $secretKey, true));

        $auth = [
            "login"   => $login,
            "tranKey" => $tranKey,
            "seed"    => $seed,
            "nonce"   => $nonceBase64,
        ];
        $hashOrder = base64_encode($order->id.";".$order->created_at.";".$user->id);

        $payment = 
        [
            "reference"=> "$order->id",
            "description"=> "Orden de Compra $order->id",
            "amount"=> [
                "currency"=> "COP",
                "total"=> $order->quantity*$order->product_price
            ],
            "allowPartial"=> false
        ];

        $data = 
        [
            "locale" => "es_CO",
            "auth" => $auth,
            "payment" => $payment,
            "expiration" => Carbon::now()->addDays(7),
            "returnUrl" => "http://localhost:8000/order/detail/$hashOrder",
            "ipAddress" => "127.0.0.1",
            "userAgent" => "PlacetoPay Sandbox"
        ];
        
        $newRequest = Http::post(
            ENV('PLACE_TO_PAY_URL').'/api/session/', 
            $data
        );
        $newRequest = json_decode($newRequest);

        return $newRequest;
    }
    
}
