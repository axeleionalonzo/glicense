<script src="{{ asset('/js/services/jquery.min.js') }}"></script>
<!-- <script src="https://code.jquery.com/ui/1.12.1/jquery-ui.js"></script> -->
<script src="{{ asset('/js/services/bootstrap.min.js') }}"></script>
<script src="{{ asset('/js/services/materialize.js') }}"></script>
<!-- <script src="{{ asset('/js/services/jquery.floatThead.js') }}"></script> -->

<script type="text/javascript">
	// initialize materialize js
	$( document ).ready(function(){
		$(".button-collapse").sideNav();
		$(".dropdown-button").dropdown();
		$(".modal").modal();

	    $(".loginbox .card-action").fadeIn(1000);
	});
</script>
<!--AngularJS-->
<script src="{{ asset('/js/services/angular.min.js') }}"></script> <!-- load angular -->
<script src="{{ asset('/js/services/angular-animate.min.js') }}"></script>
<!-- <script src="{{ asset('/js/services/angular-validator.min.js') }}"></script> -->
<script src="{{ asset('/js/services/loading-bar.js') }}"></script>
<script src="{{ asset('/js/app.js') }}"></script>