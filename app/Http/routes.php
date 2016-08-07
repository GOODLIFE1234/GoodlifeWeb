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
 *     GET Method
 */
/*REST API*/
Route::group(['prefix' => 'api'], function () {
    Route::get('foods', 'RestController@getFoods');
    Route::get('exercises', 'RestController@getExercise');
});
/*User*/
Route::get('/home', 'HomeController@index');
Route::get('/bmi', 'HomeController@getBMI');
Route::get('/foods-calculator', 'HomeController@getFoods');
Route::get('/exercises-calculator', 'HomeController@getExercise');
/*Admin*/
Route::group(['prefix' => 'admin'], function () {
/*GET*/
    Route::get('/login', 'AdminController@index');
    /*User Management*/
    Route::get('/users/edit/{id}', 'AdminController@getEditUsers');
    Route::get('/users/delete/{id}', 'AdminController@geDeleteUsers');
    Route::get('/users', 'AdminController@getUsers');
    /*Food Management*/
    Route::get('/foods/edit/{id}', 'AdminController@getEditFood');
    Route::get('/foods/delete/{id}', 'AdminController@getDeleteFood');
    Route::get('/foods/add', 'AdminController@getAddFood');
    Route::get('/foods', 'AdminController@getFoods');
    /*Exercise Management*/
    Route::get('/exercises/edit/{id}', 'AdminController@getEditExercises');
    Route::get('/exercises/delete/{id}', 'AdminController@getDeleteExercise');
    Route::get('/exercises/add', 'AdminController@getAddExercise');
    Route::get('/exercises', 'AdminController@getExercises');
/*Post*/
    Route::post('/foods/add', 'AdminController@postAddFood');
    Route::post('/foods/edit/{id}', 'AdminController@postUpdateFood');
    Route::post('/exercises/add', 'AdminController@postAddExercise');
    Route::post('/exercises/edit/{id}', 'AdminController@postUpdateExercise');
    Route::post('/users/updater', 'AdminController@postUpdateUser');
});
