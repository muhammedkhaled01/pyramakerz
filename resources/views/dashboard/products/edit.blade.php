@extends('dashboard.layouts.layout')
@section('page_css')
    <link rel="stylesheet" href="{{ asset('public/dashboard/assets/css/summernote.min.css') }}">
@endsection

@section('content')
    <div class="container-fluid  pl-0">
        <div class="row">
            <div class="col-sm-12 col-md-4 col-lg-2">
                @include('dashboard.layouts.sidebar')
            </div>
            <div class="col-sm-12 col-md-8 col-lg-10">
                @include('dashboard.layouts.navbar')

                <div class="card">
                    <h5 class="card-header">Create Product</h5>
                    <div class="card-body">
                        <form method="post" action="{{ route('products.update' , $product->id) }}" enctype="multipart/form-data">
                            @csrf
                            @method('PATCH')
                            <div class="form-group">
                                <label for="inputTitle" class="col-form-label">Name <span
                                        class="text-danger">*</span></label>
                                <input id="inputTitle" type="text" name="name" placeholder="Enter title"
                                    value="{{ $product->name}}" class="form-control">
                                @error('title')
                                    <span class="text-danger">{{ $message }}</span>
                                @enderror
                            </div>

                            <div class="form-group">
                                <label for="description" class="col-form-label">Description</label>
                                <textarea class="form-control" id="description" name="description">{{$product->description}}</textarea>
                                @error('description')
                                    <span class="text-danger">{{ $message }}</span>
                                @enderror
                            </div>


                            <div class="form-group">
                                <label for="price" class="col-form-label">Price <span
                                        class="text-danger">*</span></label>
                                <input id="price" type="number" name="price" placeholder="Enter price"
                                    value="{{ $product->price }}" class="form-control">
                                @error('price')
                                    <span class="text-danger">{{ $message }}</span>
                                @enderror
                            </div>



                            <div class="form-group">
                                <label for="stock">Quantity <span class="text-danger">*</span></label>
                                <input id="quantity" type="number" name="stock" min="0"
                                    placeholder="Enter quantity" value="{{ $product->stock }}" class="form-control w-100">
                                @error('stock')
                                    <span class="text-danger">{{ $message }}</span>
                                @enderror
                            </div>
                            <div class="form-group">
                                <label for="inputPhoto" class="col-form-label">Image <span
                                        class="text-danger">*</span></label>
                                        <img src="{{ asset('public/assets/images/Products') }}/{{ $product->photo }}" style="max-width: 80px ; display: block; margin-bottom:15px;" alt="{{$product->name}}">
                                        <input type="file" name="photo" class="form-control" value="{{$product->photo}}">


                                <div id="holder" style="margin-top:15px;max-height:100px;"></div>
                                @error('photo')
                                    <span class="text-danger">{{ $message }}</span>
                                @enderror
                            </div>

                            <div class="form-group">
                                <label for="status" class="col-form-label">Status <span
                                        class="text-danger">*</span></label>
                                <select name="status" class="form-control">
                                    <option value="active" {{(($product->status=='active')? 'selected' : '')}}>Active</option>
                                    <option value="inactive" {{(($product->status=='inactive')? 'selected' : '')}}>Inactive</option>
                                </select>
                                @error('status')
                                    <span class="text-danger">{{ $message }}</span>
                                @enderror
                            </div>
                            <div class="form-group mb-3">
                                <button type="reset" class="btn btn-warning">Reset</button>
                                <button class="btn btn-success" type="submit">Create</button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection

@section('page_js')
    <script src="{{ asset('public/dashboard/assets/js/summernote.min.js') }}"></script>

    <script>
        $(document).ready(function() {
            $('#description').summernote({
                placeholder: "Write detail description.....",
                tabsize: 2,
                height: 150
            });
        });
    </script>
@endsection
