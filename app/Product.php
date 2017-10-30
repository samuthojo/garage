<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

use Carbon\Carbon;

class Product extends Model
{
  use SoftDeletes;

  /**
   * The name of the "created at" column.
   *
   * @var string
   */
  const CREATED_AT = 'date_added';

  /**
   * The name of the "updated at" column.
   *
   * @var string
   */
  const UPDATED_AT = 'date_modified';

  protected $guarded = ['id', ];

  protected $dates = ['deleted_at', ];

  public function purchases() {
    return $this->hasMany('App\Purchase');
  }

  public function car() {
    return $this->belongsTo('App\Car')->withDefault([
        'name' => 'All',
    ]);
  }

  public function car_model() {
    return $this->belongsTo('App\CarModel')->withDefault([
        'model_name' => 'All',
    ]);
  }

  public function category() {
    return $this->belongsTo('App\Category');
  }

  public function getDateAddedAttribute($value) {
    return Carbon::parse($value)->format("j M \\'y");
  }

  public function getDateModifiedAttribute($value) {
    return Carbon::parse($value)->format("j M \\'y");
  }

  // public function setHasIncludesAttribute($value) {
  //   $this->attributes['has_includes'] =
  //     (strcasecmp($value, 'yes')) ? true : false;
  // }

  // public function getIncludePriceAttribute($price) {
  //   return sprintf('%s', number_format($price, 0));
  // }

}
