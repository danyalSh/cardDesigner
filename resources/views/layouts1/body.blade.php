@extends('layouts1.app')
@section('body')
<body scroll-spy="" id="top" class=" theme-template-dark theme-pink alert-open alert-with-mat-grow-top-right">
<main>

	@include('layouts1.aside')

	<div class="main-container">
		@include('layouts1.breadcrumb')
		<div class="main-content" autoscroll="true" bs-affix-target="" init-ripples="" style="">
			<div class="dashboard grey lighten-3"></div>
			@yield('section')
		</div>
	</div>
	</div>

</main>


<style>
	.glyphicon-spin-jcs {
		-webkit-animation: spin 1000ms infinite linear;
		animation: spin 1000ms infinite linear;
	}
	@-webkit-keyframes spin {
		0% {
			-webkit-transform: rotate(0deg);
			transform: rotate(0deg);
		}
		100% {
			-webkit-transform: rotate(359deg);
			transform: rotate(359deg);
		}
	}
	@keyframes spin {
		0% {
			-webkit-transform: rotate(0deg);
			transform: rotate(0deg);
		}
		100% {
			-webkit-transform: rotate(359deg);
			transform: rotate(359deg);
		}
	}
</style>
</body>
@stop