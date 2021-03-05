<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>@yield('title')</title>
    {{-- <base href="{{asset('public/frontend')}}/"> --}}
    <link rel="stylesheet" href="{{asset('public/frontend/css/all.min.css')}}">
    <link rel="stylesheet" href="{{asset('public/frontend/css/owl.carousel.min.css')}}">
    <link rel="stylesheet" href="{{asset('public/frontend/css/owl.theme.default.min.css')}}">
    <link rel="stylesheet" href="{{asset('public/frontend/css/bootstrap.css')}}">
    <link rel="stylesheet" href="{{asset('public/frontend/css/toastr.min.css')}}">
    <link rel="stylesheet" href="{{asset('public/frontend/css/style.css')}}">
    <script type="text/javascript" src="{{asset('public/frontend/js/jquery-3.5.1.js')}}"></script>
    <script type="text/javascript" src="{{asset('public/frontend/js/owl.carousel.min.js')}}"></script>
    <script type="text/javascript" src="{{asset('public/frontend/js/toastr.min.js')}}"></script>
    <script type="text/javascript" src="{{asset('public/frontend/js/bootstrap.js')}}"></script>
</head>

<body>
    <header id="header">
        <div class="header-top">
            <div class="container">
                <div class="row">
                    <div class="col-md-3 col-sm-6 col-12">
                        <div class="social">
                            <a href="#"><i class="fab fa-twitter"></i></a>
                            <a href="#"><i class="fab fab fa-facebook"></i></a>
                            <a href="#"><i class="fab fab fa-google"></i></a>
                        </div>
                    </div>
                    <div class="col-md-9 col-sm-6 col-12">
                        @if(!Auth::guard('customer')->check())
                        <div class="top-right">
                            <i class="fas fa-user"></i>
                            <a href="{{asset('login')}}" class="login">dang nhap</a>
                            <span>|</span>
                            <a href="{{asset('register')}}" class="logout">dang kí</a>
                    `   </div>
                        @else
                        <div class="top-right">
                            <i class="fas fa-user"></i>
                            <a href="" class="login">{{ Auth::guard('customer')->user()->user_name }}</a>
                            <div class="user-list">
                                <div class="user-item"><a href="{{ asset('order') }}"><i class="fas fa-ship"></i><span>order</span></a></div>
                                <div class="user-item"><a href="{{ asset('cart') }}"><i class="fas fa-shopping-cart"></i><span>cart</span></a></div>
                                <div class="user-item"><a href="{{ asset('setting')}}"><i class="fas fa-cog"></i><span>setting</span></a></div>
                                <div class="user-item"><a href="{{ asset('change-password')}}"><i class="fas fa-cog"></i><span>password</span></a></div>
                                <div class="user-item"><a href="{{ asset('logout') }}"><i class="fas fa-sign-out-alt"></i><span>logout</span></a></div>
                            </div>
                        </div>
                        @endif
                    </div>
                </div>
            </div>
        </div>
        <div class="header-main">
            <div class="container">
                <div class="row">
                    <div class="col-md-4 col-sm-4 col-12">
                        <div class="logo">
                            <h1><a href="{{asset('')}}">Qshop</a></h1>
                        </div>
                    </div>
                    <div class="col-md-6 col-sm-6 col-12">
                        <div class="search">
                            <form action="index.php?layout=search" method="post">
                                <input type="text" name="search" placeholder="search">
                                <input type="submit" name="submit" value="Search">
                            </form>
                        </div>
                    </div>
                    <div class="col-md-2 col-sm-2 col-12">
                        <div class="cart">
                            <a href="{{ asset('cart/index') }}"><i class="fas fa-shopping-cart"></i></a>
                            <span>@if(Auth::guard('customer')->check()) {{ $cart_count }} @else 0 @endif</span>
                            {{-- <span>{{ count(Auth::guard('customer')->user()->cart) }}</span> --}}
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <nav class="header-bottom">
            <div class="container">
                <ul class="menu">
                    <li>
                        <a href="#">Danh mục sản phẩm</a>
                        <ul id="menu2" class="menu2">
                            {{-- <li>
                                <a href="index.php?layout=product&cate_id=1">pin laptop</a>
                                <ul id="menu3" class="menu3">
                                    <li><a href="index.php?layout=product&cate_id=1&brand_id=14">Dell</a></li>
                                    <li><a href="index.php?layout=product&cate_id=1&brand_id=15">Acer</a></li>
                                    <li><a href="index.php?layout=product&cate_id=1&brand_id=16">Hp</a></li>
                                </ul>
                            </li> --}}
                            @foreach($categories as $category)
                            <li>
                                <a href="{{route('product.category', $category->slug)}}">{{$category->name}}</a>
                                <ul id="menu3" class="menu3">
                                    @foreach($category->brand as $brand)
                                    <li><a href="{{route('product.brand', [$brand->id, $brand->slug])}}">{{$brand->name}}</a></li>
                                    @endforeach
                                </ul>
                            </li>
                            @endforeach
                        </ul>
                    </li>
                    <li><a href="#">home</a></li>
                    <li><a href="#">giới thiệu</a></li>
                    <li><a href="#">liên hệ</a></li>
                </ul>
            </div>
        </nav>
    </header>
    <section id="slide">
        <div class="container">
            <div class="owl-carousel owl-theme slide">
                @foreach($sliders as $slider)
                <div class="item"><img src="{{ asset('public/uploads/slider/'.$slider->image)}}" alt=""></div>
                @endforeach
            </div>
        </div>
    </section>
    
    @yield('content')

    <div class="footer">
        <div class="container">
            <div class="row">
                <div class="col-md-4 col-sm-6 col-12">
                    <div class="logo f-logo">
                        <h1><a href="">Qshop</a></h1>
                    </div>
                </div>
                <div class="col-md-4 col-sm-6 col-12">
                    <div class="f-contact">
                        <h6>tong dai ho tro</h6>
                        <div class="f-contact-item">
                            <i class="fas fa-phone-alt"></i>
                            <span>09123456789</span>
                        </div>
                        <div class="f-contact-item">
                            <i class="fas fa-envelope"></i>
                            <span>09123456789</span>
                        </div>
                    </div>
                </div>
                <div class="col-md-4 col-sm-6 col-12">
                    <div class="f-address">
                        <h6>Address</h6>
                        <div class="f-address-item">
                            <i class="fas fa-map-marker-alt"></i>
                            <span>251, Đội Cấn - Ba Đình - Hà Nội</span>
                        </div>
                        <div class="f-address-item">
                            <i class="fas fa-map-marker-alt"></i>
                            <span>251, Đội Cấn - Ba Đình - Hà Nội</span>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <script type="text/javascript">
    $(document).ready(function() {

        $('.slide').owlCarousel({
            loop: true,
            dots: true,
            margin: 30,
            nav: true,
            navText: [
                '<span class="prev"><i class="fas fa-chevron-left"></i></span>', '<span class="next"><i class="fas fa-chevron-right"></i></span>'
            ],
            navClass: ['owl-prev', 'owl-next'],
            autoplay: true,
            autoplayHoverPause: true,
            responsive: {
                0: {
                    items: 1
                },
                600: {
                    items: 1
                },
                1000: {
                    items: 1
                }
            }
        });


        $('.category').owlCarousel({
            loop: true,
            dots: false,
            margin: 30,
            nav: false,
            // navText: [
            // '<span class="prev">prev</span>','<span class="prev">prev</span>'
            // ],
            // navClass: ['owl-prev', 'owl-next'],
            autoplay: true,
            autoplayHoverPause: true,
            responsive: {
                0: {
                    items: 1
                },
                576: {
                    items: 2
                },
                768: {
                    items: 4
                }
            }
        });

    });

    $.ajaxSetup({
        headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        }
    });

    @if(session('thongbao'))
    toastr.success("{{session('thongbao')}}", 'Thông báo', {timeOut: 5000});
    @endif

    @if(session('error'))
    toastr.error("{{session('error')}}", 'Thông báo', {timeOut: 5000});
    @endif



    </script>

    @yield('js')
</body>

</html>