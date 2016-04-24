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

use Illuminate\Support\Facades\Mail;

Route::controller('auth/password', 'Auth\PasswordController', [
	'getEmail' => 'auth.password.email',
	'getReset' => 'auth.password.reset',
]);


Route::controllers([
	'auth' => 'Auth\AuthController',
]);

Route::resource('/', 'ShortenerController', ['except' => ['show', 'create', 'edit', 'update', 'destroy']]);
Route::post('/destroy_url/{id}', ['as' => 'destroyUrl', 'uses' => 'ShortenerController@destroyUrl' ]);

Route::get('/{shortUrl}', ['as' => 'showUrl', 'uses' => 'ShortenerController@showUrl' ])->where('shortUrl', '[a-zA-Z0-9]+');
Route::get('/statistics/{shortUrl}', ['as' => 'showUrl', 'uses' => 'ShortenerController@statistics' ])->where('shortUrl', '[a-zA-Z0-9]+');

Route::resource('user', 'UserController', ['except' => ['index', 'show', 'create', 'store', 'destroy']]);

Route::get('email/send', function() {
	Mail::send('email.test', ['name' => 'ohidul'], function($message) {
		$message->to('ohidul.islam951@gmail.com', 'Ohidul')->subject('Hello');
	});
});