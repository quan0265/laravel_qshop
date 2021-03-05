<div class="sidebar">
    <h4>danh mục sản phẩm</h4>
    {{-- <div class="cate active">
        <h5><a href="index.php?layout=product&cate_id=2"><i class="fas fa-angle-right"></i>sac laptop</a><span>4</span></h5>
        <ul class="cate-list">
            <li><i class="fas fa-angle-right"></i><a href="index.php?layout=product&cate_id=2&brand_id=18">Acer</a><span>4</span></li>
            <li><i class="fas fa-angle-right"></i><a href="index.php?layout=product&cate_id=2&brand_id=17">Dell</a><span>0</span></li>
        </ul>
    </div> --}}
    @foreach($categories as $category)
    <div class="cate active">
        <h5><a href="{{route('product.category', $category->slug)}}"><i class="fas fa-angle-right"></i>{{$category->name}}</a><span>{{count($category->product)}}</span></h5>
        <ul class="cate-list">
            @foreach($category->brandOderby as $brand)
            <li><i class="fas fa-angle-right"></i><a href="{{route('product.brand', [$brand->id, $brand->slug])}}">{{$brand->name}}</a><span>{{count($brand->product)}}</span></li>
            @endforeach
        </ul>
    </div>
    @endforeach
    <h4>Sản phẩm mới</h4>
    <ul class="product-hot-list">
        {{-- <li>
            <a href="index.php?layout=product_detail&product_id=36"><img src="images/product/715pin-dell-inspiron-3421.jpg" alt=""></a>
            <div class="hot-item-text">
                <a href="index.php?layout=product_detail&product_id=36">pin dell inspiron 3442 3421</a>
                <p>400000</p>
            </div>
        </li> --}}
        @foreach($product_new as $product)
        <li>
            <a href="{{route('detail', [$product->id, $product->slug])}}"><img src="{{asset('public/uploads/product')}}/{{$product->image}}" alt=""></a>
            <div class="hot-item-text">
                <a href="{{route('detail', [$product->id, $product->slug])}}">{{$product->name}}</a>
                <p>{{$product->price}}</p>
            </div>
        </li>
        @endforeach
    </ul>
</div>