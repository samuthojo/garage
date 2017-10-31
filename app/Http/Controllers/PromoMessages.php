<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\OrderPromoMessage;
use App\ServicePromoMessage;
use App\Http\Requests\CreatePromoMessage;

class PromoMessages extends Controller
{
    public function __construct() {
      $this->middleware('auth');
    }

    public function index() {
      $order_promo = OrderPromoMessage::first();
      $service_promo = ServicePromoMessage::first();
      return view('promo.promo_messages', compact('order_promo', 'service_promo'));
    }

    public function orderPromo() {
      $order_promo = OrderPromoMessage::first();
      return response()->json(compact('order_promo'));
    }

    public function servicePromo() {
      $service_promo = ServicePromoMessage::first();
      return response()->json(compact('service_promo'));
    }

    public function updateServicePromo(CreatePromoMessage $request, $id) {
      ServicePromoMessage::where('id', $id)->update($request->only('message'));
      $promo = ServicePromoMessage::find($id);
      return response()->json(compact('promo'));
    }

    public function updateOrderPromo(CreatePromoMessage $request, $id) {
      OrderPromoMessage::where('id', $id)->update($request->only('message'));
      $promo = OrderPromoMessage::find($id);
      return response()->json(compact('promo'));
    }
}
