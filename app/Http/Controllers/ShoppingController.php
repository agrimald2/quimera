<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Str;
use App\Shopping;

class ShoppingController extends Controller
{

    const SESSION_ID_KEY = 'tmp_id';

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $sessionId = $this->getTemporalSessionId();

        $shoppings = Shopping::where('tmp_id', $sessionId)
            ->with('product')
            ->get();

        return response()->json([
            'shoppings' => $shoppings
        ]);
    }

    public function removeAll()
    {
        $sessionId = $this->getTemporalSessionId();
        
        $shoppings = Shopping::where('tmp_id', $sessionId)
            ->get();

        $shoppings->each->delete();

        return NULL;
    }


    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $sessionId = $this->getTemporalSessionId();
        
        $id = $request->input('productId');
        $qty = $request->input('counter', 1);

        $shopping = Shopping::where([
                'tmp_id' => $sessionId,
                'product_id' => $id,
            ])
            ->first();

        
        // Create if not exists
        if (!$shopping) {
            $shopping = new Shopping([
                'tmp_id' => $sessionId,
                'product_id' => $id,
            ]);
        }

        $shopping->counter = $qty;

        $shopping->save();
        
        return response()->json([
            'shopping' => $shopping
        ]);
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
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
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $sessionId = $this->getTemporalSessionId();

        $shopping = Shopping::where([
                'product_id' => $id,
                'tmp_id' => $sessionId,
            ])
            ->first();
        
        $shopping->delete();
        
        return $this->index();
    }


    public function getTemporalSessionId()
    {
        $sessionId = session('tmp_id');
        
        if (!$sessionId) {
            $sessionId = Str::random(10);
            session(['tmp_id' => $sessionId]);
        }

        return $sessionId;
    }


}
