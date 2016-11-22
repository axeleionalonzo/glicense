<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="utf-8">
	<meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="description" content="">
    <meta name="viewport" content="initial-scale=1, maximum-scale=1, user-scalable=no" />

	<title>License</title>

	<!-- Styles -->
	<link href="{{ asset('/css/app.css') }}" rel="stylesheet">
	<link href="{{ asset('/css/style.css') }}" rel="stylesheet">

	<!-- Fonts -->
	<link href="//fonts.googleapis.com/css?family=Roboto:700,400,300" rel="stylesheet" type="text/css">
	<link href="{{ asset('/css/material-icon.css') }}" rel="stylesheet">

	<!-- Scripts -->
	<script src="{{ asset('/js/services/jquery.min.js') }}"></script>
	<script src="{{ asset('/js/services/bootstrap.min.js') }}"></script>

	<!--AngularJS-->
	<script src="{{ asset('/js/services/angular.min.js') }}"></script> <!-- load angular -->
	<script src="{{ asset('/js/services/jquery.floatThead.min.js') }}"></script>
	<script src="{{ asset('/js/app.js') }}"></script>
</head>
<body>
	<nav class="navbar navbar-default">
		<div class="container-fluid">
			<div class="navbar-header">
				<button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#bs-example-navbar-collapse-1">
					<span class="sr-only">Toggle Navigation</span>
					<span class="icon-bar"></span>
					<span class="icon-bar"></span>
					<span class="icon-bar"></span>
				</button>
				<a class="navbar-brand" href="#">License</a>
			</div>

			<div class="collapse navbar-collapse" id="bs-example-navbar-collapse-1">
				<ul class="nav navbar-nav">
					<li><a href="{{ url('/') }}">Home</a></li>
				</ul>

				<ul class="nav navbar-nav navbar-right">
					@if (Auth::guest())
						<li><a href="{{ url('/auth/login') }}">Login</a></li>
						<li><a href="{{ url('/auth/register') }}">Register</a></li>
					@else
						<li class="dropdown">
							<a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-expanded="false">{{ Auth::user()->name }} <span class="caret"></span></a>
							<ul class="dropdown-menu" role="menu">
								<li><a href="{{ url('/auth/logout') }}">Logout</a></li>
							</ul>
						</li>
					@endif
				</ul>
			</div>
		</div>
	</nav>
	
	@yield('content')

</body>
</html>
