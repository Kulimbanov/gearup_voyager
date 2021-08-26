@extends('layouts.main')

@section('content')
    <div class="container">
        <section class="py-5 text-center services">
            <h2 class="text-center">Bicycle Services</h2>
            <p class="text-muted mb-5 text-center">Enjoy the ride with boosted bike performance.</p>
            <div class=" d-flex flex-column flex-sm-row">
                <div class="service silver col-sm p-3 mx-auto my-5">
                    <div class="card wrapper p-3">
                        <font-awesome-icon class="mx-auto my-4" icon="cog" size="4x"></font-awesome-icon>
                        <h3 class="mt-4 mb-1">Silver Pack</h3>
                        <ul class="content">
                            <li>Speed adjustment</li>
                            <li>Breaks adjustment</li>
                            <li>Wheels true-center</li>
                            <li>Complete diagnostic</li>
                            <li><a href="#" class="more text-decoration-none">Read More</a></li>
                        </ul>
                    </div>
                </div>
                <div class="service gold col-sm p-3 m-auto mb-5">
                    <div class="card wrapper p-3">
                        <font-awesome-icon class="mx-auto my-4" icon="cogs" size="4x"></font-awesome-icon>
                        <h3 class="mt-4 mb-1">Golden Pack</h3>
                        <ul class="content">
                            <li>Silver pack +</li>
                            <li>Crank-Set</li>
                            <li>Dropouts</li>
                            <li>Headset</li>
                            <li><a href="#" class="more text-decoration-none">Read More</a></li>
                        </ul>
                    </div>
                </div>
                <div class="service platinum col-sm p-3 m-auto">
                    <div class="card wrapper p-3">
                        <font-awesome-icon class="mx-auto my-4" icon="dna" size="4x"></font-awesome-icon>
                        <h3 class="mt-4 mb-1">Platinum Pack</h3>
                        <ul class="content">
                            <li>Golden Pack +</li>
                            <li>Shock absorber service</li>
                            <li>Cable change</li>
                            <li>Cable housing change</li>
                            <li><a href="#" class="more text-decoration-none">Read More</a></li>
                        </ul>
                    </div>
                </div>
            </div>
        </section>

        <section class="featured">
            <featured-product></featured-product>
        </section>
        {!! $page->getBody() !!}
    </div>

@endsection
