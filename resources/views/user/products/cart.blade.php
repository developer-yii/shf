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
        <div class="col-12">
            <div class="card">
                <div class="card-body">
                    <div class="row">
                        <div class="col-lg-8">
                            <div class="table-responsive">
                                <table class="table table-borderless table-nowrap table-centered mb-0">
                                    <thead class="table-light">
                                        <tr>
                                            <th>Product</th>
                                            <th>Price</th>
                                            <th>Quantity</th>
                                            <th>Total</th>
                                            <th style="width: 50px;"></th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @php 
                                            $total = 0;
                                            $total_qty = 0
                                        @endphp
                                        @if(session('cart'))
                                            @foreach(session('cart') as $id => $details)
                                                @php 
                                                    $total += $details['price'] * $details['quantity'];
                                                    $total_qty += $details['quantity'];
                                                @endphp
                                                <tr data-id="{{ $id }}">
                                                    <td>
                                                        <img src="{{ $baseUrl }}/{{ $details['image'] }}" alt="contact-img" title="contact-img" class="rounded me-3" height="64">
                                                        <p class="m-0 d-inline-block align-middle font-16">
                                                            <a href="{{ route('user.product.detail', $details['id']) }}" class="text-body">{{ $details['name'] }}</a>
                                                            <br>
                                                            <small class="me-2"><b>Size:</b> Large </small>
                                                            <small><b>Color:</b> Light Green
                                                            </small>
                                                        </p>
                                                    </td>
                                                    <td><i class="mdi mdi-currency-eur"></i>{{ $details['price'] }}</td>
                                                    <td>
                                                        <input type="number" min="1" value="{{ $details['quantity'] }}" class="form-control quantity update-cart" data-product-id="{{ $details['id'] }}" />
                                                    </td>
                                                    <td><i class="mdi mdi-currency-eur"></i>{{ $details['price'] * $details['quantity'] }}</td>
                                                    <td>
                                                        <button class="btn btn-danger btn-sm remove-from-cart"><i class="mdi mdi-delete"></i></button>                                  
                                                    </td>
                                                </tr>
                                            @endforeach
                                        @endif
                                    </tbody>
                                </table>
                            </div> <!-- end table-responsive-->

                            <!-- action buttons-->
                            <div class="row mt-4">
                                <div class="col-sm-6">
                                    <a href="{{ route('user.product') }}" class="btn text-muted d-none d-sm-inline-block btn-link fw-semibold">
                                        <i class="mdi mdi-arrow-left"></i> Continue Shopping </a>
                                </div> <!-- end col -->
                                <div class="col-sm-6">
                                    <div class="text-sm-end">
                                        <a href="{{ route('user.checkout') }}" class="btn btn-danger">
                                            <i class="mdi mdi-cart-plus me-1"></i> Checkout </a>
                                    </div>
                                </div> <!-- end col -->
                            </div> <!-- end row-->
                        </div>
                        <!-- end col -->

                        <div class="col-lg-4">
                            <div class="border p-3 mt-4 mt-lg-0 rounded">
                                <h4 class="header-title mb-3">Order Summary</h4>

                                <div class="table-responsive">
                                    <table class="table mb-0">
                                        <tbody>
                                            <tr>
                                                <td>Grand Total :</td>
                                                <td><i class="mdi mdi-currency-eur"></i>{{ $total }}</td>
                                            </tr>
                                            <tr>
                                                <td>Total Quantity :</td>
                                                <td>{{ $total_qty }}</td>
                                            </tr>
                                        </tbody>
                                    </table>
                                </div>
                                <!-- end table-responsive -->
                            </div>

                        </div> <!-- end col -->

                    </div> <!-- end row -->
                </div> <!-- end card-body-->
            </div> <!-- end card-->
        </div> <!-- end col -->
    </div>
    <!-- end page title -->
</div>
<!-- container -->
@endsection
