@extends('layouts.main')

@section('content')
    <div class="container">
        <div class="py-5">
            {!! $page->getBody() !!}
        </div>
        <contact></contact>
    </div>
    <div class="container"></div>
@endsection
