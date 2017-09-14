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

$app->group(['middleware' => 'cors'], function () use ($app) {
    $app->get('/', function () {
        return redirect('/profile');
    });
    $app->get('/profile', 'ProfileController@index');
    $app->get('/posts', 'PostsController@search');
    $app->put('/posts', ['middleware' => 'auth', 'uses' => 'PostsController@create']);
    $app->get('/posts/{id}', 'PostsController@read');
});
