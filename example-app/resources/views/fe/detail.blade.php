@extends('fe.index')
@section('main')
    <main class="main">
        <div class="container">
            <nav aria-label="breadcrumb" class="breadcrumb-nav">
                <ol class="breadcrumb">
                    <li class="breadcrumb-item"><a href="{{ route('index') }}">Home</a></li>
                    <li class="breadcrumb-item active" aria-current="page">Product</li>
                </ol>
            </nav>

            <div class="row main-content-wrapper">
                <div class="col-lg-9">
                    <div class="product-single-container product-single-default">
                        <div class="cart-message d-none">
                            <strong class="single-cart-notice">“Men Black Sports Shoes”</strong>
                            <span>has been added to your cart.</span>
                        </div>

                        <div class="row">
                            <div class="col-xl-5 col-md-6 product-single-gallery mb-3">
                                <div class="product-slider-container">
                                    <div class="label-group">
                                        @if ($product->sale_price > 0)
                                            <span class="product-label label-hot">HOT</span>
                                            <span
                                                class="product-label label-sale">{{ percent($product->sale_price, $product->price) }}%</span>
                                        @else
                                            <span class="product-label label-hot">HOT</span>
                                        @endif
                                    </div>

                                    <div class="product-single-carousel owl-carousel owl-theme show-nav-hover">
                                        <div class="product-item">
                                            <img class="product-single-image"
                                                src="{{ asset('storage/images') }}/{{ $product->image }}"
                                                data-zoom-image="{{ asset('storage/images') }}/{{ $product->image }}"style="height: 468px; width: 468px;"
                                                alt="product" />
                                        </div>
                                        @foreach ($product->images as $item)
                                            <div class="product-item">
                                                <img class="product-single-image"
                                                    src="{{ asset('storage/images') }}/{{ $item->image }}"
                                                    data-zoom-image="{{ asset('storage/images') }}/{{ $item->image }}"style="height: 468px; width: 468px;"
                                                    alt="product" />
                                            </div>
                                        @endforeach

                                    </div>
                                    <!-- End .product-single-carousel -->
                                    <span class="prod-full-screen">
                                        <i class="icon-plus"></i>
                                    </span>
                                </div>

                                <div class="prod-thumbnail owl-dots">
                                    <div class="owl-dot">
                                        <img src="{{ asset('storage/images') }}/{{ $product->image }}"
                                            style="height: 110px; width:110px;" alt="product-thumbnail" />
                                    </div>
                                    @foreach ($product->images as $item)
                                        <div class="owl-dot">
                                            <img src="{{ asset('storage/images') }}/{{ $item->image }}"style="height: 110px; width:110px;"
                                                alt="product-thumbnail" />
                                        </div>
                                    @endforeach


                                </div>
                            </div>
                            <!-- End .product-single-gallery -->

                            <div class="col-xl-7 col-md-6 product-single-details">
                                <h1 class="product-title">{{ $product->name }}</h1>

                                <div class="product-nav">
                                    @isset($previousProduct)
                                        <div class="product-prev">
                                            <a href="{{ route('detail', $previousProduct->slug) }}">
                                                <span class="product-link"></span>

                                                <span class="product-popup">
                                                    <span class="box-content">
                                                        <img alt="" style="height: 150px; width: 150px;"
                                                            src="{{ asset('storage/images') }}/{{ $previousProduct->image }}"
                                                            style="padding-top: 0px;">


                                                    </span>
                                                </span>
                                            </a>
                                        </div>
                                    @endisset

                                    @isset($nextProduct)
                                        <div class="product-next">
                                            <a href="{{ route('detail', $nextProduct->slug) }}">
                                                <span class="product-link"></span>

                                                <span class="product-popup">
                                                    <span class="box-content">
                                                        <img alt="product" style="height: 150px; width: 150px;"
                                                            src="{{ asset('storage/images') }}/{{ $nextProduct->image }}"
                                                            style="padding-top: 0px;">


                                                    </span>
                                                </span>
                                            </a>
                                        </div>
                                    @endisset

                                </div>

                                <div class="ratings-container">
                                    <div class="product-ratings">
                                        <span class="ratings" style="width:{{ $product->reviews->avg('rating_star') / 5 * 100 }}%"></span>
                                        {{-- <span class="ratings" style="width: 20%"></span> --}}

                                        <!-- End .ratings -->
                                        <span class="tooltiptext tooltip-top"></span>
                                    </div>
                                    <!-- End .product-ratings -->

                                    <a href="#" class="rating-link">( {{ $count }} Reviews )</a>
                                </div>
                                <!-- End .ratings-container -->

                                <hr class="short-divider">

                                <div class="price-box">
                                    @if ($product->sale_price > 0)
                                        <del class="old-price">{{ number_format($product->price, 2) }}$</del>
                                        <span class="product-price">{{ number_format($product->sale_price, 2) }}$</span>
                                    @else
                                        <span class="product-price">{{ number_format($product->price, 2) }}$</span>
                                    @endif
                                </div>
                                <!-- End .price-box -->

                                <!-- End .product-desc -->

                                <ul class="single-info-list">
                                    <!---->

                                    <li>
                                        CATEGORY:
                                        <strong>
                                            <a href="#" class="product-category">{{ $product->category->name }}</a>
                                        </strong>
                                    </li>
                                </ul>

                                <div class="product-filters-container">


                                    <!---->
                                </div>

                                <div class="product-action">
                                    <form action="{{ route('cart.add') }}" method="POST">
                                        @csrf
                                        <input type="hidden" name="id" value="{{ $product->id }}">


                                        <div class="product-single-qty">
                                            <input class="horizontal-quantity form-control" value="1" name="quantity"
                                                type="text">
                                        </div>
                                        <!-- End .product-single-qty -->

                                        <button type="submit" class="btn btn-dark  mr-2" title="Add to Cart">Add to
                                            Cart</button>
                                    </form>
                                    <a href="cart.html" class="btn btn-gray view-cart d-none">View cart</a>
                                </div>
                                <!-- End .product-action -->

                                <hr class="divider mb-0 mt-0">

                                <div class="product-single-share mb-2">
                                    <label class="sr-only">Share:</label>

                                    <div class="social-icons mr-2">
                                        <a href="#" class="social-icon social-facebook icon-facebook"
                                            target="_blank" title="Facebook"></a>
                                        <a href="#" class="social-icon social-twitter icon-twitter" target="_blank"
                                            title="Twitter"></a>
                                        <a href="#" class="social-icon social-linkedin fab fa-linkedin-in"
                                            target="_blank" title="Linkedin"></a>
                                        <a href="#" class="social-icon social-gplus fab fa-google-plus-g"
                                            target="_blank" title="Google +"></a>
                                        <a href="#" class="social-icon social-mail icon-mail-alt" target="_blank"
                                            title="Mail"></a>

                                        @if (Auth::check())
                                            <div class="mt-2">
                                                <form action="{{ route('user.wishlist_post') }}" method="post">
                                                    @csrf
                                                    <input type="hidden" name="product_id" value="{{ $product->id }}">
                                                    <input type="hidden" name="user_id" value="{{ Auth::user()->id }}">
                                                    <button type="submit" class="btn btn-info"><i
                                                            class="icon-wishlist-2"></i><span>Add to
                                                            Wishlist</span></button>
                                                </form>
                                            </div>
                                        @else
                                            <div class="mt-2">
                                                <form action="{{ route('user.wishlist_post') }}" method="post">
                                                    @csrf
                                                    <input type="hidden" name="product_id" value="{{ $product->id }}">
                                                    <button type="submit"
                                                        class="btn btn-outline-secondary btn-ellipse btn-md"><i
                                                            class="icon-wishlist-2"></i><span>Add to
                                                            Wishlist</span></button>
                                                </form>
                                            </div>
                                        @endif

                                    </div>
                                    <!-- End .social-icons -->

                                    {{-- <a href="wishlist.html" class="btn-icon-wish add-wishlist" title="Add to Wishlist"><i class="icon-wishlist-2"></i><span>Add to
                                                Wishlist</span></a> --}}
                                </div>
                                <!-- End .product single-share -->
                            </div>
                            <!-- End .product-single-details -->
                        </div>
                        <!-- End .row -->
                    </div>
                    <!-- End .product-single-container -->

                    <div class="product-single-tabs">
                        <ul class="nav nav-tabs" role="tablist">
                            <li class="nav-item">
                                <a class="nav-link active" id="product-tab-desc" data-toggle="tab"
                                    href="#product-desc-content" role="tab" aria-controls="product-desc-content"
                                    aria-selected="true">Description</a>
                            </li>

                            <li class="nav-item">
                                <a class="nav-link" id="product-tab-reviews" data-toggle="tab"
                                    href="#product-reviews-content" role="tab"
                                    aria-controls="product-reviews-content" aria-selected="false">Reviews
                                    ({{ $count }})</a>
                            </li>
                        </ul>

                        <div class="tab-content">
                            <div class="tab-pane fade show active" id="product-desc-content" role="tabpanel"
                                aria-labelledby="product-tab-desc">
                                <div class="product-desc-content">
                                    {!! $product->description !!}
                                </div>
                                <!-- End .product-desc-content -->
                            </div>
                            <!-- End .tab-pane -->
                            <!-- End .tab-pane -->

                            <div class="tab-pane fade" id="product-reviews-content" role="tabpanel"
                                aria-labelledby="product-tab-reviews">
                                <div class="product-reviews-content">
                                    <h3 class="reviews-title">{{ $count }} review for {{ $product->name }}</h3>
                                    @foreach ($review as $item)
                                        <div class="comment-list">
                                            <div class="comments">
                                                <figure class="img-thumbnail">
                                                    @if (!$item->user_id == '' && !$item->cus->avatar == '')
                                                        <img src="{{ asset('storage/images') }}/{{ $item->cus->avatar }}"
                                                            alt="author" style="height: 80px; width: 80px;">
                                                    @else
                                                        <img src="{{ asset('fe-asset') }}/assets/images/pngtree-detective-line-icon-man-symbol-cap-in-head-sign-png-image_5050033.jpg"
                                                            alt="author" width="80" height="80">
                                                    @endif

                                                </figure>

                                                <div class="comment-block">
                                                    <div class="comment-header">
                                                        <div class="comment-arrow"></div>

                                                        <div class="ratings-container float-sm-right">
                                                            <div class="product-ratings">

                                                                @if ($item->rating_star == 1)
                                                                    <span class="ratings" style="width: 20%"></span>
                                                                @elseif ($item->rating_star == 2)
                                                                    <span class="ratings" style="width: 40%"></span>
                                                                @elseif ($item->rating_star == 3)
                                                                    <span class="ratings" style="width: 60%"></span>
                                                                @elseif ($item->rating_star == 4)
                                                                    <span class="ratings" style="width: 80%"></span>
                                                                @elseif ($item->rating_star == 5)
                                                                    <span class="ratings" style="width: 100%"></span>
                                                                @endif

                                                                <!-- End .ratings -->
                                                                <span class="tooltiptext tooltip-top"></span>
                                                            </div>
                                                            <!-- End .product-ratings -->
                                                        </div>

                                                        <span class="comment-by">

                                                            <strong>{{ $item->name }}</strong> –
                                                            {{ date('d/m/Y', strtotime($item->created_at)) }}
                                                        </span>
                                                    </div>

                                                    <div class="comment-content">
                                                        <p>{{ $item->review }}</p>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    @endforeach
                                    {{ $review->links() }}
                                    <div class="divider"></div>

                                    <div class="add-product-review">
                                        <h3 class="review-title">Add a review</h3>

                                        <form action="{{ route('product.review') }}" enctype="multipart/form-data"
                                            method="POST" class="comment-form m-0">
                                            @csrf
                                            <div class="rating-form">
                                                <label for="rating">Your rating <span class="required">*</span></label>
                                                <span class="rating-stars">
                                                    <a class="star-1" href="#">1</a>
                                                    <a class="star-2" href="#">2</a>
                                                    <a class="star-3" href="#">3</a>
                                                    <a class="star-4" href="#">4</a>
                                                    <a class="star-5" href="#">5</a>
                                                </span>
                                                <input type="hidden" id="product_id" name="product_id"
                                                    value="{{ $product->id }}">
                                                <select name="rating_star" id="rating" required=""
                                                    style="display: none;">
                                                    <option value="">Rate…</option>
                                                    <option value="5">Perfect</option>
                                                    <option value="4">Good</option>
                                                    <option value="3">Average</option>
                                                    <option value="2">Not that bad</option>
                                                    <option value="1">Very poor</option>
                                                </select>
                                                @error('rating_star')
                                                <span class="text-danger ml-3"><strong>{{ $message }}</strong></span>
                                                @enderror
                                            </div>

                                            <div class="form-group">
                                                <label>Your review <span class="required">*</span></label>
                                                <textarea cols="5" name="review" id="review" rows="6" class="form-control form-control-sm"></textarea>
                                            </div>
                                            <!-- End .form-group -->


                                            <div class="row">
                                                <div class="col-md-6 col-xl-12">
                                                    <div class="form-group">
                                                        @if (Auth::Check())
                                                            <label>Name <span class="required">*</span></label>
                                                            <input type="text" name="name"
                                                                value="{{ Auth::user()->name }}"
                                                                class="form-control form-control-sm" required>
                                                            <input type="hidden" name="user_id"
                                                                value="{{ Auth::user()->id }}">
                                                        @else
                                                            <label>Name <span class="required">*</span></label>
                                                            <input type="text" name="name"
                                                                class="form-control form-control-sm" required>
                                                        @endif
                                                        @error('name')
                                                        <span class="text-danger ml-3"><strong>{{ $message }}</strong></span>
                                                        @enderror
                                                    </div>
                                                    <!-- End .form-group -->
                                                </div>
                                            </div>

                                            <input id="my-button" type="submit" class="btn btn-primary" value="Submit">
                                        </form>
                                    </div>
                                    <!-- End .add-product-review -->
                                </div>
                                <!-- End .product-reviews-content -->
                            </div>
                            <!-- End .tab-pane -->
                        </div>
                        <!-- End .tab-content -->
                    </div>
                    <!-- End .product-single-tabs -->
                </div>
                <!-- End .col-lg-9 -->

                <div class="sidebar-overlay"></div>
                <div class="sidebar-toggle custom-sidebar-toggle"><i class="fas fa-sliders-h"></i></div>
                <aside class="sidebar-product col-lg-3 padding-left-lg mobile-sidebar">
                    <div class="sidebar-wrapper">

                        <div class="widget">
                            <h3 class="widget-title text-uppercase">Featured Products</h3>

                            <div class=" widget-body">
                                <div class="product-intro">
                                    @foreach ($featureProduct as $item)
                                        <div class="product-default left-details product-widget">
                                            <figure>
                                                <a href="{{ route('detail', $item->slug) }}">
                                                    <img src="{{ asset('storage/images') }}/{{ $item->image }}"
                                                        width="75" height="75" alt="product" />
                                                </a>
                                            </figure>
                                            <div class="product-details">
                                                <h3 class="product-title"> <a
                                                        href="{{ route('detail', $item->slug) }}">{{ $item->name }}</a>
                                                </h3>
                                                <a href=""
                                                    class="product-category">{{ $item->category->name }}</a>
                                                <!-- End .product-container -->
                                                <div class="price-box">
                                                    @if ($item->sale_price > 0)
                                                        <del class="old-price">{{ number_format($item->price, 2) }}$</del>
                                                        <span
                                                            class="product-price">{{ number_format($item->sale_price, 2) }}$</span>
                                                    @else
                                                        <span
                                                            class="product-price">{{ number_format($item->price, 2) }}$</span>
                                                    @endif
                                                </div>
                                                <!-- End .price-box -->
                                            </div>
                                            <!-- End .product-details -->
                                        </div>
                                    @endforeach

                                </div>
                            </div>
                            <!-- End .widget-body -->
                        </div>
                        <!-- End .widget -->

                        <div class="widget widget-block">
                            <h3 class="widget-title text-uppercase">Custom HTML Block</h3>

                            <!-- End .widget-body -->
                        </div>
                        <!-- End .widget -->

                        <div class="widget widget-banner">
                            <div class="home-banner pb-0 mb-2 mb-lg-0">
                                <figure style="background-color: #222529;">
                                    <img src="{{ asset('fe-asset') }}/assets/images/demoes/demo29/banners/banner-sidebar.jpg" width="313"
                                        height="379" alt="Banner" />
                                </figure>
                                <div class="banner-content content-top">
                                    <span class="font2">check new arrivals</span>
                                    <h4><strong>cool lamps</strong></h4>
                                </div>
                            </div>
                        </div>
                        <!-- End .widget -->
                    </div>
                </aside>
                <!-- End .col-md-3 -->
            </div>
            <!-- End .row -->

            <div class="products-section pt-0">
                <h2 class="section-title">Related Products</h2>

                <div class="products-slider owl-carousel owl-theme dots-top dots-small 5col"
                    data-owl-options="{
                        'dots': true
                    }">
                    @foreach ($related as $item)
                        <div class="product-default inner-quickview left-details inner-icon">
                            <figure>
                                <a href="{{ route('detail', $item->slug) }}">
                                    <img src="{{ asset('storage/images') }}/{{ $item->image }}"
                                        style="height: 257px; width: 257px;" alt="Product" />
                                </a>
                                <div class="btn-icon-group">
                                    <form action="{{ route('cart.add') }}" method="POST">
                                        @csrf
                                        <input type="hidden" name="id" value="{{ $item->id }}">
                                        <input type="hidden" value="1" name="quantity">

                                        <button type="submit" class="btn btn-outline-info btn-ellipse btn-md"
                                            title="Add to Cart"><i class="fas fa-cart-plus"></i></button>
                                    </form>

                                </div>
                            </figure>
                            <div class="product-details">
                                <div class="category-wrap">
                                    <div class="category-list">
                                        <a href="demo29-shop.html"
                                            class="product-category">{{ $item->category->name }}</a>
                                    </div>
                                    <form action="{{ route('user.wishlist_post') }}" method="post" class="inline-form">
                                        @csrf
                                        <input type="hidden" name="product_id" value="{{ $item->id }}">
                                        @if (Auth::check())
                                            <input type="hidden" name="user_id" value="{{ Auth::user()->id }}">
                                        @endif

                                        @if (Auth::check())
                                            @if ($item->isfavorite)
                                                <button type="submit" class="btn btn-secondary btn-ellipse btn-sm"><i
                                                        class="icon-wishlist-2"></i></button>
                                            @else
                                                <button type="submit"
                                                    class="btn btn-outline-secondary btn-ellipse btn-sm"><i
                                                        class="icon-wishlist-2"></i></button>
                                            @endif
                                        @else
                                            <button type="submit" class="btn btn-outline-secondary btn-ellipse btn-sm"><i
                                                    class="icon-wishlist-2"></i></button>
                                        @endif

                                        
                                    </form>
                                </div>
                                <h3 class="product-title">
                                    <a href="{{ route('detail', $item->slug) }}">{{ $item->name }}</a>
                                </h3>
                                {{-- <div class="ratings-container">
                                
                                <!-- End .product-ratings -->
                            </div> --}}
                                <!-- End .product-container -->
                                <div class="price-box">
                                    @if ($item->sale_price > 0)
                                        <del class="old-price">{{ number_format($item->price, 2) }}$</del>
                                        <span class="product-price">{{ number_format($item->sale_price, 2) }}$</span>
                                    @else
                                        <span class="product-price">{{ number_format($item->price, 2) }}$</span>
                                    @endif
                                </div>
                                <!-- End .price-box -->
                            </div>
                            <!-- End .product-details -->
                        </div>
                    @endforeach

                </div>
                <!-- End .products-slider -->
            </div>
            <!-- End .products-section -->

            <hr class="mt-0 m-b-5" />

            <div class="product-widgets-container row pb-2">
                <div class="col-lg-6 col-sm-6 pb-5 pb-md-0">
                    <h4 class="section-sub-title">Featured Products</h4>
                    @foreach ($featureProduct as $item)
                        <div class="product-default left-details product-widget">
                            <figure>
                                <a href="{{ route('detail', $item->slug) }}">
                                    <img src="{{ asset('storage/images') }}/{{ $item->image }}"
                                        style="height: 74px; width: 74px;" alt="product">
                                </a>
                            </figure>

                            <div class="product-details">
                                <h3 class="product-title"> <a
                                        href="{{ route('detail', $item->slug) }}">{{ $item->name }}</a> </h3>

                                <div class="ratings-container">
                                    <a href="demo29-shop.html" class="product-category">{{ $item->category->name }}</a>
                                    <!-- End .product-ratings -->
                                </div>
                                <!-- End .product-container -->

                                <div class="price-box">
                                    @if ($item->sale_price > 0)
                                        <del class="old-price">{{ number_format($item->price, 2) }}$</del>
                                        <span class="product-price">{{ number_format($item->sale_price, 2) }}$</span>
                                    @else
                                        <span class="product-price">{{ number_format($item->price, 2) }}$</span>
                                    @endif
                                </div>
                                <!-- End .price-box -->
                            </div>
                            <!-- End .product-details -->
                        </div>
                    @endforeach

                </div>


                <div class="col-lg-6 col-sm-6 pb-5 pb-md-0">
                    <h4 class="section-sub-title">Latest Products</h4>
                    @foreach ($latestPro as $item)
                        <div class="product-default left-details product-widget">
                            <figure>
                                <a href="{{ route('detail', $item->slug) }}">
                                    <img src="{{ asset('storage/images') }}/{{ $item->image }}"
                                        style="height: 74px; width: 74px;" alt="product">
                                </a>
                            </figure>

                            <div class="product-details">
                                <h3 class="product-title"> <a
                                        href="{{ route('detail', $item->slug) }}">{{ $item->name }}</a> </h3>

                                <div class="ratings-container">
                                    <a href="demo29-shop.html" class="product-category">{{ $item->category->name }}</a>
                                    <!-- End .product-ratings -->
                                </div>
                                <!-- End .product-container -->

                                <div class="price-box">
                                    @if ($item->sale_price > 0)
                                        <del class="old-price">{{ number_format($item->price, 2) }}$</del>
                                        <span class="product-price">{{ number_format($item->sale_price, 2) }}$</span>
                                    @else
                                        <span class="product-price">{{ number_format($item->price, 2) }}$</span>
                                    @endif
                                </div>
                                <!-- End .price-box -->
                            </div>
                            <!-- End .product-details -->
                        </div>
                    @endforeach
                </div>
            </div>
            <!-- End .row -->
        </div>
        <!-- End .container -->
    </main>

@endsection
