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

// TODO: return different headers on empty response

$app->group(['prefix' => 'user', 'middleware' => 'jwt.auth'], function($app) {
    $app->post('/', 'App\Http\Controllers\UserController@store');
    $app->put('/{id}', 'App\Http\Controllers\UserController@update');
    $app->delete('/{id}', 'App\Http\Controllers\UserController@destroy');
});

$app->group(['prefix' => 'user'], function ($app)
{
    $app->get('/', 'App\Http\Controllers\UserController@index');
    $app->get('/{id}', 'App\Http\Controllers\UserController@show');
});

$app->post('auth/login', 'App\Http\Controllers\Auth\AuthController@check');