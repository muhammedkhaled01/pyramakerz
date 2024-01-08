@extends('layouts.layout')

@section('content')
    @include('layouts.navbar')
    <div class="container">
        <div class="row">
            <div class="col-12">
                @include('dashboard.layouts.notification')
            </div>
            <div class="col-sm-8 mx-auto">
                <form action="{{ route('update-profile', $user->id) }}" method="post" class="form mt-3">
                    @csrf
                    @method('PATCH')
                    <h2 class="mb-3">Profile</h2>
                    <div class="form-group mb-3">
                        <label for="email" class="mb-2">Email:</label>
                        <input type="email" class="form-control" name="email" value="{{ $user->email }}" readonly
                            disabled>
                    </div>
                    <div class="form-group mb-3">
                        <label for="name" class="mb-2">Name:</label>
                        <input type="text" class="form-control" name="name" value="{{ $user->name }}">
                    </div>
                    <div class="form-group mb-3">
                        <label for="name" class="mb-2">Phone:</label>
                        <input type="number" class="form-control" name="phone" value="{{ $user->phone }}">
                    </div>
                    <div class="text-center">
                        <button class="btn btn-success w-25" type="submit">Submit</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
@endsection
