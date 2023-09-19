@php
    $userid = Auth::user()->id;
    $baseUrl = asset('backend')."/";
@endphp

@extends('layouts.app')

@section('title','Admin | Contact Mail')
@section('content')

    <div class="container-fluid">
        <div class="row">
            <div class="col-12">
                <div class="page-title-box">
                    <div class="page-title-right">
                        <ol class="breadcrumb m-0">
                            <li class="breadcrumb-item"><a href="{{ route('admin.adminHome') }}">Project-X</a></li>
                            <li class="breadcrumb-item active">User list</li>
                        </ol>
                    </div>
                    <h4 class="page-title">Contact Mail list</h4>
                </div>
            </div>
        </div>
        @include('include.flash')
        <span id="success"></span>
        <div class="row">
            <div class="col-12">
                <div class="card">
                    <div class="card-body">
                        <h4 class="header-title">Contact Mail List</h4>
                        <div class="tab-content">
                            <div class="tab-pane show active" id="basic-datatable-preview">
                                <table id="contact_datatable" class="table dt-responsive w-100">
                                    <thead>
                                        <tr>                                            
                                            <th width="15%">Name</th>            
                                            <th width="15%">Email</th>
                                            <th width="20%">Country</th>
                                            <th width="35%">Message</th>
                                            <th width="15%">Action</th>
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
    var contactusList = "{{ route('admin.contactus.list') }}"; 
    var contactusdelete = "{{ route('admin.contactus.delete') }}";
    var are_you_sure ="Are you sure want to delete?";
</script>
<script src="{{$baseUrl}}admin/js/contact-us.js"></script>

@endsection
