<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Discount extends Model
{
    protected $fillable = [
        'porcentage', 
    ];

    public function product()
    {
        return $this->belongsTo('App\Product');
    }
}