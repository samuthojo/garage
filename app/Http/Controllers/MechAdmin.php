<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use App\Car;
use App\Service;
use App\ServiceAsProduct;
use App\Customer;
use App\User;
use App\CustomerService;
use App\CustomerCar;
use App\Product;
use App\Order;
use App\Purchase;
use App\Device;
use App\CarModel;
use App\Category;
use App\Logic\FCM;
use App\Logic\Push;
use App\UserDevice;
use Carbon\Carbon;
use App\Feedback;
use App\OrderPromoMessage;
use App\ServicePromoMessage;

class MechAdmin extends Controller
{
  public function __construct() {
    //$this->middleware('auth:api')->except(['login', ]);
  }

  public function login(Request $request) {
    $credentials = $request->only('username', 'password');

    $feedback = "";

    if(Auth::attempt($credentials)) {

      $feedback = array();
      $feedback['user'] = Auth::user();

      $token_info = "";
      $feedback['token_info'] = "";

    }
    else {
      $feedback = ["message" => "Wrong username or password", ];
    }

    return response()->json($feedback, 200);
  }

  public function orders() {
    $orders = Order::where('status', 0)
                    ->get()
                   ->map( function($order){
                      $myOrder = [];
                      $customer = $order->customer()->first();
                      $myOrder['order_id'] = $order->id;
                      $myOrder['customer_name'] = $customer->name;
                      $myOrder['customer_phone'] = $customer->phonenumber;
                      $myOrder['num_items'] = $order->num_items;
                      $myOrder['amount'] = $order->amount;
                      $myOrder['date_ordered'] = $order->date;

                      return $myOrder;
                    });

    return response()->json(compact('orders'), 200);
  }

  public function bookedServices() {
    $customer_services =
      CustomerService::where('status', 1)
                     ->get()
                     ->map( function($customer_service){
                          $myService = [];
                          $service_as_product = $customer_service->serviceAsProduct()
                                                                 ->first();
                          $service = $service_as_product->service()
                                                        ->first();
                          $car = $service_as_product->car;
                          $model = $service_as_product->car_model;
                          $customer = $customer_service->customer()->first();

                          $myService['customer_service_id'] = $customer_service->id;
                          $myService['service_name'] = $service->name;
                          $myService['service_picture'] = $service->picture;
                          $myService['car_name'] = $car->name;
                          $myService['model_name'] = $model->model_name;
                          $myService['customer_name'] = $customer->name;
                          $myService['customer_phone'] = $customer->phonenumber;
                          $myService['price'] = $customer_service->price;
                          $myService['pick_option'] = $customer_service->pick_option;
                          $myService['longitude'] = $customer_service->longitude;
                          $myService['latitude'] = $customer_service->latitude;
                          $myService['location_name'] = $customer_service->location_name;
                          $myService['date_requested'] = $customer_service->created_at;
                          $myService['date_due'] = $customer_service->date;
                          $myService['status'] = $customer_service->status;

                          return $myService;
                        });

    return response()->json(compact('customer_services'), 200);
  }

  public function orderItems(Order $order) {
    $items = $order->purchases()
                  ->get()
                  ->map( function($purchase) {
                    $item = $purchase;
                    $product = $purchase->product()->first();
                    $car = $product->car;
                    $model = $product->car_model;
                    $item->name = $product->name;
                    $item->picture = $product->image;
                    $item->category_name = $product->category()->first()->name;
                    $item->car_name = $car->name;
                    $item->car_model = $model->model_name;

                    return $item;
                  });

    return response()->json(compact('items'), 200);
  }

  public function updateOrderStatus($order_id, $status) {
    $comment = request('message');
    Order::where('id', $order_id)->update(compact('status', 'comment'));

    $order = Order::find($order_id);
    $customer = $order->customer()->first();
    $tokens = $this->getTokens($customer);

    $fcm = new FCM();

    $data = array();
    $data['type'] = 3;
    $data['date'] = $order->updated_at;
    $data['data'] = $order_id . "";

    if($status == 1) {
      $data['title'] = "Order Accepted!";
      if(!is_null($comment)) {
        $data["message"] = $comment;
      } else {
        $data["message"] = "Your order has been accepted!";
      }
    }
    else if($status == 4) {
      $data['title'] = "Order Rejected";
      if(!is_null($comment)) {
        $data["message"] = $comment;
      } else {
        $data["message"] = "Your order has been rejected!";
      }
    }

    // sending push message to multiple users by fcm registration ids
    $status = $fcm->sendMultiple($tokens, $data);

    if($status) {
      return response()->json(['success' => 'okay, customer notified',
                               'status' => $status,], 200);
    }

    return response()->json(['error' => 'network error, customer not notified',
                             'status' => $status,], 200);


  }

  private function getTokens($customer) {
    $tokens = $customer->devices()
                       ->get(['token'])
                       ->map( function($t) {
                           return $token = $t->token;
                       });
    return $tokens;
  }

  public function updateRequestStatus($id, $status) {
    $comment = request('message');
    CustomerService::where('id', $id)->update(compact('status', 'comment'));
    $customer_service = CustomerService::find($id);
    $service_as_product = $customer_service->serviceAsProduct()->first();
    $service = $service_as_product->service()->first();
    $model = $service_as_product->car_model;

    $customer_service->car_model = $model->model_name;
    $customer_service->service_name = $service->name;

    $customer = $customer_service->customer()->first();
    $tokens = $this->getTokens($customer);

    $fcm = new FCM();

    $data = array();
    $data['type'] = 4;
    $data['date'] = $customer_service->updated_at;
    $data['data'] = $customer_service;
    if($status == 1) {
      $data['title'] = "Request Accepted!";
      if(!is_null($comment)) {
        $data["message"] = $comment;
      } else {
        $data["message"] = "Your request has been accepted!";
      }
    }
    else if($status == 4) {
      if(!is_null($comment)) {
        $data['title'] = "Request Rejected";
        $data["message"] = $comment;
      } else {
        $data["message"] = "Your request has been rejected!";
      }
    }

    // sending push message to multiple users by fcm registration ids
    $status = $fcm->sendMultiple($tokens, $data);

    if($status) {
      return response()->json(['success' => 'okay, customer notified',
                               'status' => $status,], 200);
    }

    return response()->json(['error' => 'network error, customer not notified',
                             'status' => $status,], 200);

  }

  public function rescheduleRequest($id) {
    $comment = request('message');
    $date = request('date');
    $status = request('status');//Rescheduled
    CustomerService::where('id', $id)->update(compact('status', 'date'));
    $customer_service = CustomerService::find($id);
    $service_as_product = $customer_service->serviceAsProduct()->first();
    $service = $service_as_product->service()->first();
    $model = $service_as_product->car_model;

    $customer_service->car_model = $model->model_name;
    $customer_service->service_name = $service->name;

    $customer = $customer_service->customer()->first();
    $tokens = $this->getTokens($customer);

    $data = array();
    $data['type'] = 4;
    $data['date'] = $customer_service->updated_at;
    $data['data'] = $customer_service;
    $data['title'] = "Request Rescheduled";
    if(!is_null($comment)) {
      $data["message"] = $comment;
    } else {
      $data["message"] = "Your request has been rescheduled to " . $date;
    }

    $fcm = new FCM();
    // sending push message to multiple users by fcm registration ids
    $status = $fcm->sendMultiple($tokens, $data);

    if($status) {
      return response()->json(['success' => 'okay, customer notified',
                               'status' => $status,], 200);
    }

    return response()->json(['error' => 'network error, customer not notified',
                             'status' => $status,], 200);

  }

  public function feedbacks() {
    $feedbacks = Feedback::all();
    return response()->json(compact('feedbacks'), 200);
  }

  public function feedbackDelete(Request $request) {
    $feedback_id = $request->input('feedback_id');
    Feedback::where('id', $feedback_id)->delete();

    return response()->json(["status" => "okay",], 200);
  }

}
