<?php

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('/', function () {
    return view('welcome');
});

Auth::routes();

Route::get('home', 'HomeController@index')->name('home')->middleware('auth');
Route::get('room/{id}', 'HomeController@index')->name('room')->middleware('auth');
// Route::post('send', "HomeController@send")->name('send');

// Route::group(['prefix' => 'api', 'namespace' => 'api', 'as' => 'api.'], function() {
//     Route::resource('message', 'MessageController', ['only' => ['store']]);
// });

// Route::post('messages', 'MessageController@store');
// Route::get('rooms', 'RoomController@index');
// Route::get('rooms/{id}', 'RoomController@show');

Route::group(['prefix' => 'api', 'middleware' => 'auth'], function() {
	Route::group(['prefix' => 'rooms'], function() {
		Route::get('/', 'RoomController@getListRoom');
		Route::get('/{id}', 'RoomController@getRoom');
		Route::get('/{id}/user', 'RoomController@getUserCreatedRoom');
		Route::get('/{id}/messages', 'RoomController@getMessagesOfRoom');
	});

	Route::group(['prefix' => 'messages'], function() {
		Route::get('/{id}/user', 'MessageController@getUserCreatedMessage');
		Route::post('/create', 'MessageController@postCreateMessage');
	});

	Route::group(['prefix' => 'users'], function() {
	    Route::get('/current-user', 'UserController@getCurrentUser');
	    Route::get('/users-in-channel/{room_id}', 'UserController@getUsersInChannel');
	});
});
