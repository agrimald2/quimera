<?php

namespace App\Http\Controllers\Ecommerce;
use App\Category;
use App\Brand;
use App\Collection;
use App\Product;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class HomeController extends Controller
{
    public function index(){   
        $categories = Category::all()->toArray();
        $brands = Brand::all()->toArray();
        $collections = Collection::get();
        $products = Product::where('new_product', true)->get();
        return view('quimeraWelcome', compact('categories','brands','products', 'collections'));
    }

    public function records(){
        $categories = Category::get();
        $brands = Brand::get();
        $collections = Collection::get();

        return compact('categories', 'brands', 'collections');
    }
}
