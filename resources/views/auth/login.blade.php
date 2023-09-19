@php    
    $baseUrl = asset('frontend')."/";
@endphp
@extends('layouts.app-frontend')
@section('content')
    <div class="main-container">
        <div class="about-section">
          <div class="container">
            <h1 class="head-1 black">Welcome to Xandoz</h1>
            <div class="danger">
                You have not admin access. Please Login as admin
            </div>
             @if(Session::has('error'))    
                {{ Session::get('error') }}    
            @endif
          </div>      
        </div>
    </div>
@endsection
@section('js')
<script type="text/javascript">

    $.magnificPopup.open({
        items: {
            src: '#sign-in',
            type: 'inline'
        },       
    })
    
</script>
@endsection
