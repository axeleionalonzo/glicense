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
    
	@yield('header')

	<link rel="shortcut icon" href="{{ url('/favicon.ico') }}">
</head>
<body>

	@if (!Auth::guest())
	<div id="wrapper">
    @endif

		@yield('content')

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
    @endif

    <!-- Scripts -->
    @include('layout.script')

	@yield('footer')

</body>
</html>
