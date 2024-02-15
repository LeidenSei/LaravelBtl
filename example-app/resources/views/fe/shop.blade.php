@extends('fe.index')

@section('main')
    <main class="main">


        <div class="container">
            <nav aria-label="breadcrumb" class="breadcrumb-nav">
                <ol class="breadcrumb">
                    <li class="breadcrumb-item"><a href="{{ route('index') }}"><i class="icon-home"></i></a></li>
                    <li class="breadcrumb-item"><a href="{{ route('shopCate') }}">Shopping</a></li>
                    @if (isset($cateName) && $cateName != '')
                        @if (is_string($cateName))
                            <li class="breadcrumb-item active" aria-current="page">{{ $cateName }}</li>
                        @else
                            <li class="breadcrumb-item active" aria-current="page">{{ $cateName->name }}</li>
                        @endif
                    @endif

                </ol>
            </nav>

            <nav class="toolbox sticky-header horizontal-filter mb-1" data-sticky-options="{'mobile': true}">
                <div class="toolbox-left">
                    <a href="#" class="sidebar-toggle"><svg data-name="Layer 3" id="Layer_3" viewBox="0 0 32 32"
                            xmlns="http://www.w3.org/2000/svg">
                            <line x1="15" x2="26" y1="9" y2="9" class="cls-1"></line>
                            <line x1="6" x2="9" y1="9" y2="9" class="cls-1"></line>
                            <line x1="23" x2="26" y1="16" y2="16" class="cls-1"></line>
                            <line x1="6" x2="17" y1="16" y2="16" class="cls-1"></line>
                            <line x1="17" x2="26" y1="23" y2="23" class="cls-1"></line>
                            <line x1="6" x2="11" y1="23" y2="23" class="cls-1"></line>
                            <path d="M14.5,8.92A2.6,2.6,0,0,1,12,11.5,2.6,2.6,0,0,1,9.5,8.92a2.5,2.5,0,0,1,5,0Z"
                                class="cls-2"></path>
                            <path d="M22.5,15.92a2.5,2.5,0,1,1-5,0,2.5,2.5,0,0,1,5,0Z" class="cls-2"></path>
                            <path d="M21,16a1,1,0,1,1-2,0,1,1,0,0,1,2,0Z" class="cls-3"></path>
                            <path d="M16.5,22.92A2.6,2.6,0,0,1,14,25.5a2.6,2.6,0,0,1-2.5-2.58,2.5,2.5,0,0,1,5,0Z"
                                class="cls-2"></path>
                        </svg>
                        <span>Filter</span>
                    </a>

                    <div class="toolbox-item filter-toggle d-none d-lg-flex">
                        <span>Filters:</span>
                        <a href=#>&nbsp;</a>
                    </div>
                </div>
                <!-- End .toolbox-left -->
                <div class="toolbox-item toolbox-sort ml-lg-auto">
                    <label>Sort By:</label>

                    <div class="select-custom">
                        <select onchange="location = this.value;" class="form-control">
                            <option value="{{ Route('shopCate') }}" selected="selected">Default sorting</option>

                            <option
                            
                                value="{{ Route('shopCate', ['min_price' => Request::get('min_price'), 'max_price' => Request::get('max_price'), 'sort' => '1']) }}"
                                {{ Request::get('sort') == '1' ? 'selected' : '' }}>Sort by popularity</option>
                            <option
                                value="{{ Route('shopCate', ['min_price' => Request::get('min_price'), 'max_price' => Request::get('max_price'), 'sort' => '2']) }}"
                                {{ Request::get('sort') == '2' ? 'selected' : '' }}>Sort by newness</option>
                            <option
                                value="{{ Route('shopCate', ['min_price' => Request::get('min_price'), 'max_price' => Request::get('max_price'), 'sort' => '3']) }}"
                                {{ Request::get('sort') == '3' ? 'selected' : '' }}>Sort by price: low to high</option>
                            <option
                                value="{{ Route('shopCate', ['min_price' => Request::get('min_price'), 'max_price' => Request::get('max_price'), 'sort' => '4']) }}"
                                {{ Request::get('sort') == '4' ? 'selected' : '' }}>Sort by price: high to low</option>
                            <option
                                value="{{ Route('shopCate', ['min_price' => Request::get('min_price'), 'max_price' => Request::get('max_price'), 'sort' => '5']) }}"
                                {{ Request::get('sort') == '5' ? 'selected' : '' }}>Sort by character:A-Z</option>
                            <option
                                value="{{ Route('shopCate', ['min_price' => Request::get('min_price'), 'max_price' => Request::get('max_price'), 'sort' => '6']) }}"
                                {{ Request::get('sort') == '6' ? 'selected' : '' }}>Sort by character:Z-A</option>
                        </select>
                    </div>
                    <!-- End .select-custom -->
                </div>

            </nav>

            <div class="row main-content-wrap">
                <div class="col-lg-9 main-content">
                    <div class="row">
                        @foreach ($product as $item)
                            <div class="col-6 col-sm-4 col-md-3">
                                <div class="product-default">
                                    <figure>
                                        <a href="{{ route('detail', $item->slug) }}">
                                            <img src="{{ asset('storage/images') }}/{{ $item->image }}"style="height: 280px; width: 280px;"
                                                alt="product" />

                                        </a>
                                        {{-- <a href="#" class="btn-icon btn-add-cart product-type-simple"><i
                                            class="icon-shopping-cart"></i></a> --}}

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
                                        <div class="category-wrap">
                                            <div class="category-list">
                                                <a href="{{ route('detail', $item->slug) }}"
                                                    class="product-category">{{ $item->category->name }}</a>

                                            </div>
                                        </div>

                                        <h3 class="product-title"> <a
                                                href="{{ route('detail', $item->slug) }}">{{ $item->name }}</a> </h3>
                                        <div class="ratings-container">
                                            <div class="product-ratings">
                                                <span class="ratings"
                                                    style="width:{{ ($item->reviews->avg('rating_star') / 5) * 100 }}%"></span>
                                                <!-- End .ratings -->
                                                <span class="tooltiptext tooltip-top"></span>
                                            </div>
                                            <!-- End .product-ratings -->
                                        </div>
                                        <span>{{ date('d/m/Y', strtotime($item->created_at)) }}</span>
                                        <div class="price-box">

                                            @if ($item->sale_price > 0)
                                                <del class="old-price">{{ number_format($item->price, 2) }}$</del>
                                                <span
                                                    class="product-price">{{ number_format($item->sale_price, 2) }}$</span>
                                            @else
                                                <span class="product-price">{{ number_format($item->price, 2) }}$</span>
                                            @endif

                                        </div>
                                        <div class="d-flex align-items-center">
                                            <form action="{{ route('user.wishlist_post') }}" method="post"
                                                class="inline-form">
                                                @csrf
                                                <input type="hidden" name="product_id" value="{{ $item->id }}">
                                                @if (Auth::check())
                                                    <input type="hidden" name="user_id" value="{{ Auth::user()->id }}">
                                                @endif
                                                @if (Auth::check())
                                                    @if ($item->isfavorite)
                                                        <button type="submit"
                                                            class="btn btn-secondary btn-ellipse btn-sm"><i
                                                                class="icon-wishlist-2"></i></button>
                                                    @else
                                                        <button type="submit"
                                                            class="btn btn-outline-secondary btn-ellipse btn-sm"><i
                                                                class="icon-wishlist-2"></i></button>
                                                    @endif
                                                @else
                                                    <button type="submit"
                                                        class="btn btn-outline-secondary btn-ellipse btn-sm"><i
                                                            class="icon-wishlist-2"></i></button>
                                                @endif
                                            </form>
                                            <form action="{{ route('cart.add') }}" method="POST">
                                                @csrf
                                                <input type="hidden" name="id" value="{{ $item->id }}">
                                                <input type="hidden" value="1" name="quantity">

                                                <button type="submit" class="btn-icon btn-add-cart"
                                                    title="Add to Cart">Add to cart</button>
                                            </form>
                                        </div>
                                    </div>
                                    <!-- End .product-details -->
                                </div>
                            </div>
                        @endforeach

                        <!-- End .col-sm-4 -->
                        <!-- End .col-sm-4 -->
                    </div>
                    <!-- End .row -->
                    {{ $product->links() }}
                   
                </div>
               
                <!-- End .col-lg-9 -->

                <div class="sidebar-overlay"></div>
                <aside class="sidebar-shop col-lg-3 order-lg-first mobile-sidebar">
                    <div class="sidebar-wrapper">
                        <div class="widget">
                            <h3 class="widget-title">
                                <a data-toggle="collapse" href="#widget-body-2" role="button" aria-expanded="true"
                                    aria-controls="widget-body-2">Categories</a>
                            </h3>

                            <div class="collapse show" id="widget-body-2">
                                <div class="widget-body">
                                    <ul class="cat-list">
                                        @foreach ($cate as $item)
                                            <li>
                                                <form action="{{ route('shopCate') }}" method="GET">
                                                    <input type="hidden" name="cate" value="{{ $item->slug }}">
                                                    <button type="submit" class="btn bg-white" data-toggle="collapse"
                                                        role="button" aria-expanded="true"
                                                        aria-controls="widget-category-1"> {{ $item->name }}<span
                                                            class="products-count">({{ $item->products->count() }})</span></button>
                                                </form>
                                                {{-- <a href="#widget-category-1" data-toggle="collapse" role="button" aria-expanded="true" aria-controls="widget-category-1">
                                            {{$item->name}}<span class="products-count"></span>
                                           
                                        </a> --}}
                                            </li>
                                        @endforeach
                                    </ul>

                                </div>
                                <!-- End .widget-body -->
                            </div>
                            <!-- End .collapse -->
                        </div>
                        <!-- End .widget -->
                        <div class="widget">
                            <h3 class="widget-title">
                                <a data-toggle="collapse" href="#widget-body-3" role="button" aria-expanded="true"
                                    aria-controls="widget-body-3">Price</a>
                            </h3>

                            <div class="collapse show" id="widget-body-3">
                                <div class="widget-body pb-0">
                                    <form action="{{ route('shopCate') }}" method="GET" name="filter-form">
                                        <div class="price-slider-wrapper">
                                            <div id="price-slider"></div>
                                        </div>
                                        <div
                                            class="filter-price-action d-flex align-items-center justify-content-between flex-wrap">
                                            <div class="filter-price-text">
                                                Price:
                                                <span id="filter-price-range"></span>
                                            </div>
                                            <button type="submit" class="btn btn-primary">Filter</button>
                                            <input type="hidden" name="min_price" id="min_price">
                                            <input type="hidden" name="max_price" id="max_price">
                                        </div>
                                    </form>



                                    <!-- End .widget-body -->
                                </div>
                                <!-- End .collapse -->
                            </div>

                            <!-- End .widget -->



                            <div class="widget widget-featured">
                                <h3 class="widget-title">Featured</h3>

                                <div class="widget-body">
                                    <div class="owl-carousel widget-featured-products">
                                        <div class="featured-col">
                                            @foreach ($featureProduct2 as $item)
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
                                                        <a href="demo29-shop.html"
                                                            class="product-category">{{ $item->category->name }}</a>
                                                        <div class="price-box">
                                                            @if ($item->sale_price > 0)
                                                                <del
                                                                    class="old-price">{{ number_format($item->price, 2) }}$</del>
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
                                        <!-- End .featured-col -->

                                        <div class="featured-col">
                                            @foreach ($featureProduct as $item)
                                                <div class="product-default left-details product-widget">
                                                    <figure>
                                                        <a href="product.html">

                                                            <img src="{{ asset('storage/images') }}/{{ $item->image }}"
                                                                width="75" height="75" alt="product" />
                                                        </a>
                                                    </figure>
                                                    <div class="product-details">
                                                        <h3 class="product-title"> <a
                                                                href="{{ route('detail', $item->slug) }}">{{ $item->name }}</a>
                                                        </h3>
                                                        <a href="demo29-shop.html"
                                                            class="product-category">{{ $item->category->name }}</a>
                                                        <div class="price-box">
                                                            @if ($item->sale_price > 0)
                                                                <del
                                                                    class="old-price">{{ number_format($item->price, 2) }}$</del>
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
                                        <!-- End .featured-col -->
                                    </div>
                                    <!-- End .widget-featured-slider -->
                                </div>
                                <!-- End .widget-body -->
                            </div>
                            <!-- End .widget -->

                            <div class="widget widget-block">
                                <h3 class="widget-title">Hope you have a nice day</h3>
                                <p>
                                    Product quality is the degree to which a product meets the needs of its users. It is a
                                    measure of how well a product performs its intended function, meets user expectations,
                                    and is free of defects. </p>
                            </div>
                            <!-- End .widget -->
                        </div>
                        <!-- End .sidebar-wrapper -->
                </aside>
                <!-- End .col-lg-3 -->
            </div>
            <!-- End .row -->
        </div>
        <!-- End .container -->

        <div class="mb-4"></div>
        <!-- margin -->
    </main>
    <script>
        const form = document.querySelector('form[name="filter-form"]');

        form.addEventListener('submit', () => {
            const priceSlider = document.getElementById('price-slider');
            const [minPrice, maxPrice] = priceSlider.noUiSlider.get();

            document.getElementById('min_price').value = minPrice;
            document.getElementById('max_price').value = maxPrice;
        });
    </script>
@endsection
