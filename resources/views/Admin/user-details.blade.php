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
                    Szczegóły użytkownika
                </div>
                <div class="card-body">
                    <form class="row" method="POST">
                        @csrf
                        <div class="col-12 col-md-4">
                            <table class="table">
                                <tbody>
                                    <tr>
                                        <td>ID</td>
                                        <td>{{$user->id}}</td>
                                    </tr>
                                    <tr>
                                        <td>Imie</td>
                                        <td>{{$user->name}}</td>
                                    </tr>
                                    <tr>
                                        <td>Nazwisko</td>
                                        <td>{{$user->surname}}</td>
                                    </tr>
                                    <tr>
                                        <td>E-mail</td>
                                        <td>{{$user->email}}</td>
                                    </tr>
                                    <tr>
                                        <td>Uprawnienia</td>
                                        <td>
                                            <select name="admin_level" class="form-control" id="">
                                                @foreach ($levels as $levelId => $levelName)
                                                    <option value="{{$levelId}}" @if ($levelId == $user->admin_level) selected @endif>{{$levelName}}</option>
                                                @endforeach
                                            </select>
                                        </td>
                                    </tr>
                                </tbody>
                            </table>
                        </div>
                        <div class="w-100"></div>
                        <div class="col-12 col-md-4">
                            <button class="btn btn-primary">Zapisz</button>
                        </div>
                    </form>
                </div>

            </div>
        </div>

    </div>
@endsection
