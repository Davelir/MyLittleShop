@extends('layouts.admin')
@section('content')
<div class="row no-gutters">
    <div class="col-12 mb-2">
        <div class="card">
            <div class="card-header">
                Nowy produkt
            </div>
            <div class="card-body">
                <form action="{{ route('AdminProductNew') }}" method="post">
                    @csrf
                    <input type="text" class="form-control mb-2" name="name" placeholder="Nazwa produktu">
                    <button class="btn btn-primary"> Dodaj nowy</button>
                </form>
            </div>

        </div>

    </div>
    <div class="col-12">
        <div class="card">
            <div class="card-header">
                Lista produktów
            </div>
            <div class="card-body">
                <table class="table " id="product-list">
                    <thead>
                        <tr>
                            <th>ID</th>
                            <th>Nazwa</th>
                            <th>Cena</th>
                            <th>Kategoria</th>
                            <th>Status</th>
                            <th>Akcje</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($products as $product)
                        <tr>
                            <td>{{$product->id}}</td>
                            <td>{{$product->name}}</td>
                            <td>{{price($product->price)}}</td>
                            <td>{{$product->category->name}}</td>
                            <td>{{$product->getStatusText()}}</td>
                            <td><a href="/admin/product/{{$product->id}}/edit" class="btn btn-sm btn-primary">Edytuj</a></td>
                        </tr>
                        @endforeach

                    </tbody>
                </table>
            </div>

        </div>


    </div>
</div>




<script>
    $(function () {
        if($('#product-list tbody tr').length){
            $('#product-list').DataTable();
        }

    });
</script>
@endsection
