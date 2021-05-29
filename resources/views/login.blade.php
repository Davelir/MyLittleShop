@extends('layouts.public')
@section('content')

    <div class="container">
        <div class="row p-2">
            <div class="col-12">
                    <div class="card">
                        <div class="card-header bg-primary text-light">
                            Logowanie
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
                                                class="form-control" name="email" id="email" aria-describedby="helpId" placeholder="E-mail" value="{{ old('email') }}">
                                            </div>

                                            <div class="form-group">
                                            <input type="password" class="form-control" name="password" id="password" placeholder="Hasło">
                                            </div>

                                            <div class="w-100 text-center py-2">
                                                <button class="btn btn-primary">Zaloguj się</button>
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
