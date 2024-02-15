@extends('fe.index')
@section('main')
    <main class="main">
        <div class="page-header">
            <div class="container d-flex flex-column align-items-center">
                <nav aria-label="breadcrumb" class="breadcrumb-nav">
                    <div class="container">
                    </div>
                </nav>

                <h1>My Account</h1>
            </div>
        </div>

        <div class="container login-container">
            <div class="row">
                <div class="col-lg-10 mx-auto">
                    <div class="row justify-content-md-center">
                        <div class="col-md-6">
                            <div class="heading mb-1">
                                <h2 class="title">Login</h2>
                                @if ($message = Session::get('error'))
                                    <div class="alert alert-danger alert-block">

                                        <button type="button" class="close" data-dismiss="alert">×</button>

                                        <strong>{{ $message }}</strong>

                                    </div>
                                @endif
                            </div>

                            <form action="{{ route('user.postLogin') }}" method="POST">
                                @csrf
                                <label for="login-email">
                                   Email address
                                    <span class="required">*</span>
                                </label>
                                <input type="email" name="email" value="{{ old('email') }}" class="form-input form-wide" id="login-email"
                                    required />

                                <label for="login-password">
                                    Password
                                    <span class="required">*</span>
                                </label>
                                <input type="password" name="password" value="{{ old('password') }}" class="form-input form-wide" id="login-password"
                                    required />

                                <div class="mb-3">
                                    <a class="btn btn-secondary" href="{{ route('user.register') }}">Register</a>
                             
                                </div>
                                <div class="mb-3">
                                    <a href="{{route('user.forgot')}}"
                                    class="forget-password text-dark form-footer-right">Forgot
                                    Password?</a>
                                </div>
                                <button type="submit" class="btn btn-dark btn-md w-100">
                                    LOGIN
                                </button>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </main><!-- End .main -->
@endsection
