<div>
    @for ($i = 0; $i < ($loop->depth - 1); $i++)
        -
    @endfor
    {{$category->name}} <a href="{{route('AdminCategoryEdit',['id' => $category->id])}}">[Edytuj]</a> <br>
    @foreach ($category->child as $category)
        @include('Admin.components.category-element', ['category' => $category])
    @endforeach

</div>
