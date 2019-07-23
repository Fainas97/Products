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

    protected function pricesWithDiscountGlobal($prices, $products)
    {
        $i = 0;
        $globalDis = config('price.global');
        foreach ($products as $product) {
            $a = substr($globalDis, 0, -1);
            if ($product->discount > 0) {
                $prices[$i] -= $product->discount;
            } else if (substr($globalDis, -1) != '%' && $globalDis > 0) {
                $prices[$i] -= $globalDis;
            } else if (substr($globalDis, -1) == '%' && substr($globalDis, 0, -1) > 0) {
                $prices[$i] -= $prices[$i] / 100 * substr($globalDis, 0, -1);
            }
            $i++;
        }
        return $prices;
    }

    public function pricesCalculation($products)
    {
        $prices = [];
        if (config('price.flag')) {
            foreach ($products->items() as $item) {
                $prices[] = $item->price + $item->price / 100 * config('price.tax');
            }
        } else {
            $prices = array_column($products->items(), 'price');
        }
        $prices = $this->pricesWithDiscountGlobal($prices, $products->items());
        return $prices;
    }

    public function priceCalculation($product)
    {
        $price = $product->price;
        $globalDis = config('price.global');
        if (config('price.flag')) {
            $price += $price / 100 * config('price.tax');
        }
        if ($product->discount > 0) {
            $price -= $product->discount;
        } else if (substr($globalDis, -1) != '%' && $globalDis > 0) {
            $price -= $globalDis;
        } else if (substr($globalDis, -1) == '%' && substr($globalDis, 0, -1) > 0) {
            $price -= $price / 100 * substr($globalDis, 0, -1);
        }
        return $price;
    }
}
