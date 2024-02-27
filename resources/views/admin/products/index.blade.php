@php
    $userid = Auth::user()->id;
    $baseUrl = asset('backend')."/";
@endphp

@extends('layouts.app')

@section('title','Admin | Product List')
@section('content')

    <div class="container-fluid">
        <div class="row">
            <div class="col-12">
                <div class="page-title-box">
                    <div class="page-title-right">
                        <ol class="breadcrumb m-0">
                            <li class="breadcrumb-item"><a href="{{ route('admin.adminHome') }}">SHF</a></li>
                            <li class="breadcrumb-item active">Products</li>
                        </ol>
                    </div>
                    <h4 class="page-title">Products List</h4>
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
                                <h4 class="header-title">Products List</h4>
                            </div>
                            @if(Auth::user()->role == "1")
                                <div class="col-8">
                                    <button class="btn btn-primary btn-sm" type="button" data-toggle="modal" data-target="#addproduct" style="margin-bottom:1em; float: right;">Add Product</button>
                                </div>
                            @endif
                        </div>

                        <div class="tab-content">
                            <div class="tab-pane show active" id="basic-datatable-preview">
                                <table id="product_datatable" class="table dt-responsive nowrap w-100">
                                    <thead>
                                        <tr>
                                            <!-- <th>ID</th> -->
                                            <th>Image</th>
                                            <th>Name</th>
                                            <th>Price</th>
                                            <th>Volume</th>
                                            <th>Tension</th>
                                            <th>Quantity</th>
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
    <div id="addproduct" class="modal fade" tabindex="-1" role="dialog" aria-hidden="true">
        <div class="modal-dialog modal-lg">
            <div class="modal-content">
                <div class="modal-body">

                    <div class="text-center mt-2 mb-4">
                        <h5 class="modal-title"><span id="exampleModalLabel">Add Product</span>
                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                <span aria-hidden="true">&times;</span>
                            </button></h5>
                    </div>
                    <form class="pl-3 pr-3" id="add_product" enctype="multipart/form-data">
                        @csrf
                        <div class="form-group form-input">
                            <input type="hidden" name="product_id" class="product-id" id="product-id">
                            <input type="hidden" name="hidden_image" class="hidden_image">
                        </div>

                        <div class="row">
                            <div class="form-group form-input col-md-6">
                                <label for="productname">Product Name<span class="text-danger">*</span></label>
                                <input class="form-control" type="text" id="name" name="name">
                                <span class="text-danger error"></span>
                            </div>

                            <div class="form-group form-input col-md-6">
                                <label for="price">Price<span class="text-danger">*</span></label>
                                <input class="form-control" type="text" id="price" name="price">
                                <span class="text-danger error"></span>
                            </div>
                        </div>

                        <div class="row">
                            <div class="form-group form-input col-md-6">
                                <label for="productart">Product Arts<span class="text-danger">*</span></label>
                                <select class="select2 form-control select2-multiple" name="product_arts[]" id="product_arts" data-toggle="select2" multiple="multiple">
                                    @foreach($productArts as $productArt)
                                        <option value="{{ $productArt->id }}">{{ $productArt->name }}</option>
                                    @endforeach
                                </select>
                                <span class="text-danger error"></span>
                            </div>

                            <div class="form-group form-input col-md-6">
                                <label for="producttarget">Select Product Target<span class="text-danger">*</span></label>
                                <select class="select2 form-control select2-multiple" name="product_target[]" id="product_target" data-toggle="select2" multiple="multiple">
                                    @foreach($productTargets as $productTarget)
                                        <option value="{{ $productTarget->id }}">{{ $productTarget->name }}</option>
                                    @endforeach
                                </select>
                                <span class="text-danger error"></span>
                            </div>
                        </div>

                        <div class="row">
                            <div class="form-group form-input col-md-6">
                                <label for="productuse">Product Use<span class="text-danger">*</span></label>
                                <select class="form-control" name="product_use_id" id="product_use_id">
                                        <option value="" class="d-none">Select Use</option>
                                    @foreach($productUses as $productUse)
                                        <option value="{{ $productUse->id }}">{{ $productUse->use }}</option>
                                    @endforeach
                                </select>
                                <span class="text-danger error"></span>
                            </div>

                            <div class="form-group form-input col-md-6">
                                <label for="volume">Volume</label>
                                <div class="input-group">
                                    <input type="text" class="form-control" name="volume" id="volume" placeholder="" aria-label="" aria-describedby="basic-addon1">
                                    <div class="input-group-prepend">
                                        <select class="btn btn-primary" name="volume_type" id="volume_type">
                                            <option class="dropdown-item-volume d-none" value="">Type</option>
                                            <option class="dropdown-item-volume" value="1">ml</option>
                                            <option class="dropdown-item-volume" value="2">caps</option>
                                            <option class="dropdown-item-volume" value="3">tabs</option>
                                        </select>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <div class="row">
                            <div class="form-group form-input col-md-6">
                                <label for="tension">Tension(mg)</label>
                                <input class="form-control" type="text" id="tension" name="tension">
                            </div>
                            <div class="form-group form-input col-md-6">
                                <label for="quantity">Quantity<span class="text-danger">*</span></label>
                                <input class="form-control" type="text" id="quantity" name="quantity">
                                <span class="text-danger error"></span>
                            </div>
                        </div>

                        <div class="row">
                            <div class="form-group form-input col-md-12">
                                <label for="description">Description<span class="text-danger"></span></label>
                                <textarea class="form-control" name="description" id="description"></textarea>
                            </div>
                        </div>

                        <div class="row">
                            <div class="form-group form-input col-md-12">
                                <label for="username">Product Image<span class="text-danger">*</span></label>
                                <input type="file" name="product_image" class="form-control mb-3" id="product_image">
                                <span class="text-danger error"></span>
                            </div>
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
    var productList = "{{ route('admin.product.list') }}";
    var createproduct = "{{ route('admin.product.create') }}";
    var getproduct = "{{ route('admin.product.detail') }}";
    var deleteproduct = "{{ route('admin.product.delete') }}";
    var imgUrl="{{ asset('product_images/') }}";
    var usertype ="{{ Auth::user()->role }}";
</script>
<script src="{{$baseUrl}}admin/js/product.js?{{ time() }}"></script>

@endsection
