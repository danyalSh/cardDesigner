<nav class="navbar topnav-navbar navbar-fixed-top" role="navigation">
	<div class="navbar-header text-center">
		<button type="button" class="navbar-toggle" id="showMenu" >
	        <span class="sr-only">Toggle navigation</span>
	        <span class="icon-bar"></span>
	        <span class="icon-bar"></span>
	        <span class="icon-bar"></span>
	    </button>

		<a class="navbar-brand" href="home"> Swap Cards</a>
	</div>
	<div class="collapse navbar-collapse">

		<ul class="nav navbar-nav pull-right navbar-right">


	        <li class="dropdown admin-dropdown">
	            <a href="/home	" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-expanded="false">
	            	<img src="{{asset('images/flat-avatar.png')}}" class="topnav-img" alt=""><span class="hidden-sm">{{\Illuminate\Support\Facades\Auth::user()->name}}</span>
	            </a>
	            <ul class="dropdown-menu" role="menu">
	                <li><a href="#">Profile</a></li>
	                <li><a href="/logout">Logout</a></li>
	            </ul>
	        </li>
		</ul>
		{{--<a class="btn btn-primary btn-rounded pull-right btn-bordered visible-lg" href="http://www.strapui.com/themes/ani-laravel-theme/" style="margin: 8px 10px 0 0;">Buy Now</a>--}}

	</div>
	<ul class="nav navbar-nav pull-right hidd">	
		<li class="dropdown admin-dropdown" dropdown on-toggle="toggled(open)">
			<a href class="dropdown-toggle animated fadeIn" dropdown-toggle><img src="{{asset('images/flat-avatar.png')}}" class="topnav-img" alt=""></a>
			<ul class="dropdown-menu pull-right">
				<li><a href="profile">profile</a></li>
				<li><a href="login">logout</a></li>
			</ul>
		</li>	
	</ul>
</nav>