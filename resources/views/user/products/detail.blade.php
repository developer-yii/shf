@extends('layouts.app')
@php    
    $baseUrl = asset('storage/product_images');
@endphp
@section('title','User | Dashboard')
@section('content')
  <!-- Start Content-->
  <div class="container-fluid">

    <!-- start page title -->
    <div class="row">
        <div class="col-12">
            <div class="page-title-box">
                
                <h4 class="page-title">Product Details</h4>
            </div>
        </div>
    </div>
    <div class="row">
        <div class="col-12">
            <div class="card">
                <div class="card-body">
                    <div class="row">
                        <div class="col-lg-5">
                            <!-- Product image -->
                            <a href="javascript: void(0);" class="text-center d-block mb-4">
                                <img src="{{ $baseUrl }}/{{ $product['image'] }}" class="img-fluid" style="max-width: 280px;" alt="Product-img">
                            </a>
                        </div> <!-- end col -->
                        <div class="col-lg-7">
                            <form class="ps-lg-4">
                                <!-- Product title -->
                                <h3 class="mt-0">{{ $product['name'] }}<a href="javascript: void(0);" class="text-muted"></a> </h3>

                                <!-- Product description -->
                                <div class="mt-4">
                                    <h6 class="font-14">Price:</h6>
                                    <h3><i class="uil uil-dollar-alt"></i>{{ $product['price'] }}</h3>
                                </div>

                                <!-- Quantity -->
                                <div class="mt-4">
                                    <h6 class="font-14">Quantity</h6>

                                     @php
                                        $cartItem = $cart[$product->id] ?? null;
                                        $quantity = $cartItem['quantity'] ?? 0;
                                    @endphp
                                    <div class="d-flex product">
                                        @if ($quantity == 0)
                                            <a href="#" data-product-id="{{ $product['id'] }}" class="btn add-cart-button btn-primary mt-2 add-to-cart-btn">
                                                <i class="mdi mdi-cart me-1"></i>Add to Cart
                                            </a>
                                        @endif
                                            <input type="number" min="1" value="{{ $quantity }}" class="form-control quantity update-qty" data-product-id="{{ $product->id }}" placeholder="Qty" style="width: 90px; {{ $quantity == 0 ? 'display: none;' : '' }}">
                                            
                                            <a href="{{ route('user.cart') }}" data-product-id="{{ $product->id }}" class="btn btn-primary ms-2 buy-now" style=" {{ $quantity == 0 ? 'display: none;' : '' }}"><i class="mdi mdi-cart me-1"></i> Buy Now</a>
                                        
                                    </div>
                                </div>
                                <div class="mt-4">
                                    <div class="row">
                                        <div class="col-md-12">
                                            <label class="font-14"><b>Product Arts :</b></label>
                                            <span>
                                                {{ $product->arts->implode('name', ', ') }}
                                            </span>
                                        </div>
                                    </div>
                                    <div class="row">
                                        <div class="col-md-12">
                                            <label class="font-14"><b>Product Targets :</b></label>
                                            <span>
                                                {{ $product->targets->implode('name', ', ') }}
                                            </span>
                                        </div>
                                    </div>
                                </div>
                                <!-- Product information -->
                                <div class="mt-2">
                                    <div class="row">
                                        <div class="col-md-4">
                                            <h6 class="font-14">Available Stock :</h6>
                                            <p class="text-sm lh-150">{{ $product['quantity'] }}</p>
                                        </div>
                                        <div class="col-md-4">
                                            <h6 class="font-14">Volume :</h6>
                                            <p class="text-sm lh-150">{{ $product['total_volume'] }}{{ getUnitByVolumeType($product['volume_type'])['unit'] }}</p>
                                        </div>
                                        <div class="col-md-4">
                                            <h6 class="font-14">Tension :</h6>
                                            <p class="text-sm lh-150">{{ $product['tension'] }}</p>
                                        </div>
                                    </div>
                                </div>

                            </form>
                        </div> <!-- end col -->
                    </div> <!-- end row-->
                </div> <!-- end card-body-->
            </div> <!-- end card-->
        </div> <!-- end col-->
    </div>
</div>
<!-- container -->
@endsection