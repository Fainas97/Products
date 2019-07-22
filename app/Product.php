<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
    protected $fillable = ['name', 'sku', 'status', 'price',
        'special_price', 'image', 'description'];

    public function rating()
    {
        return $this->hasMany('App\Rating', 'product_id', 'id');
    }
}
