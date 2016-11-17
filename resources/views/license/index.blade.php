@extends('app')

@section('content')
<div class="container" ng-app="licenseApp" ng-controller="licenseController">
	<div class="col-md-12">
		<div class="row">
			<licenses></licenses>
		</div>
	</div>
</div>
@endsection