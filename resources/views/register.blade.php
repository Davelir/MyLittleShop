@extends('layouts.public')
@section('content')
<div class="container">
    <div class="row p-2">
        <div class="col-12">
                <div class="card">
                    <div class="card-header bg-primary text-light">
                        Rejestracja
                    </div>
                    <div class="card-body row justify-content-center">
                        <div class="col-12">
                            @include('components.errors')
                        </div>
                        <div class="w-100"></div>
                        <div class="col-12">
                            <div class="row justify-content-center">
                                <div class="col-12 col-md-6 col-lg-4">
                                    <form action="" method="post">
                                        @csrf
                                        <div class="form-group">
                                        <input type="text"
                                            class="form-control" name="email" id="email" aria-describedby="helpId" placeholder="E-mail">
                                        </div>
                                        <div class="form-group">
                                            <input type="text"
                                                class="form-control" name="name" id="name" aria-describedby="helpId" placeholder="Imię">
                                        </div>
                                        <div class="form-group">
                                            <input type="text"
                                                class="form-control" name="surname" id="surname" aria-describedby="helpId" placeholder="Nazwisko">
                                        </div>
                                        <div class="form-group">
                                        <input type="password" class="form-control" name="pass1" id="pass1" placeholder="Hasło">
                                        </div>
                                        <div class="form-group">
                                        <input type="password" class="form-control" name="pass2" id="pass2" placeholder="Powtórz hasło">
                                        </div>
                                        <div class="custom-control custom-checkbox">
                                            <input type="checkbox" class="custom-control-input" id="accept" name="accept">
                                            <label class="custom-control-label" for="accept">Akceptuję regulamin serwisu</label>
                                          </div>
                                        <div class="w-100 text-center py-2">
                                            <button class="btn btn-primary">Zarejestruj się</button>
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
