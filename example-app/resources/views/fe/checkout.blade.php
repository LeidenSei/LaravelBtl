@extends('fe.index')
@section('main')
    <main class="main main-test">
        <div class="container checkout-container">
            <ul class="checkout-progress-bar d-flex justify-content-center flex-wrap">
                <li>
                    <a href="cart.html">Shopping Cart</a>
                </li>
                <li class="active">
                    <a href="checkout.html">Checkout</a>
                </li>
                <li class="disabled">
                    <a href="#">Order Complete</a>
                </li>
            </ul>


            <div class="row">
                <div class="col-lg-7">
                    <ul class="checkout-steps">
                        <li>
                            <h2 class="step-title">Billing details</h2>

                            <form action="{{route('post.checkout')}}"  method="POST" id="checkout-form">
                                @csrf
                                <div class="form-group mb-1 pb-2">
                                    <label>FullName
                                        <abbr class="required" title="required">*</abbr></label>
                                    @if (Auth::check())
                                        <input type="text" class="form-control" name="name"
                                            placeholder="Enter your name" value="{{ Auth::user()->name }}" required />
                                    @else
                                        <input type="text" class="form-control" name="name"
                                            placeholder="Enter your name" required />
                                    @endif
                                    @error('name')
                                        <div class="alert alert-danger">{{ $message }}</div>
                                    @enderror

                                </div>

                                <div class="form-group mb-1 pb-2">
                                    <label>Address
                                        <abbr class="required" title="required">*</abbr></label>
                                    @if (Auth::check())
                                        <input type="text" name="address" class="form-control" placeholder="Name address"
                                            value="{{ Auth::user()->address }}"  />
                                    @else
                                        <input type="text" name="address" class="form-control" placeholder="Name address"
                                             />
                                    @endif
                                    @error('address')
                                        <div class="alert alert-danger">{{ $message }}</div>
                                    @enderror

                                </div>

                                <div class="form-group">
                                    <label>Phone <abbr class="required" title="required">*</abbr></label>

                                    @if (Auth::check())
                                        <input type="text" name="phone" value="{{ Auth::user()->phone }}"
                                            class="form-control"  />
                                    @else
                                        <input type="text" name="phone" class="form-control"  />
                                    @endif

                                    @error('phone')
                                        <div class="alert alert-danger">{{ $message }}</div>
                                    @enderror
                                </div>

                                <div class="form-group">
                                    <label>Email address
                                        <abbr class="required" title="required">*</abbr></label>
                                    @if (Auth::check() )
                                        <input type="text" name="email" value="{{ Auth::user()->email }}"
                                            class="form-control"  />
                                    @else
                                        <input type="text" name="email" class="form-control"  />
                                    @endif
                                    @error('email')
                                        <div class="alert alert-danger">{{ $message }}</div>
                                    @enderror
                                </div>


                                <div class="form-group">
                                    <label class="order-comments">Order notes (optional)</label>
                                    <textarea name="order_note" class="form-control" placeholder="Notes about your order, e.g. special notes for delivery."></textarea>
                                </div>
                           
                        </li>
                    </ul>
                </div>
                <!-- End .col-lg-8 -->

                <div class="col-lg-5">
                    <div class="order-summary">
                        <h3>YOUR ORDER</h3>

                        <table class="table table-mini-cart">
                            <thead>
                                <tr>
                                    <th colspan="2">Product</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($cart->list() as $item)
                                <tr>
                                    <td class="product-col">
                                        <h3 class="product-title">
                                            {{$item['name']}} ×
                                            <span class="product-qty">{{$item['quantity']}}</span>
                                        </h3>
                                    </td>

                                    <td class="price-col">
                                        <span>{{number_format($item['price']*$item['quantity'],2)}}$</span>
                                    </td>
                                </tr>
            
                            @endforeach


                            </tbody>
                            <tfoot>
                                <tr class="order-shipping">
                                    <td class="text-left" colspan="2">
                                        <h4 class="m-b-sm">Payment methods</h4>

                                        <div class="form-group form-group-custom-control">
                                            <div class="custom-control custom-radio d-flex">
                                                <input type="radio" class="custom-control-input" value="1" name="payType"
                                                    checked />
                                                <label class="custom-control-label">Cash</label>
                                            </div>
                                            <!-- End .custom-checkbox -->
                                        </div>
                                        <!-- End .form-group -->

                                        <div class="form-group form-group-custom-control mb-0">
                                            <div class="custom-control custom-radio d-flex mb-0">
                                                <input type="radio" name="payType" value="2" class="custom-control-input">
                                                <label class="custom-control-label">Credit</label>
                                            </div>
                                            <!-- End .custom-checkbox -->
                                        </div>
                                        @error('payType')
                                        <span class="text-danger mt-2"> <strong>{{ $message }}</strong></span>
                                         @enderror 
                                        <!-- End .form-group -->
                                    </td>

                                </tr>

                                <tr class="order-total">
                                    <td>
                                        <h4>Total</h4>
                                    </td>
                                    <td>
                                        <b class="total-price"><span>{{number_format($cart->getTotalPrice(),2)}}$</span></b>
                                    </td>
                                </tr>
                            </tfoot>
                        </table>
                        
                        <button type="submit" class="btn btn-dark btn-place-order" form="checkout-form">
                            Place order
                        </button>
                    </form>
                    </div>
                    <!-- End .cart-summary -->
                </div>
                <!-- End .col-lg-4 -->
            </div>
            <!-- End .row -->
        </div>
        <!-- End .container -->
    </main>
@endsection
