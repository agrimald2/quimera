<?php

namespace App\Http\Controllers\Frontend;

use App\Brand;
use App\Category;
use App\Collection;
use App\Http\Controllers\Controller;
use App\Product;
use Illuminate\Http\Request;

class FrontendController extends Controller
{
    
    public function index()
    {
        return view('frontend.index.index');
    }

    public function indexData()
    {
        $p = Product::where('new_product', true)->get();
        $p = $p->concat($p)->concat($p);
        $p = $p->concat($p)->concat($p);

        return response()->json([
            'categories' => Category::all()->toArray(),
            'brands' => Brand::all()->toArray(),
            'collections' => Collection::get(),
            'products' => Product::where('new_product', '!=', false)->get(),
        ]);
    }

}
