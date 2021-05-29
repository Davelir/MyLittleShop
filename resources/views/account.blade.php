@extends('layouts.public')
@section('content')

    <div class="container">
        <div class="row">
            <div class="col-12">
                <div class="card shadow">
                    <div class="card-header bg-primary text-light">
                        Informacje o koncie
                    </div>
                    <div class="card-body row">
                        <div class="col-12">
                            @include('components.errors')
                        </div>
                        <div class="col-6">
                            <div class="row">
                                <div class="col-12">
                                    <h5>Zmiana hasła</h5>
                                </div>
                                <div class="col-12">
                                    <form action="/account/change_password" method="post">
                                        @csrf
                                        <div class="form-group">
                                          <label for="current_password">Aktualne hasło</label>
                                          <input type="password" class="form-control" name="current_password" id="current_password" placeholder="">
                                        </div>
                                        <div class="form-group">
                                          <label for="password">Nowe hasło</label>
                                          <input type="password" class="form-control" name="password" id="password" placeholder="">
                                        </div>
                                        <div class="form-group">
                                          <label for="password2"> Powtórz nowe hasło</label>
                                          <input type="password" class="form-control" name="password2" id="password2" placeholder="">
                                        </div>
                                        <div class="w-100 p-2 text-center">
                                            <button class="btn btn-primary mx-auto">Zmień hasło</button>
                                        </div>
                                    </form>
                                </div>
                            </div>

                        </div>
                    </div>
                </div>

            </div>
        </div>
    </div>

@endsection
