<!doctype html>
<html lang="en">
  <head>
    <title> Sklep It-dream</title>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

    <!-- Bootstrap CSS -->

  </head>
  <body>
    <link rel="stylesheet" href="/css/app.css">
    <script src="/js/jquery.js"></script>
    <script src="/js/URI.min.js"></script>
    <script src="/js/bootstrap.js"></script>
    <script src="/js/app.js"></script>
    <!-- Optional JavaScript -->
    <!-- jQuery first, then Popper.js, then Bootstrap JS -->


    @include('components.top-menu')
    <main>
        @yield('content')
    </main>
    <footer>
        @include('components.footer')
    </footer>

</body>
</html>
