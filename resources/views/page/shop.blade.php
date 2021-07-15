@extends('layouts.main')


@section('content')
    <div class="container">
        <h1>{{ $page->getTitle() }}</h1>
        <products type="{{ $page->category_id }}"></products>
    </div>
@endsection


