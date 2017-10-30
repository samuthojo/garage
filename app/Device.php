<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Device extends Model
{
  use SoftDeletes;

  protected $guarded = ['id', ];

  protected $dates = ['deleted_at', ];

  public function customer() {
    return $this->belongsTo('App\Customer');
  }

}
