<!DOCTYPE html>
<html lang = "ar">
<head>
    <meta http-equiv = "Content-Type" content = "text/html; charset=UTF-8"/>
    <meta name = "viewport" content = "width=device-width, initial-scale=1, maximum-scale=1.0"/>
    <title>@yield('title')</title>
    <link rel = "stylesheet" href = "{{asset('zezont4/laravel_generator/css/materialize.min.css')}}">
    <link rel = "stylesheet" href = "{{asset('zezont4/laravel_generator/css/materialize-rtl.css')}}">
    <link rel = "stylesheet" href = "{{asset('zezont4/laravel_generator/css/style.css')}}">
    <link href = "https://fonts.googleapis.com/icon?family=Material+Icons" rel = "stylesheet">
    @yield('header')
</head>
<body>

@section('nav')
    @include('package_views::layouts.menu')
@show

@section('body_header')
    <main>
        <div class = "container">
            <div class = "row">
                <div class = "col s12">
                    <div class = "section">

                        @include('package_views::layouts.messages')
                        @show

                        @yield('content')
                        <script src = "https://code.jquery.com/jquery-1.12.2.js" integrity = "sha256-VUCyr0ZXB5VhBibo2DkTVhdspjmxUgxDGaLQx7qb7xY=" crossorigin = "anonymous"></script>
                        <script src = "{{asset('zezont4/laravel_generator/js/materialize.min.js')}}"></script>

                        @include('package_views::layouts.js_messages')

                        @section('body_footer')
                    </div>
                </div>
            </div>
        </div>
    </main>
@show
<footer>

</footer>
@yield('footer')

<script>

    $(document).ready(function () {
        $('select').material_select();
        $('.button-collapse').sideNav({
                    edge: 'right'
                }
        );
        document.getElementById("nav-mobile").removeAttribute('style');
        document.getElementById("nav-mobile").style["width"] = "240px";
    });
</script>
</body>

</html>
