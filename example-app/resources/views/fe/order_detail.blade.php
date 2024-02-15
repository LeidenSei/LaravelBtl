@extends('fe.index')
@section('main')
<main class="main">
    <div class="page-header">
        <div class="container d-flex flex-column align-items-center">
            <nav aria-label="breadcrumb" class="breadcrumb-nav">
                <div class="container">
                    <ol class="breadcrumb">
                        <li class="breadcrumb-item"><a href="{{route('index')}}">Home</a></li>
                        <li class="breadcrumb-item"><a href="{{route('dashboard',Auth::user()->id)}}">Dashboard</a></li>
                        <li class="breadcrumb-item active" aria-current="page">
                            Order Detail
                        </li>
                    </ol>
                </div>
            </nav>

            <h1>Wishlist</h1>
        </div>
    </div>

    <div class="container">
        <div class="wishlist-title">
            <h2 class="p-2">My Order detail</h2>
        </div>
        <div class="wishlist-table-container">
            <table class="table table-wishlist mb-0">
                <thead>
                    <tr>
                        <th class="thumbnail-col"></th>
                        <th class="product-col">Product</th>
                        <th class="product-col">Order Id</th>
                        <th class="price-col">Quantity</th>
                        <th class="status-col">Total Price</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($detail as $item)
                    <tr class="product-row">
                        <td>
                            <figure class="product-image-container">
                                <a href="product.html" class="product-image">
                                    <img src="{{ asset('storage') }}/images/{{ $item->product->image }}" alt="product">
                                </a>
                            </figure>
                        </td>
                        <td>
                            <h5 class="product-title">
                                <a href="product.html">{{ $item->product->name }}</a>
                            </h5>
                        </td>
                        <td>
                            <h5 class="product-title">
                                <a href="product.html">{{ $item->order_id}}</a>
                            </h5>
                        </td>
                        <td class="price-box">{{ $item->quantity }}</td>
                        <td>
                            <span class="stock-status">{{ number_format($item->total_price,2) }}$</span>
                        </td>
                    </tr>
                    @endforeach

                </tbody>
            </table>
        </div><!-- End .cart-table-container -->
    </div><!-- End .container -->
</main><!-- End .main -->
@endsection