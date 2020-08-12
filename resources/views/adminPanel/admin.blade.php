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
		<title>Login - UKMF Admin</title>
	</head>
	<body>
		<section class="material-half-bg">
			<div class="cover"></div>
		</section>
		<section class="login-content">
			<div class="logo">
				<h1>Mpwtcs</h1>
			</div>
			{{-- Error Message Code --}}
			@if(session()->has('errors'))
			<div class="alert alert-danger">
				<strong>Whoops!</strong> There were some problems with your input.
				<br />
				<ul>
					@foreach($errors->all() as $error)
					<li>{{ $error }}</li>
					@endforeach
				</ul>
			</div>
			@endif
			{{-- Success Message Code --}}
			@if(session()->has('message'))
			<div class="alert alert-success">
				{{ session()->get('message') }}
			</div>
			@endif
			<div class="login-box">
				<form class="login-form" action="{!! route('userLogin') !!}" method="POST">
					{{csrf_field()}}
					<h3 class="login-head"><i class="fa fa-lg fa-fw fa-user"></i>SIGN IN</h3>
					<div class="form-group">
						<label class="control-label">USERNAME</label>
						<input class="form-control" name="username" required="required" type="text" placeholder="Username" autofocus>
					</div>
					<div class="form-group">
						<label class="control-label">PASSWORD</label>
						<input class="form-control" name="password" required="required" type="password" placeholder="Password">
					</div>
					<div class="form-group">
						<input class="form-control" name="source" type="hidden" value="Admin">
					</div>
					<div class="form-group">
						<input class="form-control" name="language" type="hidden" value="English">
					</div>
					<div class="form-group">
						<div class="utility">
							<p class="semibold-text mb-2"><a href="#" data-toggle="flip">Forgot Password ?</a></p>
						</div>
					</div>
					<div class="form-group btn-container">
						<button class="btn btn-primary btn-block"><i class="fa fa-sign-in fa-lg fa-fw"></i>SIGN IN</button>
					</div>
				</form>
				<form class="forget-form" action="{!! route('resendOTP') !!}" method="GET">
					{{csrf_field()}}
					<h3 class="login-head"><i class="fa fa-lg fa-fw fa-lock"></i>Forgot Password ?</h3>
					<div class="form-group">
						<label class="control-label">Mobile Number</label>
						<input class="form-control phoneNumber" name="phoneNumber" required="required" minlength=10 type="text" placeholder="Mobile Number">
					</div>
					<div class="form-group">
						<input class="form-control" name="source" type="hidden" value="Admin">
					</div>
					<div class="form-group">
						<input class="form-control" name="language" type="hidden" value="English">
					</div>
					<div class="form-group">
						<input class="form-control" name="templateName" type="hidden" value="userResetPassword">
					</div>
					<div class="form-group">
						<input class="form-control" name="calledFrom" type="hidden" value="adminLogin">
					</div>
					<div class="form-group btn-container">
						<button type="submit" class="btn btn-primary btn-block"><i class="fa fa-unlock fa-lg fa-fw"></i>RESET</button>
					</div>
					<div class="form-group mt-3">
						<p class="semibold-text mb-0"><a href="#" data-toggle="flip"><i class="fa fa-angle-left fa-fw"></i> Back to Login</a></p>
					</div>
				</form>
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
