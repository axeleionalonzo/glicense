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
					<div class="valign col geoimgfooterbox">
						<img class="geofooter" src="{{ asset('/img/geo.png') }}">
					</div>
					<div class="valign col geolabelfooterbox">
						<h5 class="default-text">geoHMI</h5>
						<a href="https://play.google.com/store/apps/details?id=com.tecsq.geoHMI&hl=en" class="black-text text-lighten-4">Get the app.</a>
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
