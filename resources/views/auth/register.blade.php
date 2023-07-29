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
                <h4 class="text-dark-50 text-center mt-0 font-weight-bold">Register</h4>
            </div>

            <form method="POST" action="{{ route('register') }}">
                @csrf

                <div class="form-group">
                    <label for="first_name">{{ __('First Name') }}</label>
                    <input id="first_name" type="text" class="form-control @error('first_name') is-invalid @enderror" name="first_name" value="{{ old('first_name') }}" autocomplete="first_name" {{ $errors->has('first_name') ? 'autofocus' : '' }}>

                    @error('first_name')
                        <span class="invalid-feedback" role="alert">
                            <strong>{{ $message }}</strong>
                        </span>
                    @enderror
                </div>

                <div class="form-group">
                    <label for="last_name">{{ __('Last Name') }}</label>
                    <input id="last_name" type="text" class="form-control @error('last_name') is-invalid @enderror" name="last_name" value="{{ old('last_name') }}" autocomplete="last_name" {{ $errors->has('last_name') ? 'autofocus' : '' }}>

                    @error('last_name')
                        <span class="invalid-feedback" role="alert">
                            <strong>{{ $message }}</strong>
                        </span>
                    @enderror                   
                </div>

                <div class="form-group">
                    <label for="email">{{ __('Email Address') }}</label>
                    <input id="email" type="email" class="form-control @error('email') is-invalid @enderror" name="email" value="{{ old('email') }}" autocomplete="email" {{ $errors->has('email') ? 'autofocus' : '' }}>

                    @error('email')
                        <span class="invalid-feedback" role="alert">
                            <strong>{{ $message }}</strong>
                        </span>
                    @enderror                   
                </div>

                <div class="form-group">
                    <label for="phone_number">{{ __('Phone Number') }}</label>
                    <input id="phone_number" type="text" class="form-control @error('phone_number') is-invalid @enderror" name="phone_number" value="{{ old('phone_number') }}" autocomplete="phone_number" {{ $errors->has('phone_number') ? 'autofocus' : '' }}>

                    @error('phone_number')
                        <span class="invalid-feedback" role="alert">
                            <strong>{{ $message }}</strong>
                        </span>
                    @enderror                    
                </div>
                <div class="form-group">
                    <label for="country" class="form-label">Select Country:</label>
                    <select id="country" name="country" class="form-control @error('country') is-invalid @enderror" {{ $errors->has('country') ? 'autofocus' : '' }}>
                        <option value="" class="d-none">Select Country</option>
                        @foreach ($countries as $country)
                            <option value="{{$country->id}}" {{ old('country') == $country->id ? 'selected' : '' }}>{{$country->name}}</option>
                        @endforeach
                    </select>
                    @error('country')
                        <span class="invalid-feedback" role="alert">
                            <strong>{{ $message }}</strong>
                        </span>
                    @enderror   
                </div>

                <div class="form-group">
                    <label for="password">{{ __('Password') }}</label>
                    <div class="input-group input-group-merge">
                        <input type="password" id="password" class="form-control @error('password') is-invalid @enderror" placeholder="Enter your password" name="password" {{ $errors->has('password') ? 'autofocus' : '' }}> 
                        <div class="input-group-append" data-password="false">
                            <div class="input-group-text">
                                <span class="password-eye"></span>
                            </div>
                        </div>
                        @error('password')
                        <span class="invalid-feedback" role="alert">
                            <strong>{{ $message }}</strong>
                        </span>
                        @enderror
                    </div>       
                </div>

                <div class="form-group">
                    <label for="password-confirm">{{ __('Confirm Password') }}</label>                    
                    <input id="password-confirm" type="password" class="form-control" name="password_confirmation" autocomplete="new-password" {{ $errors->has('password-confirm') ? 'autofocus' : '' }}>                    
                </div>


                <div class="form-group mb-0 text-center">
                    <button class="btn btn-primary" type="submit"> Register </button>
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