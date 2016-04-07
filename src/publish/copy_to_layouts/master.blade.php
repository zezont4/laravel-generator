<!DOCTYPE html>
<html lang="ar">
<head>
    <meta http-equiv="Content-Type" content="text/html; charset=UTF-8"/>
    <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1.0"/>
    <link rel="shortcut icon" type="image/ico" href="/favicon.ico"/>

    <meta id="token" value="{{ csrf_token() }}">

    <title>@yield('title')</title>
    <link rel="stylesheet" href="/css/materialize.min.css">

    {{-- For right to left support --}}
    <link rel="stylesheet" href="/css/materialize-rtl.css">

    {{-- a custom Hijri calender --}}
    <link rel="stylesheet" href="/css/zezo_date.css">

    {{-- your custom css --}}
    <link rel="stylesheet" href="/css/style.css">

    <link href="http://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet">

    @yield('header')

</head>
<body>

<header>
    @include('layouts.menu')
</header>

<main>
    @section('body_header')
        <div class="container">
            <div class="row">
                <div class="col s12">
                    <div class="section">

                        @include('layouts.messages')
                        @show

                        @yield('content')

                    </div>
                </div>
            </div>
        </div>
    @show
</main>
<footer>

</footer>
<script src="/js/jquery-1.12.2.min.js"></script>
<script src="/js/materialize.min.js"></script>

{{-- Custom Hijri Calender --}}
<script src="/js/zezo_calender.js"></script>

{{-- custom js file --}}
<script src="/js/js.js"></script>

@yield('footer')
</body>

</html>
