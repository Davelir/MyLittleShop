
@if (isset($breadcrumbs) && $breadcrumbs)
    <nav class="breadcrumb mb-0 bg-white">
        @foreach ($breadcrumbs->items as $item)
            @if ($loop->last)
                <span class="breadcrumb-item active">{{$item['name']}}</span>
            @else
                <a class="breadcrumb-item" href="{{$item['link']}}">{{$item['name']}}</a>
            @endif
        @endforeach
    </nav>
@endif
