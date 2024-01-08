@extends('layouts.layout')

@section('content')
    @include('layouts.navbar')
    <div class="container mt-5">
        <div class="row">
            <div class="col-12">
                @include('dashboard.layouts.notification')
            </div>
            <div class="col-sm-12 col-md-6">
                <div class="container-product-image">
                    <img src="{{ asset('public/assets/images/Products') }}/{{ $products->photo }}" class="img-fluid"
                        alt="{{ $products->name }}">
                </div>

            </div>

            <div class="col-sm-12 col-md-6">
                <p class="mb-2 h5">Name:</p>
                <div class="product-name mb-4">
                    <h2 class="fw-bold"> {{ $products->name }}</h2>
                </div>
                <p class="product-desc">
                    <span class="mb-2 h5">Description:</span>
                    {!! html_entity_decode(Str::limit($products->description , 2000)) !!}
                </p>
                <p class="product-price">Price: <span class="currency">{{ $products->price }} EGP </span></p>


                {{-- <span>Quantity: {{ $products->stock }}</span> --}}


                <div class="mt-3">
                    <form action="{{ route('store-product-order') }}" method="POST">
                        @csrf

                        @if (Auth::user()->role == 'client')
                            <label for="quantity">
                                Quantity :
                            </label>
                            <input type="number" id="quantity" name="quantity" min="1" max=""
                                value="1">
                            <input type="hidden" name="product_id" value="{{ $products->id }}">
                            <input type="hidden" name="user_id" value="{{ Auth()->user()->id }}">
                            <input type="hidden" name="price" value="{{ $products->price }}">
                            <button class="btn btn-add-to-cart border" type="submit">Buy it now</button>
                        @endif


                    </form>
                </div>



            </div>
        </div>
    </div>
@endsection
