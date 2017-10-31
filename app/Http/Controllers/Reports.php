<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\DB;
use Illuminate\Http\Request;
use App\ServiceAsProduct;
use App\Order;
use App\CustomerService;

class Reports extends Controller {

  public function __construct() {
    //$this->middleware('auth');
  }

  public function reports() {
    return view('reports.reports');
  }

  public function  orderReports(Request $request) {
    $status = $request->input('status');
    if($status == 3) {
      $status++;
    }
    $startDate = $request->input('start_date');
    $endDate = $request->input('end_date');
    if($request->filled(['start_date', 'end_date'])) {
      return $this->orderReportWithBothDates($status, $startDate, $endDate);
    }
    else if($request->filled('start_date')) {
      return $this->orderReportWithStartDate($status, $startDate);
    }
    else {
      return $this->simpleOrderReport($status);
    }
  }

  private function orderReportWithBothDates($status, $startDate,
        $endDate) {

    $conditions = [
        ['status', '=', $status],
        ['updated_at', '>=', $startDate],
        ['updated_at', '<=', $endDate],
     ];

     $orders = Order::where($conditions)
                    ->get()
                    ->map( function($order) {
                      $myOrder = $order;
                      $myOrder->customer = $order->customer()->first()->name;
                      $myOrder->contact = $order->customer()->first()->phonenumber;

                      return $myOrder;
                    });

      $total_amount = DB::table('orders')->where($conditions)->sum('amount');

      return view('reports.orders_report', compact('orders', 'total_amount'));
  }

  private function orderReportWithStartDate($status, $startDate) {
    $conditions = [
        ['status', '=', $status],
        ['updated_at', '>=', $startDate],
     ];

     $orders = Order::where($conditions)
                    ->get()
                    ->map( function($order) {
                      $myOrder = $order;
                      $myOrder->customer = $order->customer()->first()->name;
                      $myOrder->contact = $order->customer()->first()->phonenumber;

                      return $myOrder;
                    });

      $total_amount = DB::table('orders')->where($conditions)->sum('amount');

      return view('reports.orders_report', compact('orders', 'total_amount'));
  }

  private function simpleOrderReport($status) {
     $conditions = [
        ['status', '=', $status],
     ];

    $orders =
       Order::where($conditions)
           ->get()
           ->map( function($order) {
             $myOrder = $order;
             $myOrder->customer = $order->customer()->first()->name;
             $myOrder->contact = $order->customer()->first()->phonenumber;

             return $myOrder;
           });

    $total_amount = DB::table('orders')->where($conditions)->sum('amount');

    return view('reports.orders_report', compact('orders', 'total_amount'));
  }

  public function  requestedServiceReports(Request $request) {
    $status = $request->input('status');
    if($status == 3) {
      $status++;
    } else if($status == 4) {
      $status--;
    }
    $startDate = $request->input('start_date');
    $endDate = $request->input('end_date');
    if($request->filled(['start_date', 'end_date'])) {
      return $this->serviceReportWithBothDates($status, $startDate, $endDate);
    }
    else if($request->filled('start_date')) {
      return $this->serviceReportWithStartDate($status, $startDate);
    }
    else {
      return $this->simpleServiceReport($status);
    }
  }

  private function serviceReportWithBothDates($status, $startDate, $endDate) {
    $conditions = [
        ['status', '=', $status],
        ['updated_at', '>=', $startDate],
        ['updated_at', '<=', $endDate],
     ];

     $service_as_product_ids =
       DB::table('customer_services')
         ->where($conditions)
         ->select('service_as_product_id')
         ->groupBy('service_as_product_id')
         ->get()->map( function($data) {
           return $mydata = $data->service_as_product_id;
         });
     $service_as_products =
      ServiceAsProduct::whereIn('id', $service_as_product_ids)
                     ->get()
                     ->map( function($serv) use($conditions) {
                       $service = $serv;
                       $service->service = $serv->service()->first()->name;
                       $service->car = $serv->car()->first()->name;
                       $service->model = $serv->car_model()->first()->model_name;
                       $service->customers = $serv->customerServices()
                                                  ->where($conditions)
                                                  ->count();
                       return $service;
                     });

     return view('reports.requested_services_report', compact('service_as_products'));
  }

  private function serviceReportWithStartDate($status, $startDate) {
    $conditions = [
        ['status', '=', $status],
        ['updated_at', '>=', $startDate],
     ];

     $service_as_product_ids =
       DB::table('customer_services')
         ->where($conditions)
         ->select('service_as_product_id')
         ->groupBy('service_as_product_id')
         ->get()->map( function($data) {
           return $mydata = $data->service_as_product_id;
         });
     $service_as_products =
      ServiceAsProduct::whereIn('id', $service_as_product_ids)
                     ->get()
                     ->map( function($serv) use($conditions) {
                       $service = $serv;
                       $service->service = $serv->service()->first()->name;
                       $service->car = $serv->car()->first()->name;
                       $service->model = $serv->car_model()->first()->model_name;
                       $service->customers = $serv->customerServices()
                                                  ->where($conditions)
                                                  ->count();
                       return $service;
                     });

     return view('reports.requested_services_report', compact('service_as_products'));
  }

  private function simpleServiceReport($status) {
     $conditions = [
        ['status', '=', $status]
     ];

     $service_as_product_ids =
       DB::table('customer_services')
         ->where($conditions)
         ->select('service_as_product_id')
         ->groupBy('service_as_product_id')
         ->get()->map( function($data) {
           return $mydata = $data->service_as_product_id;
         });
     $service_as_products =
      ServiceAsProduct::whereIn('id', $service_as_product_ids)
                     ->get()
                     ->map( function($serv) use($conditions) {

                       $service = $serv;
                       $service->service = $serv->service()->first()->name;
                       $service->car = $serv->car()->first()->name;
                       $service->model = $serv->car_model()->first()->model_name;
                       $service->customers = $serv->customerServices()
                                                  ->where($conditions)
                                                  ->count();
                       return $service;
                     });

     return view('reports.requested_services_report', compact('service_as_products'));
  }
}
