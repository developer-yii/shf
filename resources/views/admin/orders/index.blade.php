@php
    $userid = Auth::user()->id;
    $baseUrl = asset('backend')."/";
@endphp

@extends('layouts.app')

@section('title','Admin | Product Uses')
@section('content')

    <div class="container-fluid">
        <div class="row">
            <div class="col-12">
                <div class="page-title-box">
                    <div class="page-title-right">
                        <ol class="breadcrumb m-0">
                            <li class="breadcrumb-item"><a href="{{ route('admin.adminHome') }}">Project-X</a></li>
                            <li class="breadcrumb-item active">Orders</li>
                        </ol>
                    </div>
                    <h4 class="page-title">Order List</h4>
                </div>
            </div>
        </div>
        @include('include.flash')
        <span id="success"></span>
        <div class="row">
            <div class="col-12">
                <div class="card">
                    <div class="card-body">
                        <div id="flash-message"></div>
                        <div class="tab-content">
                            <div class="tab-pane show active" id="basic-datatable-preview">
                                <table id="order_datatable" class="table dt-responsive nowrap w-100">
                                    <thead>
                                        <tr>
                                            <th>Order No.</th>                                            
                                            <th>Date</th>                                            
                                            <th>Name</th>
                                            <th>Total</th>
                                            <th width="20%">Status</th>               
                                            <th width="10%">Actions</th>
                                            
                                        </tr>
                                    </thead>
                                </table>
                            </div> <!-- end preview-->
                        </div> <!-- end tab-content-->
                    </div> <!-- end card body-->
                </div> <!-- end card -->
            </div><!-- end col-->
        </div>
        <!-- end row-->
    </div>
@endsection

@section('js')
<script>
    var orderList = "{{ route('order.list') }}"; 
    //var createproduct = "{{ route('admin.product.create') }}";
    var detailOrder = "{{ route('order.detail') }}";
    var changeStatusUrl = "{{ route('order.change_status') }}";
    var imgUrl="{{ asset('product_images/') }}";
    var usertype ="{{ Auth::user()->role }}";
</script>
<script src="{{$baseUrl}}admin/js/order.js?{{ time() }}"></script>
@endsection
