<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use App\Size;

class SizeController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $sizes = Size::paginate(18);
        return [
            'sizes' => $sizes->items(),
            'count' => $sizes->total(),
            'pages' => $sizes->lastPage(),
        ];
    }

    public function all()
    {
        $sizes = Size::all()->get();
        return [
            'sizes' => $sizes,
        ];
    }

    public function search($key)
    {
        $sizes = Size::where('name', 'like', "%{$key}%")->get();
        if (count($sizes)) {
            return ['sizes' => $sizes];
        } else {
            return response('Sin resultados', 400);
        }
    }

    public function withInventory()
    {
        $sizes = Size::paginate(18);
        return [
            'sizes' => $sizes->items(),
            'count' => $sizes->total(),
            'pages' => $sizes->lastPage(),
        ];
    }

    // public function withInventoryAll()
    // {
    //     $sizes = Size::with('category', 'subCategory')->get();
    //     return [ 'sizes' => $sizes ];
    // }

    public function checkInventory()
    {
        $sizes = Size::all()->get();
        return ['sizes' => $sizes];
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $size = new Size($request->size);
        $size->save();
        return ['size' => $size];
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
        $size = Size::find($id);
        return ['size' => $size];
    }

    public function inventoryAll($id)
    {
        if(request('rm')){
            $size = Size::find($id);
        }else{
            $size = Size::find($id);
        }

        return ['size' => $size];
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
        $size = Size::find($id);
        $size->fill($request->size);
        $size->save();
        return ['size' => $size];
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $size = Size::find($id);
        $size->delete();
    }
}
