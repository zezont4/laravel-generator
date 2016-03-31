<header>
    <nav class="top-nav">
        <div class="container">
            <div class="nav-wrapper">
                <a class="page-title">@yield('title')</a>
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
                <img id="front-page-logo" width="190" class="logo" src="{{ asset('zezont4/laravel_generator/image/laravel-generator-200.png') }}">
            </a>
        </li>
        <li class="divider"></li>
        <li><a href="/laravel_generator/show_tables" class="waves-effect waves-teal">بدء العملية</a></li>
        <li class="no-padding">

            <ul class="collapsible collapsible-accordion">

                <li class="bold">
                    <a class="collapsible-header  waves-effect waves-teal">test</a>
                    <div class="collapsible-body">
                        <ul>
                            <li><a href='#'>menu1</a></li>
                            <li><a href='#'>menu2</a></li>
                        </ul>
                    </div>
                </li>

            </ul>

        </li>
    </ul>
</header>