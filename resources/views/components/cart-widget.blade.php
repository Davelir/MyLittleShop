<div class="cart-wrapper">
    <div class="cart-box shadow p-2">
        <div class="row">
            <div class="col-12">
                <div class="row">
                    <div class="col-12 h5 text-center py-2">
                        Twój koszyk
                    </div>
                </div>
                {{-- {{dd($cart->items)}} --}}
                @if ($cart)
                <div class="row mx-0">
                    @if ($cart->items->isNotEmpty())
                        @foreach ($cart->items as $item)
                            <div class="col-12 py-1 border-bottom">
                                <div class="row no-gutters">
                                    <div class="col-1 ">
                                        <form action="/cart/remove" method="post">
                                            @csrf
                                            <input type="hidden" name="product_id" value="{{$item->product->id}}">
                                            <button class="btn btn-danger btn-sm py-0 px-1"><i class="fa fa-trash" aria-hidden="true"></i></button>
                                        </form>
                                    </div>
                                    <div class="col-8 px-1">{{$item->product->name}} x {{$item->amount}}</div>
                                    <div class="col-3">{{price($item->amount * $item->price)}}</div>
                                </div>

                            </div>
                        @endforeach
                        <div class="col-12 py-1">
                            <div class="row">
                                <div class="col-8 text-right">Suma</div>
                                <div class="col-4 font-weight-normal">{{price($cart->getCartSum())}}</div>
                            </div>

                        </div>
                    @else
                    <div class="col-12 text-center">
                        Twój koszyk jest pusty
                    </div>
                    @endif

                </div>
                @else
                    <div class="text-center">
                        Twój koszyk jest pusty
                    </div>
                @endif
            </div>
            <div class="col-12 text-center py-2">
                <a href="/cart" class="btn btn-outline-primary">Pokaż koszyk</a>
            </div>
        </div>


    </div>
</div>
