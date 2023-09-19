@php    
    $baseUrl = asset('frontend')."/";
@endphp
@extends('layouts.app-main')

@section('title','Home')
@section('content')


    <div class="bg-img">
      <img src="{{ $baseUrl }}img/bg-img.png" alt="">
    </div>
    <div class="x-elem">
      <img src="{{ $baseUrl }}img/x-elem.png" alt="">
    </div>
    <div class="main-txt">
      <div class="hor-line"></div>
      @include('include.flash')
        @if(Auth::user() !== null)
          <!-- $userid = Auth::user()->id;   -->
          <h4>welcome {{Auth::user()->email}}</h4>
          <a href="{{route('logout')}}">
            <span>Logout</span>
          </a>      
        @endif
      
      <h2>WE ARE CURRENTLY <span>BUILDING</span> </h2>
      <h3>OUR AWESOME WEBSITE</h3>
      <div class="hor-line"></div>

      <a href="{{ route('view') }}" class="button">CHECK PRODUCT CODE</a>
      <p>UNTIL WE HAVE DONE ALL <br />
        CHANGES FOR LEBANON</p>
    </div>

@endsection