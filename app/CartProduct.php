<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class CartProduct extends Model
{
    public $table = 'carts_products';

    public function product(){
        return $this->belongsTo('App\Product');
    }
    public function cart(){
        return $this->belongsTo('App\Cart');
    }
    public function getSum(){
        return $this->amount*$this->price;
    }
}
