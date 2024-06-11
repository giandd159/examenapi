<?php

/** @var \Laravel\Lumen\Routing\Router $router */

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


/**
 * @OA\Post(
*$router->get('/posts', 'ExternalRequestController@getPostsFromLaravel');  ruta para obtener los posts desde laravel
*$router->get('/api/posts', 'ExternalRequestController@getPostsFromLaravel'); 
* $router->post('/api/posts', 'ExternalRequestController@createPostInLaravel');ruta para crear los posts desde laravel 
 */



$router->group(['middleware' => ['auth', 'verified']], function () use ($router) {
 //   $router->get('/api/posts', 'PostController@index');
   // $router->post('/api/posts', 'PostController@store');

});


$router->get('/posts', 'ExternalRequestController@getPostsFromLaravel');
$router->get('/api/posts', 'ExternalRequestController@getPostsFromLaravel');
$router->post('/api/posts', 'ExternalRequestController@createPostInLaravel');
/*
$router->get('/api/posts', 'PostController@index');
$router->post('/api/posts', 'PostController@store');
*/
$router->get('/', function () use ($router) {
    return $router->app->version();
    
});
