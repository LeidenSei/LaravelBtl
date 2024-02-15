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
									<h2 class="title">Register</h2>
								</div>

								<form action="{{route('post.register')}}" method="POST" >
									@csrf
									<label for="login-email">
										Username
										<span class="required">*</span>
									</label>
									<input type="text" name="name" class="form-input form-wide" id="login-email" value="{{ old('name') }}" required />
									@error('name')
									<span class="text-danger p-2">{{ $message }}</span>
								@enderror
									<label for="login-email">
										Email address
										<span class="required">*</span>
									</label>
									<input type="email" name="email" class="form-input form-wide" id="login-email" value="{{ old('email') }}" required />
									@error('email')
									<span class="text-danger p-2">{{ $message }}</span>
								@enderror
									<label for="login-password">
										Password
										<span class="required">*</span>
									</label>
									<input type="password" name="password" class="form-input form-wide" id="login-password" value="{{ old('password') }}" required />
									@error('password')
									<span class="text-danger p-2">{{ $message }}</span>
								@enderror
									<label for="login-password">
										Cofirm Password
										<span class="required">*</span>
									</label>
									<input type="password" name="cofirm_password" class="form-input form-wide" id="login-password" value="{{ old('cofirm_password') }}" required />
									@error('cofirm_password')
									<span class="text-danger p-2">{{ $message }}</span>
								@enderror
									<button type="submit" class="btn btn-dark btn-md w-100">
										Register
									</button>
								</form>
							</div>
						</div>
					</div>
				</div>
			</div>
		</main><!-- End .main -->
@endsection