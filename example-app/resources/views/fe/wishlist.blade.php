@extends('fe.index')
@section('main')
    
<main class="main">
    <div class="page-header">
        <div class="container d-flex flex-column align-items-center">
            <nav aria-label="breadcrumb" class="breadcrumb-nav">
                <div class="container">
                    <ol class="breadcrumb">
                        <li class="breadcrumb-item"><a href="{{route('index')}}">Home</a></li>
                        <li class="breadcrumb-item active" aria-current="page">
                            Wishlist
                        </li>
                    </ol>
                </div>
            </nav>

            <h1>Wishlist({{$countWish}} product)</h1>
        </div>
    </div>

    <div class="container">
        <div class="wishlist-title">
            <h2 class="p-2">My wishlist</h2>
        </div>
        <div class="wishlist-table-container">
            <table class="table table-wishlist mb-0">
                <thead>
                    <tr>
                        <th class="thumbnail-col"></th>
                        <th class="product-col">Product</th>
                        <th class="price-col">Price</th>
                        <th class="status-col">Delete</th>
                        <th class="action-col">Add Cart</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($wishlist as $item)
                    <tr class="product-row">
                        <td>
                            <figure class="product-image-container">
                                <a href="{{route('detail',$item->product->slug)}}" class="product-image">
                                    <img src="{{asset('storage/images')}}/{{$item->product->image}}" alt="product">
                                </a>

                            </figure>
                        </td>
                        <td>
                            <h5 class="product-title">
                                <a href="{{route('detail',$item->product->slug)}}">{{$item->product->name}}</a>
                            </h5>
                        </td>
                        @if ($item->product->sale_price>0)
                        <td class="price-box">{{number_format($item->product->sale_price,2)}}$</td>
                        @else
                        <td class="price-box">{{number_format($item->product->price,2)}}$</td>
                        @endif
                        <td>
                            <span class="stock-status mt-4">
                                <form action="{{route('user.removeWish')}}" method="POST">
                                    @csrf
                                    <input type="hidden" name="id" value="{{$item->id}}">
                                    <button type="submit" class="btn btn-danger">Delete</button>
                                </form>
                                
                            </span>
                        </td>
                        <td>
                            <div class="">
                                
                                <form action="{{route('cart.add')}}" method="POST">
                                    @csrf
                                    <input type="hidden" name="id" value="{{$item->product->id}}">
                                    <input type="hidden"  value="1" name="quantity">
                                <!-- End .product-single-qty -->

                                <button type="submit" class="btn btn-info">
                                    ADD TO CART
                                </button>
                                </form>
                            </div>
                        </td>
                    </tr>
                    @endforeach
                    {{ $wishlist->links() }}
                </tbody>
            </table>
        </div><!-- End .cart-table-container -->
    </div><!-- End .container -->
</main><!-- End .main -->

@endsection