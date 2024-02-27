@php
    $userid = Auth::user()->id;
    $baseUrl = asset('backend')."/";
@endphp

@extends('layouts.app')

@section('title','User | Chat')
@section('content')
<div class="container-fluid">
    <div class="row">
        <div class="col-12">
            <div class="page-title-box">
                <div class="page-title-right">
                    <ol class="breadcrumb m-0">
                        <li class="breadcrumb-item"><a href="{{ route('admin.adminHome') }}">SHF</a></li>
                        <li class="breadcrumb-item active"><a href="">Chatboard</a></li>
                    </ol>
                </div>
                <h4 class="page-title">Chatboard</h4>
            </div>
        </div>
    </div>
    @include('include.flash')
    <span id="success"></span>
    <div class="row">
        <div class="col-12">
            <div class="card">
               <div class="card">
                    <div class="card-body">
                      <div class="modal-body append-modal-body">
                         <div class="col-md-12">
                            <div class="row">
                               <div class="col-md-6  text-left">
                                  <div class="row">
                                     <div class="col-md-6"><label>Topic</label>:</div>
                                     <div class="col-md-6">{{ $model->topic}}</div>
                                  </div>
                               </div>
                               <div class="col-md-6">
                                  <div class="row">
                                     <div class="col-md-6"><label>Title</label>:</div>
                                     <div class="col-md-6">{{ $model->title}}</div>
                                  </div>
                               </div>

                            </div>
                            <div class="row">

                              <div class="col-md-6">
                                    <div class="row">
                                     <div class="col-md-6"><label>Message</label>:</div>
                                     <div class="col-md-6">{!! $model->message !!}</div>
                                  </div>
                                </div>

                               <div class="col-md-6">
                                    <div class="row">
                                     <div class="col-md-6"><label>Date</label>:</div>
                                     <div class="col-md-6">{{ $model->created_at}}</div>
                                  </div>
                                </div>
                            </div>
                            <div class="row">

                            </div>
                         </div>
                      </div>
                      <div class="col-xl-12 col-lg-12 order-lg-2 order-xl-1">
                        <div class="card">
                           <div class="card-body">
                              <ul class="conversation-list" data-simplebar style="max-height: 537px">

                                 @php $lastmessageid = ''; @endphp
                                 @foreach($chat as $chatmessage)
                                 @php
                                    $class='';
                                    $status='';

                                    if($chatmessage->is_read=='0')
                                    {
                                       $status="font-weight-bold";
                                    }
                                    if ($chatmessage->sender_id == $userid)
                                    {
                                       $class='odd';
                                       $status='';
                                    }

                                 $lastmessageid=$chatmessage->id;
                                 @endphp
                                 <li class="clearfix {{$class}} {{$status}}" data_id="{{ $chatmessage->id}}" data-sender-id="{{ $chatmessage->sender_id }}" data-user-id="{{ $userid }}" data-message-id="{{ $chatmessage->message_id }}">
                                    <div class="chat-avatar">
                                       <img src="{{ $baseUrl}}assets/images/blank.png" alt="user-image" class="rounded-circle">
                                    </div>
                                    <div class="conversation-text">
                                       <div class="ctext-wrap">
                                          <i style="font-size: 15px;">{{ $chatmessage->user_name }}</i>
                                          <p style="font-size: 15px;">
                                             {{ $chatmessage->chat_message }}
                                          </p>
                                          <p style="color: #927c8f">
                                             {{ \Carbon\Carbon::parse($chatmessage->created_at)->format('d-m-Y H:i:s')}}</p>
                                       </div>
                                    </div>
                                 </li>
                                 @endforeach
                              </ul>
                               <div class="row">
                                  <div class="col">
                                     <div class="mt-2 bg-light p-3 rounded">
                                        <form class="" method="POST" novalidate="" name="chat-form" id="chat-form">
                                            @csrf
                                           <input type="hidden" name="message_id" value="{{ $model->id}}" id="message_id">
                                           <input type="hidden" name="last_message_id" value="{{$lastmessageid}}" id="last_message_id">


                                          <div class="row">
                                              <div class="col mb-2 mb-sm-0 fv-row">
                                                 <input type="text" name="message" id="message" class="form-control border-0 " placeholder="Enter your text" autocomplete="off">
                                                 <span class="error-border"></span>
                                                 <span class="text-danger error invalid-data error-message" id="error_message"></span>
                                              </div>
                                              <div class="col-sm-auto">
                                                 <div class="btn-group">

                                                    <button type="submit" class="btn btn-success chat-send btn-block"><i class="uil uil-message"></i></button>
                                                 </div>
                                              </div>
                                              <!-- end col -->
                                           </div>
                                           <!-- end row-->
                                        </form>
                                     </div>
                                  </div>
                                  <!-- end col-->
                               </div>
                               <!-- end row -->
                            </div>
                            <!-- end card-body -->
                         </div>
                         <!-- end card -->
                      </div>
                    </div>
                </div>
            </div> <!-- end card -->
        </div><!-- end col-->
    </div>
    <!-- end row-->
</div>

@endsection
@section('js')
<script>
    var chatUrl = "{{ route('user.chat.message') }}";
    var fetchData="{{ route('user.chat.fetchData') }}";

</script>
<!-- <script src="{{$baseUrl}}assets/js/chat.js"></script> -->

@endsection

