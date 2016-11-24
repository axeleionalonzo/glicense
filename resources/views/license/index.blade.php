@extends('app')

@section('content')
<div class="container" ng-app="licenseApp" ng-controller="licenseController">
	<div class="col-md-12">
		<div class="row menu">
			<licmenu></licmenu>
			<!-- Modal -->
			<div class="modal fade" id="addLicenseModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
				<div id="draggable" class="modal-dialog modal-md" role="document">
					<addlicense></addlicense>
				</div>
			</div>
		</div>
		<div class="row">
			<licenses></licenses>
		</div>
	</div>
</div>
@endsection