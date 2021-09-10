@extends('layouts.main')

@section('content')
    <div class="single-product">
        <div class="container">
            <div class="py-5 row">
                <div class="col-lg-6">
                    <div class="single-product-gallery">
                        <div class="single-product-gallery-card">
                            <svg>
                                <filter id="wavy2">
                                    <feturbulence x="0" y="0" baseFrequency="0.02" numOctaves="5"
                                                  seed="1"></feturbulence>
                                    <feDisplacementMap in="SourceGraphic" scale="20"/>
                                </filter>
                            </svg>
                            <div class="image"
                                 style="background-image: url({!! Storage::url($page->getImages()->first()) !!})"></div>
                        </div>
                    </div>
                    <div class="single-product-gallery-price">
                        <div class="value">{{ $page->getPrice().' '. setting('site.currency')}}</div>
                    </div>
                </div>

                <div class="col-lg-6">
                    <div class="single-product-description">
                        <h2>{{ $page->getTitle() }}</h2>
                        @foreach($page->getBrands() as $brand)
                            <h3>{{ $brand->name }}</h3>
                        @endforeach
                        <h3>{{ $page->getCategory() }}</h3>
                    </div>
                </div>

            </div>
            <single-product :page="{{json_encode($page->getProperties())}}"></single-product>
        </div>
    </div>
@endsection
