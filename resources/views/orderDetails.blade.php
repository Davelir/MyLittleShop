@extends('layouts.public')
@section('content')

    <div class="container">
        <div class="row bg-1 shadow mb-2 pb-2">
            <div class="col-12 px-0 mb-2">
                <div class="box-title">
                    Zamówienie
                </div>
            </div>
            <div class="col-12 col-md-6 col-xl-4">
                <div class="card">
                    <div class="card-body">
                        <h4 class="card-title">Adres dostawy</h4>
                        <p class="card-text">
                            {{$order->address->name}} {{$order->address->surname}} <br>
                            ul. {{$order->address->street}} <br>
                            {{$order->address->postcode}} {{$order->address->city}} <br>
                            {{$order->address->country}}
                        </p>
                    </div>
                </div>
            </div>
            <div class="col-12 col-md-6 col-xl-4">
                <div class="card">
                    <div class="card-body">
                        <h4 class="card-title">Szczegóły</h4>
                        <p class="card-text">
                            <table class="table">
                                <tbody>
                                    <tr class="">
                                        <td>Numer</td>
                                        <td>{{$order->id}}</td>
                                    </tr>
                                    <tr>
                                        <td>Status</td>
                                        <td>{{$order->getStatusText()}}</td>
                                    </tr>
                                    <tr>
                                        <td>Data złożenia</td>
                                        <td>{{$order->created_at}}</td>
                                    </tr>
                                    <tr>
                                        <td>Numer przewozowy</td>
                                        <td>{{$order->tracking_number}}</td>
                                    </tr>

                                </tbody>
                            </table>
                        </p>
                    </div>
                </div>
            </div>
            <div class="col-12">
                <h5>Produkty</h5>
                <table class="table">
                    <tbody>
                        @foreach ($order->products as $product)

                        @endforeach
                        <tr>
                            <td><img class="img-thumbnail img-min "src="{{$product->product->getImageUri()}}" alt="product image"></td>
                            <td>{{$product->product->name}}</td>
                            <td>{{$product->id}}</td>
                            <td>{{price($product->amount*$product->price)}}</td>
                        </tr>
                    </tbody>
                </table>
            </div>
        </div>
    </div>

@endsection
