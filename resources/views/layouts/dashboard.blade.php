@extends('layouts.plain')
@section('body')
	@include('partials.topnav')
	@include('partials.menubar')
	<section id="body-container" class="animsition dashboard-page">
		@yield('section')
	</section>
@stop
