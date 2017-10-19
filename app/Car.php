<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Carbon\Carbon;

class Car extends Model
{

  use SoftDeletes;

  /**
   * The name of the "created at" column.
   *
   * @var string
   */
  const CREATED_AT = 'date_added';

  protected $guarded = ['id', ];

  protected $dates = ['deleted_at', ];

  public function products() {
    return $this->hasMany('App\Product');
  }

  public function models() {
    return $this->hasMany('App\CarModel');
  }

  public function service_as_products() {
    return $this->hasMany('App\ServiceAsProduct');
  }

  public function customerCars() {
    return $this->hasMany('App\CustomerCar');
  }

  public function customerServices() {
    return $this->hasMany('App\CustomerService');
  }

  public function getDateAddedAttribute($value) {
    return Carbon::parse($value)->format("j M \\'y");
  }

  public function getUpdatedAtAttribute($value) {
    return Carbon::parse($value)->format("j M \\'y");
  }

}
