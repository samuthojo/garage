<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Carbon\Carbon;

class CarModel extends Model
{
  use SoftDeletes;

  protected $guarded = ['id', ];

  protected $dates = ['deleted_at', ];

  public function car() {
    return $this->belongsTo('App\Car');
  }

  public function customerCars() {
    return $this->hasMany('App\CustomerCar');
  }

  public function products() {
    return $this->hasMany('App\Product');
  }

  public function service_as_products() {
    return $this->hasMany('App\ServiceAsProduct');
  }

  public function getCreatedAtAttribute($value) {
    return Carbon::parse($value)->format("j M \\'y");
  }

  public function getUpdatedAtAttribute($value) {
    return Carbon::parse($value)->format("j M \\'y");
  }

}
