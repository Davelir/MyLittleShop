@extends('layouts.admin')
@section('content')
<div class="row no-gutters">
    <div class="col-12 mb-2">
        <div class="row">
            <div class="col-12 col-md-6 text-left h5"> Edycja produktu</div>
        </div>
    </div>
    <div class="col-12">
        <form class="row" method="POST" enctype='multipart/form-data'>
            @csrf
            <div class="col-12 col-md-6">
                <div class="row">

                    <div class="col-12 mb-2">
                        <div class="card">
                            <div class="card-header">
                                Dane produktu
                            </div>
                            <div class="card-body">
                                {{-- ID --}}
                                <div class="row no-gutters mb-2">
                                    <div class="col-12 col-md-2 text-left text-md-right font-weight-bold pr-2">
                                        ID
                                    </div>
                                    <div class="col-12  col-md-10">
                                        <input type="text" class="form-control" value="{{$product->id}}" readonly>
                                    </div>
                                </div>

                                {{-- Nazwa --}}
                                <div class="row no-gutters mb-2">
                                    <div class="col-12 col-md-2 text-left text-md-right font-weight-bold pr-2">
                                        Nazwa
                                    </div>
                                    <div class="col-12 col-md-10">
                                        <input type="text" class="form-control" name="name" value="{{$product->name}}">
                                    </div>
                                </div>

                                {{-- Cena --}}
                                <div class="row no-gutters mb-2">
                                    <div class="col-12 col-md-2 text-left text-md-right font-weight-bold pr-2">
                                        Cena
                                    </div>
                                    <div class="col-12 col-md-10">
                                        <input type="text" class="form-control" name="price" value="{{$product->price}}">
                                    </div>
                                </div>

                                {{-- Opis --}}
                                <div class="row no-gutters mb-2">
                                    <div class="col-12 col-md-2 text-left text-md-right font-weight-bold pr-2">
                                        Opis
                                    </div>
                                    <div class="col-12 col-md-10">
                                        <textarea class="form-control" name="description" id="" >{{$product->description}}</textarea>
                                    </div>
                                </div>

                                {{-- Kategoria --}}
                                <div class="row no-gutters mb-2">
                                    <div class="col-12 col-md-2 text-left text-md-right font-weight-bold pr-2">
                                        Kategoria
                                    </div>
                                    <div class="col-12 col-md-10">
                                        <select name="category_id" id="" class="form-control">
                                              <option value="0" @if ($product->category_id == null) selected  @endif> Kategoria główna</option>
                                                @foreach ($categories as $category)
                                                    <option value="{{$category->id}}" @if ($category->id == $product->category_id) selected @endif>{{$category->name}}</option>
                                                @endforeach
                                        </select>
                                    </div>
                                </div>
                                <div class="row no-gutters mb-2">
                                    <div class="col-12 col-md-12 text-center">
                                        <button class="btn btn-primary" name="save_product">Zapisz</button>
                                    </div>
                                </div>
                            </div>

                        </div>
                    </div>

                    <div class="col-12 mb-2">
                        <div class="card">
                            <div class="card-header">
                                Tagi
                            </div>
                            <div class="card-body">
                                <div class="row mb-2">
                                    <div class="col-4">
                                        <select name="add_attribute_name" class="form-control" id="add_attribute_name">
                                            @foreach ($attributes as $attribute)
                                                <option value="{{$attribute->id}}">{{$attribute->name}}</option>
                                            @endforeach
                                        </select>
                                    </div>
                                    <div class="col-4">
                                        <select name="add_attribute_value" class="form-control" id="add_attribute_value">
                                            @foreach ($attributesValues as $attributeValue)
                                                <option value="{{$attributeValue->id}}">{{$attributeValue->name}}</option>
                                            @endforeach
                                        </select>
                                    </div>
                                    <div class="col-4">
                                        <button class="btn btn-primary" name="add_attribute">Dodaj</button>
                                    </div>
                                </div>
                                <div class="row">
                                    <table class="table">
                                        <thead>
                                            <tr>
                                                <th>Atrybut</th>
                                                <th>Wartość</th>
                                                <th>Akcja</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            @foreach ($product->attributes as $attribute)
                                            <tr>
                                                <td>{{$attribute->attribute->name}}</td>
                                                <td>{{$attribute->value->name}}</td>
                                                <td><button class="btn btn-sm btn-danger" name="delete_attribute" value="{{$attribute->id}}">Usuń</button></td>
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
            <div class="col-12 col-md-6">
                <div class="row">
                    <div class="col-12 mb-2">
                        <div class="card">
                            <div class="card-header">
                                Obrzaki
                            </div>
                            <div class="card-body">
                                <div class="row">
                                    <div class="col-12 mb-2">
                                        <img src="{{$product->getImageUri()}}" alt="" class="img-fluid">
                                    </div>
                                    <div class="col-12">
                                        <input type="file" class="form-control-file" name="image" id="" placeholder="">
                                    </div>
                                </div>
                            </div>

                        </div>
                    </div>
                </div>
            </div>
        </form>
    </div>
</div>

@endsection
