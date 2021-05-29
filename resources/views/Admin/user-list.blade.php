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
                    Lista użytkowników
                </div>
                <div class="card-body">
                    <table class="table" id="user-list">
                        <thead>
                            <tr>
                                <th>ID</th>
                                <th>Imie</th>
                                <th>Nazwisko</th>
                                <th>E-mail</th>
                                <th>Uprawnienia</th>
                                <th>Data rejestracji</th>
                                <th>Akcja</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($users as $user)
                            <tr>
                                <td>{{$user->id}}</td>
                                <td>{{$user->name}}</td>
                                <td>{{$user->surname}}</td>
                                <td>{{$user->email}}</td>
                                <td>{{$user->getAdminLevelText()}}</td>
                                <td>{{$user->created_at}}</td>
                                <td><a class="btn btn-primary btn-sm" href="{{ route('adminUserDetails',['id'=> $user->id]) }}">Edycja</a></td>
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
            if($('#user-list tbody tr').length){
                $('#user-list').DataTable();
            }
        });
    </script>
@endsection
