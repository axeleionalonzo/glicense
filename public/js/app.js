var app = angular.module('licenseApp', ['clickOut'], function($interpolateProvider) {
	$interpolateProvider.startSymbol('<%');
	$interpolateProvider.endSymbol('%>');
});

app.controller('licenseController', function($scope, $http) {

	$scope.licenses = [];
	$scope.loading = false;

	// loads the licenses
	$scope.init = function() {
		$scope.loading = true;

		$http.get('/api/license').
		success(function(data, status, headers, config) {
			$scope.licenses = data;
			$scope.loading = false;
		});
	}

	$scope.addLicense = function() {
		$scope.loading = true;
		$http.post('/api/license', {
			act_code:		$scope.license.act_code,
			organization:	$scope.license.organization,
			status:			$scope.license.status,
			device_code:	$scope.license.device_code,
			project:		$scope.license.project,
			act_date:		$scope.license.act_date
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

	$scope.hide = function() {
		alert("asd");
	};

	$scope.getLicense = function(index) {
		$scope.loading = true;
		$scope.licenses[index].editing = true;
		
		var license = $scope.licenses[index];

		var makeEdits = $('tr#'+ license.id);
		makeEdits.find('input').removeAttr('readonly');
		// console.log(makeEdits);
	};

	$scope.updateLicense = function(index) {
		$scope.loading = true;
		var license = $scope.licenses[index];

		$http.put('/api/license/' + license.id, {
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
		});;
	};

	$scope.deleteLicense = function(index) {
		if (confirm("sure to delete")) {
			$scope.loading = true;

			var license = $scope.licenses[index];

			$http({
				method: 'DELETE',
				url: '/api/license/' + license.id
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

			// $http.delete('/api/license/' + license.id)
			// 	.success(function(data, status, headers)  {
			// 		$scope.license.splice(index, 1);
			// 		$scope.loading = false;
			// 	}).error(function(data, status, header, config) {
			//         $scope.ServerResponse = console.log("Data: " + data +
			//             "\n\n\n\nstatus: " + status +
			//             "\n\n\n\nheaders: " + header +
			//             "\n\n\n\nconfig: " + config);
			//     });
		}

	};

	$scope.init();

});

