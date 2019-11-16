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

/* @var \Laravel\Lumen\Routing\Router $router */

$router->get('/', 'DashboardController');

$router->group(['prefix' => 'api/v1', 'middleware' => 'auth:api'], static function () use ($router) {
    $router->group(['prefix' => 'product', 'namespace' => 'Api\V1\Product'], static function () use ($router) {
        $router->get('/', 'ListProductsController');
        $router->group(['middleware' => 'auth:api,admin'], static function() use ($router) {
            $router->post('/', 'StoreProductController');
            $router->put('/{id}', 'UpdateProductController');
            $router->delete('/{id}', 'DestroyProductController');
        });
    });

    $router->group(['prefix' => 'wishlist', 'namespace' => 'Api\V1\Wishlist'], function () use ($router) {
        $router->get('/', 'ListWishlistsController');
        $router->post('/', 'StoreWishlistController');
        $router->put('/{id}', 'UpdateWishlistController');
        $router->delete('/{id}', 'DestroyWishlistController');
    });
});
