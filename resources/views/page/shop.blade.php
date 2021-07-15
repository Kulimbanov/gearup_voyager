@extends('layouts.main')


@section('content')
    <div class="container">
        <h1>{{ $page->getTitle() }}</h1>
        <products v-bind:category_id="{{ $page->category_id }}"></products>
    </div>
@endsection


