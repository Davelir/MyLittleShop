@extends('layouts.public')
@section('content')
<div class="container">
    <div class="row ">

        <div class="col-12 mb-2">
            <div class="row bg-1 shadow">
                <div class="col-12">
                    @include('components.breadcrumbs')
                </div>
            </div>
        </div>
        <div class="col-12 col-md-4 col-lg-3 mb-2">
            <div class="row bg-1 shadow">

                <div class="col-12">
                    <img src="{{$product->getImageUri()}} " class="img-fluid" alt="">
                </div>
            </div>
        </div>

        <div class="col-12 col-md-4 col-lg-4 mb-2 offset-0 offset-md-1">
            <div class="row bg-1 shadow">
                <div class="col-12 px-0 mb-2">
                    <div class="box-title">
                        Specyfikacja produktu
                    </div>
                </div>
                <div class="col-12 h5 py-2">
                    {{$product->name}}
                </div>
                <div class="col-12">
                    @if ($product->attributes->isNotEmpty())
                        <table class="table">
                            <tbody>
                                @foreach ($product->attributes as $attribute)
                                    <tr>
                                        <td>{{$attribute->attribute->name}} </td>
                                        <td>{{$attribute->value->name}} </td>
                                    </tr>
                                @endforeach

                            </tbody>
                    </table>
                    @endif
                </div>
            </div>
        </div>

        <div class="col-12 col-md-5 col-lg-3 mb-2 offset-0 offset-md-1">
            <div class="row bg-1 shadow">
                <div class="col-12 px-0 mb-2">
                    <div class="box-title">
                        Kup teraz
                    </div>
                </div>
                <div class="col-12 text-center h1 font-weight-light">
                    {{price($product->price)}}
                </div>
                <div class="col-12 text-center mb-2">
                    <form action="/cart/add" method="post" class="w-100 text-center">
                        @csrf
                        <input type="hidden" name="product_id" value="{{$product->id}}">
                        <button class="btn btn-outline-primary">Do koszyka</button>
                    </form>

                </div>
            </div>
        </div>

        <div class="col-12 mb-2">
            <div class="row bg-1 shadow">
                <div class="col-12 px-0">
                    <div class="box-title">
                        Opis
                    </div>
                </div>
                <div class="col-12 mt-2">
                    {!! $product->description !!}
                </div>
            </div>
        </div>

        <div class="col-12 mb-2">
            <div class="row bg-1 shadow">
                <div class="col-12 px-0">
                    <div class="box-title">
                        Podobne produkty
                    </div>

                </div>
                <div class="col-12">
                    <div class="row mt-2">
                    @foreach ($product->getSimilarProducts() as $similarProduct)
                            <a href="{{$similarProduct->getProductUri()}} " class="product_box col-2">
                                <div class="row">
                                    <div class="col-12">
                                        <img src="{{$similarProduct->getImageUri()}}" class="img-fluid" alt="">
                                    </div>
                                    <div class="col-12 text-center">
                                        {{$similarProduct->name}}
                                    </div>
                                </div>
                            </a>
                    @endforeach
                </div>
                </div>
            </div>
        </div>

        <div class="col-12 mb-2">
            <div class="row bg-1 shadow">
                <div class="col-12 px-0">
                    <div class="box-title">
                        Recenzje
                    </div>
                </div>
                @if (Auth::check())
                    <div class="col-12 mt-2">
                        <form method="post" action="/product/{{$product->id}}/add_review">
                            @csrf
                            <div class="form-group">
                              <label for="rate">Ocena</label>
                              <select class="form-control" name="rate" id="rate">
                                @for ($i = 0; $i <= 10; $i++)
                                    <option value="{{$i}}">{{$i/2}}</option>
                                @endfor
                              </select>
                            </div>
                            <div class="form-group">
                              <label for="review">Treść</label>
                              <textarea class="form-control" name="review" id="review" rows="3"></textarea>
                            </div>
                            <div class="w-100 text-center">
                                <button class="btn btn-primary">Dodaj recenzję</button>
                            </div>
                        </form>
                    </div>
                @endif
                @if ($reviews->isNotEmpty())

                    <div class="col-12 mt-2">
                        <div class="row px-3">
                            @foreach ($reviews as $review)
                                <div class="col-12 review mb-2 px-2 shadow">
                                    <div class="row">
                                        <div class="col-12">
                                            Ocena : {{$review->getFormatedRate()}}
                                        </div>
                                        <div class="col-12 py-1">
                                            {!! $review->review !!}
                                        </div>
                                        <div class="col-12 text-right"> {{$review->created_at}}</div>
                                        </div>
                                </div>
                            @endforeach
                        </div>
                    </div>


                @else
                   <div class="col-12 text-center">
                       Brak recenzji tego produktu
                    </div>
                @endif

            </div>
        </div>
    </div>
</div>


@endsection
