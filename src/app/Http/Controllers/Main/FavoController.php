<?php

namespace App\Http\Controllers\Main;

use App\User;
use App\Model\Post;
use App\Model\Like;
use App\Http\Controllers\Controller;
use Socialite;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;


class FavoController extends Controller
{
  public function index(Request $request)
  {
    if(isset($request->page)){
      $page = $request;
    }else{
      $page = 1;
    }
      
  

    $all = Like::select('public.posts.id', 'public.posts.image', 'public.posts.caption', 'public.posts.user_id', 'public.users.github_id')
                    ->join('public.posts', 'public.likes.image_id', '=', 'public.posts.id')
                    ->join('public.users', 'public.posts.user_id', '=', 'public.users.id')
                    ->where('public.likes.user_id', auth()->user()->id);

    $images = $all->orderBy('public.posts.id', 'desc')
                    ->offset(($page - 1) * 10)->limit(10)
                    ->get();

    $maxPage = ceil($all->count() / 10);

    return view('main/favo',[
      'head' => 'お気に入り',
      'images' => $images,
      'page' => $page,
      'maxPage' => $maxPage
    ]);
  }
}
