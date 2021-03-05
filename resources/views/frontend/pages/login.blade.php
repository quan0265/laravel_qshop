@extends('frontend.layouts.master')

@section('title')
login
@endsection
@section('content')
<div id="main">
    <div class="container">
        <div class="bread-crumb">
            <a href="index.php">Home</a>
            <i class="fas fa-angle-right"></i>
            <span>login</span>
        </div>
        <div class="product-main">
            <div class="row">
                <div class="col-md-9 col-sm-8 col-12">
                    <div class="page-login">
                        <form action="{{asset('login')}}" method="post" autocomplete="off">
                            @csrf
                            <!-- <h4>Login</h4> -->
                            <!-- <div class="alert alert-danger">username hoặc password không đúng</div> -->
                            <div class="form-group">
                                <label for="">Email</label>
                                <input type="text" name="email" value="" placeholder="Username" autocomplete="nope">
                                @if($errors->has('email'))
                                    <div class="text-danger">{{ $errors->first('email')}}</div>
                                @endif
                            </div>
                            <div class="form-group">
                                <label for="">Password</label>
                                <input type="password" name="password" value="" placeholder="Password" autocomplete="new-password">
                                @if($errors->has('password'))
                                    <div class="text-danger">{{ $errors->first('password')}}</div>
                                @endif
                            </div>
                            <div class="form-group">
                                <label class="d-block"><input class="d-inline-block" type="checkbox" name="remember"><span>Remember me</span></label>
                            </div>
                            <div class="form-group text-center">
                                <button type="submit" name="login" class="btn btn-primary">Login</button>
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
