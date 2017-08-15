@extends('layouts1.app')
@section('body')
	<body class="page-login" init-ripples="">
	<div class="center">
		<div class="card bordered z-depth-2" style="margin:0% auto; max-width:400px;">
			<div class="card-header">
				<div class="brand-logo">
					{{--<div id="logo">--}}
						{{--<div class="foot1"></div>--}}
						{{--<div class="foot2"></div>--}}
						{{--<div class="foot3"></div>--}}
						{{--<div class="foot4"></div>--}}
					{{--</div>--}}
					SwapCards </div>
			</div>
			<form class="form-floating" role="form" method="POST" action="{{ url('/login') }}">
				{{csrf_field()}}
				<div class="card-content">
					<div class="m-b-30">
						<div class="card-title strong pink-text">Login</div>
						{{--<p class="card-title-desc"> Welcome to SwapCards! The admin template for material design lovers. </p>--}}
					</div>
					<div class="form-group">
						<label for="email" class="control-label">Email</label>
						<input type="text" name="email" id="email" value="{{ old('email') }}" class="form-control">
						@if ($errors->has('email'))
							<span class="red-text"> <strong>{{ $errors->first('email') }}</strong></span>
						@endif
					</div>
					<div class="form-group">
						<label for="inputPassword" class="control-label">Password</label>
						<input type="password" class="form-control" id="password" name="password">@if ($errors->has('password'))
							<span class="red-text"> <strong>{{ $errors->first('password') }}</strong></span>
						@endif
					</div>
					<div class="form-group">
						<div class="checkbox">
							<label>
								<input type="checkbox" name="remember"> Remember me </label>
						</div>
					</div>

				</div>
				<div class="card-action clearfix">
					<div class="pull-right">
						{{--<button type="button" class="btn btn-link black-text">Forgot password</button>--}}
						<button type="submit" class="btn btn-link black-text">Login</button>
					</div>
				</div>
			</form>
		</div>
	</div>
	<script charset="utf-8" src="assets/js/vendors.min.js"></script>
	<script charset="utf-8" src="assets/js/app.min.js"></script>
	</body>
@stop
@section('js')
@stop