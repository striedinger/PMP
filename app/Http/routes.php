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

Route::get('/home', 'HomeController@index');

//Users

Route::get('/users', 'UserController@index');

Route::get('/users/update/{id}', 'UserController@update');

Route::post('/users/update/{id}', 'UserController@update');

//Exams

Route::get('/exams', 'ExamController@index');

Route::get('/exams/create', 'ExamController@create');

Route::post('/exams/create', 'ExamController@create');

Route::get('/exams/update/{id}', 'ExamController@update');

Route::post('/exams/update/{id}', 'ExamController@update');

//Questions

Route::get('/questions', 'QuestionController@index');

Route::get('/questions/create', 'QuestionController@create');

Route::post('/questions/create', 'QuestionController@create');

Route::get('/questions/update/{id}', 'QuestionController@update');

Route::post('/questions/update/{id}', 'QuestionController@update');

//Sessions

Route::get('/sessions/{id}', function(){
	return view('sessions.update');
});


