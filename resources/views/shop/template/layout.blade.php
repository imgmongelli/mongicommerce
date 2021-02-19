<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="csrf-token" content="{{ csrf_token() }}" />
    <meta name="description" content="@yield('description')">
    <meta name="author" content="">

    <title>@yield('title')</title>
    <script src="https://kit.fontawesome.com/23e0351c87.js" crossorigin="anonymous"></script>
    <!-- Bootstrap core CSS -->
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css"
        integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">
    <link rel="stylesheet" href="{{asset('mongicommerce/template/shop/plugins/jqueryToast/bootoast.css')}}">
    @yield('css')

</head>

<body>

    <nav class="navbar navbar-expand-lg navbar-dark bg-dark fixed-top">
        <a class="navbar-brand" href="#">{{$mongicommerce->shop_name}}</a>
        <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent"
            aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
        </button>
        @include('mongicommerce.template.menu')
    </nav>



    <!-- Header -->
    <header class="bg-primary py-5 mb-5">
        <div class="container h-100">
            <div class="row h-100 align-items-center">
                <div class="col-lg-12">
                    <h1 class="display-4 text-white mt-5 mb-2">@yield('title')</h1>
                    <p class="lead mb-5 text-white-50">@yield('description')</p>
                </div>
            </div>
        </div>
    </header>

    <!-- Page Content -->
    <main class="container" style="min-height: 100vh;">
        @yield('content')
    </main>
    <!-- /.container -->

    <!-- Footer -->
    <footer class="py-5 footer bg-dark">
        <div class="container">
            <p class="m-0 text-center text-white">Copyright &copy; {{$mongicommerce->address}}</p>
        </div>
        <!-- /.container -->
    </footer>

    <!-- Bootstrap core JavaScript -->
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.12.9/umd/popper.min.js"
        integrity="sha384-ApNbgh9B+Y1QKtv3Rn7W3mgPxhU9K/ScQsAP7hUibX39j7fakFPskvXusvfa0b4Q" crossorigin="anonymous">
    </script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/js/bootstrap.min.js"
        integrity="sha384-JZR6Spejh4U02d8jOt6vLEHfe/JQGiRRSQQxSfFWpi1MquVdAyjUar5+76PVCmYl" crossorigin="anonymous">
    </script>
    <script>
        let url_get_product_variation_information = '{{route('shop.get.product.information')}}';
        let url_add_to_cart = '{{route('shop.addtocart')}}';
        let url_get_cart_elements = '{{route('shop.getcartelements')}}';
        let url_cart_page = '{{route('shop.cart')}}';

        let url_get_cart_product = '{{route('getcartproducts')}}';
        let url_increment_number_product_in_cart = '{{route('increment_number_product_in_cart')}}';
        let url_delete_from_cart = '{{route('delete_from_cart')}}';
    </script>
    <script src="{{asset('mongicommerce/template/shop/plugins/jqueryToast/bootoast.js')}}"></script>
    <script src="{{asset('mongicommerce/template/shop/js/app.js')}}"></script>
    @yield('js')

</body>

</html>
