<?php

namespace App\Http\Controllers;

use App\Models\Product;
use Illuminate\Http\Request;

class HomeController extends Controller
{
    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()
    {
        $products = Product::all();
        return view('index')->with('products',$products);
    }

    public function checkout(Request $request)
    {
        $params = $request->all();
        $product = Product::where('id', $params["product_id"])->first();
        return view('checkout')->with('data', 
        [
            "params" => $params,
            "product" => $product
        ]);
    }

    public function resume(Request $request)
    {       
        $params = $request->all();
        $product = Product::where('id', $params["product_id"])->first();

        $viewName = 'resume';
        return view($viewName)->with('data', 
        [
            "params" => $params,
            "product" => $product,
            "viewName" => $viewName
        ]);
    }

}
