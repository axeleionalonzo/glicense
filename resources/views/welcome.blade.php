<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="utf-8">
	<meta http-equiv="X-UA-Compatible" content="IE=edge">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<title>License</title>


	<!-- Styles -->
    @include('layout.style')
	<link href='//fonts.googleapis.com/css?family=Lato:300,100' rel='stylesheet' type='text/css'>

	<style>
		.bodeh {
			margin-top: 200px;
			padding: 0;
			width: 100%;
			height: 100%;
			color: #B0BEC5;
			display: table;
			font-weight: 100;
			font-family: 'Lato';
		}

		.container-bodeh {
			text-align: center;
			display: table-cell;
			vertical-align: middle;
		}

		.content-bodeh {
			text-align: center;
			display: inline-block;
		}

		.title-bodeh {
			display: none;
			font-size: 96px;
			margin-bottom: 40px;
		}

		.quote-bodeh {
			display: none;
			font-weight: 300;
			font-size: 24px;
		}

		.geo {
			color: #2E7D32;
		}

		.intel {
			color: #3F51B5;
		}
	</style>
</head>
</body>
	<nav class="top-nav white">
		<div class="nav-container">
			<div class="nav-wrapper">
				<ul class="right default-text">
					<li><a href="{{ url('/auth/login') }}">Login</a></li>
					<li><a href="{{ url('/auth/register') }}">Register</a></li>
				</ul>
			</div>
		</div>
	</nav>

	<div class="bodeh">
		<div class="container-bodeh">
			<div class="content-bodeh">
				<div class="title-bodeh"><span class="geo">Geo</span> <span class="intel">Intel</span></div>
				<div class="quote-bodeh">{{ Inspiring::quote() }}</div>
			</div>
		</div>
	</div class="bodeh">

	<!-- Scripts -->
	<script src="//cdnjs.cloudflare.com/ajax/libs/jquery/2.1.3/jquery.min.js"></script>
	<script src="//cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/3.3.1/js/bootstrap.min.js"></script>
	<script type="text/javascript">
		$( document ).ready(function(){
			$(".title-bodeh").fadeIn(1000);
			$(".quote-bodeh").delay(1000).fadeIn(1000);
		});
	</script>
</html>
