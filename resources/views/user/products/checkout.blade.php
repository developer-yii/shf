@extends('layouts.app')
@php
    $baseUrl = asset('storage/product_images');
@endphp
@section('title','User | Order Details')
@section('content')
  <!-- Start Content-->
  <div class="container-fluid">

    <!-- start page title -->
    <div class="row">
        <div class="col-12">
            <div class="page-title-box">

                <h4 class="page-title">Checkout</h4>
            </div>
        </div>
    </div>
    <div class="row">
        <div class="col-12">
            <div class="card">
                <div class="card-body">
                    <!-- Steps Information -->
                    <div class="tab-content">
                        <!-- Billing Content-->
                        <div class="tab-pane show active" id="billing-information">
                            <div class="row">
                                <div class="col-lg-12">
                                    <span id="success">
                                        <div class="alert alert-success alert-dismissible bg-success text-white border-0 fade show" role="alert">
                                        <strong>Your order has been successfully placed. </strong>
                                        </div>
                                    </span>
                                    <p class="text-muted mb-4"></p>
                                </div>
                                <div class="col-lg-8">
                                    <div class="border p-3 mt-4 mt-lg-0 rounded">
                                        <h4 class="header-title mb-3">Order Summary : Order-{{ $order->id }}</h4>
                                        <div class="table-responsive">
                                            <table class="table table-nowrap table-centered mb-0">
                                                <tbody>
                                                    @php $total = 0 @endphp
                                                    @if($order->user_id == Auth::user()->id)
                                                    @foreach($orderDetail as $id => $details)
                                                        @php $total += $details->price * $details->quantity @endphp
                                                        <tr>
                                                            <td>
                                                                <img src="{{ $baseUrl }}/{{ $details->image }}" alt="contact-img" title="contact-img" class="rounded me-2" height="48">
                                                                <p class="m-0 d-inline-block align-middle">
                                                                    <a href="{{ route('user.product.detail', $details->product_id) }}" class="text-body fw-semibold">{{ $details->name }}</a>
                                                                    <br>
                                                                    <small>{{ $details->quantity }} x <i class="uil uil-dollar-alt"></i>{{ $details->price }}</small>
                                                                </p>
                                                            </td>
                                                            <td class="text-end">
                                                                <i class="uil uil-dollar-alt"></i>{{ $details->price * $details->quantity }}
                                                            </td>
                                                        </tr>
                                                    @endforeach
                                                        <tr class="text-end">
                                                            <td>
                                                                <h5 class="m-0">Total:</h5>
                                                            </td>
                                                            <td class="text-end fw-semibold">
                                                                <i class="uil uil-dollar-alt"></i>{{ $total }}
                                                            </td>
                                                        </tr>
                                                    @endif
                                                </tbody>
                                            </table>
                                        </div>
                                        <!-- end table-responsive -->
                                    </div> <!-- end .border-->

                                </div> <!-- end col -->
                            </div> <!-- end row-->
                        </div>
                        <!-- End Billing Information Content-->
                    </div> <!-- end tab content-->

                </div> <!-- end card-body-->
            </div> <!-- end card-->
        </div> <!-- end col -->
    </div>
    <!-- end page title -->
</div>
<!-- container -->
@endsection