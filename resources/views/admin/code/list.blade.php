@php
    $userid = Auth::user()->id;
    $baseUrl = asset('backend')."/";
@endphp

@extends('layouts.app')

@section('title', 'Code')

@section('content')

    <div class="container-fluid">
        <div class="row">
            <div class="col-12">
                <div class="page-title-box">
                    <div class="page-title-right">
                        <ol class="breadcrumb m-0">
                            <li class="breadcrumb-item"><a href="{{ route('admin.adminHome') }}">Project-X</a></li>
                            <li class="breadcrumb-item active"><a href="{{ route('admin.code.list') }}">Code list</a></li>
                        </ol>
                    </div>
                    <h4 class="page-title">Code list</h4>
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
                            <div class="col-2">
                                <button class="btn btn-primary" type="button" data-toggle="modal" data-target="#addproductcode"
                                    style="margin-bottom:1em;">Add Code</button>
                            </div>
                            <div class="col-10">
                                <button class="btn btn-primary btn-sm" type="button" data-toggle="modal" data-target="#showimport" style="margin-bottom:1em; float: right;">Import Excel</button>
                            </div>
                        </div>
                        <h4 class="header-title">Product Code List</h4>
                        <div class="tab-content">
                            <div class="tab-pane show active" id="basic-datatable-preview">
                                <table id="code_datatable" class="table dt-responsive nowrap w-100">
                                    <thead>
                                        <tr>
                                            <th>Sr. No.</th>
                                            <th>Code Id</th>
                                            <th>Added By</th>
                                            <th>Created Date</th>
                                            <th>Code Checked On</th>
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
    <div id="addproductcode" class="modal fade" tabindex="-1" role="dialog" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">

                <div class="modal-body">
                    <div class="text-center mt-2 mb-4">
                    <h5 class="modal-title"><span id="exampleModalLabel">Add Code</span><button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button></h5>
                    </div>
                    <form class="pl-3 pr-3" id="createcode">
                        @csrf
                        <input type="hidden" name="user_id" value="{{ $userid }}">
                        <input type="hidden" name="code_id" class="code-id">
                        <div class="form-group">
                            <label for="username">Code</label>
                            <input class="form-control" type="text" id="code" name="code"
                                placeholder="Enter Maximum of 30 digit code here...">
                                <span class="text-danger error invalid-feedback error-code"
                                id="error-code"></span>    
                        </div>

                      
                        <div class="form-group text-center">
                            <button class="btn btn-primary" type="submit">Add Code</button>
                        </div>

                    </form>

                </div>
            </div><!-- /.modal-content -->
        </div><!-- /.modal-dialog -->
    </div><!-- /.modal -->

     <div id="showimport" class="modal fade" tabindex="-1" role="dialog" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">

                <div class="modal-body">
                    <div class="text-center mt-2 mb-4">
                    <h5 class="modal-title" id="exampleModalLabel">Import Code<button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button></h5>
                    </div>
                    <form class="pl-3 pr-3" id="importcode" enctype="multipart/form-data">
                        @csrf
                        <input type="hidden" name="user_id" value="{{ $userid }}">
                        <div class="form-group">
                            <label for="username">Choose File</label>
                            <input class="form-control" type="file" id="excelfile" name="excelfile" placeholder="Enter Maximum of 30 digit code here...">
                            <span class="text-danger error invalid-feedback error-excelfile" id="error-excelfile">
                            </span>  
                        </div>
                        
                        <div class="from-group">
                            <label for="samplefile"><strong>Note : </strong><a href="{{ asset('samplefile/productsample.xlsx') }}" download>Download Sample Code File</a></label>
                             
                        </div>
                        <div class="form-group text-center">
                            <button class="btn btn-primary" type="submit">Import Code</button>
                        </div>

                    </form>

                </div>
            </div><!-- /.modal-content -->
        </div><!-- /.modal-dialog -->
    </div><!-- /.modal -->
@endsection
@section('js')

<script>
    var codelist = "{{ route('admin.code.list') }}";
    var createcode = "{{ route('admin.code.create') }}";
    var getcode = "{{ route('admin.code.detail') }}";
    var deletecode = "{{ route('admin.code.delete') }}";
    var importcode = "{{ route('admin.code.import') }}"
</script>
<script src="{{$baseUrl}}assets/js/code.js"></script>


@endsection
