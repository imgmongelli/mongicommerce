<aside class="page-sidebar">
    <div class="page-logo">
        <a href="#" class="page-logo-link press-scale-down d-flex align-items-center position-relative"
            data-toggle="modal" data-target="#modal-shortcut">
            <i class="fal fa-cart-plus fa-2x"></i>
            <span class="page-logo-text mr-1">{{$mongicommerce->shop_name}}</span>
            <span class="position-absolute text-white opacity-50 small pos-top pos-right mr-2 mt-n2"></span>
            <i class="fal fa-angle-down d-inline-block ml-1 fs-lg color-primary-300"></i>
        </a>
    </div>
    <!-- BEGIN PRIMARY NAVIGATION -->
    <nav id="js-primary-nav" class="primary-nav" role="navigation">
        <div class="nav-filter">
            <div class="position-relative">
                <input type="text" id="nav_filter_input" placeholder="Filter menu" class="form-control" tabindex="0">
                <a href="#" onclick="return false;" class="btn-primary btn-search-close js-waves-off"
                    data-action="toggle" data-class="list-filter-active" data-target=".page-sidebar">
                    <i class="fal fa-chevron-up"></i>
                </a>
            </div>
        </div>
        <div class="info-card">
            <img src="{{img('demo/avatars/avatar-admin.png')}}" class="profile-image rounded-circle"
                alt="Dr. Codex Lantern">
            <div class="info-card-text">
                <a href="#" class="d-flex align-items-center text-white">
                    <span class="text-truncate text-truncate-sm d-inline-block">
                        {{Auth::user()->first_name}}
                    </span>
                </a>
                <span class="d-inline-block text-truncate text-truncate-sm">Bari, Italia</span>
            </div>
            <img src="{{img('card-backgrounds/cover-2-lg.png')}}" class="cover" alt="cover">

        </div>
        <!--
        TIP: The menu items are not auto translated. You must have a residing lang file associated with the menu saved inside dist/media/data with reference to each 'data-i18n' attribute.
        -->
        <ul id="js-nav-menu" class="nav-menu">
            <li class="active">
                <a href="{{route('admin.dashboard')}}" title="Blank Project" data-filter-tags="blank page">
                    <i class="fal fa-globe"></i>
                    <span class="nav-link-text" data-i18n="nav.blankpage">Dashboard</span>
                </a>
            </li>
            <li class="nav-title">Impostazioni prodotti</li>
            <li>
                <a href="{{route('admin.category.new')}}" title="Blank Project">
                    <i class="fal fa-tags"></i>
                    <span class="nav-link-text" data-i18n="nav.blankpage">Categorie</span>
                </a>
            </li>

            <li>
                <a href="{{route('admin.details')}}" title="Blank Project">
                    <i class="fal fa-list"></i>
                    <span class="nav-link-text" data-i18n="nav.blankpage">Dettagli</span>
                </a>
            </li>
            <li class="nav-title">Prodotti</li>
            <li>
                <a href="{{route('admin.new.single.product')}}" title="Blank Project">
                    <i class="fal fa-book"></i>
                    <span class="nav-link-text" data-i18n="nav.blankpage">Nuovo singolo prodotto</span>
                </a>
            </li>
            <li>
                <a href="{{route('admin.product.new')}}" title="Blank Project">
                    <i class="fal fa-books"></i>
                    <span class="nav-link-text" data-i18n="nav.blankpage">Nuovo prodotto con variante</span>
                </a>
            </li>
            <li>
                <a href="{{route('admin.product.list')}}" title="Menu child">
                    <i class="fal fa-list"></i>
                    <span class="nav-link-text">Lista prodotti</span>
                </a>
            </li>
            <li class="nav-title">Negozio</li>
            <li>
                <a href="{{route('admin.orders.list')}}" title="Blank Project">
                    <i class="fal fa-shopping-cart"></i>
                    <span class="nav-link-text" data-i18n="nav.blankpage">Ordini</span>
                </a>
            </li>
            <li class="nav-title">Clienti</li>
            <li>
                <a href="{{route('admin.clients')}}" title="Blank Project">
                    <i class="fal fa-users"></i>
                    <span class="nav-link-text" data-i18n="nav.blankpage">Lista Clienti</span>
                </a>
            </li>
    
            <li>
                <a href="{{route('admin.volantini')}}" title="Blank Project">
                    <i class="fal fa-file"></i>
                    <span class="nav-link-text" data-i18n="nav.blankpage">Volantini</span>
                </a>
            </li>

            {{--
            <!-- Example of open and active states -->
            <li class="active open">
                <a href="#" title="Category" data-filter-tags="category">
                    <i class="fal fa-plus"></i>
                    <span class="nav-link-text" data-i18n="nav.category">Open Item</span>
                </a>
                <ul>
                    <li class="active open">
                        <a href="javascript:void(0);" title="Menu child"
                           data-filter-tags="utilities menu child">
                                    <span class="nav-link-text"
                                          data-i18n="nav.utilities_menu_child">Open Sub-category</span>
                        </a>
                        <ul>
                            <li class="active">
                                <a href="javascript:void(0);" title="Sublevel Item"
                                   data-filter-tags="utilities menu child sublevel item">
                                            <span class="nav-link-text"
                                                  data-i18n="nav.utilities_menu_child_sublevel_item">Active Item</span>
                                </a>
                            </li>
                        </ul>
                    </li>
                </ul>
            </li>
            --}}
        </ul>
        <div class="filter-message js-filter-message bg-success-600"></div>
    </nav>
    <!-- END PRIMARY NAVIGATION -->
    <!-- NAV FOOTER -->
    <div class="nav-footer shadow-top">
        <a href="#" onclick="return false;" data-action="toggle" data-class="nav-function-minify"
            class="hidden-md-down">
            <i class="ni ni-chevron-right"></i>
            <i class="ni ni-chevron-right"></i>
        </a>
        <ul class="list-table m-auto nav-footer-buttons">
            <li>
                <a href="{{route('admin.settings')}}" data-toggle="tooltip" data-placement="top" title="Impostazioni">
                    <i class="fal fa-cogs"></i>
                </a>
            </li>
            <li>
                <a href="{{route('admin.updatepackage')}}" data-toggle="tooltip" data-placement="top"
                    title="Update application">
                    <i class="fal fa-redo"></i>
                </a>
            </li>
            <li>
                <a href="{{route('shop')}}" target="_blank" data-toggle="tooltip" data-placement="top"
                    title="vai al negozio">
                    <i class="fal fa-desktop"></i>
                </a>
            </li>
        </ul>
    </div> <!-- END NAV FOOTER -->
</aside>
