<nav class="navbar">
    <div class="py-sm-5 pt-0 text-center header-image"
         @if($page ?? false)
         style="background-image: url({{ $page->getHeaderImage() }})"
        @endif
    >
        <auth-user></auth-user>
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
