<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Collection extends Model
{
    protected $fillable = [
        'name',
        'image_url'
    ];

    public function product()
    {
        return $this->belongsTo('App\Product');
    }
}