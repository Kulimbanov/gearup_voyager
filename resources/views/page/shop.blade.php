@extends('layouts.main')


@section('content')
    <div class="container">
        <div class="row">
            <h1>{{ $page->getTitle() }}</h1>
            <div class="col-md-3">
                <product-filter></product-filter>
            </div>
            <div class="col-md-9">
                <div class="pb-3">
                    <products v-bind:category_id="{{ $page->category_id }}"></products>
                </div>
                <div class="row">
                    <div class="col-md-6">.col-md-6</div>
                    <div class="col-md-6">.col-md-6</div>
                </div>
            </div>
        </div>
    </div>
@endsection


