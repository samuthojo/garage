<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Purchase extends Model
{
    use SoftDeletes;

    protected $guarded = ['id', ];

    protected $dates = ['deleted_at', ];

    public function product() {
      return $this->belongsTo('App\Product');
    }

    public function order() {
      return $this->belongsTo('App\Order');
    }

    // public function getPriceAttribute($price) {
    //   return sprintf('%s', number_format($price, 0));
    // }

    // public function getTotalPriceAttribute($price) {
    //   return sprintf('%s', number_format($price, 0));
    // }
    //
    // public function getIncludePriceAttribute($price) {
    //   return (!is_null($price)) ? sprintf('%s', number_format($price, 0)) : "-";
    // }
    //
    // public function getIncludesAttribute($includes) {
    //   return (!is_null($includes)) ? $includes : "-";
    // }

}
