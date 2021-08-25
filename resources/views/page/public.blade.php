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
            <h2 class="text-center">Hot products</h2>
            <p class="text-muted mb-5 text-center">List of our featured hot products.</p>
            <div class="featured-container">
                <div class="box box-1">
                    <div class="cover"><img
                            src="https://s3-us-west-2.amazonaws.com/s.cdpn.io/945546/3433202-893bc9989a52eba0.png"
                            alt=""></div>
                    <button>
                        <div></div>
                    </button>
                </div>
                <div class="box box-2">
                    <div class="cover"><img
                            src="https://s3-us-west-2.amazonaws.com/s.cdpn.io/945546/3433202-964edcf0f07211b0.png"
                            alt=""></div>
                    <button>
                        <div></div>
                    </button>
                </div>
                <div class="box box-3">
                    <div class="cover"><img
                            src="https://s3-us-west-2.amazonaws.com/s.cdpn.io/945546/3433202-2ebb2b6f93add843.png"
                            alt=""></div>
                    <button>
                        <div></div>
                    </button>
                </div>
                <div class="box box-4">
                    <div class="cover"><img
                            src="https://s3-us-west-2.amazonaws.com/s.cdpn.io/945546/3433202-f79c4cc8de2f84ae.png"
                            alt=""></div>
                    <button>
                        <div></div>
                    </button>
                </div>

            </div>
        </section>
        {!! $page->getBody() !!}
    </div>

@endsection
