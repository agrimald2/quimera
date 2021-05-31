<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Storage;
use App\Inventory;
use App\Product;
use App\RawMaterial;
use App\Sale;
use DateTime;
use Illuminate\Support\Facades\Auth;
use SimpleSoftwareIO\QrCode\Facades\QrCode;

class InventoryController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $sd = (new DateTime($request->sd))->format('Y-m-d');
        $ed = (new DateTime($request->ed))->modify('+1 day')->format('Y-m-d');
        $sales = Sale::whereBetween('created_at', [$sd, $ed])->get();
        $salesId = $sales->map(function($item) {
            return $item->id;
        });
        $inventories = Inventory::with(['product' => function($query) {
                return $query->with('category', 'subCategory');
            }])
            ->with(['sale' => function($query) {
                return $query->with('customer', 'delivery');
            }])
            ->whereIn('sale_id', $salesId)
            ->get();
        return ['inventories' => $inventories];
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        foreach ($request->inventories as $item) {
            for ($i=0; $i < $item['quantity']; $i++) { 
                $inventory = new Inventory($item);
                if(!$inventory->office_id)
                {
                    $inventory->office_id = session('officeId');
                }
                $inventory->user_id = Auth::id();
                $inventory->codigo = Str::random(10);
                $inventory->save();

                if($inventory->raw_material_id)
                {
                    $rawMaterial = RawMaterial::find($inventory->raw_material_id );
                    $rawMaterial->weight_remaining -= $inventory->weight;
                    $rawMaterial->status = 1;
                    $rawMaterial->save();
                }
            }
        }

        return NULL;
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
        $inventory = Inventory::find($id);
        $inventory->fill($request->inventory);
        $inventory->save();
        return ['inventory' => $inventory];
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $inventory = Inventory::find($id);

        if($inventory->raw_material_id)
        {
            $rawMaterial = RawMaterial::find($inventory->raw_material_id);
            $rawMaterial->weight_remaining += $inventory->weight;
            $rawMaterial->save();
        }

        $inventory->delete();
    }

    public function GenerateQR()
    {
            $data=Inventory::all();
            for ($i=0; $i < count($data); $i++) { 
                $array = $data[$i]->pluck('codigo');
                return view('QRGenerate.pdf_qrgenerate', compact('array'));
            }
        
    }



    public function ScannerInventories($code_inventorie)
    {

        $inventories = Inventory::where('codigo', $code_inventorie)->first();

        $products = Product::with('category')->where('id', $inventories->product_id )->get();

        if (count($products)) {
            return ['inventories' => $inventories, 'products' => $products];
        } else {
            return response('Sin resultados', 400);
        }

    
    }



}