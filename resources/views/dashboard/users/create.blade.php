@extends('dashboard.layouts.layout')

@section('content')
    <div class="container-fluid  pl-0">
        <div class="row">
            <div class="col-sm-12 col-md-4 col-lg-2">
                @include('dashboard.layouts.sidebar')
            </div>
            <div class="col-sm-12 col-md-8 col-lg-10">
                @include('dashboard.layouts.navbar')

                <form action="{{ route('user.store') }}" method="post">
                    @csrf
                    <div class="form-group mb-3">
                        <label for="email">
                            Email:
                        </label>
                        <input type="email" class="form-control" id="email" name="email">
                        @error('email')
                            <span class="text-danger">{{ $message }}</span>
                        @enderror
                    </div>
                    <div class="form-group mb-3">
                        <label for="name">
                            Name:
                        </label>
                        <input type="text" id="name" class="form-control" name="name">
                        @error('name')
                            <span class="text-danger">{{ $message }}</span>
                        @enderror
                    </div>
                    <div class="form-group mb-3">
                        <label for="password">
                            Password:
                        </label>
                        <input type="password" id="password" class="form-control" name="password">
                        @error('password')
                            <span class="text-danger">{{ $message }}</span>
                        @enderror
                    </div>

                    <div class="form-group mb-3">
                        <label for="phone">
                            Phone:
                        </label>
                        <input type="number" class="form-control" name="phone">
                        @error('phone')
                            <span class="text-danger">{{ $message }}</span>
                        @enderror
                    </div>
                    <div class="form-group mb-3">
                        <label for="role">
                            Role:
                        </label>
                        <select name="role" class="form-select" id="role">
                            <option selected disabled>Select role</option>
                            <option value="admin">Admin</option>
                            <option value="technicalTeam">Technical team</option>
                        </select>
                        @error('role')
                            <span class="text-danger">{{ $message }}</span>
                        @enderror
                    </div>
                    <div class="text-center">
                        <button type="submit" class="btn btn-success w-25">Submit</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
@endsection
