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
                            <li class="breadcrumb-item active">Product Uses</li>
                        </ol>
                    </div>
                    <h4 class="page-title">Product Uses List</h4>
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
                                <h4 class="header-title">Product Uses List</h4>
                            </div>
                            <div class="col-8">
                                <button class="btn btn-primary btn-sm" type="button" data-toggle="modal" data-target="#addproductuse" style="margin-bottom:1em; float: right;">Add Product Use</button>
                            </div>
                        </div>
                        
                        <div class="tab-content">
                            <div class="tab-pane show active" id="basic-datatable-preview">
                                <table id="productuse_datatable" class="table dt-responsive nowrap w-100">
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
    <div id="addproductuse" class="modal fade" tabindex="-1" role="dialog" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-body">
                    <div class="text-center mt-2 mb-4">
                    <h5 class="modal-title"><span id="exampleModalLabel">Add Product Use</span>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button></h5>
                    </div>
                    <form class="pl-3 pr-3" id="add_productuse">
                        @csrf
                        <div class="form-group form-input">
                            <input type="hidden" name="product_use_id" class="product-use-id">
                        </div>

                        <div class="form-group form-input">
                            <label for="username">Product Use<span class="text-danger">*</span></label>
                            <input class="form-control" type="text" id="use" name="use"
                                placeholder="Enter product use here...">
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
    var productuseList = "{{ route('admin.productuse.list') }}"; 
    var createproductuse = "{{ route('admin.productuse.create') }}";
    var getproductuse = "{{ route('admin.productuse.detail') }}";
    var deleteproductuse = "{{ route('admin.productuse.delete') }}";
</script>
<script src="{{$baseUrl}}admin/js/productuse.js"></script>

@endsection
