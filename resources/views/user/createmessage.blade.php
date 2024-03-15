@php
    $userid = Auth::user()->id;
    $baseUrl = asset('backend')."/";
@endphp

@extends('layouts.app')

@section('title', 'Message')
@section('content')
    @php
        $topic="";
        $title="";
        $msg="";
        $button="Send Message";
        $msg_id = "";
    @endphp

    @if(isset($message) && $message->id != null)
        @php
        $topic=$message->topic;
        $title=$message->title;
        $msg=$message->message;
        $button="Update Message";
        $msg_id = $message->id;
        @endphp
    @endif
</script>
    <div class="container-fluid">
        <div class="row">
            <div class="col-12">
                <div class="page-title-box">
                    <div class="page-title-right">
                        <ol class="breadcrumb m-0">
                            <li class="breadcrumb-item"><a href="{{ route('admin.adminHome') }}">Dashboard</a></li>
                            <li class="breadcrumb-item active"><a href="{{ route('admin.code.list') }}">Message create</a></li>
                        </ol>
                    </div>
                    <h4 class="page-title">Message</h4>
                </div>
            </div>
        </div>
        @include('include.flash')
        <span id="success"></span>
        <div class="row">
            <div class="col-12">
                <div class="card">
                    <div class="card-body col-8">
                        <form method="post" action="{{ route('user.createmessage') }}" class="" id="createmessage">
                            @csrf
                            <input type="hidden" name="user_id" value="{{ $userid }}">
                            <input type="hidden" name="message_id" value="{{ $msg_id }}">
                            <div class="form-group mb-3">
                                <label for="topic" class="form-label">Select Topic <span class="text-danger">*</span></label>
                                <select class="form-control" id="topic" name="topic">
                                    <option value="">Select Topic</option>
                                    <option value="Order question" @if(old('topic')=='Order question') selected  @endif>Order question</option>
                                    <option value="Product question" @if(old('topic')=='Product question') selected  @endif>Product question</option>
                                    <option value="General question" @if(old('topic')=='General question') selected  @endif>General question</option>
                                    <option value="Product issues" @if(old('topic')=='Product issues') selected  @endif>Product issues</option>
                                    <option value="Special inquiry" @if(old('topic')=='Special inquiry') selected  @endif>Special inquiry</option>
                                    <option value="I would like to buy" @if(old('topic')=='I would like to buy') selected  @endif>I would like to buy</option>
                                </select>
                                @if($errors->has('topic'))
                                    <span class="text-danger">{{ $errors->first('topic') }}</span>
                                @endif
                            </div>

                            <div class="form-group">
                                <label for="title">Title <span class="text-danger">*</span></label>
                                <input class="form-control" type="text" id="title" name="title"
                                    placeholder="Enter Title here..." value="{{ old('title') }}">
                                @if($errors->has('title'))
                                    <span class="text-danger">{{ $errors->first('title') }}</span>
                                @endif
                            </div>

                            <div class="form-group">
                                <label for="username">Message <span class="text-danger">*</span></label>
                                <textarea cols="80" id="message" name="message" rows="10">{{ old('message') }}</textarea>
                                <span class="text-danger error invalid-feedback error-code"
                                    id="error-code"></span>
                                @if($errors->has('message'))
                                    <span class="text-danger">{{ $errors->first('message') }}</span>
                                @endif
                            </div>

                            <div class="form-group text-center">
                                <button class="btn btn-primary" type="submit">{{ $button }}</button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection

@section('js')

<script src="https://cdn.ckeditor.com/4.22.1/full/ckeditor.js"></script>
<script>
    CKEDITOR.replace('message', {
      height: 200,
      baseFloatZIndex: 10005,
      removeButtons: 'PasteFromWord'
    });
  </script>
@endsection

