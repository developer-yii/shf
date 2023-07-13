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
                <h4 class="text-dark-50 text-center mt-0 font-weight-bold">{{ __('Reset Password') }}</h4>
            </div>

            @if (session('status'))
                <div class="alert alert-success" role="alert">
                    {{ session('status') }}
                </div>
            @endif

            <form method="POST" action="{{ route('password.email') }}">
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

                <div class="form-group mb-0 text-center">
                    <button class="btn btn-primary" type="submit">{{ __('Send Password Reset Link') }}</button>
                </div>
            </form>            
            <div class="row mt-3">
                <div class="col-12 text-center">
                    <p class="text-muted">Already have account? <a href="{{ route('login') }}" class="text-muted ms-1"><b>Log In</b></a></p>
                </div> <!-- end col-->
            </div>
        </div> <!-- end card-body -->
    </div>


@endsection
