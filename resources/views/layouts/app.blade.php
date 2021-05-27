<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no" />
    <meta name="description" content="" />
    <meta name="author" content="" />
    <title>@yield('title','Home Page')</title>
    <!-- Favicon-->
    <link rel="icon" type="image/x-icon" href="{{ asset('/img/favicon.ico') }}" />
    <!-- Font Awesome icons (free version)-->
    <script src="https://use.fontawesome.com/releases/v5.13.0/js/all.js" crossorigin="anonymous"></script>
    <!-- Google fonts-->
    <link href="https://fonts.googleapis.com/css?family=Montserrat:400,700" rel="stylesheet" type="text/css" />
    <link href="https://fonts.googleapis.com/css?family=Lato:400,700,400italic,700italic" rel="stylesheet" type="text/css" />
    <!-- Core theme CSS (includes Bootstrap)-->
    <link href="{{ asset('/css/styles.css') }}" rel="stylesheet" />
    <link href="{{ asset('/css/custom-styles.css') }}" rel="stylesheet" />
</head>

<body id="page-top">
    <!-- Navigation-->
    <nav class="navbar navbar-expand-lg bg-secondary text-uppercase fixed-top" id="mainNav">
        <div class="container">
            <div class="collapse navbar-collapse" id="navbarSupportedContent">
                <!-- Left Side Of Navbar -->
                <ul class="navbar-nav mr-auto">
                    <!-- Future Left Side Links -->

                </ul>
                <!-- Right Side Of Navbar -->

                <ul class="navbar-nav ml-auto">
                    <!-- Future authentication Links -->
                </ul>
            </div>
            <div class="collapse navbar-collapse" id="navbarResponsive">
                <ul class="navbar-nav ml-auto">
                    <ul class="navbar-nav ml-auto">
                        @guest
                        <li class="nav-item mx-0 mx-lg-1"><a class="nav-link py-3 px-0 px-lg-3 rounded js-scroll-trigger" href="{{ route('login') }}">@lang('general.login')</a></li>
                        <li class="nav-item mx-0 mx-lg-1"><a class="nav-link py-3 px-0 px-lg-3 rounded js-scroll-trigger" href="{{ route('user.register') }}">@lang('general.register')</a></li>

                        @else


                        <form id="logout-form" action="{{ route('logout') }}" method="POST" class="d-none">
                            @csrf
                        </form>

                        <li class="nav-item mx-0 mx-lg-1"><a class="nav-link py-3 px-0 px-lg-3 rounded js-scroll-trigger" href="{{ route('logout') }}" onclick="event.preventDefault();
                            document.getElementById('logout-form').submit();">@lang('general.logout')</a></li>


                        @endguest
                        <li class="nav-item mx-0 mx-lg-1">
                            <a href="#pageSubmenu9" data-toggle="collapse" aria-expanded="false" class="nav-link py-3 px-0 px-lg-3 dropdown-toggle">{{ Config::get('languages')[App::getLocale()] }}</a>
                            <div class="collapse" id="pageSubmenu9">
                                @foreach (Config::get('languages') as $lang => $language)
                                @if ($lang != App::getLocale())
                                <a class="nav-link" href="{{ route('lang.switch', $lang) }}">{{$language}}</a>
                                @endif
                                @endforeach
                            </div>
                        </li>
                    </ul>
            </div>
        </div>
    </nav>


    <main class="py-4">

        <!-- <div class="container-fluid padding-20" style="margin-top: 60px">
            @if(!empty($data["breadlist"]))
            <div class="container-fluid padding-top-20">
                <ol class="breadcrumb">
                    @foreach ($data["breadlist"] as $bread)
                    @if ($bread[3] == "1")
                    <li class="breadcrumb-item active" aria-current="page">{{$bread[0]}}</li>
                    @else
                    <li class="breadcrumb-item"><a href="{{route($bread[1],$bread[2])}}">{{$bread[0]}}</a></li>
                    @endif
                    @endforeach
                </ol>
            </div>
            @endif
        </div> -->

        @yield('content')
    </main>

    <!-- Footer-->

    <!-- Bootstrap core JS-->
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.0/js/bootstrap.bundle.min.js"></script>
    <!-- Third party plugin JS-->
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery-easing/1.4.1/jquery.easing.min.js"></script>
    <!-- Core theme JS-->
    <script src="{{ asset('/js/scripts.js') }}"></script>
</body>

</html>