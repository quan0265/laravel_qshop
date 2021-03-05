@extends('frontend.layouts.master')

@section('title')
order
@endsection
@section('content')
<div id="main">
    <div class="container">
        <div class="bread-crumb">
            <a href="{{asset('')}}">Home</a>
            <i class="fas fa-angle-right"></i>
            <span>Order</span>
        </div>
        <div class="product-main">
            <div class="row">
                <div class="col-md-9 col-sm-8 col-12">
                    <div class="page-order">
                        <table class="table">
                            <thead>
                                <tr>
                                    <th>stt</th>
                                    <th>phone</th>
                                    <th>address</th>
                                    <th>total money</th>
                                    <th>date</th>
                                    <th>status</th>
                                    <th>view</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach($orders as $key=> $order)
                                <tr>
                                    <td>{{ $key+1 }}</td>
                                    <td>{{ $order->phone}}</td>
                                    <td>{{ $order->address }}</td>
                                    <td>{{ number_format($order->total_money) }} <sup>đ</sup></td>
                                    <td>{{ date_format($order->created_at, 'H:i:s d-m-Y') }}</td>
                                    <td>
                                        @if($order->status==1)
                                        đang xử lí
                                        @elseif($order->status==2)
                                        đang gửi hàng
                                        @else
                                        đã nhận hàng
                                        @endif
                                    </td>
                                    <td><a href="{{ asset('order') }}/{{ $order->id }}">detail</a></td>
                                </tr>
                                @endforeach
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
