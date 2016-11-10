<?php

/*
|--------------------------------------------------------------------------
| Application Routes
|--------------------------------------------------------------------------
|
| Here is where you can register all of the routes for an application.
| It's a breeze. Simply tell Laravel the URIs it should respond to
| and give it the controller to call when that URI is requested.
|
*/

Route::get('/', 'WelcomeController@index');

Route::get('home', 'HomeController@index');

Route::controllers([
	'auth' => 'Auth\AuthController',
	'password' => 'Auth\PasswordController',
]);

Route::get('license', 'LicenseController@index');

/*
|--------------------------------------------------------------------------
| FROM THE TUTORIAL STUFF
|--------------------------------------------------------------------------
*/

// create an item
Route::post('test', function() {
	echo 'post'; 
});

// read an item
Route::get('test', function() {
	echo 'get'; 
});

// update an item
Route::put('test', function() {
	echo 'put'; 
});

// delete an item
Route::delete('test', function() {
	echo 'delete'; 
});
