<nav class="navbar">
    <div class="py-sm-5 pt-0 text-center header-image"
         style="background-image: url({{$page->getHeaderImage()}})">
        <div class="holder">
            <div class="d-flex flex-column-reverse flex-sm-row align-items-stretch header-wrapper container">
                <div class="separate-left">
                    <a class="navbar-brand" href="{{ url('/') }}">
                        <img class="logo" src="{{Voyager::image(setting('site.logo'))}}">
                        <img class="logo dark" src="{{Voyager::image(setting('site.logo_dark'))}}">
                    </a>
                    <h2 class="mx-2 mx-sm-2 subtitle">{{ $page->getSubTitle() }}</h2>
                </div>
                <div class="separate-right d-flex flex-column-reverse flex-sm-column flex-wrap">
                    <search></search>
                    <h1 class="title">{{ $page->getTitle() }}</h1>
                    <nav-menu></nav-menu>
                    <div class="menu">
                        {{ menu('Public','bootstrap') }}
                    </div>
                </div>
            </div>
        </div>
    </div>
</nav>
