@extends('../../layouts/my')
@section('title', 'Home')
@section('content')
<!-- View uploaded image -->
<div class="container">
  <h2>投稿詳細</h2>
  <div class="card-deck">
    @isset ($post)
      <div class="card mb-4 bg-light" style="min-width: 70rem; max-width: 80rem;">
        <div class="row no-gutters">
          <div class="col-md-4 my-auto">
            <img src="data:image/png;base64,{{ $post->image }}" class="card-img-top ml-3" alt="..." height="300">
          </div>
          <div class="col-md-8 mt-5">
            <div class="card-body text-center">
                <blockquote class="blockquote mb-0 ">
                    <p>{{ $post->caption }}</p>
                    <footer class="blockquote-footer">
                    Posted by <a href="/user?user_id={{ $post->user_id }}">{{ App\User::where('id', $post->user_id)->first()->github_id }} </a>
                    </footer>
                </blockquote>
            </div>
            <div class="card-body">
              <div class="text-right mr-5">
                <a href="/like/list?iid={{ $post->id }}" class="card-link btn btn-outline-primary ml-5 mr-2">
                  {{ App\Model\Like::where('image_id', $post->id)->count() }} いいね
                </a>
                @guest
                  <button class="card-link btn btn-outline-primary mr-2" disabled><i class="fa fa-heart" aria-hidden="true"></button>
                @else
                  <form class="d-inline" action="/like" method="post">
                      {{ csrf_field() }}
                      <input type="hidden" name="iid" value="{{ $post->id }}">
                      <input type="hidden" name="user_id" value="{{ auth()->user()->id }}">

                      <?php
                          $row = App\Model\Like::where('image_id', $post->id)
                                              ->where('user_id', auth()->user()->id)
                                              ->get();
                          if (count($row) != 0) { 
                      ?>
                              <button class="card-link btn btn-outline-secondary mr-2"><i class="fa fa-heart" aria-hidden="true"></i></button>
                      <?php
                          } else {
                      ?>
                              <button class="card-link btn btn-outline-danger mr-2">
                              <i class="fa fa-heart" aria-hidden="true" style="color: red;"></i> </button>
                      <?php
                          }
                      ?>
                  </form>
                  <?php
                    $user = \Auth::user();
                    if ($user->id == $post->user_id){
                  ?>
                    <button class="btn btn-outline-secondary" data-toggle="modal" data-target="#exampleModal"> <i class="fas fa-trash-alt"></i> </button>
                  <!-- Modal -->
                      <div class="modal fade" id="exampleModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
                          <div class="modal-dialog" role="document">
                              <div class="modal-content">
                                  <div class="modal-header">
                                      <h5 class="modal-title text-danger" id="exampleModalLabel">注意！</h5>
                                      <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                      <span aria-hidden="true">&times;</span>
                                      </button>
                                  </div>
                                  <div class="modal-body">
                                    本当に削除しますか?
                                  </div>
                                  <div class="modal-footer">
                                      <button type="button" class="btn btn-secondary" data-dismiss="modal">戻る</button>
                                        <form action="/post/delete" method="post">
                                            {{ csrf_field() }}
                                            <input type="hidden" name="id" value="{{ $post->id }}">
                                            <button class="card-link btn btn-danger mr-2">削除</button>
                                        </form>
                                  </div>
                              </div>
                          </div>
                      </div>
                  <?php
                      }
                  ?>
              </div>
                <div class="container">
                  <!-- Form -->
                  <form action="{{ url('comment/create') }}" method="post" enctype="multipart/form-data">
                    <div class="form-group">
                      <input type="hidden" name="user_id" value="{{ auth()->user()->id }}">
                    </div>
                    <div class="form-group">
                      <input type="hidden" name="post_id" value="{{ $post->id }}">
                    </div>
                    <div class="form-group">
                      <label for="comment">コメント</label>
                      <textarea class="form-control" name="comment" rows="4" cols="2"></textarea>
                    </div>
                    {{ csrf_field() }}
                    <button class="btn btn-success"> コメントする </button>
                  </form>
                </div>
                @endguest
            </div>
          </div>
        </div>
      </div>
    @endisset
  </div>
</div>
<div class="container">
  <div class="card-deck">
    @isset ($comments)
      <h2>Comments</h2>
      @foreach($comments as $comment)
        <div class="container">
          <div class="card bg-light mb-3" style="max-width: 70rem;">
            <div class="card-header">
              <a href="/user?uid={{ $comment->user_id }}">{{ App\User::where('id', $comment->user_id)->first()->github_id }} </a>
            </div>
            <div class="card-body">
              <p class="card-text">{{$comment->comment}}</p>
            </div>
          </div>
        </div>
      @endforeach
    @endisset
  </div>
</div>
@endsection
