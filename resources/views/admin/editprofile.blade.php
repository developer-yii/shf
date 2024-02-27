@php
    $userid = Auth::user()->id;
    $baseUrl = asset('backend')."/";
@endphp

@extends('layouts.app')

@section('title', 'Message')
@section('content')
    <div class="container-fluid">
        <div class="row">
            <div class="col-12">
                <div class="page-title-box">
                    <div class="page-title-right">
                        <ol class="breadcrumb m-0">
                            <li class="breadcrumb-item"><a href="{{ route('admin.adminHome') }}">SHF</a></li>
                            <li class="breadcrumb-item active">Update Profile</li>
                        </ol>
                    </div>
                    <h4 class="page-title">Update Profile</h4>
                </div>
            </div>
        </div>
        @include('include.flash')
        <span id="success"></span>
        <div class="row">
            <div class="col-12">
                <div class="card">
                    <div class="card-body col-8">
                        <form method="post" class="" id="update_profile">
                            @csrf
                            <input type="hidden" name="id" value="{{ $data->id }}">
                            <div class="form-group mb-3 form-input">
                                <label for="first_name" class="form-label">First Name <span class="text-danger">*</span></label>
                                <input class="form-control" type="text" id="first_name" name="first_name"
                                   @if(old('_token')) value="{{ old('first_name') }}" @else value="{{ $data->first_name }}" @endif">
                               <span class="error text-danger"></span>
                            </div>

                            <div class="form-group mb-3 form-input">
                                <label for="last_name" class="form-label">Last Name <span class="text-danger">*</span></label>
                                <input class="form-control" type="text" id="last_name" name="last_name"
                                  value="{{ old('last_name') ?: $data->last_name }}">
                                <span class="error text-danger"></span>
                            </div>

                            <div class="form-group mb-3 form-input">
                                <label for="email" class="form-label">Email <span class="text-danger">*</span></label>
                                <input class="form-control" type="text" id="email" name="email"
                                   value="{{ $data->email}}">
                                <span class="error text-danger"></span>
                            </div>

                            <div class="form-group mb-3 form-input">
                                <label for="phone_number" class="form-label">Phone Number <span class="text-danger">*</span></label>
                                <input class="form-control" type="text" id="phone_number" name="phone_number"
                                   value="{{ $data->phone_number}}">
                                <span class="error text-danger"></span>
                            </div>

                            <div class="form-group form-input">
                                <label for="country" class="form-label">Select Country:</label>

                                <select id="country" name="country" class="form-control @error('country') is-invalid @enderror" {{ $errors->has('country') ? 'autofocus' : '' }}>
                                    @foreach ($countries as $country)
                                        <option value="{{$country->id}}" {{ $data->country_id == $country->id ? 'selected' : '' }}>{{$country->name}}</option>
                                    @endforeach
                                </select>
                                <span class="error text-danger"></span>
                            </div>
                            @if($data->role == 1 || $data->role == 2)
                            <div class="form-group mb-3 form-input">
                                <label for="role" class="form-label">User Role <span class="text-danger">*</span></label>
                                <select name="role" id="role" class="form-control">
                                    @foreach($rolesMap as $roleId => $roleName)
                                        <option value="{{ $roleId }}" @if($data->role == $roleId) selected @endif>{{ $roleName }}</option>
                                    @endforeach
                                </select>
                                <span class="error text-danger"></span>
                            </div>

                            <div class="form-group mb-3 form-input">
                                <label for="userstatus" class="form-label">User status <span class="text-danger">*</span></label>
                                <select name="userstatus" id="userstatus" class="form-control">
                                    @foreach($statusMap as $statusId => $userstatus)
                                        <option value="{{ $statusId }}" @if($data->is_active == $statusId) selected @endif>{{ $userstatus }}</option>
                                    @endforeach
                                </select>
                                <span class="error text-danger"></span>
                            </div>
                            @endif

                            <div class="form-group text-center">
                                <button class="btn btn-primary" type="submit">Update</button>
                                <a href="{{ route('profile') }}" class="btn btn-danger" type="submit">Cancel</a>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
@section('js')
<script>
    var updateprofile = "{{ route('profile.update') }}";
    var redirectroute = "{{ route('profile') }}";
</script>
<script src="{{$baseUrl}}admin/js/custom.js"></script>
@endsection



