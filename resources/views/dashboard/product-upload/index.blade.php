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
                <table id="myTable" class="display ">
                    <thead>
                        <tr>
                            <th>ID</th>
                            <th>Image</th>
                            <th>Name</th>
                            <th>Email</th>
                            <th>Product file</th>
                            <th>Action</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($products as $product)
                            <tr>
                                <td>{{ $product->id }}</td>
                                <td>

                                    <img src="{{ asset('public/assets/images/products-upload') }}/{{ $product->photo }}"
                                        class="img-fluid zoom" style="max-width:80px" alt="{{ $product->photo }}">

                                </td>
                                <td>{{ $product->user->name ?? 'None' }}</td>
                                <td>{{ $product->user->email ?? 'None' }}</td>
                                <td>
                                    <a href="{{ asset('public/assets/upload/product_files') }}/{{ $product->product_file }}"
                                        target="_blank">Product file</a>
                                </td>
                                <td>
                                    @if ($product->status !== 'active')
                                        <button type="button" class="btn btn-sm me-2 btn-success" data-bs-toggle="modal"
                                            data-bs-target="#exampleModal{{ $product->id }}"
                                            data-idUpdate="{{ $product->id }}" title="accept"><i
                                                class="fa-solid fa-check"></i></button>
                                    @endif




                                    <form method="POST" action="{{ route('products.destroy', [$product->id]) }}"
                                        class="d-inline-block">
                                        @csrf
                                        @method('delete')
                                        <button class="btn btn-danger btn-sm dltBtn" title="delete"
                                            data-id='{{ $product->id }}' data-toggle="tooltip" data-placement="bottom"
                                            title="Delete">

                                            <i class="fa-solid fa-trash"></i>
                                        </button>
                                    </form>
                                </td>
                            </tr>
                            {{-- Start modal --}}
                            <!-- Modal -->
                            <div class="modal fade" id="exampleModal{{ $product->id }}" tabindex="-1"
                                aria-labelledby="exampleModalLabel" aria-hidden="true">
                                <div class="modal-dialog">
                                    <div class="modal-content">
                                        <div class="modal-header">
                                            <h5 class="modal-title" id="exampleModalLabel">Product details</h5>
                                            <button type="button" class="btn-close" data-bs-dismiss="modal"
                                                aria-label="Close"></button>
                                        </div>
                                        <div class="modal-body">
                                            <form action="{{ route('product-update', $product->id) }}" method="POST">
                                                @csrf
                                                @method('PATCH')
                                                <input type="hidden" name="product_id" value="{{ $product->id }}">
                                                <input type="hidden" name="user_id" value="{{ $product->user_id }}">
                                                <div class="mb-3">
                                                    <label for="product-name">Product Name</label>
                                                    <input type="text" name="name" id="product-name"
                                                        class="form-control" value="{{ $product->name }}">
                                                </div>
                                                <div class="mb-3">
                                                    <label for="quantity">Quantity</label>
                                                    <input type="number" name="quantity" id="quantity"
                                                        class="form-control w-100" value="1">
                                                </div>
                                                <div class="mb-3">
                                                    <label for="price">Price</label>
                                                    <input type="text" id="price" name="price" class="form-control"
                                                        value="{{ $product->price }}">
                                                </div>
                                                <div class="modal-footer">
                                                    <button type="button" class="btn btn-secondary"
                                                        data-bs-dismiss="modal">Close</button>
                                                    <button type="submit" class="btn btn-primary">Save</button>
                                                </div>
                                            </form>
                                        </div>

                                    </div>
                                </div>
                            </div>
                            {{-- End modal --}}
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
