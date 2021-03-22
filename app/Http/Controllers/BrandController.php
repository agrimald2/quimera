<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use App\Brand;

class BrandController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $brands = Brand::paginate(18);
        return [
            'brands' => $brands->items(),
            'count' => $brands->total(),
            'pages' => $brands->lastPage(),
        ];
    }

    public function all()
    {
        $brands = Brand::all()->get();
        return [
            'brands' => $brands,
        ];
    }

    public function search($key)
    {
        $brands = Brand::where('name', 'like', "%{$key}%")->get();
        if (count($brands)) {
            return ['brands' => $brands];
        } else {
            return response('Sin resultados', 400);
        }
    }

    public function withInventory()
    {
        $brands = Brand::paginate(18);
        return [
            'brands' => $brands->items(),
            'count' => $brands->total(),
            'pages' => $brands->lastPage(),
        ];
    }

    // public function withInventoryAll()
    // {
    //     $brands = Brand::with('category', 'subCategory')->get();
    //     return [ 'brands' => $brands ];
    // }

    public function checkInventory()
    {
        $brands = Brand::all()->get();
        return ['brands' => $brands];
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $brand = new Brand($request->brand);
        $brand->save();
        return ['brand' => $brand];
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
        $brand = Brand::find($id);
        return ['brand' => $brand];
    }

    public function inventoryAll($id)
    {
        if(request('rm')){
            $brand = Brand::find($id);
        }else{
            $brand = Brand::find($id);
        }

        return ['brand' => $brand];
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
        $brand = Brand::find($id);
        $brand->fill($request->brand);
        $brand->save();
        return ['brand' => $brand];
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $brand = Brand::find($id);
        $brand->delete();
    }
}
