<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Service extends Model
{
    use SoftDeletes;

    protected $guarded = ['id', ];

    protected $dates = ['deleted_at', ];

    public function customerServices() {
      return $this->hasMany('App\CustomerService');
    }

    public function serviceAsProducts() {
      return $this->hasMany('App\ServiceAsProduct');
    }
}
