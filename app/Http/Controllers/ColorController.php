<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use App\Color;

class ColorController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $colors = Color::paginate(18);
        return [
            'colors' => $colors->items(),
            'count' => $colors->total(),
            'pages' => $colors->lastPage(),
        ];
    }

    public function all()
    {
        $colors = Color::all()->get();
        return [
            'colors' => $colors,
        ];
    }

    public function search($key)
    {
        $colors = Color::where('name', 'like', "%{$key}%")->get();
        if (count($colors)) {
            return ['colors' => $colors];
        } else {
            return response('Sin resultados', 400);
        }
    }

    public function withInventory()
    {
        $colors = Color::paginate(18);
        return [
            'colors' => $colors->items(),
            'count' => $colors->total(),
            'pages' => $colors->lastPage(),
        ];
    }

    // public function withInventoryAll()
    // {
    //     $colors = Color::with('category', 'subCategory')->get();
    //     return [ 'colors' => $colors ];
    // }

    public function checkInventory()
    {
        $colors = Color::all()->get();
        return ['colors' => $colors];
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $color = new Color($request->color);
        $color->save();
        return ['color' => $color];
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
        $color = Color::find($id);
        return ['color' => $color];
    }

    public function inventoryAll($id)
    {
        if(request('rm')){
            $color = Color::find($id);
        }else{
            $color = Color::find($id);
        }

        return ['color' => $color];
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
        $color = Color::find($id);
        $color->fill($request->color);
        $color->save();
        return ['color' => $color];
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $color = Color::find($id);
        $color->delete();
    }
}
