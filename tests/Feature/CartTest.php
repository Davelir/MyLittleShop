<?php

namespace Tests\Feature;

use App\Cart;
use App\Product;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class CartTest extends TestCase
{
    public function testAddProductToCart()
    {
        $product_id = Product::where('active',1)->first()->id;
        $response = $this
        ->post('/cart/add',[
            'product_id' => $product_id
        ]);

        $response->assertCookie(Cart::COOKIE_NAME);
        $response->assertStatus(302);

    }
}
