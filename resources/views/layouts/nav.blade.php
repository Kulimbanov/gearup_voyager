<nav class="navbar sticky-top navbar-expand-lg navbar-light bg-light">
    <div class="py-sm-5 pt-0 text-center bg-light header-image" style="background-image: url({{$page->getHeaderImage()}})">
        <div class="d-flex flex-column flex-sm-row align-items-stretch header-wrapper">
            <div class="separate-left">
                <a class="navbar-brand" href="{{ url('/') }}">
                    <img class="logo" src="{{Voyager::image(setting('site.logo'))}}">
                </a>
                <h2 class="mx-2 mx-sm-2 subtitle">{{ $page->getSubTitle() }}</h2>
            </div>
            <div class="separate-right d-flex flex-row flex-wrap">

                <search></search>

                <h1 class="title">{{ $page->getTitle() }}</h1>

                <button class="navbar-toggler" type="button" data-bs-toggle="collapse"
                        data-bs-target="#navbarSupportedContent"
                        aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
                    <span class="navbar-toggler-icon"></span>
                </button>
                <div class="collapse navbar-collapse" id="navbarSupportedContent">
                    {{ menu('Public','bootstrap') }}
                </div>
            </div>
        </div>
    </div>
</nav>
