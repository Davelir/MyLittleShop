<div class="row">
    @foreach (['danger', 'warning', 'success', 'info'] as $key)
        @if(Session::has($key))
            <div class="col-12 p-1">
                <div class="alert alert-{{ $key }}">{{ Session::get($key) }}</div>
            </div>
        @endif
   @endforeach
    @if ($errors->any())
        @foreach ($errors->all() as $error)
            <div class="col-12 p-1">
                <div class="alert alert-danger">{{$error}}</div>
            </div>
        @endforeach
    @endif
</div>


