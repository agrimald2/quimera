<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use App\Collection;

class CollectionController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $collections = Collection::paginate(18);
        return [
            'collections' => $collections->items(),
            'count' => $collections->total(),
            'pages' => $collections->lastPage(),
        ];
    }

    public function all()
    {
        $collections = Collection::all()->get();
        return [
            'collections' => $collections,
        ];
    }

    public function search($key)
    {
        $collections = Collection::where('name', 'like', "%{$key}%")->get();
        if (count($collections)) {
            return ['collections' => $collections];
        } else {
            return response('Sin resultados', 400);
        }
    }

    public function withInventory()
    {
        $collections = Collection::paginate(18);
        return [
            'collections' => $collections->items(),
            'count' => $collections->total(),
            'pages' => $collections->lastPage(),
        ];
    }

    // public function withInventoryAll()
    // {
    //     $collections = Collection::with('category', 'subCategory')->get();
    //     return [ 'collections' => $collections ];
    // }

    public function checkInventory()
    {
        $collections = Collection::all()->get();
        return ['collections' => $collections];
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $collection = new Collection($request->collection);
        $collection->save();
        return ['collection' => $collection];
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
        $collection = Collection::find($id);
        return ['collection' => $collection];
    }

    public function inventoryAll($id)
    {
        if(request('rm')){
            $collection = Collection::find($id);
        }else{
            $collection = Collection::find($id);
        }

        return ['collection' => $collection];
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
        $collection = Collection::find($id);
        $collection->fill($request->collection);
        $collection->save();
        return ['collection' => $collection];
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $collection = Collection::find($id);
        $collection->delete();
    }
}
