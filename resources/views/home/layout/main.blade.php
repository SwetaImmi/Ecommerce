<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<meta charset="utf-8">
<meta name="viewport" content="width=device-width, initial-scale=1">
<title>App Name - @yield('title')</title>
<link rel="stylesheet" type="text/css" href="{{ asset('css/bootstrap.min.css') }}">
<link rel="stylesheet" type="text/css" href="{{ asset('css/fontawesome.css') }}">
<link rel="stylesheet" type="text/css" href="{{ asset('css/style.css') }}">

<head>
</head>

<body>
    <div class="container">
       
        <script src="{{ asset('js/jquery.min.js') }}"></script>
        <script src="{{ asset('js/bootstrap.bundle.min.js') }}"></script>
        <script>
            $('[data-toggle="tooltip"]').tooltip();
        </script>
    </div>
</body>

</html>