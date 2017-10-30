<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;

use App\Customer;
use App\Device;
use App\Product;
use App\Car;
use App\CustomerCar;
use App\CustomerService;
use App\CarModel;
use App\Service;
use App\ServiceAsProduct;
use App\Category;
use App\Purchase;
use App\Order;
use App\UserDevice;
use App\Logic\FCM;
use App\Logic\Push;
use App\User;
use App\Feedback;
use App\OrderPromoMessage;
use App\ServicePromoMessage;

class MechMaster extends Controller
{
    //action: add customer
    public function add_customer(Request $request) {
      $feedback = "";
      $customer = "";
      $email = $request->only('email');
      if(is_null($customer = Customer::where($email)->first())) {
          DB::transaction(function() {
            $customer = Customer::create(request()->only('email', 'phonenumber',
                                                         'name'));
            Device::create([
              'customer_id' => $customer->id,
              'token' => request('token'),
            ]);
          });
          $customer_id = Customer::where($email)->first()->id;
          $feedback = [
            'message' => [
              'status' => 'okay',
              'id' => $customer_id,
            ],
          ];
          return response()->json($feedback, 201);
      } else {
          $customer_id = $customer->id;
          $token = $request->input('token');
          $params = compact('customer_id', 'token');
          if(is_null(Device::where($params)->first())) {
            Device::create($params);
          }
          $feedback = [
            'message' => [
              'status' => 'exists',
              'id' => $customer_id,
            ],
          ];
          return response()->json($feedback, 200);
      }
    }

    public function products() {
      $cars = Car::all();
      $categories = Category::all();
      $products = Product::all()->map(function($prod) {
        $product = $prod;
        $car_model = $prod->car_model;
        $product->car_model_name = $car_model->model_name;
        $product->category_name = $prod->category()->first()->name;

        return $product;
      });
      $feedback = compact('cars', 'categories', 'products');
      return response()->json($feedback, 200);
    }

    public function services() {
      $cars = Car::all();
      $services = Service::all(['id', 'name', ]);
      $columns = ['id', 'service_id', 'car_id', 'car_model_id', 'price',];
      $service_as_products =
        ServiceAsProduct::where('status', true)
              ->get($columns)->map(function($serv) {
                $service = $serv;
                $service->service_name = $serv->service()->first()->name;
                $model = $serv->car_model;
                $service->car_model_name = $model->model_name;
                $service->description = $serv->service()->first()->description;
                $service->service_picture = $serv->service()->first()->picture;
                return $service;
              });

      $feedback = compact('cars', 'services', 'service_as_products');
      return response()->json($feedback, 200);
    }

    public function cars() {
      $cars = Car::all();
      $feedback = [
        'cars' => $cars,
      ];
      return response()->json($feedback, 200);
    }

   public function purchase() {
      DB::beginTransaction();
      try {
        $products = request('products');
        $order_id = Order::create([
                      'customer_id' => request('customer_id'),
                      'amount' => $this->calculateAmount($products),
                      'num_items' => $this->getNumItems($products),
                    ])->id;
        foreach($products as $product) {
          Purchase::create(array_add($this->setUpProduct($product), 'order_id',
                                                                    $order_id));
        }
        DB::commit();

        $data = [];
        $data['type'] = 3;
        $data['date'] = (now()->format('d-m-Y'));
        $data['title'] = 'New Order Placed';
        $data['message'] = 'A new order was placed';
        $data['order_id'] = $order_id;

        $fcm = new FCM();

        $status = $fcm->sendToTopic("admin", $data);

        $promo_message = OrderPromoMessage::first()->message;

        if($status) {
          $feedback = [
            'message' => [
              'status' => 'okay',
              'promo_message' => $promo_message,
            ],
          ];
          return response()->json($feedback, 201);
        }

      } catch(Throwable $e) {
          DB::rollback();
          return response()->json(['error' => $e->getMessage(), ], 500);
      }
    }

    private function calculateAmount($products) {
      $amount = 0;
      foreach($products as $product) {
        $amount +=  $this->getPrice($product) * $product['quantity'];
      }
      return $amount;
    }

    private function setUpProduct($product) {
      //set-up total price
      $product['total_price'] = $this->getPrice($product) * $product['quantity'];
      return $product;
    }

    private function getPrice($product) {
      if($product['has_includes'])
        return $price = $product['price'] + $product['include_price'];
      else
        return $price = $product['price'];
    }

    private function getNumItems($products) {
      $num_items = 0;
      foreach ($products as $product) {
        $num_items += $product['quantity'];
      }
      return $num_items;
    }

    public function add_cars() {
      foreach (request('customer_cars') as $car) {
          CustomerCar::create(array_add($car, 'customer_id',
                                               request('customer_id')));
      }
      $feedback = [
        'message' => [
          'status' => 'okay',
        ],
      ];
      return response()->json($feedback, 201);
    }

    public function book_service() {
      DB::beginTransaction();
      try {
        $id = request('id'); //the service_as_product_id
        $customer_id = request('customer_id');
        $service_as_product = ServiceAsProduct::find($id);
        $car_id = $service_as_product->car()->first()->id;
        $car_model_id = $service_as_product->car_model()->first()->id;

        CustomerCar::firstOrCreate(compact('customer_id', 'car_id', 'car_model_id'));

        $data = request()->except('id');

        CustomerService::create(array_add($data, 'service_as_product_id', $id));

        DB::commit();

        $data = [];
        $data['type'] = 4;
        $data['date'] = (now()->format('d-m-Y'));
        $data['title'] = 'Service Requested';
        $data['message'] = 'A service was requested';
        $data['service_as_product_id'] = $service_as_product->id;

        $fcm = new FCM();

        $status = $fcm->sendToTopic("admin", $data);

        $promo_message = ServicePromoMessage::first()->message;

        if($status) {
          $feedback = [
            'message' => [
              'status' => 'okay',
              'promo_message' => $promo_message,
            ],
          ];
          return response()->json($feedback, 201);
        }

      } catch(Throwable $e) {
        DB::rollback();
        return response()->json(['error' => $e->getMessage(), ], 500);
      }

    }

    public function customer_services() {

      $customer = Customer::find(request('id'));

      $services = $customer->customerServices()
                           ->get()->map(function ($s) {
                             $service = $s;
                             $serv = $s->serviceAsProduct()->first();
                             $car = $serv->car()->first();
                             $model = $serv->car_model()->first();
                             $service->price = $serv->price;
                             $service->car_id = $serv->car_id;
                             $service->car_name = $car->name;
                             $service->car_logo = $car->picture;
                             $service->car_model_id = $serv->car_model_id;
                             $service->car_model = $model->model_name;
                             $service->service_id = $serv->service_id;
                             $service->service_name = $serv->service()->first()->name;
                             $service->service_picture = $serv->service()->first()->picture;

                             return $service;
                           });

     $feedback = compact('services');
     return response()->json($feedback, 200);
   }

   public function orderItems(Order $order) {
     $items = $order->purchases()
                   ->get()
                   ->map( function($purchase) {
                     $item = $purchase;
                     $product = $purchase->product()->first();
                     $item->name = $product->name;
                     $item->picture = $product->image;
                     $item->category_name = $product->category()->first()->name;

                     return $item;
                   });

     $feedback = compact('items');
     return response()->json($feedback, 200);
   }

   public function feedbackCreate(Request $request) {
     $validatedData = $request->validate([
       'email' => 'required|email',
       'title' => 'required',
       'message' => 'required',
       'customer_id' => 'required',
     ]);
     Feedback::create($validatedData);
     $feedback = [
       'message' => ['status' => 'okay',],
     ];
     return response()->json($feedback, 201);
   }

}
