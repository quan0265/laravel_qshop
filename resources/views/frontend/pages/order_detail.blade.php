@extends('frontend.layouts.master')

@section('title')
order detail
@endsection
@section('content')
<div id="main">
    <div class="container">
        <div class="bread-crumb">
            <a href="index.php">Home</a>
            <i class="fas fa-angle-right"></i>
            <span>Order detail</span>
        </div>
        <div class="product-main">
            <div class="row">
                <div class="col-md-9 col-sm-8 col-12">
                    <div class="page-order">
                        <table class="table">
                            <thead>
                                <tr>
                                    <th>stt</th>
                                    <th>image</th>
                                    <th>name</th>
                                    <th>price</th>
                                    <th>quanlity</th>
                                    <th>money</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach($carts as $key=> $cart)
                                <tr>
                                    <td>{{ $key+1 }}</td>
                                    <td><img src="{{ asset('public/uploads/product/'.$cart->product->image)}}" alt=""></td>
                                    <td>{{ $cart->product->name}}</td>
                                    <td>{{ number_format($cart->product->price) }}<sup>đ</sup></td>
                                    <td>{{ $cart->quanlity }}</td>
                                    <td>{{ number_format($cart->money) }}<sup>đ</sup></td>
                                </tr>
                                @endforeach
                                <tr>
                                    <td colspan="6" class="text-right">total money: {{ number_format($total_money) }}<sup>đ</sup></td>
                                </tr>
                            </tbody>
                        </table>
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
