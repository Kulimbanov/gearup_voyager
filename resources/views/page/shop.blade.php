@extends('layouts.main')


@section('content')
    <div class="container">
        <products v-bind:category_id="{{ $page->category_id }}"></products>
    </div>
@endsection


