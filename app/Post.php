<?php

namespace App;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Model;

class Post extends Model
{

  protected $dates = ['updated_at'];

  // Get the user data the owns the post
  public function user()
  {
    return $this->belongsTo('App\User', 'author_ID');
  }

  // Return created at date in this format everytime
  public function getCreatedAtAttribute($value)
  {
    return (new Carbon($value))->format('M-d-Y');
  }

}
