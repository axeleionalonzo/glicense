var app = angular.module('licenseApp', ['chieffancypants.loadingBar'], function($interpolateProvider) {
	$interpolateProvider.startSymbol('<%');
	$interpolateProvider.endSymbol('%>');
}).config(function(cfpLoadingBarProvider) {
	cfpLoadingBarProvider.includeSpinner = false; // toggle spinner
    cfpLoadingBarProvider.includeBar = true; // toggle loading bar
})

app.controller('licenseController', function($scope, $interval, $http) {

	$scope.loading = false;
	$scope.licenses = [];
	$scope.genData = [];
	$scope.act_date = "...";
	$scope.genData.status = 0;
	$scope.genData.toGenerate = 1;
	$scope.license = "";

	// controls the ticking time on adding a license
	var tick = function() {
		$scope.act_date = new Date();
	}
	tick();
	$interval(tick, 1000);

	// handler controllers
	function handlers() {
		$("#draggable").draggable();
		$('[data-toggle="popover"]').popover();
	    $("#menu-toggle").click(function(e) {
	        e.preventDefault();
	        $("#wrapper").toggleClass("toggled");
	    });
	}

	// parse string and int with 000
	function pad(str, max) {
		str = str.toString();
		return str.length < max ? pad("0" + str, max) : str;
	}

	// handles the verification
	function verify() {

	}

	// loads the licenses
	$scope.init = function() {
		handlers(); // load handlers
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
				messageBox = $("div#snackbar");
				messageBox.fadeIn("slow"); // show snackbar message

				$.each(data.status, function(field, message ) {
					console.debug(field + ": " + message );
					messageBox.html("Something went wrong: "+message);
				});


				// After 3 seconds, remove the show class from DIV
				setTimeout(function(){ messageBox.fadeOut("slow") }, 4000);
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
				messageBox = $("div#snackbar");
				messageBox.fadeIn("slow"); // show snackbar message

				$.each(data.status, function(field, message ) {
					console.debug(field + ": " + message );
					messageBox.html("Something went wrong: "+message);
				});
				
				// After 3 seconds, remove the show class from DIV
				setTimeout(function(){ messageBox.fadeOut("slow") }, 4000);
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

	// deletes the motha fucka license :D
	$scope.generate = function() {
		$scope.loading = true;

		var licToGen = $scope.genData.toGenerate;
		var licensesAct = $scope.genData.act_code;

		if (licToGen) {
			var act_date = $scope.act_date.toISOString().slice(0, 19).replace('T', ' ');
			var codeIndex = 1;
			for (var i = licToGen - 1; i >= 0; i--) {
				var act_code = licensesAct + pad(codeIndex, 3);

				$http.post('./api/license', {
					act_code		: act_code,
					organization 	: $scope.genData.organization,
					status			: $scope.genData.status,
					device_code		: 0,
					project			: $scope.genData.project,
					act_date		: act_date
				}).success(function(data, status, headers, config) {
					if (data.success) {
						$scope.licenses.push(data.license); // adds the new license to the view
						$('#addLicenseModal').modal('hide');
						// removes the filled inputs value
						$scope.genData.toGenerate = 1;
						$scope.genData.act_code = "";
						$scope.genData.organization = "";
						$scope.genData.project = "";
						// reset errors on the input
						$scope.licgenform.$setPristine();
						$scope.licgenform.$setUntouched();

						// $('div[class="input-group"]').removeClass('has-error');
						// $('div[class="form-group"]').removeClass('has-error');
						$scope.loading = false;
					} else {
						$.each(data.status, function(field, message ) {
							console.debug(field + ": " + message );
						});
					}
				});

				codeIndex++;
			}
		}
	};

	$scope.init();
});

// nothing fancy custom directives // =====================================================/
// retrieves the licenses view from licenses.html
app.directive('licenses', function() {
  return {
    templateUrl: 'js/templates/licenses.html'
  };
});

// app.directive('licmenu', function() {
//   return {
//     templateUrl: 'js/templates/lic-menu.html'
//   };
// });

app.directive('addlicense', function() {
  return {
    templateUrl: 'js/templates/add-license.html'
  };
});