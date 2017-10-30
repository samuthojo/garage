<?php

use Illuminate\Http\Request;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

// Route::middleware('auth:api')->get('/user', function (Request $request) {
//     return $request->user();
// });
Route::prefix('v1')->group(function() {
  Route::post('customer', 'MechMaster@add_customer');
  Route::get('products', 'MechMaster@products');
  Route::get('services', 'MechMaster@services');
  Route::get('cars', 'MechMaster@cars');
  Route::get('customer_services/{id}', 'MechMaster@customer_services');
  Route::get('order_items/{order}', 'MechMaster@orderItems');
  Route::post('add_cars', 'MechMaster@add_cars');
  Route::post('purchase', 'MechMaster@purchase');
  Route::post('book_service', 'MechMaster@book_service');
  Route::post('feedback', 'MechMaster@feedbackCreate');
});

Route::prefix('admin/v1')->group(function() {
  Route::post('login', 'MechAdmin@login');
  Route::get('orders', 'MechAdmin@orders');
  Route::get('booked_services', 'MechAdmin@bookedServices');
  Route::get('order_items/{order}', 'MechAdmin@orderItems');
  Route::post('orders/{order_id}/{status}', 'MechAdmin@updateOrderStatus');
  Route::post('requested_services/{id}/{status}', 'MechAdmin@updateRequestStatus');
  Route::post('reschedule/{requested_service}', 'MechAdmin@rescheduleRequest');
  Route::get('feedbacks', 'MechAdmin@feedbacks');
  Route::post('feedback/delete', 'MechAdmin@feedbackDelete');
});
