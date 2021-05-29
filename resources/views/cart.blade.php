@extends('layouts.public')
@section('content')

<script async src="https://geowidget.easypack24.net/js/sdk-for-javascript.js"></script>
<link rel="stylesheet" href="https://geowidget.easypack24.net/css/easypack.css"/>

<div class="container cart">
    <div class="row">
        <div class="col-12">
            @include('components.errors')
        </div>
    </div>
    @if ($cart->items->isNotEmpty())
    <form class="row no-gutters" method="post" action="/order" id="formCart">
        @csrf
        <div class="col-12 col-md-7">
            <div class="row bg-1 shadow mb-2">
                <div class="col-12 px-0 mb-2">
                    <div class="box-title">
                        Produkty
                    </div>
                </div>
                <table class="table mb-0">
                    <tbody>
                        @foreach ($cart->items as $item)
                            <tr>
                                <td><img src="{{$item->product->getImageUri()}}"  class="img-thumbnail"alt=""></td>
                                <td class="align-middle">{{$item->product->name}}</td>
                                <td class="align-middle text-center">
                                    <input type="text" class="form-control w-50 w-md-25" name="amounts[{{$item->id}}]" value="{{$item->amount}}">

                                </td>
                                <td class="align-middle">{{price($item->getSum())}}</td>
                            </tr>
                        @endforeach

                    </tbody>
                </table>
                <div class="col-12 text-right pb-2">
                    <button class="btn btn-info" name="update" onclick="cart.updateAmounts()" type="button">Aktualizuj ilości</button>
                </div>
            </div>
            <div class="row bg-1 shadow mb-2 py-2">
                <div class="col-12 px-0 mb-2">
                    <div class="box-title">
                        Dane adresowe
                    </div>
                </div>
              <div class="col-12 col-md-6 pb-2">
                <input type="text" class="form-control" name="cart_name" placeholder="Imie">
              </div>
              <div class="col-12 col-md-6 pb-2">
                <input type="text" class="form-control" name="cart_surname" placeholder="Nazwisko">
              </div>
              <div class="col-12 col-md-6 pb-2">
                <input type="text" class="form-control" name="cart_city" placeholder="Miasto">
              </div>
              <div class="col-12 col-md-6 pb-2">
                <input type="text" class="form-control" name="cart_street" placeholder="Ulica">
              </div>
              <div class="col-12 col-md-6 pb-2">
                <input type="text" class="form-control" name="cart_code" placeholder="Kod pocztowy">
              </div>
              <div class="col-12 col-md-6 pb-2">
                <select name="cart_country" class="form-control">
                    <option value="Polska"> Polska</option>
                </select>
              </div>
            </div>
            <div class="row bg-1 shadow mb-2">
                <div class="col-12 px-0 mb-2">
                    <div class="box-title">
                        Dostawa
                    </div>
                </div>
                <table class="table mb-0">
                    <tbody>
                        @foreach ($deliveries as $delivery)
                            <tr>
                                <td>
                                    <input class=""  data-id="{{$delivery->id}}" data-price="{{$delivery->price}}" type="radio" onchange="cart.changeDelivery(this)" name="delivery" id="delivery_{{$delivery->id}}" value="{{$delivery->id}}">
                                </td>
                                <td class="align-middle">
                                <label class="form-check-label" for="delivery_{{$delivery->id}}">
                                    {{$delivery->name}}
                                </label>
                                @if ($delivery->show_inpost_widget)
                                <input type="hidden" name="delivery_data" id="delivery_data" value="">
                                    <button class="btn btn-primary btn-sm ml-3 btn-paczkomat" type="button" onclick="cart.showInpostModal(this)">Wybierz paczkomat</button>
                                @endif
                                </td>
                                <td class="align-middle">{{price($delivery->price)}}</td>
                            </tr>
                        @endforeach

                    </tbody>
                </table>
            </div>
        </div>
        <div class="col-12 col-md-4 offset-md-1 mt-2 mt-md-0">
            <div class="row bg-1 shadow">
                <div class="col-12 px-0 mb-2">
                    <div class="box-title">
                        Podsumowanie
                    </div>
                </div>
                <div class="col-12">
                    <table class="table">
                        <tbody>
                            <tr>
                                <td class="text-center align-middle">Produkty</td>
                                <td class="text-center align-middle"  id="price_products" data-sum="{{$cart->getCartSum()}}">{{price($cart->getCartSum())}}</td>
                            </tr>
                            <tr>
                                <td class="text-center align-middle">Dostawa</td>
                                <td class="text-center align-middle" id="price_delivery">{{price(0)}}</td>
                            </tr>
                            <tr>
                                <td class="text-center align-middle h5">Do zapłaty</td>
                                <td class="text-center align-middle h5" id="price_sum">{{price($cart->getCartSum())}}</td>
                            </tr>
                        </tbody>
                    </table>
                </div>
                <div class="col-12 text-center py-2">
                    <button class="btn btn-primary">Złóż zamówienie</button>
                </div>
            </div>
        </div>
    </form>
    @else
    <div class="row bg-1 shadow mb-2">
        <div class="col-12 px-0 mb-2">
            <div class="box-title">
                Koszyk
            </div>
            <div class="text-center">
                Twój koszyk jest pusty
            </div>
        </div>
    @endif

</div>


@endsection
