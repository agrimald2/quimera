<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Product extends Model
{
    use SoftDeletes;

    protected $with = ['inventoryShop', 'category', 'collection', 'color', 'size'];

    protected $fillable = [
        'name', 
        'description', 
        'sale_price',
        'category_id',
        'image_url',
        'image_second',
        'image_third',
        'unit_code',
        'collection_id',
        'brand_id',
        'color_id',
        'discount_id',
        'size_id',
        'new_product',
    ];

    protected $casts = [
      'sale_price' => 'double',
    ];

    protected $appends = [
      'weights',
      'packages',
      'picked',
      'unit',
      'short_unit'
    ];

    public function getPickedAttribute()
    {
        return [];
    }

    public function getUnitAttribute()
    {
        switch ($this->unit_code) {
          case 'KGM':
            return 'Kilogramos';
          case 'BO':
            return 'Botellas';
          case 'BG':
            return 'Bolsas';
          case 'BX':
            return 'Cajas';
          default:
            return 'Unidades';
        }
    }

    public function getShortUnitAttribute()
    {
        switch ($this->unit_code) {
          case 'KGM':
            return 'Kg';
          case 'BG':
            return 'Bol';
          case 'BO':
            return 'Bot';
          case 'BX':
            return 'Caj';
          default:
            return 'Ud';
        }
    }

    public function getWeightsAttribute()
    {
        return $this->inventory->sum('weight');
    }

    public function getPackagesAttribute()
    {
      return $this->inventory->count();
    }

    public function category()
    {
      return $this->belongsTo('App\Category');
    }

    public function subCategory()
    {
      return $this->belongsTo('App\SubCategory');
    }

    public function inventoryShop() {
      return $this->hasMany('App\Inventory')->where([
        'sale_id' => NULL,
        'office_id' => 1,
      ])->orderBy('weight', 'desc');
    }

    public function inventory() {
      return $this->hasMany('App\Inventory')->where([
        'sale_id' => NULL,
        'office_id' => session('officeId'),
      ])->orderBy('weight', 'desc');
    }

    public function inventoryAll() {
      return $this->hasMany('App\Inventory')->where([
        'office_id' => session('officeId'),
      ])->orderBy('weight', 'desc');
    }

    public function inventory_rm() {
      return $this->hasMany('App\Inventory')->where('raw_material_id',request('rm'))->orderBy('weight', 'desc');
    }

    public function color()
    {
        return $this->belongsTo('App\Color');
    }
    public function discount()
    {
        return $this->belongsTo('App\Discount')
          ->withDefault();
    }
    public function collection()
    {
        return $this->belongsTo('App\Collection');
    }
    public function brand()
    {
        return $this->belongsTo('App\Brand');
    }
    public function size()
    {
        return $this->belongsTo('App\Size');
    }
}
