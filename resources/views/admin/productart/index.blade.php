@php
    $userid = Auth::user()->id;
    $baseUrl = asset('backend')."/";
@endphp

@extends('layouts.app')

@section('title','Admin | Product Art')
@section('content')

    <div class="container-fluid">
        <div class="row">
            <div class="col-12">
                <div class="page-title-box">
                    <div class="page-title-right">
                        <ol class="breadcrumb m-0">
                            <li class="breadcrumb-item"><a href="{{ route('admin.adminHome') }}">SHF</a></li>
                            <li class="breadcrumb-item active">Product Arts</li>
                        </ol>
                    </div>
                    <h4 class="page-title">Product Arts List</h4>
                </div>
            </div>
        </div>
        @include('include.flash')
        <span id="success"></span>
        <div class="row">
            <div class="col-12">
                <div class="card">
                    <div class="card-body">
                        <div class="row">
                            <div class="col-4">
                                <h4 class="header-title">Product Arts List</h4>
                            </div>
                            <div class="col-8">
                                <button class="btn btn-primary btn-sm" type="button" data-toggle="modal" data-target="#addproductart" style="margin-bottom:1em; float: right;">Add Product Art</button>
                            </div>
                        </div>

                        <div class="tab-content">
                            <div class="tab-pane show active" id="basic-datatable-preview">
                                <table id="productart_datatable" class="table dt-responsive nowrap w-100">
                                    <thead>
                                        <tr>
                                            <!-- <th>ID</th> -->
                                            <th width="50%">Name</th>
                                            <th>Action</th>
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
@section('modal')
    <div id="addproductart" class="modal fade" tabindex="-1" role="dialog" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-body">
                    <div class="text-center mt-2 mb-4">
                    <h5 class="modal-title"><span id="exampleModalLabel">Add Product Art</span>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button></h5>
                    </div>
                    <form class="pl-3 pr-3" id="add_productart">
                        @csrf
                        <div class="form-group form-input">
                            <input type="hidden" name="product_art_id" class="product-art-id">
                        </div>

                        <div class="form-group form-input">
                            <label for="username">Product Art<span class="text-danger">*</span></label>
                            <input class="form-control" type="text" id="name" name="name"
                                placeholder="Enter product art here...">
                                <span class="text-danger error"></span>
                        </div>

                        <div class="form-group text-center">
                            <button class="btn btn-primary" type="submit">Save</button>
                        </div>

                    </form>

                </div>
            </div><!-- /.modal-content -->
        </div><!-- /.modal-dialog -->
    </div><!-- /.modal -->
@endsection
@section('js')
<script>
    var productartList = "{{ route('admin.productart.list') }}";
    var createproductart = "{{ route('admin.productart.create') }}";
    var getproductart = "{{ route('admin.productart.detail') }}";
    var deleteproductart = "{{ route('admin.productart.delete') }}";
</script>
<script src="{{$baseUrl}}admin/js/productart.js"></script>

@endsection
