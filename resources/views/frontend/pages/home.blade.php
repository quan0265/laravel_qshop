@extends('frontend.layouts.master')

@section('title')
home
@endsection
@section('content')
<div id="main">
    {{-- <section class="product">
        <div class="container">
            <div class="product-title">
                <h3><a href="index.php?layout=product&cate_id=1">pin laptop</a></h3>
                <span></span>
            </div>
            <div class="category owl-carousel owl-theme">
                <div class="product-item item">
                    <a href="index.php?layout=product_detail&product_id=34"><img src="images/product/8076sac-acer-aspire-6.png" alt=""></a>
                    <p class="price-old">440.000<sup>d</sup></p>
                    <p class="price">400.000<sup>d</sup></p>
                    <h5><a href="index.php?layout=product_detail&product_id=34">sac aus a421 dskd sksl skdk slkd sdd</a></h5>
                    <a href="index.php?layout=product_detail&product_id=34" class="product-item-detail">chi tiet</a>
                </div>
            </div>
        </div>
    </section> --}}
    @foreach($categories as $category)
    @if(count($category->product)>0)
    <section class="product">
        <div class="container">
            <div class="product-title">
                <h3><a href="index.php?layout=product&cate_id=2">{{ $category->name }}</a></h3>
                <span></span>
            </div>
            <div class="category owl-carousel owl-theme">
                @foreach($category->product as $product)
                <div class="product-item item">
                    <a href="{{route('detail', [$product->id, $product->slug])}}"><img src="{{asset('public/uploads/product')}}/{{$product->image}}" alt=""></a>
                    
                    <p class="price-old">@if($product->price_old>0){{$product->price_old}}<sup>đ</sup>@endif</p>
                    
                    <p class="price">{{number_format($product->price)}}<sup>đ</sup></p>
                    <h5><a href="{{route('detail', [$product->id, $product->slug])}}">{{$product->name}}</a></h5>
                    <a href="{{route('detail', [$product->id, $product->slug])}}" class="product-item-detail">chi tiet</a>
                </div>
                @endforeach
            </div>
        </div>
    </section>
    @endif
    @endforeach
</div>
@endsection
