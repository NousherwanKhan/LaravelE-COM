@extends('layouts.scripts')

@section('navbar')
    <nav class="navbar navbar-expand-lg bg-dark navbar-dark">
        <div class="container-fluid">
            <a class="navbar-brand fs-1 pt-3" href="{{ route('index') }}">Home</a>
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent"
                aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>
            <form class="d-flex" method="post" action="{{ url('searchproduct') }}">
                @csrf
                <input class="form-control me-2" id="search_product" type="search" name="product_name"
                    placeholder="@if ($message = Session::get('message')) {{ $message }} @endif" aria-label="Search">
                <button class="btn btn-outline-success" type="submit">Search</button>

            </form>
            <div class="collapse navbar-collapse" id="navbarSupportedContent">
                @if (Auth::check())
                    @if (Auth::user()->role_id == App\Models\User::ROLE_ADMIN)
                        <ul class="navbar-nav me-auto mb-2 mb-lg-0">                          
                            <li class="nav-item">
                                <a class="nav-link" href="{{ route('post') }}">Posts</a>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link" href="{{ route('users') }}">Users</a>
                            </li>
                            <p class="m-4 d-flex flex-end">
                                <a class="btn btn-warning " href="{{ route('cart') }}">Cart <i
                                        class=" bi bi-cart4 cartCount">
                                    </i> </a>
                            </p>
                        </ul>
                        <a class="btn btn-primary" href="{{ route('logout') }}" role="button">logout</a>
                    @elseif(Auth::user()->role_id == App\Models\User::ROLE_USER)
                        <ul class="navbar-nav me-auto mb-2 mb-lg-0">
                            <li>
                                <a class="nav-link  text-decoration-none" href="{{ route('upload') }}">Wall</a>
                            </li>
                            <p class="m-4 d-flex flex-end">
                                <a class="btn btn-warning " href="{{ route('cart') }}">Cart <i
                                        class=" bi bi-cart4 cartCount">
                                    </i> </a>
                            </p>
                        </ul>
                        <a class="btn btn-primary" href="{{ route('logout') }}" role="button">logout</a>
                    @endif
                @elseif (!Auth::user())
                    <ul class="navbar-nav me-auto mb-2 mb-lg-0">
                        <li class="nav-item">
                            <a class="nav-link text-decoration-none" href="{{ url('/register') }}">Register</a>
                        </li>
                        <li>
                            <a class="nav-link text-decoration-none" href="{{ route('login') }}">Login</a>
                        </li>
                    </ul>
                @endif
            </div>
        </div>
    </nav>

    @if ($message = Session::get('success'))
        <div class="alert alert-success alert-block">
            <button type="button" class="close" data-dismiss="alert">×</button>
            <strong>{{ $message }}</strong>
        </div>
    @endif

    @yield('user')
    @yield('admin')
    @yield('content')
@endsection
