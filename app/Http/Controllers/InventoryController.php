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
                $inventory->save();

                Inventory::where('id',$inventory->id)->update([
                    'codigo' => $inventory->id.'-'.Str::random(4),
                ]);

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
            $data=Inventory::where('sale_id',NULL)->get();
            for ($i=0; $i < count($data); $i++) { 
                $array = $data[$i]->pluck('codigo');
                $array2 = $data[$i];
                return view('QRGenerate.pdf_qrgenerate', compact('array','array2'));
            }
        
    }

    public function GenerateQR_PackProducts($id_product)
    {
            $data=Inventory::where('product_id', $id_product)
                            ->where('sale_id', NULL)
                            ->get()
                            ->each(function($i){
                                $i->items()->each(function($j){
                                    $j;
                                });
                            });
            return dd($data);
            /*for ($i=0; $i < count($data); $i++) { 
                $array = $data[$i]->pluck('codigo');
                $array2 = $data[$i];
            } */
            //return view('QRGenerate.pdf_qrgenerate', compact('array','array2'));
    }

    public function GenerateQR_Products($codigo)
    {
            $array=Inventory::where('codigo', $codigo)->first();
            return view('QRGenerate.qr_product_inventory', compact('array'));
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

    public function FilterInventory(Request $request)
    {
        $categories_id = $request->params['id_categories'];
        $collections_id = $request->params['id_collections'];
        $date_init = (new DateTime($request->params['date_init']))->format('Y-m-d');
        $date_end = (new DateTime($request->params['date_end']))->format('Y-m-d');
        $products = Product::where('category_id', $categories_id)
                            ->orWhere('collection_id', $collections_id)
                            ->whereBetween('created_at', [$date_init, $date_end])
                            ->paginate(18);
        return [
            'products' => $products->items(),
            'count' => $products->total(),
            'pages' => $products->lastPage(),
        ];
    }



}