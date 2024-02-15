@extends('fe.index')
@section('form-button')
    <style>
.forms-container {
  display: flex;
  justify-content: space-between;
  align-items: center;
}

.inline-form {
  display: inline-block;
  margin-right: 10px;
}

    </style>
@endsection
@section('main')
    <main class="home main">
        <section class="hover-section">
            <div class="owl-carousel owl-theme show-nav-hover slide-animate" data-owl-options="{
                'dots': false,
                'nav': true,
                'loop': false
            }">
            @foreach ($banner as $item)
            <div class="banner banner4">
                <figure>
                    <img style="height: 700px; width: 1920px;" src="{{ asset('storage/images') }}/{{ $item->image }}"
                        style="background:#f6e1e8;min-height:36rem;" alt="banner" />
                    <div class="snowfall particle-effect"></div>
                </figure>

                <div class="banner-layer banner-layer-middle">
                    <div class="appear-animate" data-animation-name="fadeInRightShorter">

                        <h3 class="banner-title">{{$item->name}}</h3>

                    </div>
                </div>
            </div>
            @endforeach

            </div>
        </section>
        <div class="container">



            <hr class="mt-0">

            <section class="featured-products-section">
                <h2 class="section-title title-decorate text-center d-flex align-items-center appear-animate"
                    data-animation-delay="100" data-animation-duration="1500">Featured Products</h2>

                <div class="owl-carousel owl-theme nav-image-center"
                    data-owl-options="{
                    'margin': 20,
                    'dots': false,
                    'nav': true,
                    'loop': false,
                    'autoplay': false,
                    'responsive': {
                        '0': {
                            'items': 2
                        },
                        '768': {
                            'items': 3
                        },
                        '1200': {
                            'items': 4
                        }
                    }
                }">
                    @foreach ($featureProduct as $item)
                        <div class="product-default left-details">
                            <figure>
                                <a href="{{ route('detail', $item->slug) }}">
                                    <img src="{{ asset('storage/images') }}/{{ $item->image }}" alt="product"
                                    style="height: 300px; width: 300px;">
                                    {{-- <img src="{{asset('storage/images')}}/{{$item->image}}" alt="product" width="300" height="300"> --}}
                                </a>
                                <div class="label-group">
                                    @if ($item->sale_price > 0)
                                        <span class="product-label label-hot">HOT</span>
                                        <span
                                            class="product-label label-sale">{{ percent($item->sale_price, $item->price) }}%</span>
                                    @else
                                        <span class="product-label label-hot">HOT</span>
                                    @endif
                                </div>
                            </figure>
                            <div class="product-details">
                                <div class="category-list">
                                    <a href="demo9-shop.html" class="product-category">{{ $item->category->name }}</a>
                                </div>
                                <h3 class="product-title"> <a
                                        href="{{ route('detail', $item->slug) }}">{{ $item->name }}</a> </h3>
                                        <div class="ratings-container">
                                            <div class="product-ratings">
                                                <span class="ratings" style="width:{{ $item->reviews->avg('rating_star') / 5 * 100 }}%"></span>
                                                <!-- End .ratings -->
                                                <span class="tooltiptext tooltip-top"></span>
                                            </div>
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
                                <div class="forms-container">
                                    <form action="{{ route('cart.add') }}" method="POST" class="inline-form">
                                      @csrf
                                      <input type="hidden" name="id" value="{{ $item->id }}">
                                      <input type="hidden" value="1" name="quantity">
                                      <button type="submit" class="btn btn-outline-info btn-ellipse btn-md" title="Add to Cart"><i class="fas fa-cart-plus"></i></button>
                                    </form>
                                  
                                    <form action="{{route('user.wishlist_post')}}" method="post" class="inline-form">
                                      @csrf
                                      <input type="hidden" name="product_id" value="{{$item->id}}" >
                                      @if (Auth::check())
                                        <input type="hidden" name="user_id" value="{{Auth::user()->id}}">
                                      @endif

                                      @if (Auth::check())
                                      @if ($item->isfavorite)
                                          <button type="submit" class="btn btn-secondary btn-ellipse btn-md"><i class="icon-wishlist-2"></i></button>
                                      @else
                                          <button type="submit" class="btn btn-outline-secondary btn-ellipse btn-md"><i class="icon-wishlist-2"></i></button>
                                      @endif

                                  @else
                                  <button type="submit" class="btn btn-outline-secondary btn-ellipse btn-md"><i class="icon-wishlist-2"></i></button>
                                  @endif
                                     
                                    </form>
                                  </div>
                                <!-- End .price-box -->
                                {{-- <div class="product-action">
                                    <form action="{{ route('cart.add') }}" method="POST">
                                        @csrf
                                        <input type="hidden" name="id" value="{{ $item->id }}">
                                        <input type="hidden" value="1" name="quantity">

                                        <button type="submit" class="btn-icon btn-add-cart " title="Add to Cart"><i
                                                class="icon-shopping-cart"></i><span>ADD TO CART</span></button>
                                    </form>
                                    {{-- <a href="#" class="btn-icon btn-add-cart product-type-simple"><i
                                    class="icon-shopping-cart"></i><span>ADD TO CART</span></a> --}}
                                    {{-- <a href="wishlist.html" class="btn-icon-wish" title="wishlist"><i
                                    class="icon-heart"></i></a>
                            <a href="{{route('detail',$item->slug)}}" title="wishlist" title="Quick View"><i
                                    class="fas fa-external-link-alt"></i></a> --}}
                                {{-- </div> --}}
                            </div>
                            <!-- End .product-details -->
                        </div>
                    @endforeach

                </div>
            </section>
        </div>

        <section class="banner-section home-banner mb-6 appear-animate" data-animation-name="fadeIn"
            data-animation-delay="100" data-parallax="{'speed': 1.8, 'enableOnMobile': true}"
            data-image-src="{{ asset('fe-asset') }}/assets/images/demoes/demo29/banners/banner-bathroom.jpg">
            <div class="banner-content full-content d-flex flex-lg-row flex-column align-items-center mt-1 mt-lg-0">
                <div class="left-content">
                    <div>
                        <span class="font1">it is time for a</span>
                        <h4>Modern Bathroom</h4>
                    </div>
                    <a href="demo29-shop.html" class="btn">Show Now <i class="fas fa-long-arrow-alt-right"></i></a>
                </div>
                <div class="right-content banner-info">
                    <a href="#" class="btn skew-box bg-white">Exclusive COUPON</a>
                    <h3 class="sale-off skew-box"><span class="text-white">$200</span>off</h3>
                </div>
            </div>
        </section>

        <section>
            <h2 class="section-title title-decorate text-center d-flex align-items-center appear-animate"
                data-animation-delay="100" data-animation-duration="1500">New Product</h2>
            <div class="container">
                <div class="featured-section bg-white appear-animate" data-animation-name="fadeIn"
                    data-animation-delay="100">
                    <div class="row">
                        @foreach ($product as $item)
                            <div class="col-6 col-md-4 col-lg-3 col-xl-2">
                                <div class="product-default inner-quickview left-details inner-icon">
                                    <figure>
                                        <a href="{{ route('detail', $item->slug) }}">
                                            <img src="{{ asset('storage/images') }}/{{ $item->image }}" style="height: 237px; width: 210px;" alt="Product" />
                                        </a>
                                        <div class="btn-icon-group">
                                            <form action="{{ route('cart.add') }}" method="POST">
                                                @csrf
                                                <input type="hidden" name="id" value="{{ $item->id }}">
                                                <input type="hidden" value="1" name="quantity">
        
                                                <button type="submit" class="btn btn-outline-info btn-ellipse btn-md" title="Add to Cart"><i class="fas fa-cart-plus"></i></button>
                                            </form>

                                            {{-- <a href="#" class="btn-icon btn-add-cart product-type-simple"><i
                                                    class="icon-shopping-cart"></i></a> --}}
                                        </div>
                                    </figure>
                                    <div class="product-details">
                                        <div class="category-wrap">
                                            <div class="category-list">
                                                <a href="demo29-shop.html"
                                                    class="product-category">{{ $item->category->name }}</a>
                                            </div>
                                            {{-- <a href="wishlist.html" title="Wishlist" class="btn-icon-wish"><i
                                                    class="icon-heart"></i></a> --}}
                                        </div>
                                        <h3 class="product-title"> <a
                                                href="{{ route('detail', $item->slug) }}">{{ $item->name }}</a>
                                        </h3>
                                        <div class="ratings-container">
                                            <div class="product-ratings">
                                                <span class="ratings" style="width:{{ $item->reviews->avg('rating_star') / 5 * 100 }}%"></span>
                                                <!-- End .ratings -->
                                                <span class="tooltiptext tooltip-top"></span>
                                            </div>
                                            <!-- End .product-ratings -->
                                        </div>
                                        <!-- End .product-container -->
                                        <div class="price-box">
                                            @if ($item->sale_price > 0)
                                                <del class="old-price">{{ number_format($item->price, 2) }}$</del>
                                                <span
                                                    class="product-price">{{ number_format($item->sale_price, 2) }}$</span>
                                            @else
                                                <span
                                                    class="product-price">{{ number_format($item->sale_price, 2) }}$</span>
                                            @endif
                                            <form action="{{route('user.wishlist_post')}}" method="post" class="inline-form">
                                                @csrf
                                                <input type="hidden" name="product_id" value="{{$item->id}}" >
                                                @if (Auth::check())
                                                  <input type="hidden" name="user_id" value="{{Auth::user()->id}}">
                              
                                                @endif

                                                @if (Auth::check())
                                                    @if ($item->isfavorite)
                                                        <button type="submit" class="btn btn-secondary btn-ellipse btn-sm"><i class="icon-wishlist-2"></i></button>
                                                    @else
                                                        <button type="submit" class="btn btn-outline-secondary btn-ellipse btn-sm"><i class="icon-wishlist-2"></i></button>
                                                    @endif

                                                @else
                                                <button type="submit" class="btn btn-outline-secondary btn-ellipse btn-sm"><i class="icon-wishlist-2"></i></button>
                                                @endif

                                                
                                              </form>
                                        </div>
                                        <!-- End .price-box -->
                                    </div>
                                    <!-- End .product-details -->
                                </div>
                            </div>
                        @endforeach

                    </div>
                    <a href="/shop?sort=2" class="btn with-icon align-center font2">Browse All<i
                            class="fas fa-long-arrow-alt-right"></i></a>
                </div>

                <hr />
            </div>

            <div class="blog-section container mb-4 appear-animate" data-animation-name="fadeIn"
                data-animation-delay="100">
                <div class="row">
                    <div class="col-xl-6 mb-3 mb-xl-0">
                        <div class="section-title d-flex align-items-center mt-1 mb-1">
                            <h2 class="mb-0">RECENT ARTICLE</h2>
                            <hr class="vertical d-none d-sm-block">
                            <a href="{{route('blog')}}" class="with-icon mr-sm-auto ml-4 mr-4 ml-sm-0">VIEW BLOG<i
                                    class="fas fa-long-arrow-alt-right"></i></a>
                        </div>


                    </div>
                    <div class="row">
                        @foreach ($blog as $item)
                        <div class="col-lg-12">
                            <div class="row">
                                <div class="col-md-6">
                                    <div class="post-media">
                                        <a href="{{route('blog.detail',$item->slug)}}">
                                            <img src="{{ asset('storage/images') }}/{{ $item->image }}"style="height: 500px; width: 100%;" alt="Post" />
                                        </a>

                                           

                                        <!-- End .post-date -->
                                    </div>
                                    <!-- End .post-media -->
                                </div>
                                <div class="col-md-6 d-flex align-items-center">
                                    <div class="post-body">
                                        <a href="{{route('blog.detail',$item->slug)}}" class="post-category">{{$item->name}}</a>
                                        <span class="">{{date("d/m/Y", strtotime($item->created_at))}}</span>
                                        <p class="mb-2">{!!$item->description!!}
                                        </p>
                                        <a href="{{route('blog.detail',$item->slug)}}" class="btn with-icon">READ MORE</a>
                                    </div>
                                </div>
                            </div>
                        </div>
                        @endforeach


                    </div>
                </div>
            </div>
        </section>
    </main>
@endsection
