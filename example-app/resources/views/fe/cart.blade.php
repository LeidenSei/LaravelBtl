@extends('fe.index')
@section('main')
<main class="main">

    <div class="container">
        <ul class="checkout-progress-bar d-flex justify-content-center flex-wrap">
            <li class="active">
                <a href="{{route('cart.index')}}">Shopping Cart</a>
            </li>
            <li>
                <a href="{{route('checkout')}}">Checkout</a>
            </li>
            <li class="disabled">
                <a href="cart.html">Order Complete</a>
            </li>
        </ul>

        <div class="row">
            <div class="col-lg-8">
                @if ($message = Session::get('error'))
                <div class="alert alert-warning alert-block">
            
                    <button type="button" class="close" data-dismiss="alert">×</button>
            
                    <strong>{{ $message }}</strong>
            
                </div>
                @endif
                <div class="cart-table-container">
                    <table class="table table-cart">
                        <thead>
                            <tr>
                                <th class="thumbnail-col"></th>
                                <th class="product-col">Product</th>
                                <th class="price-col">Price</th>
                                <th class="qty-col">Quantity</th>
                                <th class="text-right">Subtotal</th>
                                <th class="text-right"><a href="{{ route('cart.clear') }}"  onclick="return confirm('Are you sure about that?')" class="btn-remove icon-cancel"></a></th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($cart->list() as $key=>$item)
                            <tr class="product-row">
                                <td>
                                    <figure class="product-image-container">
                                        <a href="{{route('detail',$item['slug'])}}" class="product-image">
                                            <img src="{{asset('storage/images')}}/{{$item['image']}}" alt="product">
                                        </a>

                                        <a href="{{ route('cart.remove', $item['product_id']) }}" class="btn-remove icon-cancel" title="Remove Product"></a>
                                    </figure>
                                </td>
                                <td class="product-col">
                                    <h5 class="product-title">
                                        <a href="{{route('detail',$item['slug'])}}">{{$item['name']}}</a>
                                    </h5>
                                </td>
                                <td>{{number_format($item['price'],2)}}$</td>
                                <td>
                                    <div class="product-single-qty">
                                        <input class="horizontal-quantity  form-control"  data-id="{{ $item['product_id'] }}" onchange="updateQuantity(this)" value="{{$item['quantity']}}" type="text">
                                    </div><!-- End .product-single-qty -->
                                </td>
                                <td class="text-right"><span class="subtotal-price">{{ number_format($item['price'] * $item['quantity'],2) }}$</span></td>
                            </tr>  
                            @endforeach

                        </tbody>


                        <tfoot>
                            <tr>
                                <td colspan="5" class="clearfix">
                                    <div class="float-left">
                                        <div class="cart-discount">
                                            <form action="#">
                                                <div class="input-group">
                                                    <input type="text" class="form-control form-control-sm"
                                                        placeholder="Coupon Code" required>
                                                    <div class="input-group-append">
                                                        <button class="btn btn-sm" type="submit">Apply
                                                            Coupon</button>
                                                    </div>
                                                </div><!-- End .input-group -->
                                            </form>
                                        </div>
                                    </div><!-- End .float-left -->

                                    <div class="float-right">
                                        <a href="{{route('cart.index')}}" class="btn btn-shop btn-update-cart">
                                            Update Cart
                                        </a>
                                    </div><!-- End .float-right -->
                                </td>
                            </tr>
                        </tfoot>
                    </table>
                </div><!-- End .cart-table-container -->
            </div><!-- End .col-lg-8 -->

            <div class="col-lg-4">
                <div class="cart-summary">
                    <h3>CART TOTALS</h3>

                    <table class="table table-totals">
                        <tbody>
                            <tr>
                                <td>Subtotal</td>
                                <td>{{number_format($cart->getTotalPrice(),2)}}$</td>
                            </tr>
                        </tbody>

                        <tfoot>
                            <tr>
                                <td>Total</td>
                                <td>{{number_format($cart->getTotalPrice(),2)}}$</td>
                            </tr>
                        </tfoot>
                    </table>

                    <div class="checkout-methods">
                        <a href="{{route('checkout')}}" class="btn btn-block btn-dark">Proceed to Checkout
                            <i class="fa fa-arrow-right"></i></a>
                    </div>
                </div><!-- End .cart-summary -->
            </div><!-- End .col-lg-4 -->
        </div><!-- End .row -->
    </div><!-- End .container -->

    <div class="mb-6"></div><!-- margin -->
</main><!-- End .main -->

<form action="{{ route('cart.update') }}" method="POST" id="updateCartQty">
    @csrf
    <input type="hidden" name="id" id='id'>
    <input type="hidden" name="quantity" id='quantity'>
</form>
@endsection

@section('custom-js')
    <script>
        function updateQuantity(qty) {
            $('#id').val($(qty).data('id'));
            $('#quantity').val($(qty).val());
            $('#updateCartQty').submit();
        }
    </script>
@endsection