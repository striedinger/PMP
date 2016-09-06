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
header('Access-Control-Allow-Origin: http://localhost:8888');
header('Access-Control-Allow-Origin: *');
header('Access-Control-Allow-Methods: GET, POST, PATCH, PUT, DELETE, OPTIONS');
header('Access-Control-Allow-Headers: Origin, Content-Type, X-Auth-Token');

$api = app('Dingo\Api\Routing\Router');

$api->version('v1', ['middlware' => 'cors'],function ($api) {
	$api->get('/sessions/{id}/questions', 'App\Http\Controllers\ApiController@questions');
	$api->post('/sessions/{id}', 'App\Http\Controllers\ApiController@saveAnswer');
	$api->post('/sessions/{id}/start', 'App\Http\Controllers\ApiController@startSession');
	$api->post('/sessions/{id}/end', 'App\Http\Controllers\ApiController@endSession');
});

Route::get('/', function () {
    return view('welcome');
});

Route::auth();

Route::get('/home', 'HomeController@index');

//Users

Route::get('/users', 'UserController@index');

Route::get('/users/update/{id}', 'UserController@update');

Route::post('/users/update/{id}', 'UserController@update');

Route::delete('/users/delete/{id}', 'UserController@delete');

//Exams

Route::get('/exams', 'ExamController@index');

Route::get('/exams/create', 'ExamController@create');

Route::post('/exams/create', 'ExamController@create');

Route::get('/exams/update/{id}', 'ExamController@update');

Route::post('/exams/update/{id}', 'ExamController@update');

Route::delete('/exams/delete/{id}', 'ExamController@delete');

//Questions

Route::get('/questions', 'QuestionController@index');

Route::get('/questions/create', 'QuestionController@create');

Route::post('/questions/create', 'QuestionController@create');

Route::get('/questions/update/{id}', 'QuestionController@update');

Route::post('/questions/update/{id}', 'QuestionController@update');

Route::delete('/questions/delete/{id}', 'QuestionController@delete');

//Sessions

Route::get('/sessions/{id}', 'SessionController@update');

Route::get('/sessions/create/{id}', 'SessionController@create');

//Results

Route::get('/results', 'ResultController@index');

Route::get('/results/{id}', 'ResultController@view');

//Transactions

Route::post('/transactions/create/{id}', 'TransactionController@create');


