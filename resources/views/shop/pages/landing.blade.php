@extends('mongicommerce.template.layout')
@section('title','Welcome')
@section('description','Welcome')
@section('css')
@endsection
@section('content')
    <section class="hero-slider">
        <!-- Single Slider -->
        <div class="single-slider" style="background-image: url('{{asset('mongicommerce/template/shop/images/big_image.png')}}')">
            <div class="container">
                <div class="row no-gutters">
                    <div class="col-lg-9 offset-lg-3 col-12">
                        <div class="text-inner">
                            <div class="row">
                                <div class="col-lg-7 col-12">
                                    <div class="hero-text">

                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <!--/ End Single Slider -->
    </section>
    <!--/ End Slider Area -->

    <!-- Start Small Banner  -->
    <section class="small-banner section">
        <div class="container-fluid">
            @if($volantini->count() > 0)
                <div class="row">
                    <div class="col-12">
                        <div class="section-title">
                            <h2>Volantini</h2>
                        </div>
                    </div>
                </div>
            @endif
            <div class="row">
                <!-- Single Banner  -->
                @foreach( $volantini as $volantino)
                    <div class="col-lg-3 col-md-6 col-12">
                        <a href="{{$volantino->path}}">
                            <div class="single-banner">
                                <img src="{{asset('mongicommerce/template/shop/images/mock_volantino.png')}}" alt="#">
                                <div class="content text-center">
                                    <h3 style="background-color: #FFF;">{{$volantino->name}}</h3>
                                </div>
                            </div>
                        </a>
                    </div>
                @endforeach
            </div>
        </div>
    </section>
    <!-- End Small Banner -->


    <!-- Start Most Popular -->
    <div class="product-area section">
        <div class="container-fluid">
            <div class="row">
                <div class="col-12">
                    <div class="section-title">
                        <h2>Prodotti in evidenza</h2>
                    </div>
                </div>
            </div>
            <div class="row">
                @foreach($productsInHome as $product)
                <div class="col-lg-3 col-md-6 col-12">
                    <div class="product-info">

                            <div class="single-product">
                                <div class="product-img">
                                    <a href="{{route('shop.single.product',$product->id)}}">
                                        <img style="max-height: 750px;" class="default-img" src="{{$product->image}}" alt="#">
                                        <span class="out-of-stock">In offerta</span>
                                    </a>
                                    <div class="button-head">
                                        {{--                                        <div class="product-action">--}}
                                        {{--                                            <a title="Wishlist" href="#"><i class=" ti-heart "></i><span>Aggiungi a wishlist</span></a>--}}
                                        {{--                                        </div>--}}
                                        <div class="product-action-2">
                                            <a title="Add to cart" href="{{route('shop.single.product',$product->id)}}">Visualizza prodotto</a>
                                        </div>
                                    </div>
                                </div>
                                <div class="product-content">
                                    <h3><a href="{{route('shop.single.product',$product->id)}}">{{$product->name}}</a></h3>
                                    <div class="product-price">
                                        <span></span>
                                    </div>
                                </div>
                            </div>

                    </div>
                </div>
                @endforeach
            </div>
        </div>
    </div>
    <!-- End Most Popular Area -->

    <section class="section free-version-banner">
        <div class="container">
            <div class="row align-items-center">
                <div class="col-md-8 offset-md-2 col-xs-12">
                    <div class="section-title mb-60">
                        <span class="text-white wow fadeInDown" data-wow-delay=".2s" style="visibility: visible; animation-delay: 0.2s; animation-name: fadeInDown;">{{$mongicommerce->shop_name}}</span>
                        <h2 class="text-white wow fadeInUp" data-wow-delay=".4s" style="visibility: visible; animation-delay: 0.4s; animation-name: fadeInUp;">Acquista i nostri prodotti<br> sul nostro e-commerce.</h2>
                        <p class="text-white wow fadeInUp" data-wow-delay=".6s" style="visibility: visible; animation-delay: 0.6s; animation-name: fadeInUp;">Puoi trovare tutte le nostre offerte qui!<br> Guarda il nostro negozio</p>

                        <div class="button">
                            <a href="{{route('shop')}}" target="_blank" rel="nofollow" class="btn wow fadeInUp" data-wow-delay=".8s">Vai al negozio</a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>


    <!-- End Shop Home List  -->

    <!-- Start Shop Blog  -->
    <section class="shop-blog section">
        <div class="container">
            <div class="row">
                <div class="col-12">
                    <div class="section-title">
                        <h2>Il nostro negozio</h2>
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col-lg-4 col-md-6 col-12">
                    <!-- Start Single Blog  -->
                    <div class="shop-single-blog">
                        <img src="{{asset('mongicommerce/template/shop/images/photo_1.jpg')}}" alt="#">
                        <div class="content">
                        </div>
                    </div>
                    <!-- End Single Blog  -->
                </div>
                <div class="col-lg-4 col-md-6 col-12">
                    <!-- Start Single Blog  -->
                    <div class="shop-single-blog">
                        <img src="{{asset('mongicommerce/template/shop/images/photo_2.jpg')}}" alt="#">
                        <div class="content">
                        </div>
                    </div>
                    <!-- End Single Blog  -->
                </div>
                <div class="col-lg-4 col-md-6 col-12">
                    <!-- Start Single Blog  -->
                    <div class="shop-single-blog">
                        <img src="{{asset('mongicommerce/template/shop/images/photo_3.jpg')}}" alt="#">
                        <div class="content">
                        </div>
                        <!-- End Single Blog  -->
                    </div>
                </div>
            </div>
    </section>
    <!-- End Shop Blog  -->

    {{--
   <section class="shop-services section home">
       <div class="container">
           <div class="row">
               <div class="col-lg-3 col-md-6 col-12">
                   <!-- Start Single Service -->
                   <div class="single-service">
                       <i class="ti-rocket"></i>
                       <h4>Free shiping</h4>
                       <p>Orders over $100</p>
                   </div>
                   <!-- End Single Service -->
               </div>
               <div class="col-lg-3 col-md-6 col-12">
                   <!-- Start Single Service -->
                   <div class="single-service">
                       <i class="ti-reload"></i>
                       <h4>Free Return</h4>
                       <p>Within 30 days returns</p>
                   </div>
                   <!-- End Single Service -->
               </div>
               <div class="col-lg-3 col-md-6 col-12">
                   <!-- Start Single Service -->
                   <div class="single-service">
                       <i class="ti-lock"></i>
                       <h4>Sucure Payment</h4>
                       <p>100% secure payment</p>
                   </div>
                   <!-- End Single Service -->
               </div>
               <div class="col-lg-3 col-md-6 col-12">
                   <!-- Start Single Service -->
                   <div class="single-service">
                       <i class="ti-tag"></i>
                       <h4>Best Peice</h4>
                       <p>Guaranteed price</p>
                   </div>
                   <!-- End Single Service -->
               </div>
           </div>
       </div>
   </section>
    --}}

@endsection
