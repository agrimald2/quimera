<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Discount extends Model
{
    protected $fillable = [
        'product_id',
        'initial_date',
        'final_date',
        'porcentage', 
    ];

    public function product()
    {
        return $this->belongsTo('App\Product');
    }
}