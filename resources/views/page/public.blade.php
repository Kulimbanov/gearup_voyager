@extends('layouts.main')

@section('content')
    <div class="container">
        <section class="py-5 text-center services">
            <div class="services">
                <h2 class="text-center">Bicycle Services</h2>
                <p class="text-muted mb-5 text-center">Enjoy the ride with boosted bike performance.</p>
                <div class=" d-flex flex-column flex-sm-row">
                    <div class="service silver col-sm p-3 mx-auto my-5">
                        <div class="card wrapper p-3">
                            <font-awesome-icon class="mx-auto my-4" icon="cog" size="4x"></font-awesome-icon>
                            <h3 class="mt-4 mb-1">Silver Pack</h3>
                            <ul>
                                <li>Проверка и штелување на брзини</li>
                                <li>Проверка и штелување на кочници</li>
                                <li>Центрирање на тркала</li>
                                <li>Проверка на предна осовина</li>
                                <li>Проверка на задна осовина</li>
                                <li>Проверка на средна осовина</li>
                                <li>Проверка на гарнитура од волан</li>
                                <li>Подмачкување верига (ланец)</li>
                                <li>Кратко пробрно возење</li>
                                <li>Чистење на велосипедот</li>
                            </ul>
                        </div>
                        <!--                        <a href="#" class="more text-decoration-none text-dark ">Read More</a>-->
                    </div>
                    <div class="service gold col-sm p-3 m-auto mb-5">
                        <div class="card wrapper p-3">
                            <font-awesome-icon class="mx-auto my-4" icon="cogs" size="4x"></font-awesome-icon>
                            <h3 class="mt-4 mb-1">Golden Pack</h3>
                            {{--                            <p class="text-muted mt-1">Diagnostic checkup, we’ll dial in your brakes, tune and lube--}}
                            {{--                                your--}}
                            {{--                                shifting to perfection, true and tension the wheels, and recharge everything.</p>--}}
                        </div>
                        {{--                        <a href="#" class="more text-decoration-none text-dark">Read More</a>--}}
                    </div>
                    <div class="service platinum col-sm p-3 m-auto">
                        <div class="card wrapper p-3">
                            <font-awesome-icon class="mx-auto my-4" icon="dna" size="4x"></font-awesome-icon>
                            <h3 class="mt-4 mb-1">Platinum Pack</h3>
                            {{--                            <p class="text-muted mt-1">We’ll start by stripping your bike to the bare frame for a--}}
                            {{--                                deep clean--}}
                            {{--                                and inspection, then we’ll repack and rebuild it..</p>--}}
                        </div>
                        {{--                        <a href="#" class="more text-decoration-none text-dark">Read More</a>--}}
                    </div>
                </div>
            </div>
        </section>
        <!-- Page Content -->
        {!! $page->getBody() !!}
    </div>

@endsection
