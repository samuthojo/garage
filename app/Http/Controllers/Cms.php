<?php

namespace App\Http\Controllers;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\DB;

use Illuminate\Http\Request;
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
use Carbon\Carbon;
use App\Feedback;
use App\OrderPromoMessage;
use App\ServicePromoMessage;

class Cms extends Controller
{
    public function __construct() {
      $this->middleware('auth')->except(['index', 'authenticate', ]);
    }

    //perform display login form action
    public function index() {
      return view('login');
    }

    //perform action authenticate
    public function authenticate(Request $request) {
      $credentials = $request->only('username', 'password');
      if(Auth::attempt($credentials)) {
        $request->session()->regenerate();
        $feedback = ['success' => 'success', ];
      } else {
        $feedback = ['success' => 'failure', ];
      }
      return response()->json($feedback);
    }

    //perform return the main page action
    public function adminstart() {
      $categories = Category::orderBy('id', 'desc')->get();
      return view('dashboard')->with('categories', $categories);
    }

    public function services() {
      $services = ServiceAsProduct::orderBy('id', 'desc')
                  ->get()->map(function($serv) {
                    $service = $serv;
                    $service->service = $serv->service()->first()->name;
                    $car = $serv->car;
                    $service->car = $car->name;
                    $model = $serv->car_model;
                    $service->model = $model->model_name;

                    return $service;
                  });
      $cars = Car::all();
      return view('fetch_all.services', compact('services', 'cars'));
    }

    public function service(ServiceAsProduct $service) {
      $services = Service::all();

      $service->service = $service->service()->first()->name;
      $car = $service->car;
      $service->car = $car->name;
      $model = $service->car_model;
      $service->model = $model->model_name;
      $service->description = $service->service()->first()->description;
      $service->picture = $service->service()->first()->picture;

      $cars = Car::all();
      $models = "";
      if(($service->car()->first()) instanceof Car) {
         $models = $service->car()->first()->models;
       } else {
         $models = null;
       }

      return view('specific.service', compact('service', 'services', 'cars', 'models'));
    }

    public function newService(Request $request) {
       //This is a completely new service
       DB::beginTransaction();
       try {
         $data = $request->only('name', 'description');
         $service = "";
         if($request->hasFile('picture')) {
           $file = $request->file('picture');
           if($file->isValid()) {
             $file_name = $file->getClientOriginalName();
             $file->move('uploads/services', $file_name);
             $service = Service::create(array_add($data, 'picture', $file_name));
           }
         } else {
           $service = Service::create($data);
         }
         $data = $request->only('car_id', 'car_model_id', 'price');
         $data = array_add($data, 'service_id', $service->id);
         ServiceAsProduct::create($data);

         DB::commit();

         return $this->services();

       } catch(Throwable $e) {
           DB::rollback();
       }
    }

    public function newService2(Request $request) {
      $data = $request->only('service_id', 'car_id', 'car_model_id', 'price');
      $service = ServiceAsProduct::create($data);
      return $this->services();
    }

    public function updateService(Request $request) {
      $data1 = $request->only('service_id', 'car_id', 'car_model_id');
      $description = $request->input('description');
      $data2 = compact('description');
      $id = $request->input('id'); //Service_as_product_id
      $service_id = $request->input('service_id'); //Service_id
      $file_name = "";

      if($request->hasFile('picture')) {
        $file = $request->file('picture');
        if($file->isValid()) {
          $file_name = $file->getClientOriginalName();
          $file->move('uploads/services', $file_name);
          $data2 = array_add($data2, 'picture', $file_name);

          DB::beginTransaction();

          try {
            Service::where('id', $service_id)->update($data2);

            ServiceAsProduct::where('id', $id)->update($data1);

            DB::commit();

            return $this->services();
          } catch(Throwable $e) {
            DB::rollback();
          }
        }
      } else {
          DB::beginTransaction();

          try {
            Service::where('id', $service_id)->update($data2);

            ServiceAsProduct::where('id', $id)->update($data1);

            DB::commit();

            return $this->services();
          } catch(Throwable $e) {
            DB::rollback();
          }
      }
    }

    public function updateServiceStatus(Request $request) {
      $id = $request->input('id');
      $status = $request->input('status');
      $status = (strcasecmp($status, 'Active') == 0) ? true : false;
      ServiceAsProduct::where('id', $id)->update(['status' => $status]);
      return $this->services();
    }

    public function products() {
      $categories = Category::all();
      $products = Product::orderBy('date_modified', 'desc')->get();
      $cars = Car::all();
      return view('fetch_all.products', [
          'products' => $products,
          'categories' => $categories,
          'cars' => $cars,
      ]);
    }

    public function customers() {
      $customers = Customer::orderBy('id', 'desc')->get();
      return view('fetch_all.customers')->with('customers', $customers);
    }

    public function customer(Customer $customer) {
      return view('specific.customer', compact('customer'));
    }

    public function updateCustomer(Request $request) {
      $id = $request->only('id');
      Customer::where('id', $id)->update(['verified' => true,]);
      return $this->customers();
    }

    public function cars() {
      $cars = Car::orderBy('id', 'desc')->get();
      return view('fetch_all.cars')->with('cars', $cars);
    }

    public function categories() {
      $categories = Category::orderBy('id', 'desc')->get();
      return view('fetch_all.categories')->with('categories', $categories);
    }

    public function orders() {
      $orders = Order::all()->map(function($ord){
            $order = $ord;
            $order->customer = $ord->customer()->first()->name;
            $order->contact = $ord->customer()->first()->phonenumber;

            return $order;
        });
      return view('fetch_all.orders')->with('orders', $orders);
    }

    public function order(Order $order) {
      $purchases = $order->purchases()->get()->map(function($pur) {
        $purchase = $pur;
        $purchase->product = $pur->product()->first()->name;
        return $purchase;
      });
      return view('specific.order_items', compact('purchases', 'order'));
    }

    public function updateOrder(Request $request) {
      extract($request->all());

      $st = "";
      if(strcasecmp($status, 'accepted') == 0) {
        $st = 1;
      } else {
        $st = (strcasecmp($status, 'rejected') == 0) ? 4 : 2;
      }
      Order::where('id', $id)->update(['status' => $st,]);

      if($st == 1 || $st == 4) {//accepted or rejected respectively
        //To do: Send Push Notification
        return $this->sendOrderNotification($request->all());
      }
      else if($st == 2) {//Serviced
        $order_id = $id;
        $order = Order::find($order_id);
        $this->reduceStock($order);
      }
      return 1;
      //return $this->orders();
    }

    private function reduceStock($order) {//Whenever order is serviced reduce stock
      $purchases = $order->purchases()->get();
      foreach ($purchases as $purchase) {
        $product = $purchase->product()->first();
        $product->stock = ($product->stock) - ($purchase->quantity);
        $product->save(); //Update database
      }
    }

    private function sendOrderNotification($request) {
      extract($request, EXTR_PREFIX_ALL, 'posted');
      $order_id = $posted_id;
      $order = Order::find($order_id);
      $customer = $order->customer()->first();
      $tokens = $this->getTokens($customer);

      $fcm = new FCM();
      $push = new Push();

      $date = $order->updated_at;
      $data = $this->setUpNotification($request, $date);

      // sending push message to multiple users by fcm registration ids
      return $fcm->sendMultiple($tokens, $data);
    }

    private function setUpNotification($request, $date) {
      extract($request, EXTR_PREFIX_ALL, 'posted');

      $order_id = $posted_id;

      $data = array();
      $data['type'] = 3;
      $data['date'] = $date;
      $data['data'] = $order_id;

      if(strcasecmp($posted_status, 'accepted') == 0) {
        $data['title'] = "Order Accepted!";
        $data['message'] = "Your order has been accepted!";
      }
      else if(strcasecmp($posted_status, 'rejected') == 0) {
        $data['title'] = "Order Cancelled!";
        $data['message'] = "Your order has been cancelled!";
        $data['reason'] = $posted_reason;
      }

      return $data;
    }

    private function getTokens($customer) {
      $tokens = $customer->devices()
                         ->get(['token'])
                         ->map( function($t) {
                             return $token = $t->token;
                         });
      return $tokens;
    }

    public function sendAppWideNotification(Request $request) {
      $type = $request->input('type');
      $title = $message = "";
      if($type == 0) {
        $title = "Application Update";
        $message = "Some new features, please update your application!";
      }
      else if($type == 1) {
        $title = "Products Update";
        $message = "New products have been added please update to see them!";
      }
      else if($type == 2) {
        $title = "Services Update";
        $message = "More services have been added please update to see them!";
      }
      return $this->updateNotification($type, $title, $message);
    }

    private function updateNotification($type, $title, $message) {
      $fcm = new FCM();
      $push = new Push();

      $data = array();
      $data["type"] = $type;
      $data["date"] = (now()->format('Y-m-d'));
      $data["title"] = $title;
      $data["message"] = $message;
      $data["data"] = null;

      //sending push message to users who subscribed to the topic 'all'
      return $fcm->sendToTopic('all', $data);
    }

    public function requestedServices() {
      $service_as_product_ids =
        DB::table('customer_services')
          ->select('service_as_product_id')
          ->groupBy('service_as_product_id')
          ->get()->map( function($data) {
            return $mydata = $data->service_as_product_id;
          });
      $service_as_products = ServiceAsProduct::whereIn('id', $service_as_product_ids)
                            ->get()
                            ->map( function($serv) {
                              $service = $serv;
                              $service->service = $serv->service()->first()->name;
                              $service->car = $serv->car()->first()->name;
                              $service->model = $serv->car_model()->first()->model_name;
                              $service->customers = $serv->customerServices()->count();
                              return $service;
                            });
      return view('fetch_all.requested_services', compact('service_as_products'));
    }

    public function requestedServiceDetails(ServiceAsProduct $service) {
      $serv = $service->service()->first()->name;
      $car = $service->car()->first()->name;
      $model = $service->car_model()->first()->model_name;

      $details = $service->customerServices()
                         ->get()
                         ->map( function($c) {
                           $serv = $c;

                           $customer = $c->customer()->first();

                           $serv->customer = $customer->name;
                           $serv->phonenumber = $customer->phonenumber;

                           return $serv;
                         });
       return view('specific.requested_service', compact('details', 'serv',
                                                              'car', 'model'));
    }

    public function updateRequestStatus(Request $request) {
      $id = $request->input('id');
      $status = $request->input('status');
      if($request->filled('date')) {
        $date = $request->input('date');
        $date = Carbon::parse($date)->format('Y-m-d');
        CustomerService::where('id', $id)->update(compact('status', 'date'));
      } else {
        CustomerService::where('id', $id)->update(compact('status'));
      }

      //To do send notification to customer
      if($status == 1 || $status == 3 || $status == 4) {
        return $this->sendRequestNotification($request->all());
      }

      $service_as_product_id = CustomerService::find($id)->serviceAsProduct()
                                                         ->first()
                                                         ->id;

      return 1;
      // For a route with the following URI: requested_services/{service}
      //return redirect()->route('requested_service', ['service' => $service_as_product_id]);
    }

    private function sendRequestNotification($request) {
      extract($request);
      $fcm = new FCM();
      $push = new Push();

      $requested_service = CustomerService::find($id);

      $service_as_product = $requested_service->serviceAsProduct()->first();
      $model = $service_as_product->car_model()->first();
      $service = $service_as_product->service()->first();

      $requested_service->service_name = $service->name;
      $requested_service->car_model = $model->model_name;

      $customer = $requested_service->customer()->first();

      $tokens = $this->getTokens($customer);

      $data = $this->setUpContent($request, $requested_service);

      // sending push message to multiple users by fcm registration ids
      return $fcm->sendMultiple($tokens, $data);
    }

    private function setUpContent($request, $requested_service) {
      extract($request, EXTR_PREFIX_ALL, 'posted');

      $data = array();
      $data['type'] = 4;
      $data['date'] = $requested_service->updated_at; //Date we are sending notification
      $data['data'] = $requested_service;

      if($posted_status == 1) {//accepted
        $data['title'] = "Request accepted";
        $data['message'] = "Your request has been accepted!";
      }
      else if ($posted_status == 3) {//rescheduled
        $data['title'] = "Request Rescheduled";
        $data['message'] = "Your request has been rescheduled to " . $posted_date;
        $data['reason'] = $posted_reason;
      }
      else if ($posted_status == 4) {//rejected
        $data['title'] = "Request Rejected";
        $data['message'] = "Your request has been rejected!";
        $data['reason'] = $posted_reason;
      }

      return $data;
    }

    public function notifications() {
      return view('notifications');
    }

    public function changePasswordForm() {
      return view('change_password');
    }

    public function changePassword(Request $request) {
      $params = $request->only('old_password', 'new_password',
                                                'confirm_password');
      extract($params, EXTR_PREFIX_ALL, 'from_post');
      $user = Auth::user();
      $password = $from_post_old_password;
      if(Hash::check($password, $user->password)) {
        if(strcmp($from_post_new_password,
                        $from_post_confirm_password) == 0) {
          $user->password = Hash::make($from_post_new_password);
          $user->save();
          $status = 1; //success
        } else {
          $status = 0; //do not match
        }
      } else {
        $status = 2; //Wrong old password
      }
      $feedback = compact('status');
      return response()->json($feedback);
    }

    //perform action logout
    public function logout(Request $request) {
      Auth::logout();
      $request->session()->invalidate();
      return redirect()->route('login');
    }

    public function store(Request $request, $type) {
      if($type == 'category') {
        Category::firstOrCreate(request()->all());
        return $this->categories();
      } else if($type == 'product') {
        $data = $request->except('image');
        if($request->hasFile('image')) {
          $picture = $request->file('image');
          if($picture->isValid()) {
            $image = $picture->getClientOriginalName();
            $picture->move('uploads/products', $image);
            Product::create(array_add($data, 'image', $image));
          }
        } else {
          Product::create($data);
        }
        return $this->products();
      } else if($type == 'car') {
        $data = $request->except('picture', 'num_models');
        $num_models = request('num_models');
        $num_models = is_null($num_models) ? 1 : $num_models;
        if($request->hasFile('picture')) {
          $logo = $request->file('picture');
          if($logo->isValid()) {
            $picture = $logo->getClientOriginalName();
            $logo->move('uploads/cars', $picture);
            $data = array_add($data, 'picture', $picture);
            Car::create(array_add($data, 'num_models', $num_models));
          }
        } else {
          $data = array_add($data, 'num_models', $num_models);
          Car::create($data);
        }
        return $this->cars();
      }
    }

    public function update(Request $request, $type) {
      $id = $request->input('id');
      if($type == 'category') {
        Category::where('id', $id)->update(request()->except('id'));
        return $this->categories();
      } else if($type == 'product') {
        $data = $request->except('id', 'image');
        if($request->hasFile('image')) {
          $picture = $request->file('image');
          if($picture->isValid()) {
            $image = $picture->getClientOriginalName();
            $picture->move('uploads/products', $image);
            Product::where('id', $id)->update(array_add($data, 'image', $image));
          }
        } else {
          Product::where('id', $id)->update($data);
        }
        return $this->products();
      } else if($type == 'car') {
        $data = $request->except('picture', 'num_models');
        $num_models = request('num_models');
        $num_models = is_null($num_models) ? 1 : $num_models;
        if($request->hasFile('picture')) {
          $logo = $request->file('picture');
          if($logo->isValid()) {
            $picture = $logo->getClientOriginalName();
            $logo->move('uploads/cars', $picture);
            $data = array_add($data, 'picture', $picture);
            $data = array_add($data, 'num_models', $num_models);
            Car::where('id', $id)->update($data);
          }
        } else {
          Car::where('id', $id)->update(array_add($data, 'num_models',
                                                                  $num_models));
        }
        return $this->cars();
      }
    }

    public function delete(Request $request, $type) {
      $id = $request->input('id');
      if($type == 'service') {
        ServiceAsProduct::where('id', $id)->delete();
        return $this->services();
      } else if($type == 'category') {
        Category::where('id', $id)->delete();
        return $this->categories();
      } else if($type == 'product') {
        Product::where('id', $id)->delete();
        return $this->products();
      } else if($type == 'car') {
        Car::where('id', $id)->delete();
        return $this->cars();
      } else if($type == 'model') {
        CarModel::where('id', $id)->delete();
        return $this->products();
      }
    }

    public function view($type, $id) {
      if($type == 'product') {
        $product = Product::find($id);
        $category = $product->category; //the category it belongs to
        $car = $product->car; //the make it belongs to
        if(($product->car()->first()) instanceof Car) {
          $models = $car->models; //all the models of this make
        } else {
          $models = null;
        }
        $cars = Car::all();
        $car_model = $product->car_model; //the car_model it belongs to
        $categories = Category::all();
        return view('specific.product', compact('product', 'category', 'car',
                                  'models', 'cars', 'categories', 'car_model'));
      } else if($type == 'car') {
        $car = Car::find($id);
        return view('specific.car', compact('car'));
      }
    }

    /*
     *@var the id of the car_make
     *@return All Models of that car_make
     */
    public function models(Car $car_make) {
      $models = $car_make->models()->get();

      return response()->json($models);
    }

    public function viewModels(Car $car_make) {
      $models = $car_make->models;

      return view('specific.models', compact('models', 'car_make'));
    }

    public function modelDetails(CarModel $model) {
      $model->car = $model->car()->first()->name;
      $cars = Car::all();
      return view('specific.model', compact('model', 'cars'));
    }

    public function newModel(Request $request) {
      $data = $request->except('picture');
      $car_id = $request->input('car_id');
      $car = Car::find($car_id);
      $num_models = $car->num_models;
      if($request->hasFile('picture')) {
        DB::beginTransaction();

        try {
          $file = $request->file('picture');
          $destination = 'uploads/models';
          $file_name = $this->handleFile($file, $destination);
          $data = array_add($data, 'picture', $file_name);
          $num_models = $num_models +  1;

          CarModel::create($data);
          $car->num_models = $num_models;
          $car->save();

          DB::commit();
        } catch(Throwable $e) {
            DB::rollback();
            return response()->json(['error' => $e->getMessage(), ], 500);
          }
      } else {
        DB::beginTransaction();

        try {
          $num_models = $num_models +  1;

          CarModel::create($data);
          $car->num_models = $num_models;
          $car->save();

          DB::commit();
        } catch(Throwable $e) {
            DB::rollback();
            return response()->json(['error' => $e->getMessage(), ], 500);
          }

      }
      return redirect()->route('models', ['car_make' => $car_id]);
    }

    public function updateModel(Request $request) {
      $model = $request->input('id');
      $data = $request->except('id', 'picture');
      if($request->hasFile('picture')) {
        $file = $request->file('picture');
        $destination = 'uploads/models';
        $file_name = $this->handleFile($file, $destination);
        $data = array_add($data, 'picture', $file_name);
        CarModel::where('id', $model)->update($data);
      }
      else {
        CarModel::where('id', $model)->update($data);
      }
      return redirect()->route('model', compact('model'));
    }

    public function deleteModel(Request $request) {
      DB::beginTransaction();

      try {
        $model_id = $request->input('id');
        $car = CarModel::find($model_id)->car()->first();
        $num_models = $car->num_models;
        $num_models = $num_models - 1;

        CarModel::where('id', $model_id)->delete();
        $car->num_models = $num_models;
        $car->save();

        DB::commit();

        return redirect()->route('models', ['car_make' => $car->id]);
      } catch(Throwable $e) {
        DB::rollback();
        return response()->json(['error' => $e->getMessage(), ], 500);
      }

    }

    private function handleFile($file, $destination) {
      if($file->isValid()) {
        $file_name = $file->getClientOriginalName();
        $file->move($destination, $file_name);
        return $file_name;
      }

      return null;
    }

}
