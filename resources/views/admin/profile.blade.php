@php
    $baseUrl = asset('backend')."/";
@endphp
@extends('layouts.app')

@section('title','Admin | Dashboard')
@section('content')

<div class="container-fluid">
    <div class="row">
        <div class="col-12">
            <div class="page-title-box">
                <div class="page-title-right">
                    <ol class="breadcrumb m-0">
                        <li class="breadcrumb-item"><a href="">Temp</a></li>
                        <li class="breadcrumb-item active">Profile</li>
                    </ol>
                </div>
                <h4 class="page-title">Profile</h4>
            </div>
        </div>
    </div>
    
    <div class="row">
        <div class="col-12">
            <div class="card bg-info">
                <div class="card-body profile-user-box">
                    <div class="row">
                        <div class="col-sm-8">
                            <div class="row align-items-center">
                                <div class="col-auto">
                                    <div class="avatar-lg">
                                        <img src="{{$baseUrl}}assets/images/users/avatar-1.jpg" alt="" class="rounded-circle img-thumbnail">
                                    </div>
                                </div>
                                <div class="col">
                                    <div>
                                        <h4 class="mt-1 mb-1 text-white">{{ $user->first_name }} {{ $user->last_name }}</h4>
                                        <p class="font-13 text-white-50">Role : 
                                             @foreach($rolesMap as $roleId => $roleName)
                                                @if($user->role == $roleId) 
                                                    {{ $roleName }}
                                                @endif
                                            @endforeach
                                        </p>

                                        <ul class="mb-0 list-inline text-light">
                                            <li class="list-inline-item me-3">
                                                <h6>Email : {{ $user->email }}</h6>
                                               	<h6>Phone no. : {{ $user->phone_number }}</h6>
                                                <h6>Country : {{ $countryName }}</h6>
                                            </li>                                            
                                        </ul>
                                    </div>
                                </div>
                            </div>
                        </div> <!-- end col-->

                        <div class="col-sm-4">
                            <div class="float-right mt-sm-0 mt-3 text-sm-end">
                                <a href="{{ route('profile.edit', ['id' =>  $user->id]) }}" class="btn btn-light"><i class="mdi mdi-account-edit me-1"></i> Edit Profile</a>
                            </div>
                        </div> <!-- end col-->
                    </div> <!-- end row -->

                </div> <!-- end card-body/ profile-user-box-->
            </div>
        </div><!-- end col-->
    </div>
    <!-- end row-->
</div>
@endsection
