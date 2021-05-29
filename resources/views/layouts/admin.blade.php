<!doctype html>
<html lang="en">
  <head>
    <title>Panel zarządzania Sklep It-dream</title>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

    <!-- Bootstrap CSS -->

  </head>
  <body>
    <link rel="stylesheet" href="/css/app.css">
    <link rel="stylesheet" href="/css/datatables.min.css">
    <script src="/js/jquery.js"></script>
    <script src="/js/URI.min.js"></script>
    <script src="/js/bootstrap.js"></script>
    <script src="/js/app.js"></script>
    <script src="/js/datatables.min.js"></script>
    <!-- Optional JavaScript -->
    <!-- jQuery first, then Popper.js, then Bootstrap JS -->

    <div class="admin">
        <div class="admin-top sticky-top text-left">
            <div class="h-100 d-flex align-items-center p-2 h5 text-light">
                It-dream
            </div>
        </div>
            <div class="admin-wrapper">
                <div class="admin-left sticky-top">
                    @include('admin.components.sidebar')
                </div>
                <div class="admin-content">
                    <div class="row no-gutters">
                        <div class="col-12 p-2">
                            @yield('content')
                        </div>
                    </div>

                </div>
            </div>
    </div>



</body>
</html>
