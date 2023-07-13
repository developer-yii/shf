@php    
    $baseUrl = asset('backend') . '/';    
@endphp
@extends('layouts.main')
@section('content')

    <div class="card">

        <!-- Logo -->
        <div class="card-header pt-4 pb-4 text-center bg-primary">
            <a href="index.html">
                <span><img src="{{ $baseUrl }}assets/images/logo.png" alt="" height="18"></span>
            </a>
        </div>

        <div class="card-body p-4">
            @include('include.flash')
            <div class="text-center w-75 m-auto">
                <h4 class="text-dark-50 text-center mt-0 font-weight-bold">Sign In</h4>
            </div>

            <form method="POST" action="{{ route('login') }}">
                @csrf

                <div class="form-group">
                    <label for="emailaddress">Email address</label>
                    <input class="form-control @error('email') is-invalid @enderror" type="email" id="email"
                        name="email" placeholder="Enter your email" value="{{ old('email') }}">

                    @error('email')
                        <div class="invalid-feedback">
                            {{ $message }}
                        </div>
                    @enderror
                </div>

                <div class="form-group">
                    @if (Route::has('password.request'))
                    <a href="{{ route('password.request') }}" class="text-muted float-right">
                        <small>Forgot your password?</small></a>
                    @endif    
                    <label for="password">Password</label>
                    <div class="input-group input-group-merge">
                        <input type="password" id="password" class="form-control @error('password') is-invalid @enderror" placeholder="Enter your password" name="password"> 
                        <div class="input-group-append" data-password="false">
                            <div class="input-group-text">
                                <span class="password-eye"></span>
                            </div>
                        </div>
                        @error('password')
                        <div class="invalid-feedback">
                            {{ $message }}
                        </div>
                        @enderror
                    </div>
                </div>

                <div class="form-group mb-3">
                    <div class="custom-control custom-checkbox">
                        <input type="checkbox" class="custom-control-input" id="checkbox-signin" checked>
                        <label class="custom-control-label" for="checkbox-signin">Remember me</label>
                    </div>
                </div>

                <div class="form-group mb-0 text-center">
                    <button class="btn btn-primary" type="submit"> Log In </button>
                </div>
            </form>
            <div class="row mt-3">
                <div class="col-12 text-center">
                    <p class="text-muted">Don't have an account? <a href="{{ route('register') }}" class="text-muted ms-1"><b>Sign Up</b></a></p>
                </div> <!-- end col -->
            </div>
        </div> <!-- end card-body -->
    </div>
@endsection
