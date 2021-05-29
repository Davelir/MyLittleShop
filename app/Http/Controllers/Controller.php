<?php

namespace App\Http\Controllers;

use App\Cart;
use Illuminate\Contracts\View\View;
use Illuminate\Foundation\Bus\DispatchesJobs;
use Illuminate\Routing\Controller as BaseController;
use Illuminate\Foundation\Validation\ValidatesRequests;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use Illuminate\Http\Client\Request;
use Illuminate\Support\Facades\Cookie;

class Controller extends BaseController
{
    use AuthorizesRequests, DispatchesJobs, ValidatesRequests;

    public function __construct(){

        // dd(request()->cookie('cart'));
        if(Cookie::has(Cart::COOKIE_NAME)){
            $cart = Cart::getCart();
        }else{
            $cart = false;
        }

        view()->share('cart', $cart);
    }
}
