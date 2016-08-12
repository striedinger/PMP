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

app('Dingo\Api\Transformer\Factory')->register('Answer', 'AnswerTransformer');

$api = app('Dingo\Api\Routing\Router');

$api->version('v1', function ($api) {
	$api->get('/sessions/{id}/questions', 'App\Http\Controllers\ApiController@questions');
	$api->post('/sessions/{id}', 'App\Http\Controllers\ApiController@saveAnswer');
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

Route::get('/sessions/{id}', function(){
	return view('sessions.update');
});

Route::get('/test', function(){
	return App\Question::all()->toJSON();
});


