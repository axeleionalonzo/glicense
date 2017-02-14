@extends('app')

@section('content')

<div ng-app="licenseApp" ng-controller="licenseController">

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
	        <li>
	            <a href="#genLicenseModal" id="genlicense">Generate Licenses</a>
	        </li>
	    </ul>
	</div>
	<!-- /#sidebar-wrapper -->

	<!-- Navbar wrapper -->
	<ul id="userdropdown" class="dropdown-content">
		<li><a id="logout" href="{{ url('/auth/logout') }}">Logout</a></li>
	</ul>
	<nav class="top-nav white">
		<div class="nav-container">
			<div class="nav-wrapper">
				<div class="brand-logo">
					<a href="#menu-toggle" id="menu-toggle" class="default-text">Licenses</a>
				</div>
				<!-- Dropdown Trigger -->
				<ul class="pull-right default-text">
					<li><a class="dropdown-button" href="#!" data-activates="userdropdown">{{ Auth::user()->name }} <i class="material-icons right">arrow_drop_down</i></a></li>
				</ul>
			</div>
		</div>
	</nav>
	<!-- /Navbar wrapper -->

	<!-- Page Content -->
	<div class="contentbox" id="page-content-wrapper content">
	    <div class="container-fluid">
	        <div class="row">
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

	            <div class="row licenses">
					<nav class="indigo searchbox">
						<div class="nav-wrapper">
							<form>
								<div class="input-field">
									<input id="search" type="search" ng-model="searchLicense" placeholder="[[ placeholder ]]" required>
									<label for="search"><i class="material-icons">search</i></label>
									<i ng-click="searchLicense = ''" class="material-icons">close</i>
								</div>
							</form>
						</div>
					</nav>

					<div class="col-md-12">
						<div class="row">
							<licenses></licenses>
						</div>
					</div>

					<!-- MODALS -->
					<!-- add licenses modal -->
					<div id="addLicenseModal" class="addLicenseModal modal modal-fixed-footer bottom-sheet">
						<addlicense></addlicense>
					</div>
					<!-- generate licenses modal -->
					<div id="genLicenseModal" class="modal modal-fixed-footer bottom-sheet">
						<genlicense></genlicense>
					</div>
					<!-- confirm delete modal -->
					<div id="confirmDelete" class="modal modal-fixed-footer bottom-sheet">
						<deletelicense></deletelicense>
					</div>
					<!-- /#MODALS -->
	            </div>
	        </div>
	    </div>
	    <!-- forces the footer at the bottom if there is no content :D -->
	</div>
</div>
<!-- /#page-content-wrapper -->
@endsection

@section('footer')
	<script type="text/javascript">
		// initialize materialize js
		$( document ).ready(function(){
			$(".button-collapse").sideNav();
			$(".dropdown-button").dropdown();
			$(".modal").modal();
		});
	</script>
@endsection