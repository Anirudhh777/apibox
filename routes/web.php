<?php

use Illuminate\Support\Facades\Route;

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
    return view('main');
})->name('main');

Route::get('/register', function () {
    return view('main');
})->name('register');

Route::post('/login', 'AdminController@login');
Route::post('/register', 'AdminController@register');

Route::group(['prefix' => 'api',  'middleware' => 'apiAuth'], function ()
{
    Route::post('/add/ingredient', 'ApiController@add_ingredient');
    Route::get('/fetch/ingredients', 'ApiController@fetch_ingredients');
    Route::post('/add/recipe', 'ApiController@add_recipe');
    Route::get('/fetch/recipes', 'ApiController@fetch_recipes');   
    Route::post('/add/box', 'ApiController@add_box');
    Route::get('/order/requirements', 'ApiController@order_requirements');
});
