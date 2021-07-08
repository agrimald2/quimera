<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use App\Product;
use App\Category;
use App\Collection;
use App\Color;
use App\Brand;
use App\Size;
use App\Url;
use App\Discount;

class ProductController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //$products = Product::with(['category', 'descuento'])->paginate(18);

        $descuento = Descuento::with('products')->paginate(18);
        return [
            'products' => $descuento->items(),
            'count' => $descuento->total(),
            'pages' => $descuento->lastPage(),
        ];
    }

    public function all()
    {
        $products = Product::with('discount')->paginate(18);
        return [
            'products' => $products->items(),
            'count' => $products->total(),
            'pages' => $products->lastPage(),
        ];
    }

    public function FilterProduct(Request $request)
    {
        $categories_id = $request->params['id_categories'];
        $collections_id = $request->params['id_collections'];
        $colors_id = $request->params['id_colors'];
        $products = Product::where('category_id', $categories_id)
                            ->orWhere('collection_id', $collections_id)
                            ->orWhere('color_id', $colors_id)
                            ->paginate(18);
        return [
            'products' => $products->items(),
            'count' => $products->total(),
            'pages' => $products->lastPage(),
        ];
    }

    public function tables(){
        $categories = Category::get();
        $collections = Collection::get();
        $brands = Brand::get();
        $colors = Color::get();
        $sizes = Size::get();
        return compact('categories', 'collections', 'brands', 'colors', 'sizes');
    }

    public function search(Request $request)
    {
        $key = $request['key'];
        if ( isset($key) ) {
            $products = Product::with('category')->where('name', 'like', "%{$key}%")->get();
            return ['products' => $products];
        }else{
            $products = Product::with('discount')->paginate(18);
            return [
                'products' => $products->items(),
                'count' => $products->total(),
                'pages' => $products->lastPage(),
            ];
        }

       /* $products = Product::with('category')->where('name', 'like', "%{$key}%")->get();
        if (count($products)) {
            return ['products' => $products];
        } else {
            return response('Sin resultados', 400);
        }*/
    }

    public function withInventory()
    {
        $products = Product::with('category')->paginate(18);
        return [
            'products' => $products->items(),
            'count' => $products->total(),
            'pages' => $products->lastPage(),
        ];
    }

    // public function withInventoryAll()
    // {
    //     $products = Product::with('category', 'subCategory')->get();
    //     return [ 'products' => $products ];
    // }

    public function checkInventory()
    {
        $products = Product::with('category')->get();
        return ['products' => $products];
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $product = new Product($request->product);
        $product->save();
        return ['product' => $product];
    }

    public function storeImage(Request $request)
    {
        $image_url = $request->image_url;
        if (isSet($image_url)) {
            Storage::delete($image_url);
        }
        $path = $request->file('image')->store('images');
        return $path;
    }

    public function getImage($id)
    {
        return Storage::download("images/$id");
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $product = Product::with('category')->find($id);
        return ['product' => $product];
    }

    public function inventoryAll($id)
    {
        if(request('rm')){
            $product = Product::with('category', 'inventory_rm')->find($id);
        }else{
            $product = Product::with('category', 'inventoryAll')->find($id);
        }

        return ['product' => $product];
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $product = Product::find($id);
        $product->fill($request->product);
        $product->save();
        return ['product' => $product];
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $product = Product::find($id);
        $product->delete();
    }

    public function searchByCharacterisc($key,$id)
    {
        $products = Product::where($key, $id)->get();
        if (count($products)) {
            return ['products' => $products];
        } else {
            return ['products' => []];
        }
    }

    public function GenerateQRProduct()
    {
            $data=Product::all();
            $products = Product::all();
            for ($i=0; $i < count($data); $i++) { 
                $array = $data[$i]->pluck('name');
                return view('QRGenerate.product_qrgenerate', compact('array','products'));
            }
        
    }

    public function PostDescuento(Request $request)
    {
        $descuento = new Discount();
        $descuento->products_id = $request['products_id'];
        $descuento->initial_date = $request['initial_date'];
        $descuento->final_date = $request['final_date'];
        $descuento->porcentage = $request['porcentaje'];
        $descuento->save();

        Product::where('id', $request['products_id'])->update([
            'discount_id' => $descuento->id,
        ]);


        return ['success' => 'Descuento'];
    }

    
}
