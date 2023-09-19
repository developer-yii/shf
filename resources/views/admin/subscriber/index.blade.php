@php
    $userid = Auth::user()->id;
    $baseUrl = asset('backend')."/";
@endphp

@extends('layouts.app')

@section('title','Admin | Subscriber')
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
                    <h4 class="page-title">Subscriber list</h4>
                </div>
            </div>
        </div>
        @include('include.flash')
        <span id="success"></span>
        <div class="row">
            <div class="col-12">
                <div class="card">
                    <div class="card-body">
                        <h4 class="header-title">Subscriber List</h4>
                        <div class="tab-content">
                            <div class="tab-pane show active" id="basic-datatable-preview">
                                <table id="subscriber_datatable" class="table dt-responsive nowrap w-100">
                                    <thead>
                                        <tr>                                            
                                            <th>Email</th>                                            
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
    var subscriberList = "{{ route('admin.subscriber.list') }}"; 
    var subscriberdelete = "{{ route('admin.subscriber.delete') }}";
    var are_you_sure ="Are you sure want to delete?";
</script>
<script src="{{$baseUrl}}admin/js/subscriber.js"></script>

@endsection
