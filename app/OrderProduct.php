<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class OrderProduct extends Model
{
    protected $table = 'orders_products';

    protected $guarded = [];
    protected $with = ['product'];
    public function product(){
        return $this->belongsTo(Product::class,'product_id');
    }
}
