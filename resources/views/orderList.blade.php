@extends('layouts.public')
@section('content')

    <div class="container">
        <div class="row bg-1 shadow mb-2 pb-2">
            <div class="col-12 px-0 mb-2">
                <div class="box-title">
                    Lista zamówień
                </div>
            </div>
            <div class="col-12">
                <div class="list-group">
                    @foreach ($orders as $order)
                        <a href="{{route('orderDetails',['hash' => $order->hash])}}" class="list-group-item list-group-item-action">
                            <div class="row">
                                <div class="col-12 col-md-3">Zamówienie #{{$order->id}}</div>
                                <div class="col-6 col-md-3 text-center">{{$order->getOrderAmount()}}</div>
                                <div class="col-6 col-md-3 text-center">{{$order->getStatusText()}}</div>
                                <div class="col-6 col-md-3 text-right">{{$order->created_at}}</div>
                            </div>
                        </a>
                    @endforeach
                </div>

            </div>

        </div>
    </div>

@endsection
