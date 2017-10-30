<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Notification extends Model
{
    use SoftDeletes;

    protected $guarded = ['id', ];

    protected $dates = ['date', 'deleted_at', ];

    public function customer() {
      return $this->belongsTo('App\Customer');
    }
}
