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
        return $request->all();
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
                    $service->car = $serv->car()->first()->name;
                    $service->model = $serv->car_model()->first()->model_name;

                    return $service;
                  });
      $cars = Car::all();
      return view('fetch_all.services', compact('services', 'cars'));
    }

    public function service(ServiceAsProduct $service) {
      $services = Service::all();

      $service->service = $service->service()->first()->name;
      $service->car = $service->car()->first()->name;
      $service->model = $service->car_model()->first()->model_name;
      $service->description = $service->service()->first()->description;
      $service->picture = $service->service()->first()->picture;

      $cars = Car::all();
      $models = $service->car()->first()->models;

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
      Order::where('id', $id)->update(['status' => $status,]);
      if($status == "accepted") {
        //To do: Send Push Notification
      } else if($status == "rejected") {
        //To do: Send Push Notification
      }
      return $this->orders();
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
      if($request->filled('date')) {
        $date = $request->input('date');
        $date = Carbon::parse($date)->format('Y-m-d');
        $status = $request->input('status');
        CustomerService::where('id', $id)->update(compact('status', 'date'));
      } else {
        CustomerService::where('id', $id)->update($request->only('status'));
      }

      //To do send notification to customer
      $this->sendNotification($request->all());

      $service_as_product_id = CustomerService::find($id)->serviceAsProduct()
                                                         ->first()
                                                         ->id;

      // For a route with the following URI: requested_services/{service}
      return redirect()->route('requested_service', ['service' => $service_as_product_id]);
    }

    private function sendNotification($request) {
      //0: penging, 1: accepted, 2: serviced, 3: reschedule, 4: reject
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
      if($type == 'service') {
        Service::create(request()->all());
        return $this->services();
      } else if($type == 'category') {
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
        $models = $car->models; //all the models of this make
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
      if($request->hasFile('picture')) {
        $file = $request->file('picture');
        $destination = 'uploads/models';
        $file_name = handleFile($file, $destination);
        $data = array_add($data, 'picture', $file_name);
        CarModel::create($data);
      } else {
        CarModel::create($data);
      }
      return redirect()->route('models_of_make', ['car_make' => $car_id]);
    }

    private function handleFile($file, $destination) {
      if($file->isValid()) {
        $file_name = $file->getClientOriginalName();
        $file->move($destination, $file_name);
        return $file_name;
      } else {
        return null;
      }
    }
}
