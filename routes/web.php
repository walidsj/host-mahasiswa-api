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
    return response()->json([
        'status' => 'success',
        'message' => 'Students Database API is on-airing.',
        'apiVersion' => '1.0.0',
        'apiVendor' => $router->app->version(),
        'apiDeveloper' => '@pagiwalid'
    ]);
});

//.. for authenticating
$router->group(['prefix' => 'api/dev'], function () use ($router) {
    $router->post('user', ['uses' => 'UserController@check']);
    $router->put('user', ['uses' => 'UserController@update']);
    $router->delete('user', ['uses' => 'UserController@delete']);
    $router->post('user/register', ['uses' => 'UserController@create']);
    $router->post('user/reset-token', ['uses' => 'UserController@updateToken']);
});

//.. with middleware
$router->group(['prefix' => 'api/data', 'middleware' => 'auth'], function () use ($router) {
    $router->get('jurusan', ['uses' => 'JurusanController@show']);
    $router->post('jurusan', ['uses' => 'JurusanController@create']);
    $router->put('jurusan', ['uses' => 'JurusanController@update']);
    $router->delete('jurusan', ['uses' => 'JurusanController@delete']);

    $router->get('prodi', ['uses' => 'ProdiController@show']);
    $router->post('prodi', ['uses' => 'ProdiController@create']);
    $router->put('prodi', ['uses' => 'ProdiController@update']);
    $router->delete('prodi', ['uses' => 'ProdiController@delete']);

    $router->get('semester', ['uses' => 'SemesterController@show']);
    $router->post('semester', ['uses' => 'SemesterController@create']);
    $router->put('semester', ['uses' => 'SemesterController@update']);
    $router->delete('semester', ['uses' => 'SemesterController@delete']);

    $router->get('mahasiswa', ['uses' => 'MahasiswaController@show']);
    $router->post('mahasiswa', ['uses' => 'MahasiswaController@create']);
    $router->put('mahasiswa', ['uses' => 'MahasiswaController@update']);
    $router->delete('mahasiswa', ['uses' => 'MahasiswaController@delete']);

    $router->get('matkul', ['uses' => 'MatkulController@show']);
    $router->post('matkul', ['uses' => 'MatkulController@create']);
    $router->put('matkul', ['uses' => 'MatkulController@update']);
    $router->delete('matkul', ['uses' => 'MatkulController@delete']);

    $router->get('mahasiswa/search-matkul', ['uses' => 'MahasiswaController@showWithMatkul']);
});
