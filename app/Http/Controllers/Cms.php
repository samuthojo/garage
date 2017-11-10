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
use App\Http\Requests\CreateProduct;
use App\Http\Requests\CreateCar;
use App\Http\Requests\CreateModel;
use App\Http\Requests\CreateNewService;
use App\Http\Requests\CreateServiceFromExisting;
use App\Http\Requests\EditService;

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
      $categories = Category::orderBy('updated_at', 'desc')->get();
      return view('dashboard')->with('categories', $categories);
    }

    public function services() {
      $main_services = Service::all();

      $services = ServiceAsProduct::orderBy('updated_at', 'desc')
                  ->get()->map(function($serv) {
                    $service = $serv;
                    // $service->service = $serv->service()->first()->name;
                    $service->name = $serv->service()->first()->name;
                    $service->description = $serv->service()->first()->description;
                    $car = $serv->car;
                    $service->car = $car->name;
                    $model = $serv->car_model;
                    $service->model = $model->model_name;

                    return $service;
                  });
      $cars = Car::all();
      $models = null;
      return view('fetch_all.services', compact('services', 'cars',
                                                  'main_services',
                                                  'models'));
    }

    public function service(ServiceAsProduct $service) {
      $main_services = Service::all();

      // $service->service = $service->service()->first()->name;
      $service->name = $service->service()->first()->name;
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

      return view('specific.service', compact('service', 'main_services', 'cars', 'models'));
    }

    public function newService(CreateNewService $request) {
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

    public function newService2(CreateServiceFromExisting $request) {
      $data = $request->only('service_id', 'car_id', 'car_model_id', 'price');
      $service = ServiceAsProduct::create($data);
      return $this->services();
    }

    public function updateService(EditService $request, $location) {
      $data1 = "";
      if($request->exists('car_model_id')) {
        $data1 = $request->only('service_id', 'car_id', 'car_model_id', 'price');
      } else {
        $data1 = $request->only('service_id', 'car_id', 'price');
        $data1 = array_add($data1, 'car_model_id', null);
      }
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

            if($location == "service") {
              return redirect()->route('my_service', ['service' => $id]);
            }
            return redirect()->route('services');
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

            if($location == "service") {
              return redirect()->route('my_service', ['service' => $id]);
            }
            return redirect()->route('services');
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
      return 1;
    }

    public function products() {
      $categories = Category::all();
      $products = Product::orderBy('date_modified', 'desc')
                         ->get()
                         ->map( function($prod) {
                           $myProd = $prod;
                           $myProd->product_category = $prod->category()
                                                            ->first()
                                                            ->name;
                           $car = $prod->car;
                           $model = $prod->car_model;
                           $myProd->car = $car->name;
                           $myProd->car_model = $model->model_name;
                           return $myProd;
                         });
      $cars = Car::all();

      return view('fetch_all.products', [
          'products' => $products,
          'categories' => $categories,
          'cars' => $cars,
          'models' => null,
          'category' => null,
          'car' => null,
          'car_model' => null,
      ]);
    }

    public function productParticulars(Product $product) {
      $car = $product->car;
      $car_model = $product->car_model;
      $category = $product->category;
      $models = null;
      if(($product->car()->first()) instanceof Car) {
        $models = $car->models;
      }

      return response()->json(compact('models', 'category', 'product',
                                      'car', 'car_model'), 200);
    }

    public function customers() {
      $customers = Customer::orderBy('updated_at', 'desc')->get();
      return view('fetch_all.customers')->with('customers', $customers);
    }

    public function customer(Customer $customer) {
      return view('specific.customer', compact('customer'));
    }

    public function updateCustomer(Request $request) {
      $id = $request->only('id');
      Customer::where('id', $id)->update(['verified' => true,]);
      return 1;
    }

    public function cars() {
      $cars = Car::orderBy('updated_at', 'desc')
                 ->where('status', true)
                  ->get()
                  ->map( function($car) {
                    $myCar = $car;
                    $myCar->num_models = $car->models()
                                             ->where('status', true)
                                             ->count();
                    return $myCar;
                  });
      return view('fetch_all.cars')->with('cars', $cars);
    }

    public function categories() {
      $categories = Category::orderBy('updated_at', 'desc')->get();
      return view('fetch_all.categories')->with('categories', $categories);
    }

    public function orders() {
      $orders = Order::orderBy('updated_at', 'desc')
                     ->get()
                     ->map(function($ord){
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
      $customer = $order->customer()->first();
      $customer_name = $customer->name;
      $contact = $customer->phonenumber;
      return view('specific.order_items', compact('purchases', 'order',
                                                  'customer_name', 'contact'));
    }

    public function updateOrder(Request $request) {
      extract($request->all());

      $st = "";
      if(strcasecmp($status, 'accepted') == 0) {
        $st = 1;
      } else {
        $st = (strcasecmp($status, 'rejected') == 0) ? 4 : 2;
      }

      if($request->filled('reason')) {
        Order::where('id', $id)->update(['status' => $st, 'comment' => $reason,]);
      } else {
        Order::where('id', $id)->update(['status' => $st,]);
      }

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

    public function getOrderComment(Order $order) {
      $comment = $order->comment;
      return response()->json(compact('comment'));
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
      // $service_as_products =
      //     DB::table('customer_services')
      //       ->join('service_as_products', 'service_as_products.id', '=',
      //                           'customer_services.service_as_product_id')
      //       ->join('services', 'services.id', '=', 'service_as_products.service_id')
      //       ->join('cars', 'cars.id', '=', 'service_as_products.car_id')
      //       ->join('car_models', 'car_models.id', '=', 'service_as_products.car_model_id')
      //       ->whereIn('service_as_products.id', $service_as_product_ids)
      //       ->select('service_as_products.*', 'services.name as service',
      //                'cars.name as car', 'car_models.model_name as model',
      //                DB::raw('count(*) as customers'))
      //       ->groupBy('service_as_products.id')
      //       ->get();
      $service_as_products = ServiceAsProduct::whereIn('id', $service_as_product_ids)
                            ->get()
                            ->map( function($serv) {
                              $service = $serv;
                              $service->service = $serv->service()->first()->name;
                              $car = $serv->car;
                              $model = $serv->car_model;
                              $service->car = $car->name;
                              $service->model = $model->model_name;
                              $service->customers = $serv->customerServices()->count();
                              return $service;
                            });
      return view('fetch_all.requested_services', compact('service_as_products'));
    }

    public function requestedServiceDetails(ServiceAsProduct $service) {
      $serv = $service->service()->first()->name;
      $my_car = $service->car;
      $car = $my_car->name;
      $my_model = $service->car_model;
      $model = $my_model->model_name;

      $details = $service->customerServices()
                         ->latest('updated_at')
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
      if($request->filled(['date', 'reason'])) {
        $date = $request->input('date');
        $date = Carbon::parse($date)->format('Y-m-d');
        $comment = $request->input('reason');
        CustomerService::where('id', $id)->update(compact('status', 'date', 'comment'));
      }
      else if($request->filled('date')) {
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
      $model = $service_as_product->car_model;
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

    public function requestDetails(CustomerService $service) {
      return response()->json(compact('service'));
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

    public function createProduct(CreateProduct $request) {
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
    }

    public function createCar(CreateCar $request) {
      $data = $request->except('picture');
      if($request->hasFile('picture')) {
        $logo = $request->file('picture');
        $picture = $logo->getClientOriginalName();
        $logo->move('uploads/cars', $picture);
        $data = array_add($data, 'picture', $picture);
        Car::create($data);
      } else {
        Car::create($data);
      }
      return $this->cars();
    }

    public function store(Request $request, $type) {
      if($type == 'category') {
        Category::firstOrCreate(request()->all());
        return $this->categories();
      } else if($type == 'product') {

      } else if($type == 'car') {

      }
    }

    public function updateProduct(CreateProduct $request, $location) {
      $id = $request->input('id');
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
      if($location == "product") {
        return redirect()->route('view', ['type' => 'product', 'id' => $id]);
      }
      else if ($location == "products") {
        return $this->products();
      }
    }

    public function updateCar(CreateCar $request, $location) {
      $id = $request->input('id');
      $data = $request->except('picture');
      if($request->hasFile('picture')) {
        $logo = $request->file('picture');
        $picture = $logo->getClientOriginalName();
        $logo->move('uploads/cars', $picture);
        $data = array_add($data, 'picture', $picture);
        Car::where('id', $id)->update($data);
      } else {
        Car::where('id', $id)->update($data);
      }
      if($location == 'car') {
      return redirect()->route('view',
                          ['type' => 'car', 'id' => $id]);
      }
      else if($location == 'cars') {
        return $this->cars();
      }
    }

    public function update(Request $request, $type) {
      $id = $request->input('id');
      if($type == 'category') {
        Category::where('id', $id)->update(request()->except('id'));
        return $this->categories();
      } else if($type == 'product') {

      } else if($type == 'car') {

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
        $car = Car::find($id);
        $this->deleteAllCarModels($car);
        $this->deactivateCarServices($car);
        Car::where('id', $id)->update(['status' => false,]);
        return $this->cars();
      } else if($type == 'model') {

      }
    }

    private function deleteAllCarModels($car) {
      $model_ids = $car->models()->where('status', true)
                                 ->get(['id'])
                                 ->map( function($myId) {
                                   return $myId->id;
                                 });
      foreach ($model_ids as $model_id) {
        CarModel::where('id', $model_id)->update(['status' => false,]);
      }
    }

    private function deactivateCarServices($car) {
      $service_as_product_ids = $car->service_as_products()
                                    ->get(['id'])
                                    ->map( function($myId) {
                                      return $myId->id;
                                    });
      foreach ($service_as_product_ids as $id) {
        ServiceAsProduct::where('id', $id)->update(['status' => false]);
      }
    }

    public function view($type, $id) {
      if($type == 'product') {
        $product = Product::find($id);
        $category = $product->category; //the category it belongs to
        $car = $product->car; //the make it belongs to
        $models = "";
        if(($product->car()->first()) instanceof Car) {
          $models = $car->models; //all the models of this make
        } else {
          $models = null;
        }
        $cars = Car::where('status', true)->get();
        $car_model = $product->car_model; //the car_model it belongs to
        $categories = Category::all();
        return view('specific.product', compact('product', 'category', 'car',
                                  'models', 'cars', 'categories', 'car_model'));
      } else if($type == 'car') {
        $car = Car::find($id);
        $car->num_models = $car->models()->where('status', true)->count();
        $car_make = $car;
        $models = $car->models()->where('status', true)
                                ->latest('updated_at')
                                ->get();
        return view('specific.car', compact('car', 'car_make', 'models'));
      }
    }

    /*
     *@var the id of the car_make
     *@return All Models of that car_make
     */
    public function models(Car $car_make) {
      $models = $car_make->models;

      return response()->json($models);
    }

    public function viewModels(Car $car_make) {
      $models = $car_make->models()
                         ->where('status', true)
                         ->orderBy('updated_at', 'desc')->get();

      return view('specific.models', compact('models', 'car_make'));
    }

    public function modelDetails(CarModel $model) {
      $car = $model->car;
      $model->car = $car->name;
      $cars = Car::where('status', true)->get();
      return view('specific.model', compact('model', 'cars'));
    }

    public function newModel(CreateModel $request) {
      $data = $request->except('picture');
      $car_id = $request->input('car_id');
      $car = Car::find($car_id);
      if($request->hasFile('picture')) {
          $file = $request->file('picture');
          $destination = 'uploads/models';
          $file_name = $this->handleFile($file, $destination);
          $data = array_add($data, 'picture', $file_name);

          CarModel::create($data);

      } else {
          CarModel::create($data);
      }
      return redirect()->route('view', [
        'type' => 'car',
        'id' => $car_id,
      ]);
    }

    public function updateModel(CreateModel $request) {
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
      $car_id = CarModel::find($model)->car()->first()->id;
      return redirect()->route('view', [
        'type' => 'car',
        'id' => $car_id,
      ]);
    }

    public function deleteModel(Request $request) {
      $model_id = $request->input('id');
      $car = CarModel::find($model_id)->car;
      //Deactivate All Services that used the model
      $this->deactivateCarServices($car);
      //Delete the model
      CarModel::where('id', $model_id)->update(['status' => false,]);
      return redirect()->route('view', [
        'type' => 'car',
        'id' => $car->id,
      ]);
    }

    private function handleFile($file, $destination) {
      if($file->isValid()) {
        $file_name = $file->getClientOriginalName();
        $file->move($destination, $file_name);
        return $file_name;
      }

      return null;
    }

    public function getModelsFromServiceId($service_as_product_id) {
      $service = ServiceAsProduct::find($service_as_product_id);
      $models = "";
      if(($service->car()->first()) instanceof Car) {
        $models = $service->car()->first()->models;
      }
      else {
        $models = null;
      }
      return response()->json(compact('models'));
    }

}
