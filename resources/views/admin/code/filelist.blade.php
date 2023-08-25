@php
    $userid = Auth::user()->id;
    $baseUrl = asset('backend')."/";
@endphp

@extends('layouts.app')

@section('title', 'File List')

@section('content')

    <div class="container-fluid">
        <div class="row">
            <div class="col-12">
                <div class="page-title-box">
                    <div class="page-title-right">
                        <ol class="breadcrumb m-0">
                            <li class="breadcrumb-item"><a href="{{ route('admin.adminHome') }}">Project-X</a></li>
                            <li class="breadcrumb-item active"><a href="{{ route('admin.file.list') }}">File list</a></li>
                        </ol>
                    </div>
                    <h4 class="page-title">File list</h4>
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
                                <h4 class="header-title">Imported File List</h4>
                            </div>                            
                        </div>
                        
                        <div class="tab-content">
                            <div class="tab-pane show active" id="basic-datatable-preview">
                                <table id="file_datatable" class="table dt-responsive nowrap w-100">
                                    <thead>
                                        <tr>
                                            <th>Sr. No.</th>
                                            <th>File Name</th>
                                            <th>Total Code</th>
                                            <th>Added By</th>
                                            <th>Created Date</th>                       
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
@section('js')
<script>
    var filelist = "{{ route('admin.file.list') }}";
    var deletefile = "{{ route('admin.file.delete') }}";
    
</script>
<script src="{{$baseUrl}}assets/js/importfile.js"></script>
@endsection

