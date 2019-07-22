<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
    protected $fillable = ['name', 'sku', 'status', 'price',
        'discount', 'image', 'description'];

    public function rating()
    {
        return $this->hasMany('App\Rating', 'product_id', 'id');
    }

    public function review()
    {
        return $this->hasMany('App\Review', 'product_id', 'id');
    }
}
