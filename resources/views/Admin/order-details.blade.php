@extends('layouts.admin')
@section('content')

<script>
    function setAllProductsAmount(){
        $('.order-product').each((key,el) => {
            $(el).val($(el).data('amount'));
        });
    }
</script>
    <div class="row">
        <div class="col-12">
            <div class="card">
                <div class="card-header">
                    Szczegóły zamówienia
                </div>
                <div class="card-body">
                    <form class="row" method="POST">
                        @csrf
                        <div class="col-6 mb-3">
                            <div class="card">
                                <div class="card-body">
                                    <h4 class="card-title">Dane zamówienia</h4>
                                    <table class="table">
                                        <tbody>
                                            <tr>
                                                <td>ID</td>
                                                <td> {{$order->id}}</td>
                                            </tr>
                                            <tr>
                                                <td>Status</td>
                                                <td>
                                                    <select name="order_status" id="" class="form-control">
                                                        @foreach ($statuses as $statusId => $status)
                                                            <option value="{{$statusId}}" @if ($statusId == $order->status) selected @endif>{{$status}}</option>
                                                        @endforeach
                                                    </select>
                                                </td>
                                            </tr>
                                            <tr>
                                                <td>Rodzaj dostawy</td>
                                                <td> {{$order->delivery->name}}</td>
                                            </tr>
                                            </tr>
                                            <tr>
                                                <td>Dane dodatkowe dostawy</td>
                                                <td> {{$order->delivery_data}}</td>
                                            </tr>
                                            <tr>
                                                <td>Numer przewozowy</td>
                                                <td> <input type="text" class="form-control" name="tracking_number" value="{{$order->tracking_number}}"></td>
                                            </tr>
                                        </tbody>
                                    </table>

                                    <div class="w-100 text-center py-2">
                                        <button class="btn btn-primary">Zapisz</button>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <div class="col-6 mb-3">
                            <div class="card">
                                <div class="card-body">
                                    <h4 class="card-title">Dane adresowe</h4>
                                    <table class="table">
                                        <tbody>
                                            <tr>
                                                <td>Imie</td>
                                                <td> {{$order->address->name}}</td>
                                            </tr>
                                            <tr>
                                                <td>Nazwisko</td>
                                                <td> {{$order->address->surname}}</td>
                                            </tr>
                                            <tr>
                                                <td>Miasto</td>
                                                <td> {{$order->address->city}}</td>
                                            </tr>
                                            <tr>
                                                <td>Ulica</td>
                                                <td> {{$order->address->street}}</td>
                                            </tr>
                                            <tr>
                                                <td>Kod pocztowy</td>
                                                <td> {{$order->address->postcode}}</td>
                                            </tr>
                                            <tr>
                                                <td>Kraj</td>
                                                <td> {{$order->address->country}}</td>
                                            </tr>

                                        </tbody>
                                    </table>
                                </div>
                            </div>
                        </div>

                        <div class="col-12">
                            <div class="card">
                                <div class="card-body">
                                    <div class="row">
                                        <div class="col-6">
                                            <h4 class="card-title">Produkty</h4>
                                        </div>
                                        <div class="col-6 text-right">
                                            <button class="btn btn-primary btn-sm" type="button" onclick="setAllProductsAmount()">Ustaw wszystkie jako wysłane</button>
                                        </div>
                                    </div>

                                    <table class="table">
                                        <thead>
                                            <tr>
                                                <th>ID</th>
                                                <th>Nazwa</th>
                                                <th>Cena</th>
                                                <th>Ilość zamówiona</th>
                                                <th>Ilość wysłana</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            @foreach ($order->products as $orderProduct)
                                            <tr>
                                                <td>{{$orderProduct->product->id}}</td>
                                                <td>{{$orderProduct->product->name}}</td>
                                                <td>{{$orderProduct->price}}</td>
                                                <td>{{$orderProduct->amount}}</td>
                                                <td>
                                                    <input type="text" class="form-control order-product" data-amount="{{$orderProduct->amount}}" name="product_amount[{{$orderProduct->id}}]" value="{{$orderProduct->amount_delivered}}">
                                                </td>
                                            </tr>
                                            @endforeach

                                        </tbody>
                                    </table>
                                </div>
                            </div>
                        </div>
                    </div>

                </div>

            </div>
        </div>
    </div>
@endsection
