@extends('layouts.layout')

@section('content')
    @include('layouts.navbar')
    @include('dashboard.layouts.notification')
    <div class="container">
        <div class="row">
            <div class="col-sm-8 m-auto">
                <form class="mt-4" action="{{ route('store-upload-product') }}" method="post" enctype="multipart/form-data">
                    @csrf
                    <h2 class="title-page">Upload product page</h2>
                    <div class="mb-3">
                        <label for="uploadImage" class="mb-3">
                            Upload Product image
                        </label>
                        <input type="file" class="form-control" value="{{ old('photo') }}" name="photo"
                            id="uploadImage">
                        @error('photo')
                            <span class="text-danger">{{ $message }}</span>
                        @enderror
                    </div>
                    <div class="mb-3">
                        <label for="uploadFile" class="mb-3">
                            Upload File description
                        </label>
                        <input type="file" class="form-control" value="{{ old('product_file') }}" name="product_file"
                            id="uploadFile">
                        @error('product_file')
                            <span class="text-danger">{{ $message }}</span>
                        @enderror
                    </div>
                    <div class="text-center">
                        <button class="btn bg-main-color w-25 ">Upload</button>

                    </div>
                </form>
            </div>
        </div>
    </div>
@endsection
