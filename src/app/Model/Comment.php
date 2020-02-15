<?php 

namespace App\Model;

use Illuminate\Database\Eloquent\Model;

class Comment extends Model
{
  public function user()
    {
        return $this->belongsTo(App\User::class);
        return $this->belongsTo(App\Model\Post::class);
    }
  protected $fillable = ['post_id', 'user_id', 'comment'];
}
