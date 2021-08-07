<!DOCTYPE html>
<html lang="{{ app()->getLocale() }}">
  <head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0, shrink-to-fit=no">
    <title>RedLink</title>
    <link rel="shortcut icon" href="{{ asset('favicon.png') }}" type="image/x-icon">
    <link rel="stylesheet" href="{{ asset('assets/lte/plugins/bootstrap/css/bootstrap.min.css') }}">
    <link rel="stylesheet" href="{{ asset('assets/lte/plugins/fontawesome-free/css/all.min.css') }}">
    <link rel="stylesheet" href="{{ asset('assets/css/style-login.css') }}">
    </head>
    <body class="c-app flex-row align-items-center">
        @yield('content')
    </body>
    <script src="{{ asset('assets/lte/plugins/jquery/jquery.min.js') }}"></script>
    <script src="{{ asset('assets/lte/plugins/bootstrap/js/bootstrap.min.js') }}"></script>
</html>
