<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class CustomerCar extends Model
{
    use SoftDeletes;

    /**
     * The name of the "created at" column.
     *
     * @var string
     */
    const CREATED_AT = 'date_added';

    protected $guarded = ['id', ];

    protected $dates = ['date_added', 'deleted_at', ];

    public function car() {
      return $this->belongsTo('App\Car');
    }

    public function car_model() {
      return $this->belongsTo('App\CarModel');
    }

    public function customer() {
      return $this->belongsTo('App\Customer');
    }

}
