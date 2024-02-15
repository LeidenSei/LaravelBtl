<!DOCTYPE html>
<html lang="en">


<!-- Mirrored from portotheme.com/html/porto_ecommerce/demo29.html by HTTrack Website Copier/3.x [XR&CO'2014], Wed, 20 Sep 2023 02:22:43 GMT -->

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

    <title>The House Store</title>

    <meta name="keywords" content="HTML5 Template" />
    <meta name="description" content="Porto - Bootstrap eCommerce Template">
    <meta name="author" content="SW-THEMES">

    <!-- Favicon -->
    <link rel="icon" type="image/x-icon" href="{{ asset('fe-asset') }}/assets/images/icons/favicon.png">


    <script>
        WebFontConfig = {
            google: {
                families: ['Open+Sans:300,400,600,700,800', 'Poppins:300,400,500,600,700']
            }
        };
        (function(d) {
            var wf = d.createElement('script'),
                s = d.scripts[0];
            wf.src = '{{ asset('fe-asset') }}/assets/js/webfont.js';
            wf.async = true;
            s.parentNode.insertBefore(wf, s);
        })(document);
    </script>
    @yield('form-button')
    <!-- Plugins CSS File -->
    <link rel="stylesheet" href="{{ asset('fe-asset') }}/assets/css/bootstrap.min.css">

    <!-- Main CSS File -->
    <link rel="stylesheet" href="{{ asset('fe-asset') }}/assets/css/demo29.min.css">
    <link rel="stylesheet" type="text/css"
        href="{{ asset('fe-asset') }}/assets/vendor/fontawesome-free/css/all.min.css">
    <link rel="stylesheet" href="{{ asset('fe-asset') }}/assets/css/style.min.css">
    <link rel="stylesheet" type="text/css" href="{{ asset('fe-asset') }}/assets/vendor/fontawesome-free/css/all.min.css">
    <link rel="stylesheet" type="text/css"
        href="{{ asset('fe-asset') }}/assets/vendor/simple-line-icons/css/simple-line-icons.min.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.min.css"
        integrity="sha512-vKMx8UnXk60zUwyUnUPM3HbQo8QfmNx7+ltw8Pm5zLusl1XIfwcxo8DbWCqMGKaWeNxWA8yrx5v3SaVpMvR3CA=="
        crossorigin="anonymous" referrerpolicy="no-referrer" />
    <link href="{{ asset('common/commonStyle.css') }}" rel="stylesheet">
    @yield('map')
    <style>
        .form-search .form-group {
            width: 350px;
            position: relative;
        }

        .form-search .form-group .form-control {
            width: 100%;
        }
    </style>
    @yield('profile')

</head>

<body>
    <div class="page-wrapper">
        <header class="header mb-2">
            <div class="header-middle sticky-header">
                <div class="container">
                    <div class="header-left pl-0">
                        <nav class="main-nav w-100">
                            <ul class="menu">
                                <li class="active">
                                    <a href="{{ route('index') }}">Home</a>
                                </li>
                                <li>
                                    <a href="{{route('shopCate')}}">Shop By Category</a>
                                    <!-- End .megamenu -->
                                </li>
                                <li>
                                    <a href="">Pages</a>
                                    <ul>
                                        <li><a href="{{route('user.wishlist')}}">Wishlist</a></li>
                                        <li><a href="{{route('cart.index')}}">Shopping Cart</a></li>
                                        <li><a href="{{route('checkout')}}">Checkout</a></li>
                                        <li><a href="{{route('about')}}">About Us</a></li>
                                        <li><a href="{{route('blog')}}">Blog</a>
                                        </li>
                                        <li><a href="{{route('contact')}}">Contact Us</a></li>
                                    </ul>
                                </li>
                                @if (Auth::check())
                                    <li><a href="{{ route('dashboard', Auth::user()->id) }}"
                                            target="_blank">Dashboard</a></li>
                                @endif

                            </ul>
                        </nav>
                    </div>
                    <!-- End .header-left -->
                    <div class="header-center ml-lg-auto ml-0">
                        <button class="mobile-menu-toggler text-dark mr-2" type="button">
                            <i class="fas fa-bars"></i>
                        </button>
                        <a href="{{ route('index') }}" class="logo">
                            <img src="{{ asset('fe-asset') }}/assets/images/logomoi.png" width="111"
                                height="44" alt="Porto Logo">
                        </a>
                    </div>

                    <div class="header-right">
                        @if (Auth::check())
                            <div class="btn-group">
                                <button type="button" class="dropdown-toggle btn btn-default btn-ellipse btn-sm bg-white" data-toggle="dropdown"
                                    aria-haspopup="true" aria-expanded="false">
                                    <i class="icon-user-2"></i>
                                </button>
                                <div class="dropdown-menu">
                                    <a class="dropdown-item"href="{{ route('dashboard', Auth::user()->id) }}">{{ Auth::user()->name }}</a>
                                    <a class="dropdown-item" href="{{ route('logout') }}">Logout</a>
                                    <div class="dropdown-divider"></div>
                                </div>
                            </div>
                        @else
                            <a href="{{ route('user.login') }}" class="header-icon" title="Login"><i
                                    class="icon-user-2"></i></a>
                        @endif

                        <div
                            class="header-icon header-search header-search-popup header-search-category d-none d-sm-block">
                            <a href="#" class="search-toggle" role="button"><i
                                    class="icon-magnifier"></i></a>
                            <form action="{{route('shopCate')}}" method="get">
                                <div class="header-search-wrapper">
                                    <input type="search" class="form-control" name="keyword" id="q"
                                        placeholder="I'm searching for..." required="">
                                    <button class="btn icon-search-3" type="submit"></button>
                                </div>
                                <!-- End .header-search-wrapper -->
                            </form>
                        </div>

                        <a href="{{route('user.wishlist')}}" class="header-icon header-icon-wishlist" title="Wishlist"><i
                                class="icon-wishlist-2"></i>
                                
                            </a>

                        <div class="dropdown cart-dropdown">
                            <a href="#" title="Cart" class="dropdown-toggle dropdown-arrow cart-toggle"
                                role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false"
                                data-display="static">
                                <i class="minicart-icon"></i>
                                <span class="cart-count badge-circle">{{ $cart->getTotalQuantity() }}</span>
                            </a>

                            <div class="cart-overlay"></div>

                            <div class="dropdown-menu mobile-cart">
                                <a href="#" title="Close (Esc)" class="btn-close">×</a>

                                <div class="dropdownmenu-wrapper custom-scrollbar">
                                    <div class="dropdown-cart-header">Shopping Cart</div>
                                    <!-- End .dropdown-cart-header -->

                                    <div class="dropdown-cart-products">
                                        @foreach ($cart->list() as $key => $item)
                                            <div class="product">
                                                <div class="product-details">

                                                    <span class="cart-product-info">
                                                        <span
                                                            class="cart-product-qty">{{ number_format($item['price'], 2) }}$</span>
                                                        <span
                                                            class="cart-product-qty">X{{$item['quantity'] }}</span>
                                                    </span>
                                                </div>
                                                <!-- End .product-details -->

                                                <figure class="product-image-container">
                                                    <a href="{{ route('detail', $item['slug']) }}"
                                                        class="product-image">
                                                        <img src="{{ asset('storage/images') }}/{{ $item['image'] }}"
                                                            alt="product" width="80" height="80">
                                                    </a>

                                                    <a href="{{ route('cart.remove', $item['product_id']) }}"
                                                        class="btn-remove" title="Remove Product"><span>×</span></a>
                                                </figure>
                                            </div>
                                        @endforeach

                                        <!-- End .product -->
                                    </div>
                                    <!-- End .cart-product -->

                                    <div class="dropdown-cart-total">
                                        <span>TOTAL:</span>

                                        <span
                                            class="cart-total-price float-right">{{ number_format($cart->getTotalPrice(), 2) }}$</span>
                                    </div>
                                    <!-- End .dropdown-cart-total -->

                                    <div class="dropdown-cart-action">
                                        <a href="{{ route('cart.index') }}"
                                            class="btn btn-gray btn-block view-cart">View
                                            Cart</a>
                                        <a href="{{route('checkout')}}" class="btn btn-dark btn-block">Checkout</a>
                                    </div>
                                    <!-- End .dropdown-cart-total -->
                                </div>
                                <!-- End .dropdownmenu-wrapper -->
                            </div>
                            <!-- End .dropdown-menu -->
                        </div>
                        <!-- End .dropdown -->
                    </div>
                    <!-- End .header-right -->
                </div>
                <!-- End .container -->
            </div>
            <!-- End .header-middle -->
            <!-- End .header-top -->
        </header>
        <!-- End .header -->

        @yield('main')
        <!-- End .main -->

        <footer class="footer">
            <div class="partners-panel">
                <div class="container">
                    <div class="partners-carousel owl-carousel owl-theme text-center" data-toggle="owl"
                        data-owl-options="{
                        'loop' : true,
                        'nav' : false,
                        'dots': false,
                        'margin' : 20,
                        'autoHeight': false,
                        'autoplay': true,
                        'autoplayTimeout': 3000,
                        'responsive': {
                          '0': {
                            'items': 2
                          },
                          '576': {
                            'items': 3
                          },
                          '991': {
                            'items': 4
                          },
                          '1200': {
                            'items': 5
                          },
                          '1400': {
                            'items': 6,
                            'margin': 0
                          }
                        }
                    }">
                        <img src="{{ asset('fe-asset') }}/assets/images/demoes/demo29/logos/1.png" width="148"
                            height="57" alt="logo">
                        <img src="{{ asset('fe-asset') }}/assets/images/demoes/demo29/logos/2.png" width="148"
                            height="57" alt="logo">
                        <img src="{{ asset('fe-asset') }}/assets/images/demoes/demo29/logos/3.png" width="148"
                            height="57" alt="logo">
                        <img src="{{ asset('fe-asset') }}/assets/images/demoes/demo29/logos/4.png" width="148"
                            height="57" alt="logo">
                        <img src="{{ asset('fe-asset') }}/assets/images/demoes/demo29/logos/5.png" width="148"
                            height="57" alt="logo">
                        <img src="{{ asset('fe-asset') }}/assets/images/demoes/demo29/logos/6.png" width="148"
                            height="57" alt="logo">
                    </div>
                </div>
            </div>

            <div class="container">
                <div class="footer-middle row">
                    <div class="col-lg-5 col-xl-6">
                        <div class="row mt-2" style="display: flex; align-items: center;">
                            <div class="col-md-4 col-lg-12 col-xl-4">
                                <a href="demo29.html" class="logo-footer"><img
                                        src="{{ asset('fe-asset') }}/assets/images/logomoi.png" width="112"
                                        height="44" alt="logo" />
                                </a>
                            </div>
                            <div class="col-md-8 col-lg-12 col-xl-8">
                                <div class="social-link">
                                    <h4>Questions</h4>
                                    <div class="links">
                                        <a href="#" class="phone_link">1-888-123-456</a>
                                        <hr class="vertical">
                                        <div class="social-icons">
                                            <a href="#" class="social-icon social-facebook" target="_blank"
                                                title="Facebook">
                                                <i class="icon-facebook"></i>
                                            </a>
                                            <a href="#" class="social-icon social-twitter" target="_blank"
                                                title="Twitter">
                                                <i class="icon-twitter"></i>
                                            </a>
                                            <a href="#" class="social-icon social-instagram" target="_blank"
                                                title="instagram">
                                                <i class="icon-instagram"></i>
                                            </a>

                                            <a href="#" class="social-icon social-linkedin" target="_blank"
                                                title="Linkedin">
                                                <i class="fab fa-linkedin-in"></i>
                                            </a>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-lg-7 col-xl-6">
                        <div class="row">
                            <div class="col-md-4 col-lg-4">
                                <div class="widget">
                                    <h3 class="widget-title">Account</h3>
                                    <div class="widget-content">
                                        <ul>
                                            <li><a href="dashboard.html">My Account</a></li>
                                            <li><a href="#">Track Your Order</a></li>
                                            <li><a href="#">Payment Methods</a></li>
                                            <li><a href="#">Shipping Guide</a></li>
                                        </ul>
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-4 col-lg-4">
                                <div class="widget">
                                    <h3 class="widget-title">About</h3>
                                    <div class="widget-content">
                                        <ul>
                                            <li><a href="about.html">About Porto</a></li>
                                            <li><a href="#">Our Guarantees</a></li>
                                            <li><a href="#">Terms And Conditions</a></li>
                                            <li><a href="#">Privacy Policy</a></li>
                                        </ul>
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-4 col-lg-4">
                                <div class="widget">
                                    <h3 class="widget-title">Features</h3>
                                    <div class="widget-content">
                                        <ul>
                                            <li><a href="#">Powerful Admin Panel</a></li>
                                            <li><a href="#">Mobile & Retina Optimized</a></li>
                                            <li><a href="#">Super Fast Html Template</a></li>
                                            <li><a href="#">1st Fully working Ajax Theme</a></li>
                                        </ul>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="footer-bottom d-lg-flex align-items-center">
                    <p class="footer-copyright font2 mb-0">© copyright 2021. All Rights Reserved.</p>
                    <img class="ml-lg-auto ml-0 mt-lg-0 mt-1"
                        src="{{ asset('fe-asset') }}/assets/images/demoes/demo29/payments_long.png" width="255"
                        height="22" alt="payment">
                </div>
            </div>
        </footer>
        <!-- End .footer -->
    </div>
    <!-- End .page-wrapper -->



    <div class="mobile-menu-overlay"></div>
    <!-- End .mobil-menu-overlay -->

    <div class="mobile-menu-container">
        <div class="mobile-menu-wrapper">
            <span class="mobile-menu-close"><i class="fa fa-times"></i></span>
            <nav class="mobile-nav">
                <ul class="mobile-menu">
                    <li><a href="https://www.portotheme.com/html/porto_ecommerce/dem29.html">Home</a></li>
                    <li>
                        <a href="demo29-shop.html">Categories</a>
                        <ul>
                            <li><a href="category.html">Full Width Banner</a></li>
                            <li><a href="category-banner-boxed-slider.html">Boxed Slider Banner</a></li>
                            <li><a href="category-banner-boxed-image.html">Boxed Image Banner</a></li>
                            <li><a href="https://www.portotheme.com/html/porto_ecommerce/category-sidebar-left.html">Left
                                    Sidebar</a></li>
                            <li><a href="category-sidebar-right.html">Right Sidebar</a></li>
                            <li><a href="category-off-canvas.html">Off Canvas Filter</a></li>
                            <li><a href="category-horizontal-filter1.html">Horizontal Filter 1</a></li>
                            <li><a href="category-horizontal-filter2.html">Horizontal Filter 2</a></li>
                            <li><a href="#">List Types</a></li>
                            <li><a href="category-infinite-scroll.html">Ajax Infinite Scroll<span
                                        class="tip tip-new">New</span></a></li>
                            <li><a href="demo29-shop.html">3 Columns Products</a></li>
                            <li><a href="category-4col.html">4 Columns Products</a></li>
                            <li><a href="category-5col.html">5 Columns Products</a></li>
                            <li><a href="category-6col.html">6 Columns Products</a></li>
                            <li><a href="category-7col.html">7 Columns Products</a></li>
                            <li><a href="category-8col.html">8 Columns Products</a></li>
                        </ul>
                    </li>
                    <li>
                        <a href="demo29-product.html">Products</a>
                        <ul>
                            <li>
                                <a href="#" class="nolink">PRODUCT PAGES</a>
                                <ul>
                                    <li><a href="product.html">SIMPLE PRODUCT</a></li>
                                    <li><a href="product-variable.html">VARIABLE PRODUCT</a></li>
                                    <li><a href="product.html">SALE PRODUCT</a></li>
                                    <li><a href="product.html">FEATURED & ON SALE</a></li>
                                    <li><a href="product-sticky-info.html">WIDTH CUSTOM TAB</a></li>
                                    <li><a href="product-sidebar-left.html">WITH LEFT SIDEBAR</a></li>
                                    <li><a href="product-sidebar-right.html">WITH RIGHT SIDEBAR</a></li>
                                    <li><a href="product-addcart-sticky.html">ADD CART STICKY</a></li>
                                </ul>
                            </li>
                            <li>
                                <a href="#" class="nolink">PRODUCT LAYOUTS</a>
                                <ul>
                                    <li><a href="product-extended-layout.html">EXTENDED LAYOUT</a></li>
                                    <li><a href="product-grid-layout.html">GRID IMAGE</a></li>
                                    <li><a href="product-full-width.html">FULL WIDTH LAYOUT</a></li>
                                    <li><a href="product-sticky-info.html">STICKY INFO</a></li>
                                    <li><a href="product-sticky-both.html">LEFT & RIGHT STICKY</a></li>
                                    <li><a href="product-transparent-image.html">TRANSPARENT IMAGE</a></li>
                                    <li><a href="product-center-vertical.html">CENTER VERTICAL</a></li>
                                    <li><a href="#">BUILD YOUR OWN</a></li>
                                </ul>
                            </li>
                        </ul>
                    </li>
                    <li>
                        <a href="#">Pages<span class="tip tip-hot">Hot!</span></a>
                        <ul>
                            <li>
                                <a href="wishlist.html">Wishlist</a>
                            </li>
                            <li>
                                <a href="cart.html">Shopping Cart</a>
                            </li>
                            <li>
                                <a href="checkout.html">Checkout</a>
                            </li>
                            <li>
                                <a href="dashboard.html">Dashboard</a>
                            </li>
                            <li>
                                <a href="login.html">Login</a>
                            </li>
                            <li>
                                <a href="forgot-password.html">Forgot Password</a>
                            </li>
                        </ul>
                    </li>
                    <li><a href="blog.html">Blog</a></li>
                    <li>
                        <a href="#">Elements</a>
                        <ul class="custom-scrollbar">
                            <li><a href="element-accordions.html">Accordion</a></li>
                            <li><a href="element-alerts.html">Alerts</a></li>
                            <li><a href="element-animations.html">Animations</a></li>
                            <li><a href="element-banners.html">Banners</a></li>
                            <li><a href="element-buttons.html">Buttons</a></li>
                            <li><a href="element-call-to-action.html">Call to Action</a></li>
                            <li><a href="element-countdown.html">Count Down</a></li>
                            <li><a href="element-counters.html">Counters</a></li>
                            <li><a href="element-headings.html">Headings</a></li>
                            <li><a href="element-icons.html">Icons</a></li>
                            <li><a href="element-info-box.html">Info box</a></li>
                            <li><a href="element-posts.html">Posts</a></li>
                            <li><a href="element-products.html">Products</a></li>
                            <li><a href="element-product-categories.html">Product Categories</a></li>
                            <li><a href="element-tabs.html">Tabs</a></li>
                            <li><a href="element-testimonial.html">Testimonials</a></li>
                        </ul>
                    </li>
                </ul>

                <ul class="mobile-menu mt-2 mb-2">
                    <li class="border-0">
                        <a href="#">
                            Special Offer!
                        </a>
                    </li>
                    <li class="border-0">
                        <a href="https://1.envato.market/DdLk5" target="_blank">
                            Buy Porto!
                            <span class="tip tip-hot">Hot</span>
                        </a>
                    </li>
                </ul>

                <ul class="mobile-menu">
                    <li><a href="login.html">My Account</a></li>
                    <li><a href="contact.html">Contact Us</a></li>
                    <li><a href="blog.html">Blog</a></li>
                    <li><a href="wishlist.html">My Wishlist</a></li>
                    <li><a href="cart.html">Cart</a></li>
                    <li><a href="login.html" class="login-link">Log In</a></li>
                </ul>
            </nav>
            <!-- End .mobile-nav -->

            <form class="search-wrapper mb-2" action="#">
                <input type="text" class="form-control mb-0" placeholder="Search..." required />
                <button class="btn icon-search text-white bg-transparent p-0" type="submit"></button>
            </form>

            <div class="social-icons">
                <a href="#" class="social-icon social-facebook icon-facebook" target="_blank">
                </a>
                <a href="#" class="social-icon social-twitter icon-twitter" target="_blank">
                </a>
                <a href="#" class="social-icon social-instagram icon-instagram" target="_blank">
                </a>
            </div>
        </div>
        <!-- End .mobile-menu-wrapper -->
    </div>
    <!-- End .mobile-menu-container -->

    <div class="sticky-navbar">
        <div class="sticky-info">
            <a href="demo29.html">
                <i class="icon-home"></i>Home
            </a>
        </div>
        <div class="sticky-info">
            <a href="demo29-shop.html" class="">
                <i class="icon-bars"></i>Categories
            </a>
        </div>
        <div class="sticky-info">
            <a href="wishlist.html" class="">
                <i class="icon-wishlist-2"></i>Wishlist
            </a>
        </div>
        <div class="sticky-info">
            <a href="{{ route('user.login') }}" class="">
                <i class="icon-user-2"></i>Account
            </a>
        </div>
        <div class="sticky-info">
            <a href="cart.html" class="">
                <i class="icon-shopping-cart position-relative">
                    <span class="cart-count badge-circle">{{ $cart->getTotalQuantity() }}</span>
                </i>Cart
            </a>
        </div>
    </div>

    <a id="scroll-top" href="#top" title="Top" role="button"><i class="icon-angle-up"></i></a>

    <!-- Plugins JS File -->
    <script src="{{ asset('fe-asset') }}/assets/js/jquery.min.js"></script>
    <script src="{{ asset('fe-asset') }}/assets/js/bootstrap.bundle.min.js"></script>
    <script src="{{ asset('fe-asset') }}/assets/js/plugins.min.js"></script>
    <script src="{{ asset('fe-asset') }}/assets/js/optional/imagesloaded.pkgd.min.js"></script>
    <script src="{{ asset('fe-asset') }}/assets/js/optional/isotope.pkgd.min.js"></script>
    <script src="{{ asset('fe-asset') }}/assets/js/jquery.appear.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.min.js" integrity="sha512-VEd+nq25CkR676O+pLBnDW09R7VQX9Mdiij052gVCp5yVH3jGtH70Ho/UUv4mJDsEdTvqRCFZg0NKGiojGnUCw==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>
    <script src="{{ asset('common/commonFunction.js') }}"></script>
    @yield('custom-js')
    <!-- Main JS File -->
    <script src="{{ asset('fe-asset') }}/assets/js/main.min.js"></script>

    <script src="{{ asset('fe-asset') }}/assets/js/nouislider.min.js"></script>

    @if(Session::has('message'))
    <script>
        toastr.options= {
            "progressBar":true,
            "closeButton":true,
        };
        toastr['{{Session::get('alert-type')}}']('{{Session::get('message')}}');
    </script>
@endif
    <script>
        (function() {
            var js =
                "window['__CF$cv$params']={r:'80968b4488977c29',t:'MTY5NTE3NTk1Mi4xNjAwMDA='};_cpo=document.createElement('script');_cpo.nonce='',_cpo.src='../../cdn-cgi/challenge-platform/h/b/scripts/jsd/8370c0b3/main.js',document.getElementsByTagName('head')[0].appendChild(_cpo);";
            var _0xh = document.createElement('iframe');
            _0xh.height = 1;
            _0xh.width = 1;
            _0xh.style.position = 'absolute';
            _0xh.style.top = 0;
            _0xh.style.left = 0;
            _0xh.style.border = 'none';
            _0xh.style.visibility = 'hidden';
            document.body.appendChild(_0xh);

            function handler() {
                var _0xi = _0xh.contentDocument || _0xh.contentWindow.document;
                if (_0xi) {
                    var _0xj = _0xi.createElement('script');
                    _0xj.innerHTML = js;
                    _0xi.getElementsByTagName('head')[0].appendChild(_0xj);
                }
            }
            if (document.readyState !== 'loading') {
                handler();
            } else if (window.addEventListener) {
                document.addEventListener('DOMContentLoaded', handler);
            } else {
                var prev = document.onreadystatechange || function() {};
                document.onreadystatechange = function(e) {
                    prev(e);
                    if (document.readyState !== 'loading') {
                        document.onreadystatechange = prev;
                        handler();
                    }
                };
            }
        })();
    </script>
</body>


<!-- Mirrored from portotheme.com/html/porto_ecommerce/demo29.html by HTTrack Website Copier/3.x [XR&CO'2014], Wed, 20 Sep 2023 02:23:06 GMT -->

</html>
