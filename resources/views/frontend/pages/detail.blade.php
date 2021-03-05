@extends('frontend.layouts.master')

@section('title')
product detail
@endsection
@section('content')
<div id="main">
    <div class="container">
        <div class="bread-crumb">
            <a href="{{asset('')}}">Home</a>
            <i class="fas fa-angle-right"></i>
            <a href="{{route('product.category', $product->brand->category->slug)}}">{{$product->brand->category->name}}</a>
            <i class="fas fa-angle-right"></i>
            <a href="{{route('product.brand', [$product->brand->category->slug, $product->brand->slug])}}">{{$product->brand->name}}</a>
            <i class="fas fa-angle-right"></i>
            <span>{{$product->name}}</span>
        </div>
        <div class="product-main">
            <div class="row">
                <div class="col-md-9 col-sm-8 col-12">
                    <div class="product-detail">
                        <div class="row">
                            <div class="col-md-5 col-sm-5 col-12">
                                <div class="product-detail-left">
                                    <img src="{{asset('public/uploads/product')}}/{{$product->image}}" alt="">
                                </div>
                            </div>
                            <div class="col-md-7 col-sm-7 col-12">
                                <div class="product-detail-right">
                                    <h4>pin dell inspiron 3442 3421</h4>
                                    <p>tình trạng: <span>sản phẩm mới</span></p>
                                    <p>bảo hành: <span>12 tháng</span></p>
                                    <p>Giá: <span class="detail-price">{{number_format($product->price)}}<sup>đ</sup></span></p>
                                    <a href="{{ asset('cart/add') }}/{{ $product->id }}" class="cart-add btn btn-primary">Mua ngay</a>
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="product-detail-content">
                                <p>{!! $product->description !!}</p>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-md-3 col-sm-4 col-12">
                    {{-- sidebar --}}
                    @include('frontend.layouts.sidebar')
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
