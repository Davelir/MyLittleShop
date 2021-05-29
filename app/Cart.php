<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Cookie;
use Illuminate\Support\Facades\Crypt;

class Cart extends Model
{
    const COOKIE_NAME = 'cart';
    const COOKIE_TIME = 60 * 24 * 30; // 30 days
    public static function getCart($cookieResponse = true){

        if(Cookie::has(self::COOKIE_NAME)){
            $cookieHash = Cookie::get(self::COOKIE_NAME);
            return Cart::where('hash',$cookieHash)->first();
        }

        $cart = new Cart;
        $cart->hash = hash('sha256',time().rand(0,100000));
        $cart->save();

        if($cookieResponse) Cookie::queue(self::COOKIE_NAME,$cart->hash,self::COOKIE_TIME);
        return $cart;
    }

    public function getCartSum(){
        $sum = 0;
        foreach ($this->items as $item) {
            $sum += $item->price*$item->amount;
        }
        return $sum;
    }
    public function getCartAmount(){
        $amount = 0;
        foreach ($this->items as $item) {
            $amount += $item->amount;
        }
        return $amount;
    }
    public function items(){
        return $this->hasMany('App\CartProduct');

    }
}
