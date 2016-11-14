@extends('app')

@section('content')
<div class="container" ng-app="licenseApp" ng-controller="licenseController">
	<div class="col-md-12">
		<div class="row">
			<div class="table-responsive">
				<table class="table table-bordered">
					<!-- On rows -->
					<th class=""></th>
					<th class="active">id</th>
					<th class="">activation code</th>
					<th class="">organization</th>
					<th class="">status</th>
					<th class="">device code</th>
					<th class="">project</th>
					<th class="">date</th>
					<th class=""></th>
					<!-- On cells (`td` or `th`) -->
					<tr ng-repeat='license in licenses' ng-class="license.status==1 ? 'info' : ''">
						<td><input type="checkbox" ng-true-value="1" ng-false-value="0" ng-model="license.act_code" ng-change="updateLicense(license)"></td>
						<td class="active"><% license.act_id %></td>
						<td class=""><% license.act_code %></td>
						<td class=""><% license.organization %></td>
						<td class=""><% license.status %></td>
						<td class=""><% license.device_code %></td>
						<td class=""><% license.project %></td>
						<td class=""><% license.act_date %></td>
						<td><button class="btn btn-danger btn-xs" ng-click="deleteLicense($index)"><span class="glyphicon glyphicon-trash" ></span></button></td>
					</tr>
					<tr>
						<td>...</td>
						<td class="active">...</td>
						<td class="editable"><input type="text" ng-model="license.act_code"></td>
						<td class="editable"><input type="text" ng-model="license.organization"></td>
						<td class="editable"><input type="text" ng-model="license.status"></td>
						<td class="editable"><input type="text" ng-model="license.device_code"></td>
						<td class="editable"><input type="text" ng-model="license.project"></td>
						<td class="editable"><input type="text" ng-model="license.act_date"></td>
						<td><button class="btn btn-success btn-xs" ng-click="addLicense()"><span class="glyphicon glyphicon-ok" ></span></button></td>
					</tr>
			</div>
		</div>
	</div>
</div>
@endsection