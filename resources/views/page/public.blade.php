@extends('layouts.main')

@section('content')
    <div class="container">
        {!! $page->getBody() !!}
    </div>
@endsection
