<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Descuento extends Model
{
    use SoftDeletes;

    protected $table='descuento';

    protected $with = ['products'];

    protected $fillable = [
        'products_id',
        'initial_date',
        'final_date',
        'porcentaje'
    ];


    public function products()
    {
        return $this->belongsTo('App\Product');
    }


}
