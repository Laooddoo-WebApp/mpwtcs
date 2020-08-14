@section('header')
<ul class="app-nav">
	<div class="utility">
		<div class="animated-checkbox">
			 <ul class="app-nav">

					<li class="dropdown"><a class="app-nav__item" data-toggle="dropdown" aria-label="Open Profile Menu" style="color: #ffff;" ><i class="fa fa-language fa-lg icon-cog"></i>&nbsp;&nbsp;&nbsp;{{__('admin.language')}}</a>
						<ul class="dropdown-menu settings-menu dropdown-menu-right">
							<li><a class="dropdown-item" href="{{ route('set.language', 'en') }}"><i class="flag-icon flag-icon-us"></i> English</a></li>
							<li><a class="dropdown-item" href="{{ route('set.language', 'la') }}"><i class="flag-icon flag-icon-la"></i> ລາວ</a></li>
						</ul>
					</li>
				</ul>

		</div>
	</div>
	<!--Notification Menu-->
	<!-- User Menu-->
	<li class="dropdown">
		<a class="app-nav__item" href="#" data-toggle="dropdown" aria-label="Open Profile Menu"><i class="fa fa-user fa-lg"></i></a>
		<ul class="dropdown-menu settings-menu dropdown-menu-right">
			<li><a class="dropdown-item" href="page-user.html"><i class="fa fa-cog fa-lg"></i> Settings</a></li>
            <li><a class="dropdown-item" href="{!! route('adminLogout') !!}" ><i class="fa fa-sign-out fa-lg"></i> Logout</a></li>
		</ul>
	</li>
</ul>
@endsection
