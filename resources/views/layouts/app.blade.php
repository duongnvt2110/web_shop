<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <base href="{{asset('')}}">
    <title>{{ config('app.name', 'Laravel') }}</title>

    <script>
            window.App = {!! json_encode([
                'admin'=> Auth::guard('admin')->id(),
                'user'=>Auth::guard('web')->id(),
            ]) !!};
    </script>


    <!-- Fonts -->
    <link rel="dns-prefetch" href="//fonts.gstatic.com">
    <link href="https://fonts.googleapis.com/css?family=Nunito" rel="stylesheet" type="text/css">
    <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.8.1/css/all.css"
        integrity="sha384-50oBUHEmvpQ+1lW4y57PTFmhCaXp0ML5d60M1M7uH2+nqUivzIebhndOJK28anvf" crossorigin="anonymous">

    <!-- Styles -->
    <link href="{{asset('css/app.css')}}" rel="stylesheet">
    {{-- @yield('head') --}}
</head>

<body>
    <div id="app">
        <nav class="navbar navbar-expand-md navbar-light bg-white shadow-sm">
            @include('layouts.nav')
        </nav>
        <div class="wrapper">
            @include('layouts.wrapper')
        </div>
    </div>
</body>
    {{-- <!-- Scripts --> --}}
    <script type="text/javascript" rel="script" src="{{asset('js/app.js')}}"></script>
    <script src="https://code.jquery.com/jquery-3.4.1.min.js"
    integrity="sha256-CSXorXvZcTkaix6Yvo6HppcZGetbYMGWSFlBw8HfCJo=" crossorigin="anonymous"></script>
    <script>
        $(document).ready(function(){
            $('.alert').delay(3000).fadeOut();
            $('a').on('click', function(){
                $('a').removeClass('selected');
                $(this).addClass('selected');
            });
        });
    </script>
    @yield('scripts')
</html>
