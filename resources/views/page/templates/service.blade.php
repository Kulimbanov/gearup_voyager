@extends('layouts.main')

@section('content')
    <div class="container">
        {!! $page->getBody() !!}
    </div>
    <services></services>
@endsection
