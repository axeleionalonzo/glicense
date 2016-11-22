var app = angular.module('licenseApp', [], function($interpolateProvider) {
	$interpolateProvider.startSymbol('<%');
	$interpolateProvider.endSymbol('%>');
});

app.controller('licenseController', function($scope, $interval, $http) {

	$scope.licenses = [];
	$scope.loading = false;
	$scope.act_date = "...";

	// controls the ticking time on adding a license
	var tick = function() {
		$scope.act_date = new Date();
	}
	tick();
	$interval(tick, 1000);

	// loads the licenses
	$scope.init = function() {
		$scope.loading = true;

		$http.get('./api/license').
		success(function(data, status, headers, config) {
			$scope.licenses = data;
			$scope.loading = false;
		});
	}

	// adds license
	$scope.addLicense = function() {
		$scope.loading = true;

		// gets js datetime ready for mysql datetime
		var act_date = $scope.act_date.toISOString().slice(0, 19).replace('T', ' ');

		$http.post('./api/license', {
			act_code:		$scope.license.act_code,
			organization:	$scope.license.organization,
			status:			$scope.license.status,
			device_code:	$scope.license.device_code,
			project:		$scope.license.project,
			act_date:		act_date
		}).success(function(data, status, headers, config) {
			if (data.success) {
				$scope.licenses.push(data.license); // adds the new license to the view
				$scope.license = ""; // clears the input fields
				$scope.loading = false;
			} else {
				$.each(data.status, function(field, message ) {
					console.debug(field + ": " + message );
				});
			}
		});
	};

	// gets the license details ready for edit
	// makes the table row editabel
	$scope.getLicense = function(index) {
		$scope.loading = true;
		$scope.licenses[index].editing = 1;

		var license = $scope.licenses[index];
		var el = $('tr#'+ license.id);

		el.find('input[data="canEdit"]').removeAttr('readonly');
	};

	// updates the editable license
	$scope.updateLicense = function(index) {
		$scope.loading = true;
		var license = $scope.licenses[index];

		if (license.status == undefined) {
			console.debug("status: Must be a boolean value (0,1)");
			license.status = 0;
		}

		$http.put('./api/license/' + license.id, {
			act_code:		license.act_code,
			organization:	license.organization,
			status:			license.status,
			device_code:	license.device_code,
			project:		license.project,
			act_date:		license.act_date
		}).success(function(data, status, headers, config) {
			if (data.success) {
				$scope.licenses[index] = data.license;
				$scope.loading = false;
			} else {
				$.each(data.status, function(field, message ) {
					console.debug(field + ": " + message );
				});
			}
		});
	};

	// deletes the motha fucka license :D
	$scope.deleteLicense = function(index) {
		if (confirm("sure to delete")) {
			$scope.loading = true;

			var license = $scope.licenses[index];

			$http({
				method: 'DELETE',
				url: './api/license/' + license.id
			}).then(function successCallback(response) {
				// this callback will be called asynchronously
				// when the response is available
				$scope.licenses.splice(index, 1);
				$scope.loading = false;
			}, function errorCallback(response) {
				// called asynchronously if an error occurs
				// or server returns response with an error status.
				console.log(response);
			});
		}
	};

	$scope.init();

});

// nothing fancy custom directives // =====================================================/
// retrieves the licenses view from licenses.html
app.directive('licenses', function() {
  return {
    restrict: 'E',
    templateUrl: 'js/templates/licenses.html'
  };
});