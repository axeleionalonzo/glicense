@extends('app')

@section('content')
<div class="container" ng-app="licenseApp" ng-controller="licenseController">
	<div class="col-md-12">
		<div class="row menu">
			<div class="inLineTable">
				<div class="menu-controllers pull-right" data-toggle="modal" data-target="#myModal"><!-- Button trigger modal -->
					<button class="btn btn-default">Add License</button>
				</div>
			</div>
		</div>
		<div class="row">
			<licenses></licenses>
		</div>
	</div>
</div>







<!-- Modal -->
<div class="modal fade" id="myModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
	<div class="modal-dialog modal-lg" role="document">
		<div class="modal-content">
			<div class="modal-header">
				<button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
				<h4 class="modal-title" id="myModalLabel">Generate License</h4>
			</div>
			<div class="modal-body">
				...
			</div>
			<div class="modal-footer">
				<button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
				<button type="button" class="btn btn-primary">Save changes</button>
			</div>
		</div>
	</div>
</div>
@endsection