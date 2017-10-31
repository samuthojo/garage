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
Route::get('dashboard', 'Cms@adminstart')->name('dashboard'); //route to main page

Route::get('products', 'Cms@products');
Route::post('products/create', 'Cms@createProduct');
Route::post('products/update', 'Cms@updateProduct');

Route::get('view/{type}/{id}', 'Cms@view');

Route::post('create/{type}', 'Cms@store');

Route::post('update/{type}', 'Cms@update');

Route::delete('delete/{type}', 'Cms@delete');

Route::get('customers', 'Cms@customers');
Route::get('customers/{customer}', 'Cms@customer');
Route::post('customers/update', 'Cms@updateCustomer');

Route::get('cars', 'Cms@cars');
Route::post('cars/create', 'Cms@createCar');
Route::post('cars/update', 'Cms@updateCar');

Route::post('models/create', 'Cms@newModel');
Route::get('models/{car_make}', 'Cms@models');
Route::get('models/model/{model}', 'Cms@modelDetails')->name('model');
Route::get('models/view/{car_make}', 'Cms@viewModels')->name('models');
Route::post('models/update', 'Cms@updateModel');
Route::post('models/delete', 'Cms@deleteModel');

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
Route::get('requested_services/{service}', 'Cms@requestedServiceDetails')->name('requested_service');
Route::post('requested_services/status/update', 'Cms@updateRequestStatus');

Route::get('reports', 'Reports@reports')->name('reports');
Route::post('reports/orders', 'Reports@orderReports')->name('order_reports');
Route::post('reports/requested_services', 'Reports@requestedServiceReports')->name('requested_service_reports');

Route::get('notifications', 'Cms@notifications');
Route::post('notifications/send', 'Cms@sendAppWideNotification');

Route::get('promo_messages', 'PromoMessages@index')->name('promos.index');
Route::get('order_promo', 'PromoMessages@orderPromo')->name('promos.orderPromo');
Route::get('service_promo', 'PromoMessages@servicePromo')->name('promos.servicePromo');
Route::post('order_promo/{orderPromo}', 'PromoMessages@updateOrderPromo');
Route::post('service_promos/{servicePromo}', 'PromoMessages@updateServicePromo');
Route::post('order_promos/{orderPromo}', 'PromoMessages@updateOrderPromo');

Route::get('feedbacks', 'Feedbacks@index')->name('feedbacks.index');
Route::get('feedback/{feedback}', 'Feedbacks@read')->name('feedbacks.read');
Route::post('feedback/delete', 'Feedbacks@delete');

Route::get('change_password_form', 'Cms@changePasswordForm');
Route::post('change_password', 'Cms@changePassword');

Route::get('logout', 'Cms@logout')->name('logout');
