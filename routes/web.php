<?php

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

Route::get('', 'Cms@index'); //fetch login form
Route::get('admin', 'Cms@index')->name('login'); //fetch login form
Route::post('login', 'Cms@authenticate'); //authenticate the user
Route::get('dashboard', 'Cms@adminstart'); //route to main page

Route::get('products', 'Cms@products');

Route::get('view/{type}/{id}', 'Cms@view');

Route::post('create/{type}', 'Cms@store');

Route::post('update/{type}', 'Cms@update');

Route::delete('delete/{type}', 'Cms@delete');

Route::get('customers', 'Cms@customers');
Route::get('customers/{customer}', 'Cms@customer');
Route::post('customers/update', 'Cms@updateCustomer');

Route::get('cars', 'Cms@cars');

Route::post('models/create', 'Cms@newModel');
Route::get('models/{car_make}', 'Cms@models');
Route::get('models/model/{model}', 'Cms@modelDetails');
Route::get('models/view/{car_make}', 'Cms@viewModels')->name('models');

Route::get('categories', 'Cms@categories');

Route::get('orders', 'Cms@orders');
Route::get('orders/{order}', 'Cms@order');
Route::post('orders/update', 'Cms@updateOrder');

Route::get('services', 'Cms@services');
Route::get('services/{service}', 'Cms@service');
Route::post('services/create', 'Cms@newService');
Route::post('services/from_existing', 'Cms@newService2');
Route::post('services/update', 'Cms@updateService');
Route::post('services/status/update', 'Cms@updateServiceStatus');

Route::get('requested_services', 'Cms@requestedServices');
Route::get('requested_services/{service}', 'Cms@requestedServiceDetails');


Route::get('change_password_form', 'Cms@change_password_form');
Route::post('change_password', 'Cms@change_password');

Route::get('logout', 'Cms@logout')->name('logout');
