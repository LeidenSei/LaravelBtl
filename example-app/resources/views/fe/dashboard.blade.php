@extends('fe.index')
@section('main')
    <main class="main">
        <div class="page-header">
            <div class="container d-flex flex-column align-items-center">
                <nav aria-label="breadcrumb" class="breadcrumb-nav">
                    <div class="container">
                        <ol class="breadcrumb">
                            <li class="breadcrumb-item"><a href="demo4.html">Home</a></li>
                            <li class="breadcrumb-item"><a href="category.html">Shop</a></li>
                            <li class="breadcrumb-item active" aria-current="page">
                                My Account
                            </li>
                        </ol>
                    </div>
                </nav>

                <h1>My Account</h1>
            </div>
        </div>
        <div class="container account-container custom-account-container">
            <div class="row">
                <div class="sidebar widget widget-dashboard mb-lg-0 mb-3 col-lg-3 order-0">
                    <h2 class="text-uppercase">My Account</h2>
                    <ul class="nav nav-tabs list flex-column mb-0" role="tablist">
                        <li class="nav-item">
                            <a class="nav-link active" id="dashboard-tab" data-toggle="tab" href="#dashboard" role="tab"
                                aria-controls="dashboard" aria-selected="true">Dashboard</a>
                        </li>

                        <li class="nav-item">
                            <a class="nav-link" id="order-tab" data-toggle="tab" href="#order" role="tab"
                                aria-controls="order" aria-selected="true">Orders</a>
                        </li>

                        <li class="nav-item">
                            <a class="nav-link" href="{{ route('user.wishlist') }}">Wishlist</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" id="address-tab" data-toggle="tab" href="#address" role="tab"
                                aria-controls="address" aria-selected="false">Addresses</a>
                        </li>

                        <li class="nav-item">
                            <a class="nav-link" id="edit-tab" data-toggle="tab" href="#edit" role="tab"
                                aria-controls="edit" aria-selected="false">Account
                                details</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" id="shop-address-tab" data-toggle="tab" href="#shipping" role="tab"
                                aria-controls="edit" aria-selected="false">Change password</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="{{ route('logoutDashboard') }}">Logout</a>
                        </li>
                    </ul>
                </div>
                <div class="col-lg-9 order-lg-last order-1 tab-content">
                    <div class="tab-pane fade show active" id="dashboard" role="tabpanel">
                        <div class="dashboard-content">
                            <p>
                                Hello <strong class="text-dark">
                                    @if (Auth::check())
                                        {{ Auth::user()->name }}
                                    @endif
                                </strong>
                                @if (Auth::check())
                                    (not
                                    <strong class="text-dark">{{ Auth::user()->name }}</strong>?
                                    <a href="{{ route('logoutDashboard') }}" class="btn btn-link ">Log out</a>)
                                @endif
                            </p>

                            <p>
                                From your account dashboard you can view your
                                <a class="btn btn-link link-to-tab" href="#order">recent orders</a>,
                                manage your
                                <a class="btn btn-link link-to-tab" href="#address">shipping and billing
                                    addresses</a>, and
                                <a class="btn btn-link link-to-tab" href="#edit">edit your password and account
                                    details.</a>
                            </p>

                            <div class="mb-4"></div>

                            <div class="row row-lg">
                                <div class="col-6 col-md-4">
                                    <div class="feature-box text-center pb-4">
                                        <a href="#order" class="link-to-tab"><i class="sicon-social-dropbox"></i></a>
                                        <div class="feature-box-content">
                                            <h3>ORDERS</h3>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-6 col-md-4">
                                    <div class="feature-box text-center pb-4">
                                        <a href="{{ route('user.wishlist') }}"><i class="sicon-heart"></i></a>
                                        <div class="feature-box-content">
                                            <h3>WISHLIST</h3>
                                        </div>
                                    </div>
                                </div>


                                <div class="col-6 col-md-4">
                                    <div class="feature-box text-center pb-4">
                                        <a href="#address" class="link-to-tab"><i class="sicon-location-pin"></i></a>
                                        <div class="feature-box-content">
                                            <h3>ADDRESSES</h3>
                                        </div>
                                    </div>
                                </div>

                                <div class="col-6 col-md-4">
                                    <div class="feature-box text-center pb-4">
                                        <a href="#edit" class="link-to-tab"><i class="icon-user-2"></i></a>
                                        <div class="feature-box-content p-0">
                                            <h3>ACCOUNT DETAILS</h3>
                                        </div>
                                    </div>
                                </div>


                                <div class="col-6 col-md-4">
                                    <div class="feature-box text-center pb-4">
                                        <a href="{{ route('logoutDashboard') }}"><i class="sicon-logout"></i></a>
                                        <div class="feature-box-content">
                                            <h3>LOGOUT</h3>
                                        </div>
                                    </div>
                                </div>
                            </div><!-- End .row -->
                        </div>
                    </div><!-- End .tab-pane -->

                    <div class="tab-pane fade" id="order" role="tabpanel">
                        <div class="order-content">
                            <h3 class="account-sub-title d-none d-md-block"><i
                                    class="sicon-social-dropbox align-middle mr-3"></i>Orders</h3>
                            <div class="order-table-container text-center">
                                <table class="table table-order text-left">
                                    <thead>
                                        <tr>
                                            <th class="order-id">NO</th>
                                            <th class="order-id">ORDER</th>
                                            <th class="order-date">DATE</th>
                                            <th class="order-status">STATUS</th>
                                            <th class="order-price">Method</th>
                                            <th class="order-action">ACTIONS</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @if (isset($order) && Auth::check())
                                            @foreach ($order as $item)
                                                <tr>
                                                    <td>{{ $loop->iteration }}</td>
                                                    <td>{{ $item->id }}</td>
                                                    <td>{{ date('d/m/Y', strtotime($item->created_at)) }}</td>
                                                    <td>
                                                        @if ($item->status == 0)
                                                            <label class="badge">The payment is pending
                                                                confirmation</label>
                                                        @elseif($item->status == 1)
                                                            <label class="badge">The order will be shipped as soon as the
                                                                goods are prepared.</label>
                                                        @elseif($item->status == 2)
                                                            <label class="badge">The goods are being delivered to your
                                                                address</label>
                                                        @elseif($item->status == 3)
                                                            <label class="badge">Your order has been delivered
                                                                successfully.</label>
                                                        @elseif($item->status == 4)
                                                            <label class="badge">The order has been canceled</label>
                                                        @endif
                                                    </td>
                                                    <td>{{ $item->payType == 1 ? 'Cash' : 'Credit' }}</td>
                                                    <td>
                                                        <a href="{{ route('orderDetail', $item->id) }}"
                                                            class="btn btn-info">More info</a>


                                                        @if ($item->status == 0)
                                                            <a href="{{ route('cancelOrder', $item->id) }}"
                                                                class="btn btn-warning">Cancel </a>
                                                        @else
                                                            @if ($item->status == 4)
                                                                <a href="{{ route('deleteOrder', $item->id) }}"
                                                                    class="btn btn-danger">Delete</a>
                                                                <a href="{{ route('RestoreOrder', $item->id) }}"
                                                                    class="btn btn-success">Restore</a>
                                                            @endif
                                                        @endif

                                                    </td>
                                                </tr>
                                            @endforeach
                                        @else
                                            <tr>
                                                <td class="text-center p-0" colspan="5">
                                                    <p class="mb-5 mt-5">
                                                        No Order has been made yet.
                                                    </p>
                                                </td>
                                            </tr>
                                        @endif


                                    </tbody>
                                </table>
                                <hr class="mt-0 mb-3 pb-2" />
                            </div>
                        </div>
                    </div><!-- End .tab-pane -->



                    <div class="tab-pane fade" id="address" role="tabpanel">
                        <h3 class="account-sub-title d-none d-md-block mb-1"><i
                                class="sicon-location-pin align-middle mr-3"></i>Addresses</h3>
                        <div class="addresses-content">
                            <p class="mb-4">
                                The following addresses will be used on the checkout page by
                                default.
                            </p>

                            <div class="row">
                                @if (Auth::check() && Auth::user()->address != '')
                                    <div class="address col-md-6">
                                        <div class="heading d-flex">
                                            <h4 class="text-dark mb-0">Billing address</h4>
                                        </div>

                                        <div class="address-box">
                                            {{ Auth::user()->address }}
                                        </div>

                                    </div>
                                @else
                                    <div class="address col-md-6">
                                        <div class="heading d-flex">
                                            <h4 class="text-dark mb-0">Billing address</h4>
                                        </div>
                                        <div class="address-box">

                                            You have not set up this type of address yet.
                                        </div>
                                    </div>
                                @endif



                                <form action="{{ route('dashboard', $user->id) }}" method="POST">
                                    @csrf
                                    @method('PUT')
                                    <div class="address col-md-6 mt-5 mt-md-0">
                                        <div class="heading d-flex">
                                            <h4 class="text-dark mb-0">
                                                Address
                                            </h4>

                                        </div>
                                        <input type="text" name="address" id="">
                                        @error('address')
                                            <span class="text-danger ml-3"><strong>{{ $message }}</strong></span>
                                        @enderror
                                        <button type="submit" class="btn btn-default">Add
                                            Address</button>
                                    </div>
                                </form>

                            </div>
                        </div>
                    </div><!-- End .tab-pane -->

                    <div class="tab-pane fade" id="edit" role="tabpanel">
                        <h3 class="account-sub-title d-none d-md-block mt-0 pt-1 ml-1"><i
                                class="icon-user-2 align-middle mr-3 pr-1"></i>Account Details</h3>
                        <div class="account-content">
                            @if (Auth::check())
                                <form action="{{ route('updateProfile', $user->id) }}" enctype="multipart/form-data"
                                    method="POST">
                                    @csrf
                                    <div class="row">
                                        <div class="col-md-12">
                                            <div class="form-group">
                                                <label for="acc-name">User name <span class="required">*</span></label>
                                                <input type="text" class="form-control" value="{{ $user->name }}"
                                                    id="acc-name" name="name" />
                                                @error('name')
                                                    <span class="text-danger ml-3"><strong>{{ $message }}</strong></span>
                                                @enderror
                                            </div>
                                        </div>

                                        <div class="col-md-12">
                                            <div class="form-group">
                                                <label for="acc-lastname">Phone<span class="required">*</span></label>
                                                <input type="text" class="form-control" value="{{ $user->phone }}"
                                                    id="acc-lastname" name="phone" />
                                                @error('phone')
                                                    <span class="text-danger ml-3"><strong>{{ $message }}</strong></span>
                                                @enderror
                                            </div>
                                        </div>
                                        <div class="col-md-6">
                                            <div class="form-group">
                                                <label for="acc-lastname">Avatar<span class="required">*</span></label>
                                                <input type="file" class="form-control" value="{{ $user->phone }}"
                                                    id="acc-lastname" name="photo" onchange="showImg(this,'img')" />
                                            </div>
                                        </div>
                                        <div class="col-md-6">
                                            <div class="form-group">
                                                <img id='img'
                                                    style="height: 100%; width: 100%; border: 1px solid black;"
                                                    src="{{ asset('storage/images') }}/{{ $user->avatar }}"
                                                    alt="image of user">

                                            </div>
                                        </div>
                                    </div>

                                    <div class="form-group mb-2">
                                        <label for="acc-text">Address <span class="required">*</span></label>
                                        <input type="text" class="form-control" value="{{ $user->address }}"
                                            id="acc-text" name="address" />
                                        @error('address')
                                            <span class="text-danger ml-3"><strong>{{ $message }}</strong></span>
                                        @enderror
                                    </div>
                                    <div class="form-group mb-3">
                                        <label>Email address <span class="required">*</span></label>
                                        <input type="text" disabled class="form-control" value="{{ $user->email }}"
                                            placeholder="editor@gmail.com" required />
                                    </div>

                                    <div class="form-footer mt-3 mb-0">
                                        <button type="submit" class="btn btn-dark mr-0">
                                            Save changes
                                        </button>
                                    </div>
                                </form>
                            @else
                                <form action="">
                                    @csrf
                                    <div class="row">
                                        <div class="col-md-12">
                                            <div class="form-group">
                                                <label for="acc-name">User name <span class="required">*</span></label>
                                                <input type="text" class="form-control" id="acc-name" />
                                            </div>
                                        </div>

                                        <div class="col-md-12">
                                            <div class="form-group">
                                                <label for="acc-lastname">Phone<span class="required">*</span></label>
                                                <input type="text" class="form-control" id="acc-lastname" />
                                            </div>
                                        </div>
                                        <div class="col-md-6">
                                            <div class="form-group">
                                                <label for="acc-lastname">Avatar<span class="required">*</span></label>
                                                <input type="file" class="form-control" id="acc-lastname" />
                                            </div>
                                        </div>
                                        <div class="col-md-6">
                                            <div class="form-group">
                                                <img id='img'
                                                    style="height: 100%; width: 100%; border: 1px solid black;"
                                                    src="" alt="image of user">

                                            </div>
                                        </div>
                                    </div>

                                    <div class="form-group mb-2">
                                        <label for="acc-text">Address <span class="required">*</span></label>
                                        <input type="text" class="form-control" id="acc-text" name="address" />
                                    </div>

                                    <div class="form-footer mt-3 mb-0">
                                        <button type="submit" class="btn btn-dark mr-0">
                                            Save changes
                                        </button>
                                    </div>
                                </form>
                            @endif

                        </div>
                    </div><!-- End .tab-pane -->

                    <div class="tab-pane fade" id="shipping" role="tabpanel">
                        <div class="address account-content mt-0 pt-2">
                            <div class="change-password">
                                <h3 class="text-uppercase mb-2">Password Change</h3>
                                @if (Auth::check())
                                    @if ($message = Session::get('error'))
                                        <span class="text-danger">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @endif

                                    <form action="{{ route('changePassword', Auth::user()->id) }}" method="POST">
                                        @csrf
                                        <div class="form-group">
                                            <label for="acc-password">Current Password (leave blank to leave
                                                unchanged)</label>
                                            <input type="password" class="form-control" id="acc-password"
                                                name="passwordOld" value="{{ old('passwordOld') }}" />
                                            @error('passwordOld')
                                                <span class="text-danger"><strong>{{ $message }}</strong></span>
                                            @enderror
                                        </div>

                                        <div class="form-group">
                                            <label for="acc-password">New Password (leave blank to leave
                                                unchanged)</label>
                                            <input type="password" class="form-control" id="acc-new-password"
                                                name="password" />
                                            @error('password')
                                                <span class="text-danger"><strong>{{ $message }}</strong></span>
                                            @enderror
                                        </div>

                                        <div class="form-group">
                                            <label for="acc-password">Confirm New Password</label>
                                            <input type="password" class="form-control" id="acc-confirm-password"
                                                name="repassword" />
                                            @error('repassword')
                                                <span class="text-danger"><strong>{{ $message }}</strong></span>
                                            @enderror
                                        </div>
                            </div>

                            <div class="form-footer mt-3 mb-0">
                                <button type="submit" class="btn btn-dark mr-0">
                                    Save changes
                                </button>
                            </div>
                            </form>
                        @else
                            <form action="">
                                @csrf
                                <div class="form-group">
                                    <label for="acc-password">Current Password (leave blank to leave
                                        unchanged)</label>
                                    <input type="password" class="form-control" id="acc-password" name="passwordOld" />

                                </div>

                                <div class="form-group">
                                    <label for="acc-password">New Password (leave blank to leave
                                        unchanged)</label>
                                    <input type="password" class="form-control" id="acc-new-password" />

                                </div>

                                <div class="form-group">
                                    <label for="acc-password">Confirm New Password</label>
                                    <input type="password" class="form-control" id="acc-confirm-password" />

                                </div>
                        </div>

                        <div class="form-footer mt-3 mb-0">
                            <button type="submit" class="btn btn-dark mr-0">
                                Save changes
                            </button>
                        </div>
                        </form>
                        @endif



                    </div>
                </div><!-- End .tab-pane -->
            </div><!-- End .tab-content -->
        </div><!-- End .row -->
        </div><!-- End .container -->

        <div class="mb-5"></div><!-- margin -->
    </main><!-- End .main -->
@section('custom-js')
    <script>
        function showImg(input, target) {
            let file = input.files[0];
            let reader = new FileReader();

            reader.readAsDataURL(file);
            reader.onload = function() {

                let img = document.getElementById(target);

                img.src = reader.result;
            }
        }
    </script>
@endsection
@endsection
