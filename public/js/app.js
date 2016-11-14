var app = angular.module('licenseApp', [], function($interpolateProvider) {
	$interpolateProvider.startSymbol('<%');
	$interpolateProvider.endSymbol('%>');
});

app.controller('licenseController', function($scope, $http) {

	$scope.licenses = [];
	$scope.loading = false;

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
			act_code:	$scope.license.act_code,
			act_code:	$scope.license.organization,
			act_code:	$scope.license.status,
			act_code:	$scope.license.device_code,
			act_code:	$scope.license.project,
			act_code:	$scope.license.act_date
		}).success(function(data, status, headers, config) {
			$scope.license.push(data);
			$scope.license = '';
			$scope.loading = false;
		});
	};

	$scope.updateLicense = function(license) {
		$scope.loading = true;

		$http.put('/api/license/' + license.act_id, {
			act_code: 	license.act_code
		}).success(function(data, status, headers, config) {
			license = data;
			$scope.loading = false;

		});;
	};

	$scope.deleteLicense = function(index) {
		if (confirm("sure to delete")) {
			$scope.loading = true;

			var license = $scope.licenses[index];

			$http({
				method: 'DELETE',
				url: '/api/license/' + license.act_id
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

			// $http.delete('/api/license/' + license.act_id)
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

