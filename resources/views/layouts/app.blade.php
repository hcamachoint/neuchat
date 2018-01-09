<!DOCTYPE html>
<html lang="{{ config('app.locale') }}">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ config('app.name', 'Neuchat') }}</title>

    <!-- Styles -->
    <link href="{{ url('/css/app.css') }}" rel="stylesheet">
    <link href="{{ url('/css/font-awesome.min.css') }}" rel="stylesheet">
    <link href="{{ url('/css/sublink.css') }}" rel="stylesheet">
    @yield('head')
</head>
<body>
    <div id="app">
        <nav class="navbar navbar-icon-top navbar-default">
            <div class="container-fluid">
                <!-- Brand and toggle get grouped for better mobile display -->
                <div class="navbar-header">
                    <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#bs-example-navbar-collapse-1" aria-expanded="false">
                        <span class="sr-only">Toggle navigation</span>
                        <span class="icon-bar"></span>
                        <span class="icon-bar"></span>
                        <span class="icon-bar"></span>
                    </button>
                    <a class="navbar-brand" href="{{ route('home') }}">
                        {{ config('app.name', 'Neuchat') }}
                    </a>
                </div>
                <!-- Collect the nav links, forms, and other content for toggling -->
                <div class="collapse navbar-collapse" id="bs-example-navbar-collapse-1">
                  @if (Auth::guest())
                    <ul class="nav navbar-nav navbar-right">
                      <li><a href="{{ route('login') }}">Login</a></li>
                      <li><a href="{{ route('register') }}">Register</a></li>
                    </ul>
                  @else
                    <ul class="nav navbar-nav">
                        <li class="{{ Request::is('home') ? 'active' : '' }}"><a href="{{ route('home') }}">Home <span class="sr-only">(current)</span></a></li>
                        <li class="{{ Request::is('message*') ? 'active' : '' }}"><a href="{{ route('chat') }}">Chat <span class="sr-only">(current)</span></a></li>
                    </ul>
                    <ul class="nav navbar-nav navbar-right">
                        <li class="dropdown {{ Request::is('profile*') ? 'active' : '' }}">

                            <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="false">
                                <img class="img-responsive img-circle" src="/avatars/{{ Auth::user()->image_path }}" style="width:45px; height:45px;">
                                {{ substr(Auth::user()->name, 0, 6) }} <span class="caret"></span>
                            </a>
                            <ul class="dropdown-menu" role="menu">
                                <li>
                                    <a href="{{ route('logout') }}"
                                        onclick="event.preventDefault();
                                                 document.getElementById('logout-form').submit();">
                                        Logout
                                    </a>

                                    <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                                        {{ csrf_field() }}
                                    </form>
                                </li>
                            </ul>
                        </li>
                    </ul>
                    @endif
                </div><!-- /.navbar-collapse -->
            </div><!-- /.container-fluid -->
        </nav>
        @include('alerts.success')
        @include('alerts.request')
        @include('alerts.errors')
        <div class="container-fluid">
                @yield('content')
        </div>
    </div>

    <!-- Scripts -->
    <script src="{{ url('/js/app.js') }}"></script>
    @yield('footer')
</body>
</html>
<script>
$(function(){
    $("#wrapper").toggleClass("toggled");
});

window.Laravel = {!! json_encode([
    'csrfToken' => csrf_token(),
]) !!};
</script>
