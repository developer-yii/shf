@extends('layouts.app')
@php
    $baseUrl = asset('product_images')."/";
@endphp
@section('title','User | Dashboard')
@section('content')
  <!-- Start Content-->
  <div class="container-fluid">

    <!-- start page title -->
    <div class="row">
        <div class="col-12">
            <div class="page-title-box">
                
                <h4 class="page-title">Products</h4>
            </div>
        </div>
    </div>
    <div class="row">
        @foreach($products as $product)
            <div class="col-sm-6 col-lg-3">
                <div class="card">
                    <img src="{{ $product->getImageUrl() }}" class="card-img-top product-img" alt="{{ $product->name }}" title="{{ $product->name }}">
                    <div class="card-body text-center product">
                        <h5 class="card-title">{{ $product->name }} - {{ $product->tension}}</h5>
                        <h5 class="card-title"> <i class="mdi mdi-currency-inr"></i>{{ $product->price}} / {{ $product->total_volume}}</h5>
                        <a href="{{ route('user.product.detail', ['id' => $product->id]) }}" class="btn view-cart-button btn-info">View Details</a>
                        
                        @php
                            $cartItem = $cart[$product->id] ?? null;
                            $quantity = $cartItem['quantity'] ?? 0;
                        @endphp

                        <div class="product d-inline">
                            @if ($quantity == 0)
                                <a href="#" data-product-id="{{ $product->id }}" class="btn add-cart-button btn-primary add-to-cart-btn">
                                    <i class="mdi mdi-cart me-1"></i>Add to Cart
                                </a>
                            @endif
                                <input type="number" min="1" value="{{ $quantity }}" class="quantity update-qty" data-product-id="{{ $product->id }}" placeholder="Qty" style="width: 90px; {{ $quantity == 0 ? 'display: none;' : '' }}">                            
                        </div>
                        
                    </div> <!-- end card-body -->
                </div> <!-- end card -->
            </div> <!-- end col-->
        @endforeach     
    </div>
    <!-- end page title -->
</div>
<!-- container -->
@endsection