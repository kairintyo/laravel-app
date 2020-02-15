<?php

namespace App\Http\Controllers\Main;

use App\Model\Comment;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class CommentController extends Controller
{
  public function create(Request $request)
  {
    $previousUrl = app('url')->previous();
    $this->validate($request, [
      'post_id' => 'required',
      'user_id' => 'required',
      'comment' => 'required|max:255',
    ]);

    Comment::create([
      'post_id' => $request->post_id,
      'user_id' => $request->user_id,
      'comment' => $request->comment,
      ]);

    return redirect()->to($previousUrl);
  }
}
