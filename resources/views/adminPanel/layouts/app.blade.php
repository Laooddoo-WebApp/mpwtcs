<!DOCTYPE html>
<html lang="en">
	<head>
		<meta name="description" content="Mpwtcs">

		<title>Mpwtcs</title>
		<meta charset="utf-8">
		<meta http-equiv="X-UA-Compatible" content="IE=edge">
		<meta name="viewport" content="width=device-width, initial-scale=1">
		<!-- Main CSS-->
		<link rel="stylesheet" type="text/css" href="{{ asset('adminPanel/css/main.css') }}">
		<!-- Font-icon css-->
		<link rel="stylesheet" type="text/css" href="https://maxcdn.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css">

		<!-- Tempus Dominus CDN-->
		<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/tempusdominus-bootstrap-4/5.0.0-alpha14/css/tempusdominus-bootstrap-4.min.css" />

		<link href=" https://cdnjs.cloudflare.com/ajax/libs/flag-icon-css/3.2.1/css/flag-icon.css" rel="stylesheet">

	</head>
	<body class="app sidebar-mini rtl">
		<!-- Navbar-->
		<header class="app-header">
			<a class="app-header__logo" href="index.html">Mpwtcs</a>
			<!-- Sidebar toggle button--><a class="app-sidebar__toggle" href="#" data-toggle="sidebar" aria-label="Hide Sidebar"></a>
			<!-- Navbar Right Menu-->
			@include('adminPanel.header.header')
			@yield('header')
		</header>
		<!-- Sidebar menu-->
		<div class="app-sidebar__overlay" data-toggle="sidebar"></div>
		<aside class="app-sidebar">
			@include('adminPanel.sidebar.sidebar')
			@yield('sidebar')
		</aside>

        <!--Js for alert, need to load it before content-->
        <script src="{{ asset('adminPanel/js/jquery-3.2.1.min.js')}}"></script>
        <script type="text/javascript" src="{{ asset('adminPanel/js/plugins/bootstrap-notify.min.js')}}"></script>

		{{-- Error Message Code : START--}}
		@if(session()->has('errors'))
		<div>
			@foreach($errors->all() as $error)
			<script>
				$.notify({
					title: "Error : ",
					message: "{{ $error }}",
					icon: 'fa fa-check'
					},{
						type: "danger"
					});
			</script>
			@endforeach
		</div>
		@endif
		{{-- Error Message Code : END--}}

		{{-- Error Message Code : START --}}
		@if(session()->has('message'))
		<div>
			@php
				$temp = session()->get('message');
				if(gettype($temp) == 'array'){
					$message = $temp[array_key_first($temp)];
				}
				else{
					$message = $temp;
				}
			@endphp

			<script>
				$.notify({
					title: "Success : ",
					message: "{{ $message }}",
					icon: 'fa fa-check'
					},{
						type: "success"
					});
			</script>
		</div>
		@endif
		{{-- Error Message Code : END --}}
	
		<main class="app-content">
			@yield('content')
		</main>

		<!-- Essential javascripts for application to work-->
		<script src="{{ asset('adminPanel/js/inputValidation.js') }}"></script>
		<script src="{{asset('adminPanel/js/jquery-3.2.1.min.js')}}"></script>
		<script src=" {{asset('adminPanel/js/popper.min.js')}}"></script>
		<script src="{{asset('adminPanel/js/bootstrap.min.js')}}"></script>
		<script src="{{asset('adminPanel/js/main.js')}}"></script>

		<!-- New Create JS for Feature-->
		<script src="{{asset('adminPanel/js/filePreview.js')}}"></script>
		<script src="{{asset('adminPanel/js/searchInTable.js')}}"></script>

		<!-- The javascript plugin to display page loading on top-->
		<script src=" {{asset('adminPanel/js/plugins/pace.min.js')}}"></script>

		<!-- font Awesome -->
		<script src="https://kit.fontawesome.com/c645529b0c.js"></script>

	</body>
</html>
