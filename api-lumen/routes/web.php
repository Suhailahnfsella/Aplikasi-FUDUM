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

$router->get('/', function () use ($router) {
    return $router->app->version();
});

$router->post('api/register' ,['uses' => 'LoginController@register' ]);
$router->post('api/registeradm' ,['uses' => 'LoginController@registeradm' ]);
$router->post('api/loginpass' ,['uses' => 'LoginController@loginforgetpass']);
$router->post('api/login' ,['uses' => 'LoginController@login' ]);
$router->post('api/loginadm' ,['uses' => 'LoginController@loginadm' ]);
$router->get('api/kategori' ,['uses' => 'KategoriController@index' ]);
$router->post('api/show' ,['uses' =>'MenuController@show'] );
$router->get('api/history' ,['uses' => 'HistoryController@index' ]);

$router->group( ['prefix' => 'api'] ,function() use ($router){

    $router->get('kategori/{id}' ,['uses' =>'KategoriController@show'] );

    $router->delete('kategori/{id}' ,['uses' =>'KategoriController@destroy'] );

    $router->put('kategori/{id}' ,['uses' =>'KategoriController@update'] );

    $router->post('kategori' ,['uses' =>'KategoriController@create'] );

    $router->get('pelanggan' ,['uses' => 'PelangganController@index' ]);

    $router->get('pelanggan/{id}' ,['uses' =>'PelangganController@show'] );

    $router->post('pelanggan' ,['uses' =>'PelangganController@create'] );

    $router->delete('pelanggan/{id}' ,['uses' =>'PelangganController@destroy'] );

    $router->put('pelanggan/{id}' ,['uses' =>'PelangganController@update'] );

    $router->post('menu' ,['uses' =>'MenuController@create'] );

    $router->get('menu' ,['uses' => 'MenuController@index']);

    $router->delete('menu/{id}' ,['uses' =>'MenuController@destroy'] );

    $router->get('menu/{id}' ,['uses' =>'MenuController@show'] );

    $router->post('menu/{id}' ,['uses' =>'MenuController@update'] );

    $router->post('menu2/{id}' ,['uses' =>'MenuController@update2'] );

    $router->get('order' ,['uses' => 'OrderController@index' ]);

    $router->put('order/{id}' ,['uses' =>'OrderController@update'] );

    $router->get('order/{a}/{b}' ,['uses' =>'OrderController@show'] );

    $router->get('detail/{a}/{b}' ,['uses' =>'DetailController@show'] );

    $router->get('user' ,['uses' => 'LoginController@index' ]);

    $router->get('user2' ,['uses' => 'LoginController@index2' ]);

    $router->get('tokoall' ,['uses' => 'TokoController@index' ]);

    $router->post('tokouser/{id}' ,['uses' => 'TokoController@index2' ]);

    $router->post('menureq/{request}' ,['uses' => 'MenuController@index2' ]);

    $router->post('user/{id}' ,['uses' =>'LoginController@update'] );

    $router->post('user2/{id}' ,['uses' =>'LoginController@update2'] );

    $router->post('user3/{id}' ,['uses' =>'LoginController@update3'] );

    $router->post('toko' ,['uses' =>'TokoController@create'] );

    $router->post('history' ,['uses' =>'HistoryController@create'] );

    $router->post('history1/{id}' ,['uses' =>'HistoryController@update'] );
    
    $router->post('history2/{id}' ,['uses' =>'HistoryController@update2'] );

    $router->post('history3/{id}' ,['uses' =>'HistoryController@update3'] );
} );



