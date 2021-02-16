<div class="collapse navbar-collapse" id="navbarSupportedContent">
    <ul class="navbar-nav mr-auto">
        @auth
        <li class="nav-item dropdown">
            <a class="nav-link dropdown-toggle" href="#" id="navbarDropdown" role="button" data-toggle="dropdown"
                aria-haspopup="true" aria-expanded="false">
                <i class="fas fa-user"></i>
                {{Auth::user()->first_name}}
            </a>
            <div class="dropdown-menu" aria-labelledby="navbarDropdown">
                <a class="dropdown-item" href="{{route('shop.user.settings')}}">Profilo</a>
                <a class="dropdown-item" href="{{route('shop.user.orders')}}">Ordini</a>
                <a class="dropdown-item" href="{{route('logout')}}">Log-out</a>
            </div>
        </li>
        @else
        <li class="nav-item">
            <a class="nav-link" href="{{route('shop.redirect.login')}}">
                Login
            </a>
        </li>
        @endauth

        <li class="nav-item dropdown">
            <a class="nav-link dropdown-toggle" href="#" id="navbarDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                Shop
            </a>
            <div class="dropdown-menu" aria-labelledby="navbarDropdown">
                @foreach($categories as $category)
                    <a class="dropdown-item" href="{{route('shop',$category['id'])}}">{{$category['text']}}</a>
                @endforeach
            </div>
        </li>
        <li class="nav-item">
            <a class="nav-link" href="{{route('shop.cart')}}">
                <i class="fas fa-shopping-cart"></i>
                <span class="badge badge-success space_cart">0</span>
            </a>
        </li>



    </ul>
</div>
