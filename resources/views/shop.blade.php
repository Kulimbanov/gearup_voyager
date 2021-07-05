@extends('layouts.main')


@section('content')
    <div class="container">
        <br><br>
        <div class="row">
            @foreach($products as $product)
                <div class="col-md-3">
                    <a href="/shop/{{ $product->slug }}">
                        <h3>{{ $product->name }}</h3>
                        <img src="{{ Voyager::image( $product->image ) }}" style="width:100%">
                        <span>{{ $product->description }}</span>
                    </a>
                </div>
            @endforeach
        </div>
    </div>
@endsection
