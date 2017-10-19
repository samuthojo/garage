<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Carbon\Carbon;

class CustomerService extends Model
{
    use SoftDeletes;

    protected $dates = ['deleted_at', ];

    protected $guarded = ['id', ];

    public function getDateAttribute($value) {
      return Carbon::parse($value)->format('d-m-Y');
    }

    public function getCreatedAtAttribute($value) {
      return Carbon::parse($value)->format('d-m-Y');
    }

    public function car() {
      return $this->belongsTo('App\Car');
    }

    public function customer() {
      return $this->belongsTo('App\Customer');
    }

    public function serviceAsProduct() {
      return $this->belongsTo('App\ServiceAsProduct');
    }

}
