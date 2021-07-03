<?php

namespace App\Http\Controllers\Ecommerce;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Product;

class ProductController extends Controller
{
    public function index($id){
        $product = Product::find($id);
        return view('quimeraProduct', compact('product'));
    }

    public function records(){
        $products = Product::get();

        return $products;
    }

    public function record($id){
        $product = Product::with('discount')->find($id);
        return $product;
    }
}
