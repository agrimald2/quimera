<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\SaleDetail;
use App\Sale;
use App\Category;
use App\Brand;
use App\Collection;
use App\Product;

class SaleDetailController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $query = \DB::table('sales_details')
                ->join('products', 'sales_details.product_id','=','products.id')
                ->join('sales', 'sales_details.sale_id','=','sales.id')
                ->join('brands', 'products.brand_id','=','brands.id')
                ->join('collections', 'products.collection_id','=','collections.id')
                ->join('categories', 'products.category_id','=','categories.id')
                ->join('customers', 'sales.customer_id','=','customers.id')
                ->select('products.*','sales_details.*','sales.*', 'brands.*','collections.*', 'categories.*', 'customers.*');
        $salesdetails = $query->paginate(18);
        return [
            'salesdetails' => $salesdetails->items(),
            'count' => $salesdetails->total(),
            'pages' => $salesdetails->lastPage(),
        ];
    }



    public function findDetails(Request $request)
    {
        $key = $request->key;
        $query = \DB::table('sales_details')
                ->join('products', 'sales_details.product_id','=','products.id')
                ->join('sales', 'sales_details.sale_id','=','sales.id')
                ->join('brands', 'products.brand_id','=','brands.id')
                ->join('collections', 'products.collection_id','=','collections.id')
                ->join('categories', 'products.category_id','=','categories.id')
                ->join('customers', 'sales.customer_id','=','customers.id')
                ->where('products.name', 'like', "{$key}%")
                ->orWhere('categories.name', 'like', "{$key}%")
                ->orWhere('brands.name', 'like', "{$key}%")
                ->orWhere('collections.name', 'like', "{$key}%")
                ->orWhere('customers.name', 'like', "{$key}%")
                ->select('products.*','sales_details.*','sales.*', 'brands.*','collections.*', 'categories.*', 'customers.*');
        $salesdetails = $query->paginate(18);
        return [
            'salesdetails' => $salesdetails->items(),
            'count' => $salesdetails->total(),
            'pages' => $salesdetails->lastPage(),
        ];
    }
    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
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
        //
    }
}
