@extends('app')

@section('content')

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
<!-- generate licenses modal -->
<div id="addLicenseModal" class="modal modal-fixed-footer bottom-sheet">
	<addlicense></addlicense>
</div>
<!-- confirm delete modal -->
<div id="confirmDelete" class="modal modal-fixed-footer bottom-sheet">
	<deletelicense></deletelicense>
</div>
<!-- /#MODALS -->
@endsection