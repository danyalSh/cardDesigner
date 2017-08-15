
<aside class="sidebar fixed" style="width: 260px; left: 0px; ">
	<div class="brand-logo">
		{{--<div id="logo">--}}
			{{--<div class="foot1"></div>--}}
			{{--<div class="foot2"></div>--}}
			{{--<div class="foot3"></div>--}}
			{{--<div class="foot4"></div>--}}
		{{--</div>--}}
		Swap Cards
	</div>
	<div class="user-logged-in">
		<div class="content">
			<div class="user-name">{{\Auth::user()->name}}<span class="text-muted f9"></span></div>
			<div class="user-email">{{\Auth::user()->email}}</div>
			<div class="user-actions"> <!--<a class="m-r-5" href="#">settings</a> --> <a href="/logout">logout</a> </div>
		</div>
	</div>
	<ul class="menu-links">
		<li icon="md md-blur-on">
			<a href="/dashboard"><i class="md md-blur-on"></i>&nbsp;<span>Dashboard</span></a>
		</li>
		@if(Auth::user()->hasRole('super_admin'))
		<li>
			<a href="#" data-toggle="collapse" data-target="#companies" aria-expanded="false" aria-controls="companies" class="collapsible-header waves-effect">
				<i class="md md-camera"></i>&nbsp;Companies
			</a>
			<ul id="companies" class="collapse">
				<li name="Todo">
					<a href="/dashboard/companies-listing">
						<span id="todosCount" class="pull-right badge z-depth-0"></span>
						<span>Companies Listing</span></a>
				</li>
				<li name="Crud">
					<a href="/dashboard/create-company">
						<span class="pull-right badge theme-primary-bg z-depth-0"></span>
						<span>Create Company</span></a>
				</li>
			</ul>
		</li>
		@endif
		<li>
			<a href="#" data-toggle="collapse" data-target="#users" aria-expanded="false" aria-controls="users" class="collapsible-header waves-effect">
				<i class="md-account-child"></i>&nbsp;Users
			</a>
			<ul id="users" class="collapse">
				<li name="Todo">
					<a href="/dashboard/users-listing">
						<span id="todosCount" class="pull-right badge z-depth-0"></span>
						<span>Users Listing</span></a>
				</li>
				<li name="Crud">
					<a href="/dashboard/create-user">
						<span class="pull-right badge theme-primary-bg z-depth-0"></span>
						<span>Create User</span></a>
				</li>
			</ul>
		</li>
		@if(!Auth::user()->hasRole('super_admin'))
		<li>
			<a href="#" data-toggle="collapse" data-target="#designCards" aria-expanded="false" aria-controls="designCards" class="collapsible-header waves-effect">
				<i class="md-credit-card"></i>&nbsp;Cards
			</a>
			<ul id="designCards" class="collapse">
				<li name="Todo">
					<a href="/dashboard/design-card">
						<span id="todosCount" class="pull-right badge z-depth-0"></span>
						<span>Design Card Template</span></a>
				</li>
				</li>
			</ul>
		</li>
			@endif
	</ul>
</aside>
