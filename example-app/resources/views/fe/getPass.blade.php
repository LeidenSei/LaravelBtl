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
                                <h2 class="title">Change password</h2>
                            </div>

                            <form action="" method="POST">
                                @csrf

                                <label for="login-password">
                                    Password
                                    <span class="required">*</span>
                                </label>
                                <input type="password" name="password" value="{{old('password') }}" class="form-input form-wide" id="login-password"
                                    required />
                                    @error('password')
									<span class="text-danger p-2">{{ $message }}</span>
								@enderror
                                <label for="login-password">
                                   Cofirm Password
                                    <span class="required">*</span>
                                </label> 
                                <input type="password" name="corfirm_password" value="{{ old('corfirm_password') }}" class="form-input form-wide" id="login-password"
                                    required />
                                    @error('corfirm_password')
									<span class="text-danger p-2">{{ $message }}</span>
								@enderror

                                <button type="submit" class="btn btn-dark btn-md w-100">
                                    Retrieve password 
                                </button>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </main><!-- End .main -->
@endsection
