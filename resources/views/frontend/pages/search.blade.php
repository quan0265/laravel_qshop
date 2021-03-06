
@extends('frontend.layouts.master')

@section('title')
product
@endsection
@section('content')
<div id="main">
    <div class="container">
        <div class="bread-crumb">
            <a href="{{asset('')}}">Home</a>
            <i class="fas fa-angle-right"></i>
            <span>Search: {{ Request::get('search') }}</span>
        </div>
        <div class="product-main">
            <div class="row">
                <div class="col-md-9 col-sm-8 col-12">
                    <div class="product-list" cate_id="1" brand_id="0">
                        <div class="row" >
                            @foreach($products as $product)
                            <div class="col-md-4 col-sm-6 col-12">
                                <div class="product-item">
                                    <a href="{{route('detail', [$product->id, $product->slug])}}"><img src="{{asset('public/uploads/product')}}/{{$product->image}}" alt=""></a>
                                    <p class="price-old">@if($product->price_old) {{$product->price_old}}<sup>đ</sup> @endif</p>
                                    <p class="price">{{$product->price}}<sup>đ</sup></p>
                                    <h5><a href="{{route('detail', [$product->id, $product->slug])}}">{{$product->name}}</a></h5>
                                    <a href="{{route('detail', [$product->id, $product->slug])}}" class="product-item-detail">chi tiet</a>
                                </div>
                            </div>
                            @endforeach
                        </div>
                    </div>
                    <div class="product-more text-center mt-5">
                        {{ $products->appends(Request::all())->links() }}
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
