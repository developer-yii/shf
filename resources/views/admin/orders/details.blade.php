@php
$userid = Auth::user()->id;
$imageUrl = asset('product_images')."/";
$baseUrl = asset('backend')."/";
@endphp

@extends('layouts.app')

@section('title','Admin | Product Uses')
@section('content')

<div class="container-fluid">

    <!-- start page title -->
    <div class="row">
        <div class="col-12">
            <div class="page-title-box">
                <div class="page-title-right">
                    <ol class="breadcrumb m-0">
                        <li class="breadcrumb-item"><a href="{{ route('admin.adminHome') }}">Project-X</a></li>
                        <li class="breadcrumb-item"><a href="{{ route('order') }}">Order</a></li>
                        <li class="breadcrumb-item active">Order Details</li>
                    </ol>
                </div>
                <h4 class="page-title">Order #{{ $order->id}}</h4>
            </div>
        </div>
    </div>
    <!-- end page title --> 

    <div class="row justify-content-center">
        <div class="col-lg-7 col-md-10 col-sm-11">
            <div class="horizontal-steps mt-4 mb-4 pb-5" id="tooltip-container">
                <div class="horizontal-steps-content">
                    <div class="step-item">
                        <span data-bs-container="#tooltip-container" data-bs-toggle="tooltip" data-bs-placement="bottom" title="Pending">Order Placed</span>
                    </div>
                    @if($order->status == "Cancelled")
                    <div class="step-item current">
                        <span data-bs-container="#tooltip-container" data-bs-toggle="tooltip" data-bs-placement="bottom" title="Cancelled">Cancelled</span>
                    </div>
                    @else
                    <div class="step-item">
                        <span data-bs-container="#tooltip-container" data-bs-toggle="tooltip" data-bs-placement="bottom" title="Processing">Processing</span>
                    </div>
                    <div class="step-item">
                        <span data-bs-container="#tooltip-container" data-bs-toggle="tooltip" data-bs-placement="bottom" title="Completed">Completed</span>
                    </div>
                    @endif
                </div>
                <div class="process-line" style="width: 100%;"></div>
            </div>
        </div>
    </div>

    <!-- end row -->    
    <div class="row">
        <div class="col-lg-12">
            <div class="card">
                <div class="card-body">
                    <h4 class="header-title mb-3">Billing Information</h4>                    
                    <ul class="list-unstyled mb-0">
                        <li>
                            <p class="mb-2"><span class="fw-bold me-2">Name : </span>{{ $user->first_name }} {{ $user->last_name }}</p>
                            <p class="mb-2"><span class="fw-bold me-2">Phone No : </span> {{ $user->phone_number }}</p>
                            <p class="mb-2"><span class="fw-bold me-2">Order Date : </span> {{ $user->phone_number }}</p>
                            <p class="mb-2"><span class="fw-bold me-2">Country : </span> {{ $user->country_name }}</p>
                            
                        </li>
                    </ul>
                </div>
            </div>
        </div> <!-- end col -->        
    </div>

    <div class="row">
        <div class="col-lg-8">
            <div class="card">
                <div class="card-body">
                    <h4 class="header-title mb-3">Items List</h4>

                    <div class="table-responsive">
                        <table class="table mb-0">
                            <thead class="table-light">
                                <tr>
                                    <th>Image</th>
                                    <th>Name</th>
                                    <th>Quantity</th>
                                    <th>Price</th>
                                    <th>Total</th>
                                </tr>
                            </thead>
                            <tbody>
                                @php 
                                    $total = 0;
                                    $total_qty = 0
                                @endphp
                                
                                @foreach($orderDetail as $id => $details)
                                @php 
                                    $total += $details['price'] * $details['quantity'];
                                    $total_qty += $details['quantity'];
                                @endphp
                                <tr>
                                    <td><img src="{{ $imageUrl }}/{{ $details['image'] }}" alt="contact-img" title="contact-img" class="rounded me-2" height="48"></td>
                                    <td><a href="{{ route('user.product.detail', $details['id']) }}" class="text-body fw-semibold">{{ $details['name'] }}</a></td>
                                    <td>{{ $details['quantity'] }}</td>
                                    <td><i class="mdi mdi-currency-eur"></i>{{ $details['price'] }}</td>
                                    <td><i class="mdi mdi-currency-eur"></i>{{ $details['price'] * $details['quantity'] }}</td>
                                </tr>
                                @endforeach  

                            </tbody>
                        </table>
                    </div>
                    <!-- end table-responsive -->

                </div>
            </div>
        </div> <!-- end col -->
        
        <div class="col-lg-4">
            <div class="card">
                <div class="card-body">
                    <h4 class="header-title mb-3">Order Summary</h4>

                    <div class="table-responsive">
                        <table class="table mb-0">
                            <thead class="table-light">
                                <tr>
                                    <th>Description</th>
                                    <th>Price</th>
                                </tr>
                            </thead>
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
                    @if(IsAdmin(Auth::user()))
                    <hr>
                    <div class="row">
                        <div class="col-8 offset-2">
                            <select name="order_status" class="form-control order_status" data-id="{{ $order->id }}">
                                <option value="Pending" {{ $order->status === 'Pending' ? 'selected' : '' }}>Pending</option>
                                <option value="Processing" {{ $order->status === 'Processing' ? 'selected' : '' }}>Processing</option>
                                <option value="Completed" {{ $order->status === 'Completed' ? 'selected' : '' }}>Completed</option>
                                <option value="Cancelled" {{ $order->status === 'Cancelled' ? 'selected' : '' }}>Cancelled</option>
                            </select>
                        </div>
                        <!-- <div class="col-6">
                            <button class="btn btn-primary" style="width:100%;">Invoice</button>
                        </div> -->
                     </div>
                     @endif
                    <!-- end table-responsive -->

                </div>
            </div>
        </div> <!-- end col -->
    </div>
    <!-- end row -->
</div>
@endsection
@section('js')
<script>
    
    var orderList = "{{ route('order.list') }}";     
    var detailOrder = "{{ route('order.detail') }}";
    var changeStatusUrl = "{{ route('order.change_status') }}";
    var imgUrl="{{ asset('product_images/') }}";
    var usertype ="{{ Auth::user()->role }}";

    $(document).ready(function() {
        
        var orderStatus = "{{ $order->status }}";        
        var stepItems = $(".horizontal-steps-content .step-item");
        var processLine = $(".process-line");        
        if (orderStatus == "Pending") {
            stepItems.removeClass("current");
            stepItems.eq(0).addClass("current");
            processLine.css("width", "0%");
        } else if (orderStatus == "Processing") {
            stepItems.removeClass("current");
            stepItems.eq(1).addClass("current");
            processLine.css("width", "50%");
        } else if (orderStatus == "Completed") {
            stepItems.removeClass("current");
            stepItems.eq(2).addClass("current");
            processLine.css("width", "100%");
        }        
        $('[data-bs-toggle="tooltip"]').tooltip();
    });

</script>
<script src="{{$baseUrl}}admin/js/order.js?{{ time() }}"></script>
@endsection
