<?php

namespace App\Http\Controllers;

use App\Models\Order;
use App\Models\Product;
use App\Models\User;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Redirect;

class OrderController extends Controller
{
    public function create(Request $request)
    {
        $params = $request->all();
        $user = User::where('email', '=', $params['email'])->first();
        $product = Product::find($params['product_id'])->first();

        if(is_null($user))
        {
            $user = $this->createNewUser($params);
        }

        $order = $this->createNewOrder($params, $user, $product);

        $new_request = $this->makePlaceToPayRequest($order, $user);

        if($new_request->status->status == "OK"){
            return Redirect::to($new_request->processUrl);
        }  
        return false;
    }

    public function pay(Request $request)
    {
        $params = $request->all();
        $order = Order::where('id', $params['order_id'])->first();
        $user = User::where('id', $order->id)->first();

        $new_request = $this->makePlaceToPayRequest($order, $user);

        if($new_request->status->status == "OK"){
            return Redirect::to($new_request->processUrl);
        }  
        return false;
    }

    public function track()
    {
        return view('order.track');
    }

    public function search(Request $request)
    {
        $params = $request->all();
        $user = User::where('email', '=', $params['email'])->first();
        if(is_null($user)){
            return Redirect::back()->withErrors([
                'msg' => 'No se encontro la orden con los datos suministrados.'
            ]);
        }
        $order = Order::where('id', $params['order'])
            ->where('user_id', '=', $user->id)
            ->first();

        if(is_null($order)){
            return Redirect::back()->withErrors([
                'msg' => 'No se encontro la orden con los datos suministrados.'
            ]);
        }

        $hash = base64_encode($order->id.";".$order->created_at.";".$user->id);
        
        return redirect()->route('order.detail', $hash);
    }

    public function detail($hash)
    {
        $hash = base64_decode($hash);

        $datos = explode(";", $hash);

        $user = User::where('id', $datos[2])->first();
        $order = Order::where('id', $datos[0])->first();
        $product = Product::where('id', $order->product_id)->first();

        $view_name = 'order.detail'; 
        return view($view_name)->with('data', [
            "user" => $user,
            "order" => $order,
            "product" => $product,
            "view_name" => $view_name
        ]);
    }

    protected function createNewUser($params)
    {
        $user = new User;
        $user->name = $params['name'];
        $user->email = $params['email'];
        $user->mobile = $params['mobile'];
        $password = Str::random(10);
        $user->password = bcrypt($password);

        $user->save();
        $user->assignRole('Customer');

        return $user;
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
        $seed      = date('c');

        if (function_exists('random_bytes')) {
            $nonce = bin2hex(random_bytes(16));
        } elseif (function_exists('openssl_random_pseudo_bytes')) {
            $nonce = bin2hex(openssl_random_pseudo_bytes(16));
        } else {
            $nonce = mt_rand();
        }

        $nonceBase64 = base64_encode($nonce);

        $tranKey = base64_encode(sha1($nonce.$seed.$secretKey));

        $auth = [
            "login"   => $login,
            "tranKey" => $tranKey,
            "seed"    => $seed,
            "nonce"   => $nonceBase64,
        ];
        $hash_order = base64_encode($order->id.";".$order->created_at.";".$user->id);

        $payment = [
            "reference"=> "$hash_order",
            "description"=> "Orden de compra $hash_order",
            "amount"=> [
                "currency"=> "COP",
                "total"=> $order->quantity*$order->product_price
            ],
            "allowPartial"=> false
        ];

        $data = [
            "locale" => "es_CO",
            "auth" => $auth,
            "payment" => $payment,
            "expiration" => Carbon::now()->addDays(7),
            "returnUrl" => "http://localhost:8000/order/detail/$hash_order",
            "ipAddress" => "127.0.0.1",
            "userAgent" => "PlacetoPay Sandbox"
        ];
        
        $new_request = Http::post(
            'https://stoplight.io/mocks/placetopay-api/webcheckout-docs/10862976/api/session', 
            $data
        );
        $new_request = json_decode($new_request);

        return $new_request;
    }
}
