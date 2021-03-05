@extends('frontend.layouts.master')

@section('title')
cart
@endsection
@section('content')
<div id="main">
    <div class="container">
        <div class="bread-crumb">
            <a href="{{ asset('') }}">Home</a>
            <i class="fas fa-angle-right"></i>
            <span>shopping cart</span>
        </div>
        <div class="product-main">
            <div class="row">
                <div class="col-md-9 col-sm-8 col-12">
                    <div class="shopping-cart">
                        <form action="" method="post">
                            <table class="table table">
                                <thead>
                                    <tr>
                                        <th>hình ảnh</th>
                                        <th>sản phẩm</th>
                                        <th>giá</th>
                                        <th>số lượng</th>
                                        <th class="text-center">tổng tiền</th>
                                        <th></th>
                                    </tr>
                                </thead>
                                <tbody>
                                    {{-- <tr>
                                        <td><img width="40px" src="images/product/4355pin-dell-inspiron-3421.jpg" alt=""></td>
                                        <td>pin dell inspiron 3442 3421</td>
                                        <td>400.000<sup>đ</sup></td>
                                        <td><input type="number" min="1" max="20" name="sl[55]" value="1"></td>
                                        <td class="text-center"><span>400.000<sup>đ</sup></span></td>
                                        <td class="text-center"><a href="layout/cart/cart_delete.php?product_id=55">xóa</a></td>
                                    </tr> --}}
                                    @foreach($carts as $cart)
                                    <tr>
                                        <td><img width="40px" src="{{ asset('public/uploads/product')}}/{{ $cart->product->image }}" alt=""></td>
                                        <td>{{ $cart->product->name }}</td>
                                        <td>{{ number_format($cart->product->price) }}<sup>đ</sup></td>
                                        <td><input class="cartProduct" type="number" data-id="{{$cart->id}}" min="1" name="sl[57]" value="{{$cart->quanlity}}"></td>
                                        <td class="text-center"><span>{{ number_format($cart->money) }}<sup>đ</sup></span></td>
                                        <td class="text-center"><a onclick="return confirm('bạn có chắc muốn xóa ?')" href="{{asset('cart/delete')}}/{{$cart->id}}">xóa</a></td>
                                    </tr>
                                    @endforeach
                                    <tr>
                                        <td><a href="index.php" class="btn btn-warning">tiếp tục mua hàng</a></td>
                                        <td></td>
                                        {{-- <td><button type="submit" name="cart_update" class="btn btn-info">cập nhật giỏ hàng</button></td> --}}
                                        <!-- <td></td> -->
                                        <td colspan="2"><a onclick="return confirm('bạn có chắc muốn xóa hết không?')" href="{{ asset('cart/delete') }}/all" class="btn btn-light">xóa hết sản phẩm</a></td>
                                        <td colspan="1" class="text-center">tổng tiền giỏ hàng: <span>{{number_format($total_money)}}<sup>đ</sup></span></td>
                                        <td><a href="{{ asset('cart/confirm')}}" class="btn btn-success">thanh toán</a></td>
                                    </tr>
                                </tbody>
                            </table>
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
<script type="text/javascript">
    
$(document).ready(function(){

    $('.cartProduct').change(function(){
        let url= "{{asset('cart/update')}}";
        let quanlity= $(this).val();
        let id= $(this).data('id');
        $.ajax({
            url: url,
            method: 'post',
            data: {id:id, quanlity:quanlity},
            success: function(){
                location.reload();
            }


        });
    });



})




</script>

@endsection
