@extends('app')
	
<?php $greetings = array(
	"Hola!",
	"Indo!",
	"Bonjour!",
	"Ciao!",
	"Ola!",
	"Namaste!",
	"Salaam!",
	"Konnichiwa!",
	"Merhaba!",
	"Jambo!",
	"Ni Hau!",
	"Hallo!",
	"Hello!");
?>

@section('content')
<div class="container-fluid">
	<div class="row">
		<div class="section no-pad-bot" id="index-banner">
			<div class="container col s12 m8 l4 offset-l4 offset-m2">
				<img class="geologo center-image" src="{{ asset('/img/geo.png') }}">
				<h1 class="center amber-text text-accent-2 appname"><span class="green-text text-darken-3">Geo</span> <span class="indigo-text">Intel</span></h1>
				<div class="direcbox">
					<p class="center grey-text text-darken-2">Sign in to continue using Geo Intel</p>
				</div>
			</div>
		</div>
		<div class="container">
			<div class="row">
				<div class="col s12 m8 l4 offset-l4 offset-m2">
					<div class="card">
						<div class="loginbox">
							<div class="card-content">
								<div class="greetingbox">
									<p class="center grey-text greetings"><?php echo $greetings[array_rand($greetings)]; ?></p>
									<!-- <p id="geo-greeting" class="center grey-text greetings"></p> -->
								</div>
							</div>
							<div class="card-action">
								<form class="form-horizontal" role="form" method="POST" action="{{ url('/auth/login') }}">
									<input type="hidden" name="_token" value="{{ csrf_token() }}">

									<div class="row loginform">
										<div class="form-group">
											<div class="col s12">
												<label for="email" class="email" data-error="Invalid Email">Email</label>
												<input id="email" type="email" name="email" class="validate" value="{{ old('email') }}">
											</div>
										</div>
										<div class="form-group">
											<div class="col s12 topmaginhide">
												<label for="password" class="password" data-error="wrong">Password</label>
												<input id="password" type="password" name="password" class="validate">
											</div>
										</div>

										
										<div class="form-group">
											<!-- <div class="col s12 checkbox topmaginhide">
												<input type="checkbox" class="filled-in" id="filled-in-box" name="remember" />
												<label for="filled-in-box">Remember Me</label>
											</div> -->
											<div class="input-field col s12">
												<button id="login" type="submit" class="waves-effect waves-light btn col s12 loginbutton indigo">Login</button>
												<!-- <a class="btn btn-link" href="{{ url('/password/email') }}">Forgot Your Password?</a> -->
											</div>
										</div>
										

										<div class="form-group">
											<div id="error" class="input-field col s12">
												@if (count($errors) > 0)
													<div class="alert alert-danger">
														<br>
														<div class="error-message error">
															<strong>Whoops!</strong> There were some problems with your input.<br><br>
															<ul>
																@foreach ($errors->all() as $error)
																	<li>{{ $error }}</li>
																@endforeach
															</ul>
														</div>
													</div>
												@endif
											</div>
										</div>
									</div>
								</form>
							</div>
						</div>

						<!-- <div id="card_action" class="card-action">
							<div class="row">
								<div id="landing_email" class="col s12">
								</div>
								<div id="landing_password" class="col s12">
								</div>
							</div>
						</div> -->
					</div>
				</div>
			</div>
		</div>
	</div>
</div>
@endsection
