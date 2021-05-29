@extends('layouts.admin')
@section('content')
<script>

</script>
    <div class="row">
        <div class="col-12 px-4 mb-2">
            @include('components.errors')
        </div>
        <div class="col-12 mb-2">
            <div class="card">
                <div class="card-header">
                    Edycja kategorii
                </div>
                <div class="card-body">
                    <form  action="{{route('adminCategorySave',['id' => $category->id])}}" class="row" method="POST">
                        @csrf
                        <div class="col-12 mb-1">
                            <input type="text" class="form-control" name="name" placeholder="Nazwa kategorii" value="{{$category->name}}">
                        </div>
                        <div class="col-12 mb-1">
                            <select name="parent_id" class="form-control" id="">
                                <option value="0" @if ($category->id == null) selected  @endif> Kategoria główna</option>
                                @foreach ($categoryList as $categoryAvaible)
                                    <option value="{{$categoryAvaible->id}}" @if ($categoryAvaible->id == $category->parent_id) selected @endif>{{$categoryAvaible->name}}</option>
                                @endforeach
                            </select>
                        </div>
                        <div class="col-12">
                            <button class="btn btn-primary" name="save_category"> Zapisz</button>
                            <button class="btn btn-danger" name="remove_category"> Usuń</button>
                        </div>
                    </form>

                </div>

            </div>
        </div>

    </div>
@endsection
