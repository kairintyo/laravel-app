<?php

namespace App\Http\Controllers\Main;

use App\user;
use App\Model\Like;
use App\Model\Post;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class LikeController extends Controller
{
  public function index(Request $request)
  {
    $post = Post::where('id', $request->iid)->first();
    $users = Like::select()
                    ->join('public.users', 'public.likes.user_id', '=', 'public.users.id')
                    ->where('image_id', $request->iid)
                    ->get();

    return view('main/like',[
      'users' => $users,
      'image' => $post
    ]);
  }

  public function like(Request $request)
  {
    $previousUrl = app('url')->previous();
    $now = date("Y/m/d H:i:s");

    $row = Like::where('image_id', $request->iid)
                ->where('user_id', $request->user_id)
                ->get();

    if(count($row) == 0)  {
      Like::insert([
        "image_id" => $request->iid,
        "user_id" => $request->user_id,
        "created_at" => $now,
        "updated_at" => $now
      ]);
    }else{
      Like::where('image_id', $request->iid)
                ->where('user_id', $request->user_id)
                ->delete();
    }
    return redirect()->to($previousUrl);
  }
}
