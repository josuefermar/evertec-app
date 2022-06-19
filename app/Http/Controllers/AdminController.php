<?php

namespace App\Http\Controllers;

use App\Models\Order;
use App\Models\Product;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Http;

class AdminController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function dashboard()
    {
        return view('admin/dashboard');
    }

    public function ordersIndex()
    {
        $orders = Order::where('id','>', 0)->paginate(10);

        return view('admin/orders_index')->with('orders', $orders);
    }

    public function orderDetail($hash)
    {
        $hash = base64_decode($hash);

        $datos = explode(";", $hash);
        $user = User::where('id', $datos[2])->first();
        $order = Order::where('id', $datos[0])->first();
        $product = Product::where('id', $order->product_id)->first();
        
        if(!is_null($order->request_id))
        {
            $status_request = $this->checkOrderStatus($order);
    
            if($status_request->status->status != $order->status)
            {
                $order->status = $status_request->status->status;
                if($status_request->status->status == 'APPROVED' || 
                $status_request->status->status == 'PAYED')
                {
                    $order->status = 'PAYED';
                }
                $order->save();
            }
        }

        $view_name = 'admin.orders_detail'; 
        return view($view_name)->with('data', [
            "user" => $user,
            "order" => $order,
            "product" => $product,
            "view_name" => $view_name
        ]);
    }

    public function checkOrderStatus($order)
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
        
        $new_request = Http::post(
            ENV('PLACE_TO_PAY_URL')."/api/session/$order->request_id", 
            $data
        );
        $new_request = json_decode($new_request);

        return $new_request;
    }
}
