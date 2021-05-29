<?php

namespace App\Http\Controllers;

use App\Cart;
use App\Order;
use App\OrderAddress;
use App\OrderProduct;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Cookie;
use Illuminate\Support\Facades\DB;

class OrderController extends Controller
{
    public function create(){

        $validate = request()->validate([
            "cart_name" => "required",
            "cart_surname" => "required",
            "cart_city" => "required",
            "cart_street" => "required",
            "cart_code" => "required",
            "cart_country" => "required",
            "delivery" => "required"
        ],
        [
            'cart_name.required' => 'Imie jest wymagane!',
            'cart_surname.required' => 'Nazwisko jest wymagane!',
            'cart_city.required' => 'Miasto jest wymagane!',
            'cart_street.required' => 'Ulica jest wymagana!',
            'cart_code.required' => 'Kod pocztowy jest wymagany!',
            'cart_country.required' => 'Kraj jest wymagane!',
            'delivery.required' => 'Wybierz formę dostawy!',
        ]);

        $cart = Cart::getCart();
        $user = Auth::user();


        // todo - coś nie zapisuje danych do bazy
        DB::enableQueryLog();
        DB::beginTransaction();

        try {
            $address = OrderAddress::create([
                "name" => $validate['cart_name'],
                "surname" => $validate['cart_surname'],
                "city" => $validate['cart_city'],
                "street" => $validate['cart_street'],
                "postcode" => $validate['cart_code'],
                "country" => $validate['cart_country'],
            ]);
            $order = Order::create([
                "hash" => $cart->hash,
                "user_id" => $user->id,
                "tracking_number" => '',
                "delivery_id" => $validate['delivery'],
                "delivery_data" => request()->input('delivery_data') === null ? '' : request()->input('delivery_data'),
                "address_id" => $address->id,
            ]);
                // dd($order);
            foreach ($cart->items as $item) {
                $product = OrderProduct::create([
                    "product_id" => $item->product_id,
                    "order_id" => $order->id,
                    "price" => $item->price,
                    "amount" => $item->amount,
                ]);
            }
            // dd(DB::getQueryLog());
        } catch (\Throwable $th) {
            dd($th->getMessage());
            DB::rollBack();
            return redirect()->back()->with('danger','Błąd podczas składania zamówienia')->withInput();
        }
        DB::commit();
        return redirect()->route('orderDetails', ['hash' => $cart->hash])->withCookie(Cart::COOKIE_NAME,null,0);





    }

    public function details($hash){

        $order = Order::where('hash',$hash)->with('address','products')->firstOrFail();
        // dd($order);
        return view('orderDetails')
        ->with('order',$order);

    }
    public function list(){
        $user = Auth::user();
        $orders = Order::where('user_id',$user->id)->get();
        // dd($orders);
        return view('orderList')
        ->with('orders',$orders);

    }
}
