<nav class="top-nav">
    <div class="container">
        <div class="nav-wrapper">
            <div class="col s12">
                @yield('parent')
                <a class="page-title"> @yield('title') </a>
            </div>
        </div>
    </div>
</nav>
<div class="container">
    <a href="#" data-activates="nav-mobile" class="button-collapse top-nav full "><i class="material-icons">menu</i>
    </a>
</div>
<ul id="nav-mobile" class="side-nav fixed right-aligned" style="width: 240px;">

    <li class="logo no-padding">
        <a id="logo-container" href="/" class="brand-logo">
            <img id="front-page-logo" height="85" class="logo" src="{{ asset('image/190X85.png') }}">
        </a>
    </li>

    <div class="center-align grey-text">عنوان النظام</div>

    <li><a href="#" class="waves-effect waves-teal">القوائم</a></li>

</ul>
