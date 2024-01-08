@extends('layouts.layout')

@section('content')
    @include('layouts.navbar')
    <div class="container">
        <div class="row">
            @foreach ($products as $product)
                <div class="col-sm-12 col-md-6 col-lg-3">
                    <a href="{{ route('product-view', $product->id) }}" class="card mt-4">
                        <div class="card-header">
                            <img src="{{ asset('public/assets/images/Products') }}/{{ $product->photo }}"
                                class="img-fluid product-image" alt="">
                        </div>
                        <div class="card-body">
                            <h3 class="product-name">{{ $product->name }}</h3>
                            <p class="product-desc">
                                {!! html_entity_decode(Str::limit($product->description, 19)) !!}
                            </p>
                            <span>Stock: {{ $product->stock }}</span>

                        </div>
                        <div class="card-footer">
                            <p class="product-price ">Price: <span class="currency">{{ $product->price }} EGP </span></p>

                        </div>
                    </a>
                </div>
            @endforeach

        </div>
    </div>
@endsection
