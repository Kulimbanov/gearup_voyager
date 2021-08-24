@extends('layouts.main')

@section('content')
    <div class="contact">
        <div class="py-5">
            {!! $page->getBody() !!}
        </div>
        <contact></contact>
    </div>
    <div class="clearfix"></div>
@endsection
