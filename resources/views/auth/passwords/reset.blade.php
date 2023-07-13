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
                <h4 class="text-dark-50 text-center mt-0 font-weight-bold">Reset Password</h4>
            </div>

                
                    <form method="POST" action="{{ route('password.update') }}">
                        @csrf

                        <input type="hidden" name="token" value="{{ $token }}">

                        <div class="form-group">
                            <input id="email" type="email" class="form-control @error('email') is-invalid @enderror" name="email" value="{{ $email ?? old('email') }}" autocomplete="email" autofocus readonly> 

                            @error('email')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{!! __($message) !!}</strong>
                                </span>
                            @enderror
                        </div>

                        <div class="form-group">
                            <label for="password">Password</label>
                            <input id="password" type="password" class="form-control @error('password') is-invalid @enderror" name="password" required autocomplete="new-password">

                                @error('password')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                        </div>

                        <div class="form-group">
                            <label for="password-confirm">Confirm Password</label>                            
                                <input id="password-confirm" type="password" class="form-control" name="password_confirmation" required autocomplete="new-password">                     
                        </div>

                        <div class="form-group mb-0 text-center">
                            <button class="btn btn-primary" type="submit"> Reset Password </button>
                        </div>                     
                    </form>
                <div class="row mt-3">
                <div class="row mt-3">
                    <div class="col-12 text-center">
                        <p class="text-muted">Already have account? <a href="{{ route('login') }}" class="text-muted ms-1"><b>Log In</b></a></p>
                    </div> <!-- end col-->
                </div>
            </div>
        </div> <!-- end card-body -->
    </div>
@endsection
