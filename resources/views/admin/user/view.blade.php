@php
    $userid = Auth::user()->id;
    $baseUrl = asset('backend')."/";
@endphp

@extends('layouts.app')

@section('title','Admin | Message')
@section('content')

    <div class="container-fluid">
        <div class="row">
            <div class="col-12">
                <div class="page-title-box">
                    <div class="page-title-right">
                        <ol class="breadcrumb m-0">
                            <li class="breadcrumb-item"><a href="{{ route('admin.adminHome') }}">Project-X</a></li>
                            <li class="breadcrumb-item"><a href="{{ route('admin.user') }}">Users</a></li>
                            <li class="breadcrumb-item active">User Details</li>
                        </ol>
                    </div>
                    <h4 class="page-title">User Details</h4>
                </div>
            </div>
        </div>
        @include('include.flash')
        <span id="success"></span>
        <div class="row">
            <div class="col-12">
                <div class="card">
                    <div class="card-body">
                        <h4 class="header-title">User Details</h4>
                        <div class="tab-content">
                            <div class="row">
                                 <div class="col-md-6">
                                    <div class="row">
                                       <div class="col-md-6"><label>First Name</label>:</div>
                                       <div class="col-md-6">{{ $data->first_name }}</div>
                                    </div>
                                 </div>
                            </div>

                            <div class="row">
                                 <div class="col-md-6">
                                    <div class="row">
                                       <div class="col-md-6"><label>Last Name</label>:</div>
                                       <div class="col-md-6">{{ $data->last_name }}</div>
                                    </div>
                                 </div>
                            </div>

                            <div class="row">
                                 <div class="col-md-6">
                                    <div class="row">
                                       <div class="col-md-6"><label>Email</label>:</div>
                                       <div class="col-md-6">{{ $data->email }}</div>
                                    </div>
                                 </div>
                            </div>

                            <div class="row">
                                 <div class="col-md-6">
                                    <div class="row">
                                       <div class="col-md-6"><label>Phone Number</label>:</div>
                                       <div class="col-md-6">{{ $data->phone_number }}</div>
                                    </div>
                                 </div>
                            </div>

                            <div class="row">
                                 <div class="col-md-6">
                                    <div class="row">
                                       <div class="col-md-6"><label>Country</label>:</div>
                                       <div class="col-md-6">{{ $data->countryname }}</div>
                                    </div>
                                 </div>
                            </div>

                            <div class="row">
                                 <div class="col-md-6">
                                    <div class="row">
                                       <div class="col-md-6"><label>Role Type</label>:</div>
                                       <div class="col-md-6">{{ $data->userrole }}</div>
                                    </div>
                                 </div>
                            </div>

                            <div class="row">
                                 <div class="col-md-6">
                                    <div class="row">
                                       <div class="col-md-6"><label>Email Varification</label>:</div>
                                       <div class="col-md-6">{{ $data->email_verification }}</div>
                                    </div>
                                 </div>
                            </div>


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
</script>
<script src="{{$baseUrl}}admin/js/user.js"></script>

@endsection
