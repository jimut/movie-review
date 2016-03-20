<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <title>Movie Review</title>

    <!-- Fonts -->
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.4.0/css/font-awesome.min.css" rel='stylesheet' type='text/css'>
    <!-- <link href="https://fonts.googleapis.com/css?family=Lato:100,300,400,700" rel='stylesheet' type='text/css'> -->

    <!-- Styles -->
    <link href="{{ URL::asset('includes/bootstrap-3.3.6/css/bootstrap.min.css') }}" rel="stylesheet">
    <link href="{{ URL::asset('assets/css/main.css') }}" rel="stylesheet">

    <!-- JavaScripts -->
    <script src="{{ URL::asset('includes/jquery/jquery-2.2.1.min.js') }}"></script>
    <script src="{{ URL::asset('includes/raty-master/jquery.raty.js') }}"></script>

    <style>
        /*body {
            font-family: 'Lato';
        }*/

        .fa-btn {
            margin-right: 6px;
        }
    </style>
</head>
<body id="app-layout">

    @include('layouts.header')

    <div class="container">
      @if (session('notice'))
        <div class="alert alert-info">{{ session('notice') }}</div>
      @endif

      @yield('content')
    </div>

    <!-- JavaScripts -->
    <script src="{{ URL::asset('includes/bootstrap-3.3.6/js/bootstrap.min.js') }}"></script>
</body>
</html>
