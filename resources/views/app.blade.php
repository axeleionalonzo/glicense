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
	<link href="{{ asset('/css/simple-sidebar.css') }}" rel="stylesheet">
	<link href="{{ asset('/css/loading-bar.css') }}" rel="stylesheet">

	<!-- Fonts -->
	<link href="//fonts.googleapis.com/css?family=Roboto:700,400,300" rel="stylesheet" type="text/css">
	<link href="{{ asset('/css/material-icon.css') }}" rel="stylesheet">

	<!-- Scripts -->
	<script src="{{ asset('/js/services/jquery.min.js') }}"></script>
	<script src="{{ asset('/js/services/bootstrap.min.js') }}"></script>
	<script src="https://code.jquery.com/ui/1.12.1/jquery-ui.js"></script>

	<!--AngularJS-->
	<script src="{{ asset('/js/services/angular.min.js') }}"></script> <!-- load angular -->
	<script src="{{ asset('/js/services/jquery.floatThead.min.js') }}"></script>
	<script src="{{ asset('/js/services/angular-validator.min.js') }}"></script>
	<script src="{{ asset('/js/services/loading-bar.js') }}"></script>
	<script src="{{ asset('/js/app.js') }}"></script>
</head>
<body>

    <div id="wrapper" ng-app="licenseApp" ng-controller="licenseController">

        <!-- Sidebar -->
        <div id="sidebar-wrapper">
            <ul class="sidebar-nav">
                <li class="sidebar-brand">
                    <a href="{{ url('/') }}">
                        GeoIntel License
                    </a>
                </li>
                <li>
                    <a href="#" data-toggle="modal" data-target="#addLicenseModal">Add License</a>
                </li>
                <!-- <li>
                    <a href="#">Shortcuts</a>
                </li>
                <li>
                    <a href="#">Overview</a>
                </li>
                <li>
                    <a href="#">Events</a>
                </li>
                <li>
                    <a href="#">About</a>
                </li>
                <li>
                    <a href="#">Services</a>
                </li>
                <li>
                    <a href="#">Contact</a>
                </li> -->
            </ul>
        </div>
        <!-- /#sidebar-wrapper -->

        <!-- Navbar wrapper -->
		<nav class="navbar navbar-default makemewhite">
			<div class="container-fluid">
				<div class="navbar-header">
					<button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#bs-example-navbar-collapse-1">
						<span class="sr-only">Toggle Navigation</span>
						<span class="icon-bar"></span>
						<span class="icon-bar"></span>
						<span class="icon-bar"></span>
					</button>
					<a class="navbar-brand" href="#menu-toggle" id="menu-toggle">License</a>
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
        <!-- /Navbar wrapper -->

        <!-- Page Content -->
        <div id="page-content-wrapper">
            <div class="container-fluid">
                <div class="row">
                	<div class="jumbotron header">
	                    <h1 class="title">How to use ..</h1>

	                    <div class="instruction">
		                    <p>Active Licenses are <span class="info">highlighted as blue</span>.</p>
		                    <p>Generate multiple licenses using the sidemenu.</p>
		                    <p>You can quick add License with the form <span class="warning">highlighted as yellow</span> below.</p>
		                    <p>Double click the row of the license you want to update.</p>
	                    </div>
	                </div>

					@yield('content')

					<div id="snackbar">...</div>
                </div>
            </div>
        </div>
        <!-- /#page-content-wrapper -->

    </div>
    <!-- /#wrapper -->

</body>
</html>
