@extends('frontend.layouts.master')

@section('title')

@endsection
@section('content')
<div id="main">
    <div class="container">
        <div class="bread-crumb">
            <a href="index.php">Home</a>
            <i class="fas fa-angle-right"></i>
            <span>register</span>
        </div>
        <div class="product-main">
            <div class="row">
                <div class="col-md-9 col-sm-8 col-12">
                    <div class="page-login">
                        <form action="{{asset('register')}}" method="post" autocomplete="off">
                            <!-- <h4>Login</h4> -->
                            <!-- <div class="alert alert-danger">thông tin không được để trống</div> -->
                            @csrf
                            <div class="form-group">
                                <label for="">Full name</label>
                                <input type="text" name="full_name" placeholder="Fullname">
                                @if($errors->has('full_name'))
                                    <div class="text-danger">{{ $errors->first('full_name')}}</div>
                                @endif
                            </div>
                            <div class="form-group">
                                <label>User name</label>
                                <input type="text" name="user_name" placeholder="Username" autocomplete="nope">
                                @if($errors->has('user_name'))
                                    <div class="text-danger">{{ $errors->first('user_name')}}</div>
                                @endif
                            </div>
                            <div class="form-group">
                                <label for="">Email</label>
                                <input type="email" name="email" placeholder="Email" autocomplete="off">
                                @if($errors->has('email'))
                                    <div class="text-danger">{{ $errors->first('email')}}</div>
                                @endif
                            </div>
                            <div class="form-group">
                                <label>Password</label>
                                <input type="password" name="password" placeholder="Password" autocomplete="new-password">
                                @if($errors->has('password'))
                                    <div class="text-danger">{{ $errors->first('password')}}</div>
                                @endif
                            </div>
                            <div class="form-group">
                                <label for="">Phone</label>
                                <input type="number" name="phone" placeholder="Phone">
                                @if($errors->has('phone'))
                                    <div class="text-danger">{{ $errors->first('phone')}}</div>
                                @endif
                            </div>
                            <div class="form-group">
                                <label for="">Address</label>
                                <input type="text" name="address" placeholder="Address">
                                @if($errors->has('address'))
                                    <div class="text-danger">{{ $errors->first('address')}}</div>
                                @endif
                            </div>
                            <div class="form-group text-center">
                                <button type="submit" name="register" class="btn btn-primary">Register</button>
                            </div>
                        </form>
                    </div>
                </div>
                <div class="col-md-3 col-sm-4 col-12">
                    @include('frontend.layouts.sidebar')
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
