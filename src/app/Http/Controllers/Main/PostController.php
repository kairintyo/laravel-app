<?php

namespace App\Http\Controllers\Main;

use App\Model\Post;
use App\Model\Like;
use App\Model\Comment;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class PostController extends Controller
{
  public function index(Request $request)
  {
    return view('main/post');
  }

  public function upload(Request $request)
  {
    $this->validate($request, [
      'user_id' => 'required',
      'caption' => 'required|max:200',
      'image' => 'required|file|image|mimes:jpeg,png|max:60000',
    ]);

    if($request->file('image')->isValid([])){
      $now = date("Y/m/d H:i:s");
      $user_id = $request->user_id;
      $caption = $request->caption;
      $image = base64_encode(file_get_contents($request->image->getRealPath()));

      Post::insert([
        "image" => $image,
        "caption" => $caption,
        "user_id" => $user_id,
        "created_at" => $now,
        "updated_at" => $now
      ]);
      $posts = Post::all();

      return redirect('home');
    }else{
      return redirect()
          ->back()
          ->withInput()
          ->withErrors();
    }
  }

  public function show(Request $request)
  {
    $post = Post::find($request->id);
    $comments = Comment::where('post_id', $request->id)->get();

    return view('main/post_show', [
      'post' => $post,
      'comments' => $comments,
    ]);
  }

  public function delete(Request $request)
    {
      Post::where('id', $request->id)->delete();
      return redirect('home');
    }
}
