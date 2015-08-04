<?php

/*
|--------------------------------------------------------------------------
| Application Routes
|--------------------------------------------------------------------------
|
| Here is where you can register all of the routes for an application.
| It is a breeze. Simply tell Lumen the URIs it should respond to
| and give it the Closure to call when that URI is requested.
|
*/

$app->get('/', function () use ($app) {
    return $app->welcome();
});

$app->group(['prefix' => 'user', 'middleware' => 'getUserFromToken'], function ($app) {

    $app->get('/', 'App\Http\Controllers\UserController@index');
    $app->post('/', 'App\Http\Controllers\UserController@store');
    $app->get('/{id}', 'App\Http\Controllers\UserController@show');
    $app->put('/{id}', 'App\Http\Controllers\UserController@update');
    $app->delete('/{id}', 'App\Http\Controllers\UserController@destroy');
});

$app->get('profile', 'App\Http\Controllers\UserController@profile', ['middleware' => 'getUserFromToken']);

$app->post('auth/login', 'App\Http\Controllers\Auth\AuthController@login');
