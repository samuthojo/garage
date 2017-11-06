<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Carbon\Carbon;

class Customer extends Model
{

  use SoftDeletes;

  protected $guarded = ['id', ];

  protected $dates = ['deleted_at', ];

  public function customerCars() {
    return $this->hasMany('App\CustomerCar');
  }

  public function devices() {
    return $this->hasMany('App\Device');
  }

  public function orders() {
    return $this->hasMany('App\Order');
  }

  public function customerServices() {
    return $this->hasMany('App\CustomerService');
  }

  public function feedbacks() {
    return $this->hasMany('App\Feedback');
  }

  public function notifications() {
    return $this->hasMany('App\Notification');
  }

  public function getCreatedAtAttribute($value) {
    return Carbon::parse($value)->format("j M \\'y");
  }

  public function getUpdatedAtAttribute($value) {
    return Carbon::parse($value)->format("j M \\'y");
  }

  public function getVerifiedAttribute($value) {
    return ($value) ? 'Yes' : 'No';
  }

}
