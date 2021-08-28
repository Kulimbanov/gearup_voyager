@extends('layouts.main')

@section('content')
    <div class="product">
        <div class="py-5">
            {!! $page->getBody() !!}
        </div>
    </div>
@endsection
