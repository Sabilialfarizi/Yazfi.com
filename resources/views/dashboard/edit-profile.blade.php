@extends('layouts.master', ['title'=> 'Profile'])

@section('content')
<div class="row">
    <div class="col-sm-12">
        <h4 class="page-title">Edit Profile</h4>
    </div>
</div>

@if(session('success'))
<div class="alert alert-success alert-dismissible fade show" role="alert">
    {{ session('success') }}
    <button type="button" class="close" data-dismiss="alert" aria-label="Close">
        <span aria-hidden="true">×</span>
    </button>
</div>
@endif

<form method="POST" action="{{ route('update.profile') }}" enctype="multipart/form-data">
    @csrf
    <div class="card-box">
        <h3 class="card-title">Informations</h3>
        <div class="row">
            <div class="col-md-12">
                <div class="profile-img-wrap">
                    <img class="inline-block" src="{{ asset('/storage/' . $profile->image) }}" alt="user">
                    <div class="fileupload btn">
                        <span class="btn-text">edit</span>
                        <input class="upload" type="file" name="image">
                    </div>
                </div>
                <div class="profile-basic">
                    <div class="row">
                        <div class="col-md-6">
                            <div class="form-group form-focus focused">
                                <label class="focus-label">Name</label>
                                <input type="text" name="name" class="form-control floating" value="{{ $profile->name }}">
                            </div>
                        </div>

                        <div class="col-md-6">
                            <div class="form-group form-focus focused">
                                <label class="focus-label">Email</label>
                                <input type="email" name="email" class="form-control floating" value="{{ $profile->email }}">
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group form-focus focused">
                                <label class="focus-label">Phone</label>
                                <input type="number" name="phone_number" class="form-control floating" value="{{ $profile->phone_number }}">
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group form-focus focused">
                                <label class="focus-label">Password</label>
                                <input type="password" name="password" class="form-control floating">
                            </div>
                        </div>
                        <div class="col-md-12">
                            <div class="form-group form-focus focused">
                                <label class="focus-label">Address</label>
                                <input type="text" name="address" class="form-control floating" value="{{ $profile->address }}">
                            </div>
                        </div>
                    </div>
                </div>
            </div>

        </div>
    </div>
    <div class="text-center m-t-20">
        <button class="btn btn-primary submit-btn" type="submit">Save</button>
    </div>
</form>
@stop