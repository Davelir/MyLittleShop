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
                    Nowa kategoria
                </div>
                <div class="card-body">
                    <form  action="{{route('adminCategoryCreate')}}" class="row" method="POST">
                        @csrf
                        <div class="col-12 mb-1">
                            <input type="text" class="form-control" name="name" placeholder="Nazwa kategorii">
                        </div>
                        <div class="col-12 mb-1">
                            <select name="parent_id" class="form-control" id="">
                                <option value="0"> Kategoria główna</option>
                                @foreach ($categoryList as $category)
                                    <option value="{{$category->id}}">{{$category->name}}</option>
                                @endforeach
                            </select>
                        </div>
                        <div class="col-12">
                            <button class="btn btn-primary" name="add_category"> Dodaj kategorie</button>
                        </div>
                    </form>

                </div>

            </div>
        </div>

        <div class="col-12">
            <div class="card">
                <div class="card-header">
                    Drzewo kategorii
                </div>
                <div class="card-body">
                    <div class="row">
                        <div class="col-12">
                            @foreach ($mainCategories as $category)
                            @includeWhen($category->child->count(),'Admin.components.category-element', ['category' => $category])
                            @endforeach
                        </div>
                        <div class="col-12">

                        </div>
                    </div>

                </div>

            </div>
        </div>
    </div>
@endsection
