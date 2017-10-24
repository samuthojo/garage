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

    public function car() {
      return $this->belongsTo('App\Car');
    }

    public function customer() {
      return $this->belongsTo('App\Customer');
    }

    public function serviceAsProduct() {
      return $this->belongsTo('App\ServiceAsProduct');
    }

    public function getDateAttribute($value) {
      return Carbon::parse($value)->format('d-m-Y');
    }

    public function setDateAttribute($date) {
      $this->attributes['date'] = Carbon::parse($date)->format('Y-m-d');
    }

    public function getCreatedAtAttribute($value) {
      return Carbon::parse($value)->format('d-m-Y');
    }

    public function getUpdatedAtAttribute($value) {
      return Carbon::parse($value)->format('d-m-Y');
    }

    public function getStatusAttribute($status) {
      $st = "";
      if($status == 0) {
        $st =  'Pending';
      } else if($status == 1) {
        $st = 'Accepted';
      } else if($status == 2) {
        $st = 'Serviced';
      } else {
        $st = ($status == 3) ? 'Rescheduled' : 'Rejected';
      }
      return $st;
    }

}
