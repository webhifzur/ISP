@extends('layouts.app')

@section('content')
<div class="row">
    <div class="col-12">
        <div class="card-box">
            <form method="POST" action="{{ route('dashboard.profile.update') }}"
                data-parsley-validate novalidate enctype="multipart/form-data">
            @csrf
                <h1>Basic Info :</h1>

                <div class="row">
                    <div class="col-md-6 col-sm-12">
                        <div class="card-box">
                            <input type="file" class="dropify" data-default-file="{{ asset('storage/'.$user->profile_img) }}" name="profile_img" />
                            @error('profile_img')
                                <div class="alert alert-danger">{{ $message }}</div>
                            @enderror
                        </div>
                    </div>
                    <div class="col-md-6 col-sm-12">
                        <div class="form-group">
                            <label for="userName">User Name*</label>
                            <input type="text" name="name" parsley-trigger="change" required
                                placeholder="Enter Full Name" class="form-control" id="userName" value="{{ $user->name }}">
                            @error('name')
                                <div class="alert alert-danger">{{ $message }}</div>
                            @enderror
                        </div>
                        <div class="form-group">
                            <label for="emailAddress">Email address*</label>
                            <input type="email" name="email" parsley-trigger="change" required
                                placeholder="Enter email" class="form-control" id="emailAddress" value="{{ $user->email }}">
                            @error('email')
                                <div class="alert alert-danger">{{ $message }}</div>
                            @enderror
                        </div>
                        <div class="form-group">
                            <label for="emailAddress">Phone*</label>
                            <input type="tel" name="phone" parsley-trigger="change" required
                                placeholder="Enter Phone" class="form-control" id="phoneNumber" value="{{ $user->phone }}">
                            @error('phone')
                                <div class="alert alert-danger">{{ $message }}</div>
                            @enderror
                        </div>
                    </div>
                </div>

                @if($user->type == 1)
                    <div class="row">
                        <div class="col-md-6 col-sm-12">
                            <div class="form-group">
                                <label for="userName">Profit Percentage(%)*</label>
                                <label class="form-control">{{ $user->admin->profit_percentage }}</label>
                            </div>
                            <div class="form-group">
                                <label for="type">Slect Admin Type*</label>
                                <label class="form-control">
                                    @if ($user->type == 1)
                                        Admin
                                    @else
                                        Client
                                    @endif
                                </label>
                            </div>
                        </div>
                        <div class="col-md-6 col-sm-12">
                            @if ($user->type != 0)
                                <div class="form-group">
                                    <label for="address">Address*</label>
                                    <textarea class="form-control w-100 h-100" name="address" id="">{{ $user->admin->address }}</textarea>
                                </div>
                            @endif
                        </div>
                    </div>
                @endif
                <div class="form-group text-right m-b-0">
                    <button class="btn btn-primary waves-effect waves-light" type="submit">
                        Update
                    </button>
                </div>
            </form>

            <form method="POST" action="{{ route('dashboard.password.update') }}"
                data-parsley-validate novalidate enctype="multipart/form-data">
            @csrf
                <div class="row">
                    <div class="col-md-6 col-sm-12">
                        <h1>Password Update :</h1>
                        <div class="form-group">
                            <label for="pass1">Password*</label>
                            <input id="pass1" name="oldpassword" type="password" placeholder="Old Password" required
                                class="form-control" autocomplete="">
                            @if(session()->has('oldpassword'))
                                <div class="alert alert-danger">{{ session('oldpassword') }}</div>
                            @endif 
                            @error('oldpassword')
                                <div class="alert alert-danger">{{ $message }}</div>
                            @enderror
                        </div>
                        <div class="form-group">
                            <label for="pass1">Password*</label>
                            <input id="pass1" name="password" type="password" placeholder="Password" required
                                class="form-control">
                            @error('password')
                                <div class="alert alert-danger">{{ $message }}</div>
                            @enderror
                        </div>
                        <div class="form-group">
                            <label for="passWord2">Confirm Password *</label>
                            <input data-parsley-equalto="#pass1" name="password_confirmation" type="password" required
                                placeholder="Confirm Password" class="form-control" id="passWord2">
                        </div>
                        <div class="form-group text-right m-b-0">
                            <button class="btn btn-primary waves-effect waves-light" type="submit">
                                Reset
                            </button>
                        </div>
                    </div>
                </div>
            </form>
            
        </div>
    </div>
</div>
@endsection