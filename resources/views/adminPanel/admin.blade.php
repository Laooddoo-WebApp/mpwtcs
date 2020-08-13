<!DOCTYPE html>
<html>
	<head>
		<meta charset="utf-8">
		<meta http-equiv="X-UA-Compatible" content="IE=edge">
		<meta name="viewport" content="width=device-width, initial-scale=1">
		<!-- Main CSS-->
		<link rel="stylesheet" type="text/css" href="{{ asset('adminPanel/css/main.css') }} ">
		<!-- Font-icon css-->
		<link rel="stylesheet" type="text/css" href="https://maxcdn.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css">
		<!-- Flag-icon css-->
		<link href=" https://cdnjs.cloudflare.com/ajax/libs/flag-icon-css/3.2.1/css/flag-icon.css" rel="stylesheet">
		<title>{{__('admin.signIn')}} - Mpwtcs</title>
	</head>
	<body>
		<section class="material-half-bg">
			<div class="cover"></div>
		</section>
		<section class="login-content">
			<div class="logo">
				<h1>Mpwtcs</h1>
			</div>
			{{-- Error Message Code : START --}}
			@if(session()->has('errors'))
			<div class="alert alert-danger">
				<strong>{{__('general.Whoops')}}</strong> {{__('general.errorMsg')}}
				<br />
				<ul>
					@foreach($errors->all() as $error)
					<li>{{ $error }}</li>
					@endforeach
				</ul>
			</div>
			@endif
			{{-- Error Message Code : END --}}
			{{-- Success Message Code : START --}}
			@if(session()->has('message'))
			<div class="alert alert-success">
				{{ session()->get('message') }}
			</div>
			@endif
			{{-- Success Message Code : END --}}
			<div class="login-box">
				{{-- Login form : START --}}
				<form class="login-form" action="{!! route('adminLogin') !!}" method="POST">
					{{csrf_field()}}
					<h3 class="login-head"><i class="fa fa-lg fa-fw fa-user"></i>{{__('admin.signIn')}}</h3>
					<div class="form-group">
						<label class="control-label">{{__('admin.username')}}</label>
						<input class="form-control" name="username" required="required" type="text" placeholder="{{__('admin.username')}}" autofocus>
					</div>
					<div class="form-group">
						<label class="control-label">{{__('admin.password')}}</label>
						<input class="form-control" name="password" required="required" type="password" placeholder="{{__('admin.password')}}">
					</div>
					<div class="form-group">
						<div class="utility">
							<div class="animated-checkbox">
								 <ul class="app-nav">
         
										<li class="dropdown"><a class="app-nav__item" data-toggle="dropdown" aria-label="Open Profile Menu" style="color: #009688;" ><i class="fa fa-language fa-lg icon-cog"></i> {{__('admin.language')}}</a>
											<ul class="dropdown-menu settings-menu dropdown-menu-right">
												<li><a class="dropdown-item" href="{{ route('set.language', 'en') }}"><i class="flag-icon flag-icon-us"></i> English</a></li>
												<li><a class="dropdown-item" href="{{ route('set.language', 'la') }}"><i class="flag-icon flag-icon-la"></i> ລາວ</a></li>
											</ul>
										</li>
									</ul>

							</div>
							<p class="semibold-text mb-2"><a href="#" data-toggle="flip">{{__('admin.forgotPassword')}}</a></p>
						</div>
					</div>
					<div class="form-group btn-container">
						<button class="btn btn-primary btn-block"><i class="fa fa-sign-in fa-lg fa-fw"></i>{{__('admin.signIn')}}</button>
					</div>
				</form>
				{{-- Login form : END --}}
				{{-- forget password : START --}}
				<form class="forget-form" action="{!! route('resendOTP') !!}" method="GET">
					{{csrf_field()}}
					<h3 class="login-head"><i class="fa fa-lg fa-fw fa-lock"></i>{{__('admin.forgotPassword')}}</h3>
					<div class="form-group">
						<label class="control-label">{{__('admin.emailID')}}</label>
						<input class="form-control" name="emailID" required="required" minlength=10 type="text" placeholder="{{__('admin.emailID')}}">
					</div>
					<div class="form-group btn-container">
						<button type="submit" class="btn btn-primary btn-block"><i class="fa fa-unlock fa-lg fa-fw"></i>{{__('admin.reset')}}</button>
					</div>
					<div class="form-group mt-3">
						<p class="semibold-text mb-0"><a href="#" data-toggle="flip"><i class="fa fa-angle-left fa-fw"></i> {{__('admin.backToLogin')}}</a></p>
					</div>
				</form>
				{{-- forget password : END --}}
			</div>
		</section>
		<!-- Essential javascripts for application to work-->
		<script src="{{ asset('adminPanel/js/inputValidation.js') }}"></script>
		<script src="{{ asset('adminPanel/js/jquery-3.2.1.min.js') }}"></script>
		<script src="{{ asset('adminPanel/js/popper.min.js') }}"></script>
		<script src="{{ asset('adminPanel/js/bootstrap.min.js') }}"></script>
		<script src="{{ asset('adminPanel/js/main.js') }}"></script>
		<!-- The javascript plugin to display page loading on top-->
		<script src="{{ asset('adminPanel/js/plugins/pace.min.js') }}"></script>
		<script type="text/javascript">
			// Login Page Flipbox control
			$('.login-content [data-toggle="flip"]').click(function() {
			$('.login-box').toggleClass('flipped');
			return false;
			});
		</script>
	</body>
</html>