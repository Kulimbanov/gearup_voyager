<!DOCTYPE html>
<html lang="{{ app()->getLocale() }}">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ setting('site.title', 'Laravel') }}</title>

    <!-- Fonts -->
    <link rel="dns-prefetch" href="https://fonts.gstatic.com">
    <link href="https://fonts.googleapis.com/css?family=IBM+Plex+Sans+Condensed:500|Roboto:400,700" rel="stylesheet">

    <!-- Styles -->
    <link href="{{ asset('css/app.css') }}" rel="stylesheet">
</head>
<body>
<header>
@include('layouts.nav')
<!-- Jumbotron -->
    <div class="p-5 text-center bg-light header-image"
         style="background-image: url({{Voyager::image(setting('site.headerImage'))}})">
        <h1 class="mb-3 text-light">{{ $page->getTitle() }}</h1>
        <h4 class="mb-3 text-light">{{ $page->getSubTitle() }}</h4>
        <a class="btn btn-primary" href="" role="button">Call to action</a>
    </div>
{{--    <nav style="--bs-breadcrumb-divider: '';" aria-label="breadcrumb">--}}
{{--        <ol class="breadcrumb">--}}
{{--            <li class="breadcrumb-item"><a href="#">Home</a></li>--}}
{{--            <li class="breadcrumb-item active" aria-current="page">Library</li>--}}
{{--        </ol>--}}
{{--    </nav>--}}
    <!-- Jumbotron -->
</header>

<div id="app">
    @yield('content')
</div>

@include('layouts.footer')
</body>
</html>
