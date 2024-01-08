@extends('user.dashboard.layouts.layout')

@section('content')
    <div class="container-fluid  pl-0">
        <div class="row">
            <div class="col-12">
                @include('user.dashboard.layouts.notification')
            </div>
            <div class="col-sm-12 col-md-4 col-lg-2">
                @include('user.dashboard.layouts.sidebar')
            </div>
            <div class="col-sm-12 col-md-8 col-lg-10">
                @include('user.dashboard.layouts.navbar')
                <a href="{{ route('upload-product') }}" class="btn btn-primary">Add new product</a>
                <table id="myTable" class="display ">
                    @php
                        $showDetails = $products->contains('status', 'active');
                    @endphp
                    <thead>
                        <tr>
                            <th>ID</th>
                            <th>Image</th>
                            @if ($showDetails)
                                <th>name</th>
                                <th>price</th>
                            @endif
                            <th>Status</th>
                            {{-- <th>Action</th> --}}
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($products as $product)
                            <tr>
                                <td>{{ $product->id }}</td>
                                <td>

                                    @if ($product->photo)
                                        <img src="{{ asset('public/assets/images/products-upload') }}/{{ $product->photo }}"
                                            class="img-fluid zoom" style="max-width:80px" alt="{{ $product->photo }}">
                                    @else
                                        <img src="{{ asset('assets/images/Products/no-image.jpeg') }}" class="img-fluid"
                                            style="max-width:80px" alt="no image">
                                    @endif
                                </td>
                                @if ($product->status == 'active')
                                    <td>{{ $product->name }}</td>
                                    <td title="for one product">{{ $product->price }}</td>
                                @endif


                                <td>{{ $product->status }}</td>

                            </tr>
                        @endforeach

                    </tbody>
                </table>

            </div>
        </div>
    </div>
@endsection

@section('page_js')
    <script>
        $(document).ready(function() {
            $('#myTable').DataTable();
        });
    </script>
@endsection
