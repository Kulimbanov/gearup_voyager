@extends('layouts.main')

@section('content')
    <div class="single-product">

        <single-product :page="{{json_encode($page)}}"
                        :properties="{{json_encode($page->getProperties())}}"
                        :brands="{{json_encode($page->getBrands())}}"
                        :gallery="{{json_encode($page->getImages())}}"
        ></single-product>
        <svg>
            <filter id="imageFrame">
                <feturbulence x="0" y="0" baseFrequency="0.02" numOctaves="5"
                              seed="1"></feturbulence>
                <feDisplacementMap in="SourceGraphic" scale="20"/>
            </filter>
        </svg>
    </div>
@endsection
