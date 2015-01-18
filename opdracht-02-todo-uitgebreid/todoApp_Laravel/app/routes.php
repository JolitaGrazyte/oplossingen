<?php

/*
|--------------------------------------------------------------------------
| Application Routes
|--------------------------------------------------------------------------
|
| Here is where you can register all of the routes for an application.
| It's a breeze. Simply tell Laravel the URIs it should respond to
| and give it the Closure to execute when that URI is requested.
|
*/

// Route::get('/', function()
// {
// 	return View::make('hello');
// });

Route::get('/', array('as' => 'home', 'uses' => 'HomeController@getIndex') );
Route::get('users', 'DashboardController@getIndex');
Route::get('dashboard', 'DashboardController@getIndex');

// Authenticated group
// Sign out(GET)
Route::get('/logout', array(
	'as' 	=> 'logout',
	'uses' 	=> 'LogoutController@getLogout'
	 	));

//Todo index (GET)
Route::get('todo', array('as' => 'todo', 'uses' => 'TodoController@getIndex'));

//add Todo (GET)
Route::get('/todo/add', array(
	'as' => 'todo-add', 
	'uses' => 'TodoController@getAdd'
	));

//change status Todo (GET)
Route::get('/todo/changeStatus/{id}', array(
	'as' => 'todo-changeStatus', 
	'uses' => 'TodoController@changeStatus'
	));

//delet Todo (GET)
Route::get('/todo/delete/{id}', array(
	'as' => 'todo-delete', 
	'uses' => 'TodoController@delete'
	));



//post Todo (POST)
	 	Route::post('/todo/add', array(
	 	'as' 	=> 'todo-add-post',
	 	'uses' 	=> 'TodoController@postTodo'
	 	));


// Unauthenticated group
Route::group( array( 'before' => 'guest' ), function(){

	//CSRF protection
	 Route::group( array('before' => 'csrf' ), function(){
	 	//Register(POST)
	 	Route::post('/register', array(
	 	'as' 	=> 'register-post',
	 	'uses' 	=> 'RegisterController@postAccount'
	 	));

	 	//Login(POST)
	 	Route::post('/login', array(
	 	'as' 	=> 'login-post',
	 	'uses' 	=> 'LoginController@postLogin'
	 	));

	 });


	 //Register (GET)
	 Route::get('/register', array(
	 	'as' 	=> 'register',
	 	'uses' 	=> 'RegisterController@getAccount'
	 	));

	 Route::get('/activate/{activateCode}', array(
	 	'as' 	=> 'activate',
	 	'uses' 	=> 'LoginController@getActivate'
	 	));

	 //Login (GET)
	 Route::get('/login', array(
	 	'as' => 'login',
	 	'uses' => 'LoginController@getLogin'
	 	));


});
