<?php

namespace App\Http\Controllers;

use App\Models\Order;
use App\Models\Product;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

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

        $view_name = 'admin.orders_detail'; 
        return view($view_name)->with('data', [
            "user" => $user,
            "order" => $order,
            "product" => $product,
            "view_name" => $view_name
        ]);
    }
}
