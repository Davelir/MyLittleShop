@extends('layouts.public')
@section('content')
    <div class="container">
        <div class="row">

            <div class="col-12  mb-3 px-0">
                <div class="row no-gutters">
                    <div class="col-12 col-md-4  mb-3 mb-md-0">
                        <div class="row bg-1 no-gutters shadow">
                            <div class="col menu_box ">
                                @foreach($categories as $category)
                                    <a href="{{$category->getUrl()}}">{{$category->name}}</a>
                                @endforeach
                            </div>
                        </div>

                    </div>
                    <div class="col-12 col-md-8 pl-0 pl-md-3">
                        <div class="row no-gutters bg-1 h-100 shadow">
                            <div class="col">
                                <img src="/img/www/baner1.jpg" class="img-fluid" alt="">
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <div class="col-12 bg-1 p-2 mb-3 shadow">
                <div class="row">
                    <div class="col-12 h5">Najnowsze produkty</div>
                    <div class="col-12">
                        <div class="row px-3">
                            @foreach ($newProducts as $product)
                                <div class="col-xl-2 col-lg-2 col-md-4 col-sm-6 col-xs-12 mb-2 d-flex">

                                        <a class="row  justify-content-between product_box align-items-stretch " href="{{$product->getProductUri()}}">
                                            <div class="col-12 top_content">
                                                <div class="row pt-2">
                                                    <div class="col-12 text-center ">{{$product->name}} </div>
                                                    <div class="col-12 text-center"><img src="{{$product->getImageUri()}}" class="img-fluid mx-auto" alt=""> </div>
                                                </div>
                                            </div>
                                            <div class="col-12  bottom_content">
                                                <div class="row text-center">
                                                    <div class="col-12 pb-1">{{$product->price}} zł</div>
                                                    <div class="col-12">
                                                        <button class="btn btn-primary mx-auto"> <i class="fa fa-cart-plus mr-1" aria-hidden="true"></i> Do koszyka</button>
                                                    </div>
                                                </div>
                                            </div>
                                        </a>

                                </div>
                            @endforeach
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-12 bg-1 p-2 mb-3 shadow">
                <div class="row">
                    <div class="col-12 h5">Zobacz też</div>
                    <div class="col-12">
                        <div class="row px-3">
                        @foreach ($alsoProducts as $product)
                            <div class="col-xl-2 col-lg-2 col-md-4 col-sm-6 col-xs-12 mb-2">
                                <div class="row flex-column justify-content product_box h-100">
                                    <div class="col-12 flex-grow-2">
                                        <div class="row pt-2">
                                            <div class="col-12 text-center ">{{$product->name}} </div>
                                            <div class="col-12 text-center"><img src="{{$product->getImageUri()}}" class="img-fluid mx-auto" alt=""> </div>
                                        </div>
                                    </div>
                                    <div class="col-12">
                                        <div class="row text-center pb-2">
                                            <div class="col-12 pb-1">{{$product->price}} zł</div>
                                            <div class="col-12">
                                                <button class="btn btn-primary mx-auto"><i class="fa fa-cart-plus mr-1" aria-hidden="true"></i> Do koszyka</button>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        @endforeach
                        </div>
                    </div>
                </div>
            </div>

        </div>
    </div>
@endsection
