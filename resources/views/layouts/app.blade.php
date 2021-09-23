<!DOCTYPE html>
<html lang="{{ app()->getLocale() }}">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ setting('site.title') }}</title>

    <!-- Fonts -->
    <link rel="dns-prefetch" href="https://fonts.gstatic.com">
    <link href="https://fonts.googleapis.com/css?family=IBM+Plex+Sans+Condensed:500|Roboto:400,700" rel="stylesheet">

    <!-- Styles -->
    <link href="{{ asset('css/app.css') }}" rel="stylesheet">
</head>
<body>
<div id="app">
    <header class="header">
        <nav class="navbar">
            <div class="py-sm-5 pt-0 text-center header-image"
                 @if($page ?? false)
                 style="background-image: url({{ $page->getHeaderImage() }})"
                @endif
            >
                <auth-user
                    :user="{{ json_encode(Auth::user()) }}"
                    :token="{{ json_encode($token)  }}"
                    :email="{{ json_encode($email) }}"
                ></auth-user>
                <div class="holder">
                    <div class="d-flex flex-column-reverse flex-sm-row align-items-stretch header-wrapper container">
                        <div class="separate-left">
                            <a class="navbar-brand" href="{{ url('/') }}">
                                <img class="logo" src="{{Voyager::image(setting('site.logo'))}}">
                                <img class="logo dark" src="{{Voyager::image(setting('site.logo_dark'))}}">
                            </a>
                            @if($page ?? false)
                                <h2 class="mx-2 mx-sm-2 subtitle">{{ $page->getSubTitle() }}</h2>
                            @endif
                        </div>
                        <div class="separate-right d-flex flex-column-reverse flex-sm-column flex-wrap">
                            <search></search>
                            @if($page ?? false)
                                <h1 class="title">{{ $page->getTitle() ?? 'default' }}</h1>
                                <device-menu></device-menu>
                                <div class="menu">
                                    {{ menu('Public','bootstrap') }}
                                </div>
                            @endif
                        </div>
                    </div>
                </div>
            </div>
        </nav>
    </header>
    @yield('content')
    <footer class="footer text-center">
        @include('layouts.footer')
    </footer>
    <switch-mode class="dark-light"></switch-mode>
</div>
<script src="{{ asset('js/app.js') }}" defer></script>
</body>
</html>
