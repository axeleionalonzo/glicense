<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="utf-8">
	<meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="description" content="">
    <meta name="viewport" content="initial-scale=1, maximum-scale=1, user-scalable=no" />

	<title>Licenses</title>

	<!-- Styles -->
    @include('layout.style')

	<link rel="shortcut icon" href="{{ url('/favicon.ico') }}">
</head>
<body>

    @if (!Auth::guest())
    <div id="wrapper" ng-app="licenseApp" ng-controller="licenseController">
    @endif


        @if (!Auth::guest())
        <!-- Sidebar -->
        <div id="sidebar-wrapper">
            <ul class="sidebar-nav">
                <li class="sidebar-brand">
                    <a href="{{ url('/') }}">
                        GeoIntel License
                    </a>
                </li>
                <li>
                    <a href="#addLicenseModal" id="addlicense">Add License</a>
                </li>
            </ul>
        </div>
        <!-- /#sidebar-wrapper -->
        @endif

        <!-- Navbar wrapper -->
		<ul id="userdropdown" class="dropdown-content">
			<li><a href="{{ url('/auth/logout') }}">Logout</a></li>
		</ul>
		<nav class="top-nav white">
			<div class="nav-container">
				<div class="nav-wrapper">
					@if (Auth::guest())
						<a href="#" data-activates="mobile-demo" class="button-collapse grey-text text-darken-3"><i class="material-icons">menu</i></a>
						<ul class="right hide-on-med-and-down default-text">
							<li><a href="{{ url('/') }}">Home</a></li>
							<li><a href="{{ url('/auth/login') }}">Login</a></li>
							<li><a href="{{ url('/auth/register') }}">Register</a></li>
						</ul>
						<ul class="side-nav default-text" id="mobile-demo">
							<li><a href="{{ url('/') }}">Home</a></li>
							<li><a href="{{ url('/auth/login') }}">Login</a></li>
							<li><a href="{{ url('/auth/register') }}">Register</a></li>
						</ul>
					@else
					<div class="brand-logo">
						<a href="#menu-toggle" id="menu-toggle" class="default-text">Licenses</a>
					</div>
						<!-- Dropdown Trigger -->
						<ul class="pull-right default-text">
							<li><a class="dropdown-button" href="#!" data-activates="userdropdown">{{ Auth::user()->name }} <i class="material-icons right">arrow_drop_down</i></a></li>
						</ul>
					@endif
				</div>
			</div>
		</nav>
        <!-- /Navbar wrapper -->

        <!-- Page Content -->
        <div class="contentbox" id="page-content-wrapper content">
            <div class="container-fluid">
                <div class="row">
        			@if (!Auth::guest())
	                <div class="row jumbotronbox">
						<div class="col s12 m12">
							<div class="card">
								<div class="card-content">
									<i id="close_instruction" class="material-icons small up pull-right">close</i>
									<span class="card-title">How to use ..</span>
						            <p >Active Licenses are <span class="locked">highlighted as blue</span>.</p>
						            <p >Generate multiple licenses using the sidemenu.</p>
						            <p >You can quick add License with the form <span class="unlocked">highlighted as green</span> below.</p>
						            <p >Double click the row of the license you want to update.</p>
								</div>
							</div>
						</div>
	                </div>
        			@endif

	                <div class="row licenses">
						@yield('content')
	                </div>
                </div>
            </div>
            <!-- forces the footer at the bottom if there is no content :D -->
        </div>
        <!-- /#page-content-wrapper -->

        <!-- FOOTER -->
		<footer class="page-footer white footer">
			<div class="container">
				<div class="row valign-wrapper">
					<div class="valign col s3 geoimgfooterbox">
						<img class="geofooter" src="{{ asset('/img/geo.png') }}">
					</div>
					<div class="valign col s3 geolabelfooterbox">
						<h5 class="default-text">Geo Intel</h5>
						<p class="black-text text-lighten-4">Get the app.</p>
					</div>
					<div class="valign col s4 offset-s2">
						<a href="https://play.google.com/store/apps/details?id=com.tecsq.geointel&hl=en" >
			    			<img class="googleplay" src="https://play.google.com/intl/en_us/badges/images/generic/en_badge_web_generic.png">
			    		</a>
						<!-- <h5 class="default-text">Links</h5>
						<ul>
							<li><a class="black-text text-lighten-3" href="#!">Link 1</a></li>
							<li><a class="black-text text-lighten-3" href="#!">Link 2</a></li>
							<li><a class="black-text text-lighten-3" href="#!">Link 3</a></li>
							<li><a class="black-text text-lighten-3" href="#!">Link 4</a></li>
						</ul> -->
					</div>
				</div>
			</div>
			<div class="footer-copyright">
				<div class="container black-text text-lighten-4">
					© 2016 All Rights Reserved
					<a class="black-text text-lighten-4 right" href="http://tecsq.com/">TEC Square Solutions Inc.</a>
				</div>
			</div>
		</footer>
        <!-- /#FOOTER -->

    @if (!Auth::guest())
    </div>
    <!-- /#wrapper -->
    @endif

    <!-- Scripts -->
    @include('layout.script')

</body>
</html>
