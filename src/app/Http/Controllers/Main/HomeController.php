<?php

namespace App\Http\Controllers\Main;

use Auth;
use App\user;
use App\Model\Post;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\DB;


class HomeController extends Controller
{
  public function index(Request $request)
  {
    // pagination
    if (isset($request->page)) {
      $page = $request->page;
    } else {
        $page = 1;
    }

    // get all images
    $posts = Post::orderBy('id', 'desc')
                  ->offset(($page - 1) * 10)->limit(10)
                  ->get();

    // compute max number of page
    $maxPage = ceil(Post::count() / 10);

    return view('main/home', [
      'head' => '投稿一覧',
      'images' => $posts,
      'page' => $page,
      'maxPage' => $maxPage
    ]);
  }
}
