

@extends('frontend.layouts.master')

@section('title')
cart confirm
@endsection
@section('content')
<div id="main">
    <div class="container">
        <div class="bread-crumb">
            <a href="index.php">Home</a>
            <i class="fas fa-angle-right"></i>
            <span>xác nhận hóa đơn</span>
        </div>
        <div class="product-main">
            <div class="row">
                <div class="col-md-9 col-sm-8 col-12">
                    <div class="shopping-cart">
                        <form class="form-customer" action="" method="post">
                            <table class="table table-bordered">
                                <thead>
                                    <tr>
                                        <th class="text-center" colspan="2">thông tin khách hàng</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <tr>
                                        <td>Full name</td>
                                        <td>{{$customer->full_name}}</td>
                                    </tr>
                                    <tr>
                                        <td>Email</td>
                                        <td>{{$customer->email}}</td>
                                    </tr>
                                    <tr>
                                        <td>Phone</td>
                                        <td>{{$customer->phone}}</td>
                                    </tr>
                                    <tr>
                                        <td>Address</td>
                                        <td>{{$customer->address}}</td>
                                    </tr>
                                    <tr>
                                        <td colspan="2" class="text-center"><a href="{{asset('setting')}}" class="btn btn-primary">update</a></td>
                                    </tr>
                                </tbody>
                            </table>
                        </form>
                        <form action="" method="post">
                            <table class="table table">
                                <thead>
                                    <tr>
                                        <th>stt</th>
                                        <th>hình ảnh</th>
                                        <th>sản phẩm</th>
                                        <th>giá</th>
                                        <th>số lượng</th>
                                        <th class="text-center">tổng tiền</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach($carts as $key => $cart)
                                    <tr>
                                        <td>{{ $key+1 }}</td>
                                        <td><img width="40px" src="{{ asset('public/uploads/product')}}/{{ $cart->product->image }}" alt=""></td>
                                        <td>{{ $cart->product->name }}</td>
                                        <td>{{ number_format($cart->product->price) }}<sup>đ</sup></td>
                                        <td>{{ $cart->quanlity }}</td>
                                        <td class="text-center"><span>{{number_format($cart->money)}}<sup>đ</sup></span></td>
                                    </tr>
                                    @endforeach
                                    <tr>
                                        <td></td>
                                        <td></td>
                                        <td></td>
                                        <td></td>
                                        <td class="text-right" colspan="2">tổng tiền hóa đơn: <span>{{number_format($total_money)}}<sup>đ</sup></span></td>
                                    </tr>
                                </tbody>
                            </table>
                            <div class="form-group text-center"><a href="{{ asset('cart/complete') }}" class="btn btn-primary mt5" type="submit" name="submit" class="btn btn-primary">mua hàng</a></div>
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

@section('js')

@endsection
