<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Color extends Model
{
    protected $fillable = [
        'name', 'hex'
    ];

    public function product()
    {
        return $this->belongsTo('App\Product');
    }
}