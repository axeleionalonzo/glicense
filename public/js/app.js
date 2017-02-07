(function() {

// Initialize Firebase
var config = {
	apiKey: "AIzaSyBuN0-VcY1ZyCxJWmW2er0hWFfCrc5kHOc",
	authDomain: "geo-license.firebaseapp.com",
	databaseURL: "https://geo-license.firebaseio.com",
   	storageBucket: "geo-license.appspot.com",
	messagingSenderId: "6432295404"
};
// Get a reference to the database service
firebase.initializeApp(config);

var app = angular.module('licenseApp', ['chieffancypants.loadingBar', 'firebase'], function($interpolateProvider) {
	$interpolateProvider.startSymbol('[[');
	$interpolateProvider.endSymbol(']]');
}).config(function(cfpLoadingBarProvider) {
	cfpLoadingBarProvider.includeSpinner = false; // toggle spinner
    cfpLoadingBarProvider.includeBar = true; // toggle loading bar
})

app.controller('licenseController', function($scope, $interval, $http, $filter, $firebaseObject, $firebaseArray) {

	// download the data into a local object
	var ref = firebase.database().ref();

	$scope.licenses = [];
	$scope.genData = [];
	$scope.act_date = "...";
	$scope.genData.status = 0;
	$scope.license = "";
	$scope.sortType = 'act_date'; // set the default sort type
	$scope.sortReverse = false; // set the default sort order
	$scope.searchLicense = ""; // set the default search/filter term
	$scope.placeholder = "I'm feeling lucky"; // set the default search/filter term
	$scope.licenses = $firebaseArray(ref.child("licenses")); // populate licenses from firebase

	var dBRsearch = ref.child('greetings');

	// sync object changes using on()
	dBRsearch.on('value', snap => $scope.placeholder = snap.val());

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

	// adds license
	$scope.addLicense = function() {

		// gets js datetime ready for mysql datetime
		var act_date = $scope.act_date.toISOString().slice(0, 19).replace('T', ' ');
		var timestamp = new Date().valueOf(); // get id based time

		$scope.licenses.$add({
			"id":			timestamp,
			"act_code":		$scope.newLic.act_code,
			"organization":	$scope.newLic.organization,
			"status":		$scope.newLic.status,
			"device_code":	$scope.newLic.device_code,
			"project":		$scope.newLic.project,
			"act_date":		act_date
	    }).then(function() {
			// adds the new license to the view
			$scope.newLic = ""; // clears the input fields
			refreshHandlers(); // load handlers
		}, function(error) {
			Materialize.toast("Something went wrong! " + error, 4000, 'red');
		});
	};

	// gets the license details ready for edit
	// makes the table row editabel
	$scope.getLicense = function(license) {

		// change the button to edit mode using angular filter array
		var id = license.$id;
		ref.child("licenses").child(id).update({"editing": 1});

		// var el = $('tr#'+ license.id);
		// el.find('input[data="canEdit"]').removeAttr('readonly');
	};

	// updates the editable license
	$scope.updateLicense = function(license) {

		var id = license.$id;
		// ref.child("licenses").child(id).update({"loading": 1});

		if (license.status == undefined) {
			console.debug("status: Must be a boolean value (0,1)");
			license.status = 0;
		}

		var licenseData = $scope.licenses.$getRecord(id);

		var postData = {
			"id":			licenseData.id,
			"act_code":		licenseData.act_code,
			"organization":	licenseData.organization,
			"status":		licenseData.status,
			"device_code":	licenseData.device_code,
			"project":		licenseData.project,
			"act_date":		licenseData.act_date
		};
		console.log(license);

		// Write the new post's data simultaneously in the posts list and the user's post list.
		var updates = {};
		updates['/licenses/' + id] = postData;

		ref.update(updates).then(function() {
			refreshHandlers(); // load handlers
		}, function(error) {
			Materialize.toast("Something went wrong! " + error, 4000, 'red');
		});
	};

	$scope.toDelete = function(license) {

		var id = license.$id;
		$scope.confirmation = license.act_code;

		$('#confirmDelete').modal('open');

		$scope.deleteindex = license;
	};

	// deletes the motha fucka license :D
	$scope.deleteLicense = function(license) {

		$scope.licenses.$remove(license)
	};

	// generates license(s)
	$scope.generate = function() {

		var licToGen = $scope.genData.toGenerate;
		var licensesAct = $scope.genData.act_code;
		var prefix = $scope.genData.prefix;

		if (licToGen) {
			var act_date = $scope.act_date.toISOString().slice(0, 19).replace('T', ' ');
			var timestamp = new Date().valueOf(); // get id based time
			var codeIndex = prefix;
			for (var i = licToGen - 1; i >= 0; i--) {
				var act_code = licensesAct + pad(codeIndex, 3);

				$scope.licenses.$add({
					"id"			: timestamp,
					"act_code"		: act_code,
					"organization" 	: $scope.genData.organization,
					"status"		: $scope.genData.status,
					"device_code"	: 0,
					"project"		: $scope.genData.project,
					"act_date"		: act_date
			    }).then(function() {
					$('#addLicenseModal').modal('close');
					// adds the new license to the view
					$scope.genData = ""; // clears the input fields
					$scope.genData.toGenerate = 1;
					// reset errors on the input
					$scope.licgenform.$setPristine();
					$scope.licgenform.$setUntouched();
				}, function(error) {
					Materialize.toast("Something went wrong! " + error, 4000, 'red');
				});

				codeIndex++;
			}
			refreshHandlers(); // load handlers
		}
	};
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

}());
