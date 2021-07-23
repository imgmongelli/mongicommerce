<!DOCTYPE html>
<html lang="IT-it" style="height: 100%;">
<head>
    <title>@yield('title')</title>
    <!-- Meta Tag -->
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="csrf-token" content="{{ csrf_token() }}" />
    <meta name='copyright' content=''>
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <!-- Title Tag  -->
    <title>Eshop - eCommerce HTML5 Template.</title>
    <!-- Favicon -->

    <link rel="icon" type="image/png" href="{{asset('mongicommerce/template/shop/images/favicon.png')}}">
    <!-- Web Font -->
    <link href="https://fonts.googleapis.com/css?family=Poppins:200i,300,300i,400,400i,500,500i,600,600i,700,700i,800,800i,900,900i&display=swap" rel="stylesheet">

    <!-- StyleSheet -->

    <!-- Bootstrap -->
    <link rel="stylesheet" href="{{asset('mongicommerce/template/shop/css/bootstrap.css')}}">
    <!-- Magnific Popup -->
    <link rel="stylesheet" href="{{asset('mongicommerce/template/shop/css/magnific-popup.min.css')}}">
    <!-- Font Awesome -->
    <link rel="stylesheet" href="{{asset('mongicommerce/template/shop/css/font-awesome.css')}}">
    <!-- Fancybox -->
    <link rel="stylesheet" href="{{asset('mongicommerce/template/shop/css/jquery.fancybox.min.css')}}">
    <!-- Themify Icons -->
    <link rel="stylesheet" href="{{asset('mongicommerce/template/shop/css/themify-icons.css')}}">
    <!-- Nice Select CSS -->
    <link rel="stylesheet" href="{{asset('mongicommerce/template/shop/css/niceselect.css')}}">
    <!-- Animate CSS -->
    <link rel="stylesheet" href="{{asset('mongicommerce/template/shop/css/animate.css')}}">
    <!-- Flex Slider CSS -->
    <link rel="stylesheet" href="{{asset('mongicommerce/template/shop/css/flex-slider.min.css')}}">
    <!-- Owl Carousel -->
    <link rel="stylesheet" href="{{asset('mongicommerce/template/shop/css/owl-carousel.css')}}">
    <!-- Slicknav -->
    <link rel="stylesheet" href="{{asset('mongicommerce/template/shop/css/slicknav.min.css')}}">

    <!-- Eshop StyleSheet -->
    <link rel="stylesheet" href=" {{asset('mongicommerce/template/shop/css/reset.css')}}">
    <link rel="stylesheet" href=" {{asset('mongicommerce/template/shop/css/style.css')}}">
    <link rel="stylesheet" href=" {{asset('mongicommerce/template/shop/css/responsive.css')}}">
    <link rel="stylesheet" href="{{asset('mongicommerce/template/shop/plugins/jqueryToast/bootoast.css')}}">
    @yield('css')


</head>
<body>

<!-- Header -->
<header class="header shop">
    <!-- Topbar -->
    <div class="topbar">
        <div class="container">
            <div class="row">
                <div class="col-lg-5 col-md-12 col-12">
                    <!-- Top Left -->
                    <div class="top-left">
                        <ul class="list-main">
                            <li><i class="ti-headphone-alt"></i> {{$mongicommerce->telephone}}</li>
                            <li><i class="ti-email"></i> {{$mongicommerce->email}}</li>
                        </ul>
                    </div>
                    <!--/ End Top Left -->
                </div>
                <div class="col-lg-7 col-md-12 col-12">
                    <!-- Top Right -->
                    <div class="right-content">
                        <ul class="list-main">
                            @auth
                                <li>
                                    <i class="ti-user"></i>
                                    <a href="{{route('shop.user.settings')}}"> {{Auth::user()->first_name}}</a>
                                </li>
                                <li>
                                    <i class="ti-alarm-clock"></i>
                                    <a href="{{route('shop.user.orders')}}">Ordini</a>
                                </li>
                                <li>
                                    <i class="ti-location-pin"></i>
                                    <a href="{{route('logout')}}">Log-out</a>
                                </li>
                            @else
                                <li>
                                    <i class="ti-power-off"></i><a href="{{route('shop.redirect.login')}}">Login</a>
                                </li>
                            @endauth
                        </ul>
                    </div>
                    <!-- End Top Right -->
                </div>
            </div>
        </div>
    </div>
    <!-- End Topbar -->
    @if(count($errors) > 0)
        <div class="container mt-3" style="z-index: 200">
            <div class="alert alert-danger">
                <ul>
                    @foreach($errors->all() as $error)
                        <li>{{$error}}</li>
                    @endforeach
                </ul>
            </div>
        </div>
    @endif
    <div class="middle-inner">
        <div class="container">
            <div class="row">
                <div class="col-lg-2 col-md-2 col-12">
                    <!-- Logo -->
                    <div class="logo">
                        <a href="{{route('shop.landing')}}"><img src="{{asset('mongicommerce/template/shop/images/logo.png')}}" alt="logo"></a>
                    </div>
                    <!--/ End Logo -->
                    <!-- Search Form -->
                    <div class="search-top">
                        <div class="top-search"><a href="#0"><i class="ti-search"></i></a></div>
                        <!-- Search Form -->
                        <div class="search-top">
                            <form class="search-form" action="{{route('shop.search')}}" method="GET">
                                <input id="query" name="query" value="{{request()->input('query')}}" placeholder="Cerca prodotti qui..." type="text">
                                <button value="search" type="submit"><i class="ti-search"></i></button>
                            </form>
                        </div>
                        <!--/ End Search Form -->
                    </div>
                    <!--/ End Search Form -->
                    <div class="mobile-nav"></div>
                </div>
                <div class="col-lg-8 col-md-7 col-12">
                    <div class="search-bar-top">
                        <div class="search-bar">
                            <form action="{{route('shop.search')}}" method="GET">
                                <input id="query" name="query" value="{{request()->input('query')}}" placeholder="Cerca prodotti qui....." type="text">
                                <button type="submit" id="search_btn" class="btnn"><i class="ti-search"></i></button>
                            </form>
                        </div>
                    </div>
                </div>
                <div class="col-lg-2 col-md-3 col-12">
                    <div class="right-bar">
                        <!-- Search Form -->
{{--                        <div class="sinlge-bar">--}}
{{--                            <a href="#" class="single-icon"><i class="fa fa-heart-o" aria-hidden="true"></i></a>--}}
{{--                        </div>--}}
                        <div class="sinlge-bar">
                            @auth
                                <a href="{{route('shop.user.settings')}}" class="single-icon"><i class="fa fa-user-circle-o" aria-hidden="true"></i></a>
                            @else
                                <a href="{{route('shop.redirect.login')}}" class="single-icon"><i class="fa fa-user-circle-o" aria-hidden="true"></i></a>
                            @endauth
                        </div>
                        <div class="sinlge-bar shopping">
                            <a href="{{route('shop.cart')}}" class="single-icon"><i class="ti-bag"></i> <span class="total-count space_cart">0</span></a>
                            <!-- Shopping Item -->
                            {{--
                            <div class="shopping-item">
                                <div class="dropdown-cart-header">
                                    <span>2 Items</span>
                                    <a href="#">View Cart</a>
                                </div>
                                <ul class="shopping-list">
                                    <li>
                                        <a href="#" class="remove" title="Remove this item"><i class="fa fa-remove"></i></a>
                                        <a class="cart-img" href="#"><img src="https://via.placeholder.com/70x70" alt="#"></a>
                                        <h4><a href="#">Woman Ring</a></h4>
                                        <p class="quantity">1x - <span class="amount">$99.00</span></p>
                                    </li>
                                    <li>
                                        <a href="#" class="remove" title="Remove this item"><i class="fa fa-remove"></i></a>
                                        <a class="cart-img" href="#"><img src="https://via.placeholder.com/70x70" alt="#"></a>
                                        <h4><a href="#">Woman Necklace</a></h4>
                                        <p class="quantity">1x - <span class="amount">$35.00</span></p>
                                    </li>
                                </ul>
                                <div class="bottom">
                                    <div class="total">
                                        <span>Total</span>
                                        <span class="total-amount">$134.00</span>
                                    </div>
                                    <a href="checkout.html" class="btn animate">Checkout</a>
                                </div>
                            </div>--}}
                            <!--/ End Shopping Item -->
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- Header Inner -->
    <div class="header-inner">
        <div class="container">
            <div class="cat-nav-head">
                <div class="row">
                    {{--
                    <div class="col-lg-3">
                        <div class="all-category">
                            <h3 class="cat-heading"><i class="fa fa-bars" aria-hidden="true"></i>CATEGORIES</h3>
                            <ul class="main-category">
                                <li><a href="#">New Arrivals <i class="fa fa-angle-right" aria-hidden="true"></i></a>
                                    <ul class="sub-category">
                                        <li><a href="#">accessories</a></li>
                                        <li><a href="#">best selling</a></li>
                                        <li><a href="#">top 100 offer</a></li>
                                        <li><a href="#">sunglass</a></li>
                                        <li><a href="#">watch</a></li>
                                        <li><a href="#">man’s product</a></li>
                                        <li><a href="#">ladies</a></li>
                                        <li><a href="#">westrn dress</a></li>
                                        <li><a href="#">denim </a></li>
                                    </ul>
                                </li>
                                <li class="main-mega"><a href="#">best selling <i class="fa fa-angle-right" aria-hidden="true"></i></a>
                                    <ul class="mega-menu">
                                        <li class="single-menu">
                                            <a href="#" class="title-link">Shop Kid's</a>
                                            <div class="image">
                                                <img src="https://via.placeholder.com/225x155" alt="#">
                                            </div>
                                            <div class="inner-link">
                                                <a href="#">Kids Toys</a>
                                                <a href="#">Kids Travel Car</a>
                                                <a href="#">Kids Color Shape</a>
                                                <a href="#">Kids Tent</a>
                                            </div>
                                        </li>
                                        <li class="single-menu">
                                            <a href="#" class="title-link">Shop Men's</a>
                                            <div class="image">
                                                <img src="https://via.placeholder.com/225x155" alt="#">
                                            </div>
                                            <div class="inner-link">
                                                <a href="#">Watch</a>
                                                <a href="#">T-shirt</a>
                                                <a href="#">Hoodies</a>
                                                <a href="#">Formal Pant</a>
                                            </div>
                                        </li>
                                        <li class="single-menu">
                                            <a href="#" class="title-link">Shop Women's</a>
                                            <div class="image">
                                                <img src="https://via.placeholder.com/225x155" alt="#">
                                            </div>
                                            <div class="inner-link">
                                                <a href="#">Ladies Shirt</a>
                                                <a href="#">Ladies Frog</a>
                                                <a href="#">Ladies Sun Glass</a>
                                                <a href="#">Ladies Watch</a>
                                            </div>
                                        </li>
                                    </ul>
                                </li>
                                <li><a href="#">accessories</a></li>
                                <li><a href="#">top 100 offer</a></li>
                                <li><a href="#">sunglass</a></li>
                                <li><a href="#">watch</a></li>
                                <li><a href="#">man’s product</a></li>
                                <li><a href="#">ladies</a></li>
                                <li><a href="#">westrn dress</a></li>
                                <li><a href="#">denim </a></li>
                            </ul>
                        </div>
                    </div>--}}
                    <div class="col-lg-9 col-12">
                        <div class="menu-area">
                            <!-- Main Menu -->
                            <nav class="navbar navbar-expand-lg">
                                <div class="navbar-collapse">
                                    <div class="nav-inner">
                                        <ul class="nav main-menu menu navbar-nav">
                                            <li><a href="{{route('shop.landing')}}">Home</a></li>
                                            <li><a href="#">Categorie<i class="ti-angle-down"></i></a>
                                                @if(count($categories) <= 10)
                                                    <ul class="dropdown">
                                                        @foreach($categories as $category)
                                                            <li><a href="{{route('shop',$category['id'])}}">
                                                                    @if(str_starts_with($category['name'], '-'))
                                                                        {{$category['name']}}
                                                                    @else
                                                                        <strong>{{$category['name']}}</strong>
                                                                    @endif
                                                                </a></li>
                                                        @endforeach
                                                        @else
                                                            <ul class="dropdown double-col">
                                                                <div class="d-flex justify-content-between">
                                                                    <div class="d-flex flex-column col-6" style="border-right: 1px solid rgba(0, 0, 0, 0.1)">
                                                                        @for ($i = 0; $i < count($categories)/2; $i++)
                                                                            <li><a href="{{route('shop',$categories[$i]['id'])}}">
                                                                                    @if(str_starts_with($categories[$i]['name'], '-'))
                                                                                        {{$categories[$i]['name']}}
                                                                                    @else
                                                                                        <strong>{{$categories[$i]['name']}}</strong>
                                                                                    @endif
                                                                                </a></li>
                                                                        @endfor
                                                                    </div>
                                                                    <div class="d-flex flex-column col-6">
                                                                        @for ($i; $i < count($categories); $i++)
                                                                            <li><a href="{{route('shop',$categories[$i]['id'])}}">
                                                                                    @if(str_starts_with($categories[$i]['name'], '-'))
                                                                                        {{$categories[$i]['name']}}
                                                                                    @else
                                                                                        <strong>{{$categories[$i]['name']}}</strong>
                                                                                    @endif
                                                                                </a></li>
                                                                        @endfor
                                                                    </div>
                                                                </div>
                                                                @endif

                                                            </ul>
                                                            </li>
                                                            <li><a href="{{route('shop')}}">Shop</a></li>
                                                    </ul>
                                    </div>
                                        </ul>
                                    </div>
                                </div>
                            </nav>
                            <!--/ End Main Menu -->
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!--/ End Header Inner -->
</header>
<!--/ End Header -->

<!-- Slider Area -->
<div class="wrapper">
    @yield('content')
</div>
<!-- Modal -->
<div class="modal fade" id="exampleModal" tabindex="-1" role="dialog">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span class="ti-close" aria-hidden="true"></span></button>
            </div>
            <div class="modal-body">
                <div class="row no-gutters">
                    <div class="col-lg-6 offset-lg-3 col-12">
                        <h4 style="margin-top:100px;font-size:14px; font-weight:500; color:#F7941D; display:block; margin-bottom:5px;">Eshop Free Lite</h4>
                        <h3 style="font-size:30px;color:#333;">Currently You are using free lite Version of Eshop.<h3>
                                <p style="display:block; margin-top:20px; color:#888; font-size:14px; font-weight:400;">Please, purchase full version of the template to get all pages, features and commercial license</p>
                                <div class="button" style="margin-top:30px;">
                                    <a href="https://wpthemesgrid.com/downloads/eshop-ecommerce-html5-template/" target="_blank" class="btn" style="color:#fff;">Buy Now!</a>
                                </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<!-- Modal end -->

<!-- Start Footer Area -->
<footer class="footer">
    <!-- Footer Top -->
    <div class="footer-top small-section">
        <div class="container">
            <div class="row">
                <div class="col-lg-3 col-md-6 col-12">
                    <!-- Single Widget -->
                    <div class="single-footer about">
                        <div class="logo">
                            <a href="{{route('shop.landing')}}"><img src="{{asset('mongicommerce/template/shop/images/logo2.png')}}" width="110" alt="#"></a>
                        </div>
                        <div class="single-footer social">
                            <ul>
                                <li><a href="#"><i class="ti-facebook"></i></a></li>
                                <li><a href="#"><i class="ti-twitter"></i></a></li>
                                <li><a href="#"><i class="ti-instagram"></i></a></li>
                            </ul>
                        </div>
                        <p class="call">Chiamaci<span><a href="{{$mongicommerce->telephone}}">{{$mongicommerce->telephone}}</a></span></p>


                    </div>
                    <!-- End Single Widget -->
                </div>
                <div class="col-lg-3 col-md-6 col-12">
                    <!-- Single Widget -->
                    <div class="single-footer social">
                        <h4>Sitemap</h4>
                        <div class="contact">
                            <ul>
                                <li><a href="{{route('shop.landing')}}">Home</a></li>
                                <li><a href="{{route('shop')}}">Negozio</a></li>
                                <li><a href="{{route('shop.redirect.login')}}">Login</a></li>
                            </ul>
                        </div>
                    </div>
                    <!-- End Single Widget -->
                </div>
                <div class="col-lg-3 col-md-6 col-12">
                    <!-- Single Widget -->
                    <div class="single-footer social">
                        <h4>Link utili</h4>
                        <div class="contact">
                            <ul>
                                <li><a href="">Dove siamo</a></li>
                                <li><a href="">Terms & Privacy</a></li>
                            </ul>
                        </div>
                    </div>
                    <!-- End Single Widget -->
                </div>
                <div class="col-lg-3 col-md-6 col-12">
                    <!-- Single Widget -->
                    <div class="single-footer social">
                        <h4>Contattaci</h4>
                        <!-- Single Widget -->
                        <div class="contact">
                            <ul>
                                <li>{{$mongicommerce->address}}</li>
                                <li>{{$mongicommerce->email}}</li>
                                <li>{{$mongicommerce->telephone}}</li>
                            </ul>
                        </div>
                        <!-- End Single Widget -->

                    </div>
                    <!-- End Single Widget -->
                </div>
            </div>
        </div>
    </div>
    <!-- End Footer Top -->
    <div class="copyright">
        <div class="container">
            <div class="inner">
                <div class="row">
                    <div class="col-lg-7 col-12">
                        <div class="left">
                            <p>
                                POR FESR Lazio 2014-2020 - Mis.3.5.1 – Progetto Lazio Open Innovation Center – Zagarolo <br>
                                Copyright © 2020 <a href="#">{{$mongicommerce->shop_name}}</a>  -  All Rights Reserved.
                            </p>
                        </div>
                    </div>
                    <div class="col-lg-5 col-12">
                        <div class="right">
                            <img width="250" src="{{asset('mongicommerce/template/shop/images/img.png')}}" alt="#">
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</footer>
<!-- /End Footer Area -->

<!-- Jquery -->
<script src=" {{asset('mongicommerce/template/shop/js/jquery.min.js')}}"></script>
<script src=" {{asset('mongicommerce/template/shop/js/jquery-migrate-3.0.0.js')}}"></script>
<script src=" {{asset('mongicommerce/template/shop/js/jquery-ui.min.js')}}"></script>
<!-- Popper JS -->
<script src=" {{asset('mongicommerce/template/shop/js/popper.min.js')}}"></script>
<!-- Bootstrap JS -->
<script src=" {{asset('mongicommerce/template/shop/js/bootstrap.min.js')}}"></script>
<!-- Slicknav JS -->
<script src=" {{asset('mongicommerce/template/shop/js/slicknav.min.js')}}"></script>
<!-- Owl Carousel JS -->
<script src=" {{asset('mongicommerce/template/shop/js/owl-carousel.js')}}"></script>
<!-- Magnific Popup JS -->
<script src=" {{asset('mongicommerce/template/shop/js/magnific-popup.js')}}"></script>
<!-- Waypoints JS -->
<script src=" {{asset('mongicommerce/template/shop/js/waypoints.min.js')}}"></script>
<!-- Countdown JS -->
<script src=" {{asset('mongicommerce/template/shop/js/finalcountdown.min.js')}}"></script>
<!-- Nice Select JS -->
{{--<script src=" {{asset('mongicommerce/template/shop/js/nicesellect.js')}}"></script>--}}
<!-- Flex Slider JS -->
<script src=" {{asset('mongicommerce/template/shop/js/flex-slider.js')}}"></script>
<!-- ScrollUp JS -->
<script src=" {{asset('mongicommerce/template/shop/js/scrollup.js')}}"></script>
<!-- Onepage Nav JS -->
<script src=" {{asset('mongicommerce/template/shop/js/onepage-nav.min.js')}}"></script>
<!-- Easing JS -->
<script src=" {{asset('mongicommerce/template/shop/js/easing.js')}}"></script>
<!-- Active JS -->
<script src=" {{asset('mongicommerce/template/shop/js/active.js')}}"></script>

<script src="{{asset('mongicommerce/template/shop/plugins/jqueryToast/bootoast.js')}}"></script>
<script>
    let url_get_product_variation_information = '{{route('shop.get.product.information')}}';
    let url_add_to_cart = '{{route('shop.addtocart')}}';
    let url_get_cart_elements = '{{route('shop.getcartelements')}}';
    let url_cart_page = '{{route('shop.cart')}}';

    let url_get_cart_product = '{{route('getcartproducts')}}';
    let url_increment_number_product_in_cart = '{{route('increment_number_product_in_cart')}}';
    let url_delete_from_cart = '{{route('delete_from_cart')}}';
</script>

<script src="{{asset('mongicommerce/template/shop/js/app.js')}}"></script>
@yield('js')
</body>
</html>
