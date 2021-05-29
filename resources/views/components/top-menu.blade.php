<div class="container-fluid px-0 sticky-top shadow">
    <nav class="navbar navbar-expand-lg navbar-light bg-primary text-white top_menu ">
        <a class="navbar-brand" href="/">It-dream</a>

        <div class="col col-md-6">
            <div class="row">
                <div class="col">
                    <form action="/category" method="get" class="align-self-center">
                    <div class="input-group">
                        <input type="text" class="form-control top_search" placeholder="Szukaj w katalogu" name="search">
                        <div class="input-group-append">
                          {{-- <button class="btn btn-outline-secondary" type="button">Szukaj</button> --}}
                        </div>
                      </div>
                  </form>
                </div>
            </div>

        </div>
        <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarTogglerDemo02" aria-controls="navbarTogglerDemo02" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
          </button>
        <div class="collapse navbar-collapse" id="navbarTogglerDemo02">


                      <div class="col menu_links">
                          <div class="row justify-content-end">
                            <a href="/category">
                                <i class="fa fa-book" aria-hidden="true"></i> Katalog
                            </a>
                            <a href="/cart" class="cart-button">
                                <i class="fa fa-shopping-cart" aria-hidden="true"></i> Koszyk <span class="badge badge-secondary">
                                    @if ($cart)
                                     {{$cart->getCartAmount()}}
                                    @else
                                        0
                                    @endif

                                </span>
                            </a>
                            <a href="/contact">
                                <i class="fa fa-envelope" aria-hidden="true"></i> Kontakt
                            </a>
                            @if (Auth::check())
                            <div class="dropdown d-flex align-items-center">
                                <a class="dropdown-toggle" href="#" id="userDropdown" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                    <i class="fa fa-user" aria-hidden="true"></i>  {{ Auth::user()->name }}
                                </a>
                                <div class="dropdown-menu text-dark" aria-labelledby="userDropdown">
                                    <a class="dropdown-item text-dark" href="/account">Konto</a>
                                    <a class="dropdown-item" href="/orders">Zamówienia</a>
                                    @if (Auth::user()->isAdmin())
                                        <div class="dropdown-divider"></div>
                                        <a class="dropdown-item" href="/admin">Zarządzanie</a>
                                    @endif
                                    <div class="dropdown-divider"></div>
                                    <a class="dropdown-item" href="/logout">Wyloguj się</a>

                                  </div>

                                </div>
                            @else
                            <a href="/login">
                                <i class="fa fa-user" aria-hidden="true"></i> Logowanie
                            </a>
                            <a href="/register">
                                <i class="fa fa-user" aria-hidden="true"></i> Rejestracja
                            </a>
                            @endif

                          </div>

                      </div>

        </div>
      </nav>

</div>
@include('components.cart-widget')
