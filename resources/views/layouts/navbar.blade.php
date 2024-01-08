<nav class="navbar navbar-expand-lg navbar-light bg-dark">
    <div class="container">
        <a class="navbar-brand" href="{{ route('home') }}">
            <img src="{{ asset('public/assets/images/logo.png') }}" class="img-fluid logo" alt="Logo">
        </a>
        <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent"
            aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
        </button>
        <div class="collapse navbar-collapse" id="navbarSupportedContent">
            <ul class="navbar-nav ms-auto mb-2 mb-lg-0">
                <li class="nav-item">
                    <a class="nav-link active" aria-current="page" href="{{ route('home') }}">Home</a>
                </li>

                @if (Auth::check())
                    @if (Auth::user()->role == 'admin')
                        <li class="nav-item">
                            <a class="nav-link me-2" href="{{ route('dashboard') }}">Dashboard</a>
                        </li>
                    @elseif (Auth::user()->role == 'client')
                    <li class="nav-item">
                        <a class="nav-link me-2" href="{{ route('upload-product') }}">Upload Product</a>
                    </li>
                        <li class="nav-item">
                            <a class="nav-link me-2" href="{{ route('user-dashboard') }}">Dashboard</a>
                        </li>
                    @endif
                    <div class="dropdown">
                        <div class="text-light mt-2 dropdown-toggle" type="button" id="dropdownMenuButton1"
                            data-bs-toggle="dropdown" aria-expanded="false">
                            {{ Auth::user()->name }}
                        </div>
                        <ul class="dropdown-menu" aria-labelledby="dropdownMenuButton1">
                            <li>
                                {{-- <a class="dropdown-item" href="{{ route('profile', $user->id) }}">
                                    <i class="fas fa-user fa-sm fa-fw mr-2 text-gray-400"></i>
                                    Profile
                                </a> --}}
                                @if (auth()->check())
                                    <a class="dropdown-item" href="{{ route('profile', auth()->user()->id) }}">
                                        <i class="fas fa-user fa-sm fa-fw mr-2 text-gray-400"></i>
                                        Profile</a>
                                @else
                                    <a href="{{ route('login') }}">Login</a>
                                @endif
                            </li>
                            <li><a class="dropdown-item" href="{{ route('logout') }}">
                                    <i class="fas fa-sign-out-alt fa-sm fa-fw mr-2 text-gray-400"></i>
                                    Logout
                                </a></li>
                        </ul>
                    </div>

                    {{-- <a href="{{ route('logout') }}" class="btn btn-danger"> logout </a> --}}
                @else
                    <li class="nav-item btn btn-login">
                        <a class="nav-link " aria-current="page" href="{{ route('login') }}">Login</a>
                    </li>
                    <li class="nav-item btn btn-register">
                        <a class="nav-link " href="{{ route('register') }}">Register</a>
                    </li>
                @endif
            </ul>

        </div>

    </div>
</nav>
