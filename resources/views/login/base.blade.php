<!DOCTYPE html>
<html lang="en">

<head>
    <title>@yield('title')</title>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    
    {{-- Icon --}}
    <link rel="shortcut icon" href="{{ URL::to('/img') }}/logo.png" type="image/x-icon">
    
    {{-- CSS dari Template Baru --}}
    <link rel="stylesheet" type="text/css" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css">
    <link rel="stylesheet" type="text/css" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
    
    {{-- CSS Kustom Anda --}}
    <link rel="stylesheet" type="text/css" href="{{ asset('login_new/css/style.css') }}">
    </head>

<body>
    
    @include('sweetalert::alert')
    @yield('content')


    {{-- JS dari Template Baru --}}
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.bundle.min.js"></script>
    </body>

</html>