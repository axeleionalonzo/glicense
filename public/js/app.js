var app = angular.module('licenseApp', ['ngAnimate', 'chieffancypants.loadingBar'], function($interpolateProvider) {
	$interpolateProvider.startSymbol('[[');
	$interpolateProvider.endSymbol(']]');
}).config(function(cfpLoadingBarProvider) {
	cfpLoadingBarProvider.includeSpinner = false; // toggle spinner
    cfpLoadingBarProvider.includeBar = true; // toggle loading bar
})

app.controller('licenseController', function($scope, $interval, $http, $filter) {

	$scope.loading = false;
	$scope.licenses = [];
	$scope.genData = [];
	$scope.act_date = "...";
	$scope.genData.status = 0;
	$scope.license = "";
	$scope.sortType = 'act_date'; // set the default sort type
	$scope.sortReverse = false; // set the default sort order
	$scope.searchLicense = ""; // set the default search/filter term
	$scope.placeholder = "I'm feeling lucky"; // set the default search/filter term

	// controls the ticking time on adding a license
	var tick = function() {
		$scope.act_date = new Date();
	}
	tick();
	$interval(tick, 1000);

	var onModalHide = function() {
		$scope.licgenform.$setPristine();
		$scope.licgenform.$setUntouched();
	};

	// handler controllers
	function handlers() {
	    $("#menu-toggle").click(function(e) {
	        e.preventDefault();
	        $("#wrapper").toggleClass("toggled");
	    });

		$("#close_instruction").click(function(e) {
	        e.preventDefault();
	        $(this).parent().parent().parent().fadeOut();
	    });

		$("#addLicenseModal").modal({
		    complete : onModalHide
		});
	}

	// handler controllers
	function removeHandlers() {
	    $("#menu-toggle").off();
		$("#close_instruction").off();
		$("#addLicenseModal").off();
	}

	function refreshHandlers() {
		removeHandlers();
		handlers();
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
		$scope.loading = true;

		$http.get('./api/license').
		success(function(data, status, headers, config) {
			$scope.licenses = data;
			$scope.loading = false;
			refreshHandlers(); // load handlers
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
				refreshHandlers(); // load handlers
			} else {
				Materialize.toast("Something went wrong!", 4000, 'red');
				$.each(data.status, function(field, message ) {
					console.debug(field + ": " + message );
					Materialize.toast(message, 4000);
				});
			}
		});
	};


	$scope.toDelete = function(license) {
		$scope.loading = true;

    	var index = $scope.licenses.indexOf($filter('filter')($scope.licenses, {id: license.id })[0]);
		$scope.confirmation = $scope.licenses[index].act_code;

		$('#confirmDelete').modal('open');

		$scope.deleteindex = index;
	};

	// gets the license details ready for edit
	// makes the table row editabel
	$scope.getLicense = function(license) {
		$scope.loading = true;

		// change the button to edit mode using angular filter array
		$filter('filter')($scope.licenses, {id: license.id })[0].editing = 1;

		var el = $('tr#'+ license.id);
		el.find('input[data="canEdit"]').removeAttr('readonly');
	};

	// updates the editable license
	$scope.updateLicense = function(license) {
		$scope.loading = true;
		var license = $filter('filter')($scope.licenses, {id: license.id })[0];
		$filter('filter')($scope.licenses, {id: license.id })[0].loading = 1; // show loading

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
    			var index = $scope.licenses.indexOf($filter('filter')($scope.licenses, {id: license.id })[0]);
				$filter('filter')($scope.licenses, {id: license.id })[0].loading = 0;
				$scope.licenses[index] = data.license;
				$scope.loading = false;
				refreshHandlers(); // load handlers
			} else {
				Materialize.toast("Something went wrong!", 4000, 'red');
				$.each(data.status, function(field, message ) {
					console.debug(field + ": " + message );
					Materialize.toast(message, 4000);
				});
			}
		});
	};

	// deletes the motha fucka license :D
	$scope.deleteLicense = function(index) {
		$scope.loading = true;
		var license = $scope.licenses[index];

		$http({
			method: 'DELETE',
			url: './api/license/' + license.id
		}).then(function successCallback(response) {
			// this callback will be called asynchronously
			// when the response is available
			$('#confirmDelete').modal('close');
			$scope.licenses.splice(index, 1);
			$scope.loading = false;
			refreshHandlers(); // load handlers
		}, function errorCallback(response) {
			// called asynchronously if an error occurs
			// or server returns response with an error status.
			Materialize.toast("Something went wrong: "+message, 4000, 'red');
		});
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
						$('#addLicenseModal').modal('close');
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
						Materialize.toast("Something went wrong!", 4000, 'red');
						$.each(data.status, function(field, message ) {
							console.debug(field + ": " + message );
							Materialize.toast(message, 4000);
						});
					}
				});

				codeIndex++;
			}
			refreshHandlers(); // load handlers
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

// app.directive('licmenu', function() {
//   return {
//     templateUrl: 'js/templates/lic-menu.html'
//   };
// });

app.directive('addlicense', function() {
  return {
  	restrict: 'E',
    templateUrl: 'js/templates/add-license.html'
  };
});

app.directive('deletelicense', function() {
  return {
  	restrict: 'E',
    templateUrl: 'js/templates/delete-license.html'
  };
});