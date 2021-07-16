@extends('layouts.main')


@section('content')
    <div class="container">
        <h1>{{ $page->getTitle() }}</h1>

        {!! $page->getBody() !!}
    </div>
@endsection


