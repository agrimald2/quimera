<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class SaleDetail extends Model
{
     use SoftDeletes;

     protected $table='sales_details';

    protected $fillable = [
        'product_id',
        'sale_id',
        'office_id'
    ];


    public function product()
    {
      return $this->belongsTo('App\Product');
    }

    public function sale()
    {
      return $this->belongsTo('App\Sale');
    }

    public function office()
    {
      return $this->belongsTo('App\Office');
    }

}
