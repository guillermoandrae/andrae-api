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

$app->get('/', function () {
    if (env('API')) {
        return redirect('/profile');
    }
    return redirect('/home');
});

// Portal Routes
$app->get('/home', 'IndexController@index');
$app->get('/post/{id}', 'PostController@index');
$app->get('/post/{id}/{slug}', 'PostController@index');

// API Routes
$app->group(['middleware' => 'cors'], function () use ($app) {
    $app->get('/profile', 'ProfileController@index');
    $app->get('/posts', 'PostsController@search');
    $app->put('/posts', ['middleware' => 'auth'], 'PostsController@create');
    $app->get('/posts/{id}', 'PostsController@read');
});
