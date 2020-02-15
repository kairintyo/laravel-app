<?php

namespace App\Http\Controllers\Main;

use App\Model\Post;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class SearchController extends Controller
{
  public function search(Request $request)
  {
    // pagination
    if (isset($request->page)) {
        $page = $request->page;
    } else {
        $page = 1;
    }

    // search images
    $tar = $request->target;
    if (isset($request->target)) {
      $posts = Post::where('caption', 'ilike', '%'.$tar.'%')
                      ->orderBy('id', 'desc')
                      ->offset(($page - 1) * 10)->limit(10)
                      ->get();

      $maxPage = ceil($posts->count() / 10);
    } else {
      $posts = null;
      $maxPage = 1;
    }

    return view('main/search', [
      'head' => "検索結果:" . $tar,
      'images' => $posts,
      'page' => $page,
      'maxPage' => $maxPage
    ]);
  }
}
