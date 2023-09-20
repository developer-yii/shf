@php
    $baseUrl = asset('storage/product_images');
@endphp
@extends('layouts.app-frontend')

@section('title','Home')
@section('content')
<div class="main-container">

    <div class="products-section">
      <div class="product-top-bg"></div>

      <div class="p-detail-wrap">

        <h2 class="head-1 center black">{{ $product['name'] }}</h2>

        <div class="p-detail-box">
          <div class="p-detail-sec">
            <div class="p-detail-left">
              <div class="product-small">
                <img src="{{ $baseUrl }}/{{ $product['image'] }}" alt="">
              </div>
              <h3 class="head-2">{{ $product['name'] }}</h3>
              <div class="details">
                <div class="detail">
                  <h4>Target</h4>
                  <h5>{{ $product->targets->implode('name', ', ') }}</h5>
                </div>
                <div class="detail">
                  <h4>Volume</h4>
                 
                  <h5>{{ $product['total_volume'] }} {{ getUnitByVolumeType($product['volume_type'])['unit'] }}</h5>
                </div>
                <div class="detail">
                  <h4>Tension</h4>
                  <h5>{{ $product['tension'] }}</h5>
                </div>
                <div class="detail">
                  <h4>Use</h4>
                  <h5>{{ $productUse }}</h5>
                </div>
              </div>
            </div>
            <div class="p-detail-right">
              <a class="popup-image" href="{{ $baseUrl }}/{{ $product['image'] }}">
                <div class="small-image-box">
                  <img src="{{ $baseUrl }}/{{ $product['image'] }}" alt="">
                  <div class="open-icon">
                    <img src="{{ asset('frontend/img/open-icon.svg')}}" alt="">
                  </div>
                </div>
              </a>              
              @if(Auth::user())
                <a href="{{ route('user.product.detail', ['id' => $product->id]) }}" class="button green">Buy this product</a>
              @else
                <div class="popup-buttons">
                  <a href="#sign-in" data-id="{{ $product->id }}" data-route="{{ route('user.product.detail', ['id' => $product->id]) }}" class="popup-link button green">Buy this product</a>
                </div>
              @endif
            </div>
          </div>

          <div class="descr">
            <h4>Description</h4>
            <p><pre style="white-space: pre-wrap;">{{ $product['description'] }}<</p>
          </div>

          <div class="share">
            <h4>Share</h4>
            <a href="javascript:void(0);" id="shareButton">
              <img src="{{ asset('frontend/img/share-icon.svg')}}" alt="">
            </a>
          </div>
        </div>
      </div>

      <div class="product-bottom-section">
        <div class="container">
          <div class="bottom-box">
            <h3 class="head-2 center">Find more products.</h3>
            <h3 class="head-2 center">Check authenticity.</h3>
            <div class="bottom-btns">
              <a href="{{ route('user.product') }}" class="button blue">Discover Products </a>
              <a href="{{ route('frontend.authenticity')}}" class="button white">Authenticate Product</a>
            </div>

            <div class="bottom-image">
              <img src="{{ asset('frontend/img/products-bottom.png')}}" alt="">
            </div>
          </div>
        </div>
      </div>
    </div>


  </div>
@endsection
@section('js')
<script>
    $('.popup-image').magnificPopup({
      type: 'image'      
    });

    document.addEventListener("DOMContentLoaded", function() 
    {
        var shareButton = document.getElementById("shareButton");

        shareButton.addEventListener("click", function() {
            if (isMobile()) {
                // Open sharing options for mobile
                openMobileShareMenu();
            } else {
                // Copy the URL to clipboard for desktop
                copyToClipboard(window.location.href);
            }
        });

        function isMobile() {
            return /Android|webOS|iPhone|iPad|iPod|BlackBerry|IEMobile|Opera Mini/i.test(navigator.userAgent);
        }

        function openMobileShareMenu() {
            // Implement code to open sharing options on mobile (e.g., using share APIs)
            // Example: You can use the Web Share API for modern browsers
            if (navigator.share) {
                navigator.share({
                    title: "Share this page",
                    url: window.location.href
                }).then(() => {
                    console.log("Shared successfully.");
                }).catch((error) => {
                    console.error("Error sharing:", error);
                });
            } else {
                // Fallback for browsers that do not support Web Share API
                // Implement your custom sharing logic or use a third-party sharing library
                alert("Share functionality not supported on this device.");
            }
        }

        function copyToClipboard(text) {
            var textArea = document.createElement("textarea");
            textArea.value = text;
            document.body.appendChild(textArea);
            textArea.select();
            document.execCommand("copy");
            document.body.removeChild(textArea);            
            toastr.success("URL copied to clipboard!");
        }
    });

  </script>
@endsection