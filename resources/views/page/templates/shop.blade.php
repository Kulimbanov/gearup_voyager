@extends('layouts.main')

@section('content')
    <div class="container">
        <div class="py-5">
            <products v-bind:category_id="{{ $page->category_id }}"></products>
        </div>
    </div>
@endsection
