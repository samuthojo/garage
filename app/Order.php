<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Carbon\Carbon;

class Order extends Model
{
  use SoftDeletes;

  const CREATED_AT = 'date';

  const UPDATED_AT = 'updated_at';

  protected $dates = ['deleted_at', ];

  protected $guarded = ['id', ];

  public function getDateAttribute($value) {
    return Carbon::parse($value)->format('d-m-Y');
  }

  public function purchases() {
    return $this->hasMany('App\Purchase');
  }

  public function customer() {
    return $this->belongsTo('App\Customer');
  }

  public function getAmountAttribute($amount) {
    return sprintf('%s', number_format($amount, 0));
  }
}
