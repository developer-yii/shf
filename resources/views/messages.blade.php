@php    
    $baseUrl = asset('backend') . '/';    
@endphp
@extends('layouts.main')
@section('content')

    <div class="card">

        <!-- Logo -->
        <div class="card-header pt-4 pb-4 text-center bg-primary">
            <a href="#">
                <span><img src="{{ $baseUrl }}assets/images/logo.png" alt="" height="18"></span>
            </a>
        </div>
        <div class="card-body p-4">
            <div class="card-body p-4">
                            
                <div class="text-center m-auto">
                    <img src="{{ $baseUrl }}assets/images/mail_sent.svg" alt="mail sent image" height="64" />
                    @if(Session::has('verify'))                        
                        <h4 class="text-dark-50 text-center mt-4 fw-bold"></h4> 
                        <p class="text-muted mb-4">                        
                            {{ Session::get('verify') }} 
                        </p>
                    @endif                    
                </div>

                <form action="{{ route('frontend.home') }}">
                    <div class="mb-0 text-center">
                        <button class="btn btn-primary" type="submit"><i class="mdi mdi-home me-1"></i> Back to Home</button>
                    </div>
                </form>

            </div>

          
            
        </div> <!-- end card-body -->
    </div>

@endsection
