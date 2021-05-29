@extends('layouts.public')
@section('content')
<div class="container">
  <div class="row">
      <div class="col-12 mb-2">
        <div class="row bg-1 shadow">
            <div class="col-12">
                @include('components.breadcrumbs')
            </div>
        </div>
      </div>
      <div class="col-12 col-md-3 mb-2">
          <div class="row bg-1 shadow mb-2">
                <div class="col-12 px-0 mb-2">
                    <div class="box-title">
                        Kategorie
                    </div>
                </div>

                    <div class="col-12">
                        @if ($category)
                            @if ($category->parent)
                                <a href="{{$category->parent->getUrl()}}" class="">Wróć</a>
                            @else
                                <a href="/category" class="">Wróć</a>
                            @endif
                        @else

                        @endif

                    </div>

                <div class="col-12 pb-2">
                    <div class="list-group">
                        @foreach ($categories as $category)
                            <a href="{{$category->getUrl()}}" class="list-group-item list-group-item-action">{{$category->name}}</a>
                        @endforeach
                    </div>
                </div>
          </div>
          <div class="row bg-1 shadow pb-2">
                <div class="col-12 px-0 mb-2">
                    <div class="box-title">
                        Filtry
                    </div>
                </div>
                <div class="col-12">
                    <div class="row">
                        @if ($searchString)
                            <div class="col-12">
                                Nazwa
                            </div>
                            <div class="col-12">
                                <input type="text" class="form-control search-filtr" name="search" value="{{$searchString}}">
                            </div>
                        @endif


                        <div class="col-12">
                            Cena
                        </div>
                        <div class="col-12">
                            <div class="row">
                                <div class="col-6">
                                    <input type="text" class="form-control" placeholder="min" name="price_min">
                                </div>
                                <div class="col-6">
                                    <input type="text" class="form-control" placeholder="max" name="price_max">
                                </div>
                            </div>
                        </div>
                        <div class="col-12 pt-2">
                            Tagi
                        </div>
                        <div class="col-12">
                            @foreach ($tags as $tag)
                                <div class="row">
                                <div class="col-12">{{$tag['attribute']->name}}</div>
                                    <div class="col-12">
                                        @foreach ($tag['values'] as $value)
                                           <div class="custom-control custom-checkbox">
                                           <input type="checkbox" class="custom-control-input" id="value_{{$tag['attribute']->id}}_{{$value->id}}" name="tags" data-attribute="{{$tag['attribute']->id}}" data-value="{{$value->id}}">
                                                <label class="custom-control-label" for="value_{{$tag['attribute']->id}}_{{$value->id}}">{{$value->name}}</label>
                                            </div>
                                        @endforeach

                                    </div>
                                </div>
                            @endforeach
                        </div>
                        <div class="col-12 pt-4 text-center">
                            <button class="btn btn-primary" onclick="catalog.click()">Filtruj</button>
                        </div>
                    </div>
                </div>
          </div>
      </div>
      <div class="col-12 col-md-8 offset-0 offset-md-1 mb-2">
        <div class="row  px-3">
            @if ($products->isNotEmpty())
                @foreach ($products as $product)
                    <div class="col-12 product_row bg-1">
                        <div class="row">
                            <div class="col-3">
                                <img src="{{$product->getImageUri()}}" alt="" class="img-fluid">
                            </div>
                            <div class="col-6">
                                <div class="row">
                                    <div class="col-12 font-weight-normal pb-2">
                                        <a href="{{$product->getProductUri()}}">
                                            {{$product->name}}
                                        </a>
                                    </div>
                                    <div class="col-12 ">
                                        @if ($product->attributes->isNotEmpty())

                                        <table class="table table-sm">
                                            <tbody>
                                                @foreach ($product->attributes as $attribute)
                                                @break($loop->index > 2)
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
                            <div class="col-3">
                                <div class="row">
                                <div class="col-12 h4 font-weight-light text-center">{{price($product->price)}}</div>
                                    <div class="col-12">
                                        <form action="/cart/add" method="post" class="w-100 text-center">
                                            @csrf
                                            <input type="hidden" name="product_id" value="{{$product->id}}">
                                            <button class="btn btn-outline-primary">Do koszyka</button>
                                        </form>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                @endforeach
            @else
                <div class="col-12">
                    <div class="alert alert-info" role="alert">
                        <strong>Brak produktów spełniających podane kryteria</strong>
                    </div>
                </div>
            @endif

            <div class="col-12 d-flex justify-content-center">
                {{ $products->withQueryString()->links() }}
            </div>
        </div>
      </div>
  </div>
</div>
<script>
    catalog.setFilters();
</script>

@endsection
