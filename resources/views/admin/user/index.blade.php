@php
    $userid = Auth::user()->id;
    $baseUrl = asset('backend')."/";
@endphp

@extends('layouts.app')

@section('title','Admin | User')
@section('content')

    <div class="container-fluid">
        <div class="row">
            <div class="col-12">
                <div class="page-title-box">
                    <div class="page-title-right">
                        <ol class="breadcrumb m-0">
                            <li class="breadcrumb-item"><a href="{{ route('admin.adminHome') }}">Dashboard</a></li>
                            <li class="breadcrumb-item active">User list</li>
                        </ol>
                    </div>
                    <h4 class="page-title">User list</h4>
                </div>
            </div>
        </div>
        @include('include.flash')
        <span id="success"></span>
        <div class="row">
            <div class="col-12">
                <div class="card">
                    <div class="card-body">
                        <h4 class="header-title">User List</h4>
                        <div class="tab-content">
                            <div class="tab-pane show active" id="basic-datatable-preview">
                                <table id="user_datatable" class="table dt-responsive nowrap w-100">
                                    <thead>
                                        <tr>
                                            <th>ID</th>
                                            <th>Name</th>
                                            <th>Email</th>
                                            <th>Phone No.</th>
                                            <th>User Type</th>
                                            <th>Email Verified</th>
                                            <th>Status</th>
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
    var userList = "{{ route('admin.user.list') }}";
    var userdelete = "{{ route('admin.user.delete') }}";
    var are_you_sure ="Are you sure want to delete?";
</script>
<script src="{{$baseUrl}}admin/js/user.js"></script>

@endsection
