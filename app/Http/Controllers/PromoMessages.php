<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\OrderPromoMessage;
use App\ServicePromoMessage;

class PromoMessages extends Controller
{
    public function __construct() {
      $this->middleware('auth');
    }

    public function index() {
      $order_promos = OrderPromoMessage::all();
      $service_promos = ServicePromoMessage::all();
      return view('promo_messages', compact('order_promos', 'service_promos'));
    }
}
