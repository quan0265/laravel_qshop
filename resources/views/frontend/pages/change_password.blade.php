@extends('frontend.layouts.master')

@section('title')
change-password
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
                        <form action="{{ asset('change-password') }}" method="post" autocomplete="off">
                            @csrf
                            <!-- <h4>Login</h4> -->
                            <!-- <div class="alert alert-danger">thông tin không được để trống</div> -->
                            <div class="form-group">
                                <label for="">old password</label>
                                <input type="password" value="" name="old_password" placeholder="password">
                                @if($errors->has('old_password'))
                                    <div class="text-danger">{{ $errors->first('old_password')}}</div>
                                @endif
                            </div>
                            <div class="form-group">
                                <label for="">new password</label>
                                <input type="password" value="" name="new_password" placeholder="password">
                                @if($errors->has('new_password'))
                                    <div class="text-danger">{{ $errors->first('new_password')}}</div>
                                @endif
                            </div>
                            <div class="form-group">
                                <label for="">confirm password</label>
                                <input type="password" value="" name="confirm_password" placeholder="password">
                                @if($errors->has('confirm_password'))
                                    <div class="text-danger">{{ $errors->first('confirm_password')}}</div>
                                @endif
                            </div>
                            <div class="form-group text-center">
                                <button type="submit" name="register" class="btn btn-primary">Update</button>
                                <button type="reset" name="reset" class="btn btn-primary">Reset</button>
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
