<?php 

namespace App\Http\Controllers\Main;

use App\User;
use App\Model\Post;
use App\Model\Like;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class UserController extends Controller
{
  public function index(Request $request)
  {
    $user_id = $request->user_id;
    $user = User::where('id', $user_id)->first();

    if(isset($request->page)){
      $page = $request->page;
    }else{
      $page = 1;
    }

    $all = Post::where('user_id', $user_id);

    $posts = $all->orderBy("id", "desc")
                ->offset(($page - 1) * 10)->limit(10)
                ->get();

    $posts_count = $all->count();
    $maxPage = ceil($all->count() / 10);

    $likes = 0;
    foreach (Post::where('user_id', $user_id)->get() as $post) {
      $likes += Like::where("image_id", $post->id)->count();
    }

    return view('main/user', [
      'head' => "投稿一覧",
      'user' => $user,
      'images' => $posts,
      'page' => $page,
      'maxPage' => $maxPage,
      'likes' => $likes,
      'posts' => $posts_count
    ]);
  }
}
