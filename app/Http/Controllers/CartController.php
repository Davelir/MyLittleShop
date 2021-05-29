<?php

namespace App\Http\Controllers;

use App\Cart;
use App\CartProduct;
use App\Delivery;
use App\Product;
use Illuminate\Http\Request;

class CartController extends Controller
{
    public function index(){
        $cart = Cart::getCart();
        $deliveries = Delivery::where('is_enable',1)->get();
        return view('cart')
        ->with('cart',$cart)
        ->with('deliveries',$deliveries);
    }

    public function add(){
        $cart = Cart::getCart();

        request()->validate([
            'product_id' => 'required:integer'
        ],[
            'product_id.required' => 'Brak ID produktu',
            'product_id.integer' => 'ID produktu nieprawidłowe',
        ]);
        try {
            if(CartProduct::where('cart_id',$cart->id)->where('product_id',request()->product_id)->count() == 1){
                $cartItem = CartProduct::where('cart_id',$cart->id)->where('product_id',request()->product_id)->firstOrFail();
                $cartItem->amount = $cartItem->amount+1;
                $cartItem->save();

            }else{

                $product = Product::findOrFail(request()->product_id);
                $cartItem = new CartProduct;
                $cartItem->cart_id = $cart->id;
                $cartItem->product_id = $product->id;
                $cartItem->price = $product->price;
                $cartItem->amount = 1;
                $cartItem->save();
            }
        } catch (\Throwable $th) {
            abort(404);
        }

        return redirect()->back();

    }

    public function remove(){
        $cart = Cart::getCart();
        request()->validate([
            'product_id' => 'required:integer'
        ],[
            'product_id.required' => 'Brak ID produktu',
            'product_id.integer' => 'ID produktu nieprawidłowe',
        ]);

        $cartItem = CartProduct::where('cart_id',$cart->id)->where('product_id',request()->product_id)->firstOrFail();
        $cartItem->delete();
        return redirect()->back();
    }

    public function update(){

        $cart = Cart::getCart();
        if(request()->has('amounts')){
            foreach (request()->input('amounts') as $itemId => $itemAmount) {
                $item = CartProduct::where('id',$itemId)->where('cart_id',$cart->id)->firstOrFail();
                if($itemAmount == 0){
                    $item->delete();
                    continue;
                }
                $item->amount = $itemAmount;
                $item->save();
            }
        }

        return redirect()->back();
    }
}
