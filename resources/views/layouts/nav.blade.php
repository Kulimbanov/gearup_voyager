<nav class="navbar sticky-top navbar-expand-lg navbar-light bg-light">
    <div class="py-5 text-center bg-light header-image"
         style="background-image: url({{$page->getHeaderImage()}})">
        <form class="d-flex w-100">
            <input class="form-control me-2" type="search" placeholder="Search" aria-label="Search">
            <button class="btn btn-outline-success" type="submit">Search</button>
        </form>
        <div class="d-flex header-wrapper">
            <div class="separate-right">
                <a class="navbar-brand" href="{{ url('/') }}">
                    <img class="logo" src="{{Voyager::image(setting('site.logo'))}}">
                </a>
                <h4 class="mb-3 subtitle">{{ $page->getSubTitle() }}</h4>
            </div>
            <h1 class="mb-3 title">{{ $page->getTitle() }}</h1>
        </div>
        <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent"
                aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
        </button>
        <div class="collapse navbar-collapse" id="navbarSupportedContent">

            {{ menu('Public','bootstrap') }}

        </div>
    </div>
</nav>
