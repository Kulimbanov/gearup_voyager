@extends('layouts.main')

@section('content')
    <div class="container">
        <section class="py-5 text-center">
            <div class="container">
                <h2 class="text-center">Bicycle Services</h2>
                <p class="text-muted mb-5 text-center">Enjoy the ride with boosted bike performance.</p>
                <div class="row">
                    <div class="service-silver col-sm card m-2 py-5">
                        <font-awesome-icon class="mx-auto my-2" icon="cog" size="4x"></font-awesome-icon>
                        <h3 class="mt-4 mb-1">Silver Pack</h3>
                        <p class="text-muted">We recommend running your bike through these simple procedures every 25
                            hours of ride time or as you feel they are needed.</p>
                        <a href="#" class="button button-silver ">More </a>
                    </div>
                    <div class="service-gold col-sm card m-2 py-5">
                        <font-awesome-icon class="mx-auto my-2" icon="cogs" size="4x"></font-awesome-icon>
                        <h3 class="mt-4 mb-1">Golden Pack</h3>
                        <p class="text-muted">Diagnostic checkup, we’ll dial in your brakes, tune and lube your shifting
                            to perfection, true and tension the wheels, and recharge everything.</p>
                        <a href="#" class="button button-gold">More </a>
                    </div>
                    <div class="service-platinum col-sm card m-2 py-5">
                        <font-awesome-icon class="mx-auto my-2" icon="dna" size="4x"></font-awesome-icon>
                        <h3 class="mt-4 mb-1">Platinum Pack</h3>
                        <p class="text-muted">We’ll start by stripping your bike to the bare frame for a deep clean and
                            inspection, then we’ll repack and rebuild it..</p>
                        <a href="#" class="button button-platinum">More </a>
                    </div>
                </div>
            </div>
        </section>
        <!-- Page Content -->
        {!! $page->getBody() !!}
    </div>
@endsection
