<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Collection extends Model
{
    protected $fillable = [
        'name',
        'image_url',
        'date_start',
        'date_end'
    ];

    public function product()
    {
        return $this->belongsTo('App\Product');
    }
}