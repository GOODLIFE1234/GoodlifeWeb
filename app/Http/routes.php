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

Route::get('/', function () {
    return view('welcome');
});

Route::auth();

/*
 * 	GET Method
 */
/*REST API*/
Route::group(['prefix' => 'api'], function () {
    Route::get('foods', 'RestController@getFoods');
    Route::get('exercises', 'RestController@getExercise');
});

Route::get('/home', 'HomeController@index');
Route::get('/bmi', 'HomeController@getBMI');
Route::get('/foods-calculator', 'HomeController@getFoods');
Route::get('/exercises-calculator', 'HomeController@getExercise');

