@extends('dashboard.layouts.layout')

@section('content')
    <div class="container-fluid  pl-0">
        <div class="row">
            <div class="col-12">
                @include('dashboard.layouts.notification')
            </div>
            <div class="col-sm-12 col-md-4 col-lg-2">
                @include('dashboard.layouts.sidebar')
            </div>
            <div class="col-sm-12 col-md-8 col-lg-10">
                @include('dashboard.layouts.navbar')
                <a href="{{route("products.create")}}" class="btn btn-primary">Add new product</a>
                <table id="myTable" class="display ">
                    <thead>
                        <tr>
                            <th>ID</th>
                            <th>Image</th>
                            <th>Name</th>
                            <th>Quantity</th>
                            <th>Status</th>
                            <th>date</th>
                            <th>Action</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($products as $product)
                            <tr>
                                <td>{{ $product->id }}</td>
                                <td>

                                    @if ($product->photo)
                                        <img src="{{ asset('public/assets/images/Products') }}/{{ $product->photo }}"
                                            class="img-fluid zoom" style="max-width:80px" alt="{{ $product->photo }}">
                                    @else
                                        <img src="{{ asset('assets/images/Products/no-image.jpeg') }}" class="img-fluid"
                                            style="max-width:80px" alt="no image">
                                    @endif
                                </td>
                                <td>{{ $product->name }}</td>
                                <td>{{ $product->stock }}</td>
                                <td>{{ $product->status }}</td>
                                <td>{{ $product->created_at->format('Y-m-d') }}</td>
                                <td >

                                    <a href="{{ route('products.edit', $product->id) }}" class="btn btn-primary  btn-sm  mr-1"
                                        data-toggle="tooltip" title="edit" data-placement="bottom">
                                        <i class="fa-solid fa-pen-to-square"></i>
                                    </a>
                                    <form method="POST" class="d-inline-block" action="{{ route('products.destroy', [$product->id]) }}">
                                        @csrf
                                        @method('delete')
                                        <button class="btn btn-danger btn-sm dltBtn" data-id='{{ $product->id }}'
                                            data-toggle="tooltip" data-placement="bottom" title="Delete">

                                            <i class="fa-solid fa-trash"></i>
                                        </button>
                                    </form>
                                </td>
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
