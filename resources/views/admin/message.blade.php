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
                            <li class="breadcrumb-item active"><a href="">Message list</a></li>
                        </ol>
                    </div>
                    <h4 class="page-title">Message list</h4>
                </div>
            </div>
        </div>
        @include('include.flash')
        <span id="success"></span>
        <div class="row">
            <div class="col-12">
                <div class="card">
                    <div class="card-body">
                        <h4 class="header-title">Message List</h4>
                        <div class="tab-content">
                            <div class="tab-pane show active" id="basic-datatable-preview">
                                <table id="message_datatable" class="table dt-responsive nowrap w-100">
                                    <thead>
                                        <tr>
                                            <th>User Name</th>
                                            <th>Topic</th>
                                            <th>Title</th>
                                            <th>Date</th>
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

<div class="modal fade" id="standard-modal" data-backdrop="static" data-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title">View Message</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">×</span>
                    </button>
                </div>
                <div class="modal-body">
                    <div class="modal-body append-modal-body">
                        <div class="col-md-12">
                            <div class="row">
                                <label class="col-md-3">User Name :</label>
                                <div class="col-md-9"><div id="user_name"></div></div>
                            </div>  

                            <div class="row">
                                <label class="col-md-3">Topic :</label>
                                <div class="col-md-9"><div id="message_topic"></div></div>
                            </div>                            
                            
                            <div class="row">
                                <label class="col-md-3">Title :</label>
                                <div class="col-md-9"><div id="message_title"></div></div>
                            </div>

                            <div class="row">
                                <label class="col-md-3">Message :</label>
                                <div class="col-md-9"><div id="message_detail"></div></div>
                            </div>

                            <div class="row">
                                <label class="col-md-3">Date :</label>
                                <div class="col-md-9"><div id="message_date">-</div></div>
                            </div>

                            <div class="row">
                                <label class="col-md-3">Status :</label>
                                <div class="col-md-9"><div id="message_status"></div></div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-light" data-dismiss="modal">Close</button>
                </div>
            </div>
        </div>
    </div>
@endsection
@section('js')
<script>
    var adminmessagelist = "{{ route('admin.message') }}";   
    var changeStatusUrl = "{{ route('admin.message.change_status') }}"; 
</script>
<script src="{{$baseUrl}}admin/js/message.js"></script>

@endsection
