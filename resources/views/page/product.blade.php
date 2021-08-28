@extends('layouts.main')

@section('content')
    <div class="single-product">
        <div class="container">
            <div class="py-5">

                <div class="single-product-card">
                    <div class="image image2"
                         style="background-image: url({!! Storage::url($page->getImages()->first()) !!})"></div>
                </div>
                <svg>
                    <filter id="wavy2">
                        <feturbulence x="0" y="0" baseFrequency="0.02" numOctaves="5" seed="1"></feturbulence>
                        <feDisplacementMap in="SourceGraphic" scale="20"/>
                    </filter>
                </svg>
            </div>
        </div>
    </div>
@endsection
