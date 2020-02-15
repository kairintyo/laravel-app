<?php

namespace App\Model;

use Illuminate\Database\Eloquent\Model;

class Like extends Model
{
  public function user()
    {
        return $this->belongsTo(App\User::class);
    }

  protected $fillable = ['image_id', 'user_id'];
}
