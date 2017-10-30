<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Carbon\Carbon;

class ServiceAsProduct extends Model {

    use SoftDeletes;

    protected $guarded = ['id', ];

    public function service() {
      return $this->belongsTo('App\Service');
    }

    public function car() {
      return $this->belongsTo('App\Car')->withDefault([
          'name' => 'All',
      ]);
    }

    public function customerServices() {
      return $this->hasMany('App\CustomerService');
    }

    public function car_model() {
      return $this->belongsTo('App\CarModel')->withDefault([
          'model_name' => 'All',
      ]);
    }

    // public function getPriceAttribute($price) {
    //   return sprintf('%s', number_format($price, 0));
    // }

    public function getCreatedAtAttribute($value) {
      return Carbon::parse($value)->format("j M \\'y");
    }

    public function getUpdatedAtAttribute($value) {
      return Carbon::parse($value)->format("j M \\'y");
    }

    public function getStatusAttribute($status) {
      return ($status) ? 'Active' : 'Inactive';
    }

    public function setStatusAttribute($status) {
      return (strcasecmp($status, 'Active') == 0) ? true : false;
    }
}
