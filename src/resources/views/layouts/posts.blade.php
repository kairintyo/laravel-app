@section('posts')
<div class="container">
  <h2>{{ $head }}</h2>
  <div class="card-deck">
    @isset ($images)
      @foreach ($images as $d)
        <div class="card mb-4 bg-light" style="min-width: 21rem; max-width: 21rem;">
          <a href="{{ action('Main\PostController@show', $d->id) }}" class="card-link">
            <img src="data:image/png;base64,{{ $d->image }}" class="card-img-top" alt="..." height="300">
          </a>
          <div class="card-body">
            <blockquote class="blockquote mb-0">
              <p>{{ $d->caption }}</p>
              <footer class="blockquote-footer">
              Posted by <a href="/user?user_id={{ $d->user_id }}">{{ App\User::where('id', $d->user_id)->first()->github_id }} </a>
              </footer>
            </blockquote>
          </div>
          <div class="card-body">
            <a href="/like/list?iid={{ $d->id }}" class="card-link btn btn-outline-primary">
              {{ App\Model\Like::where('image_id', $d->id)->count() }} いいね
            </a>
            <a href="{{ action('Main\PostController@show', $d->id) }}" class=" btn btn-outline-success">
              {{ App\Model\Comment::where('post_id', $d->id)->count() }}コメント
            </a>
            @guest
              <button class="card-link btn btn-primary" disabled><i class="fa fa-heart" aria-hidden="true" style="color: red;"></i></button>
            @else
              <form class="d-inline" action="/like" method="post">
                {{ csrf_field() }}
                  <input type="hidden" name="iid" value="{{ $d->id }}">
                  <input type="hidden" name="user_id" value="{{ auth()->user()->id }}">

                  <?php
                    $row = App\Model\Like::where('image_id', $d->id)
                                        ->where('user_id', auth()->user()->id)
                                        ->get();
                    if (count($row) != 0) { 
                  ?>
                    <button class="card-link btn btn-outline-secondary"><i class="fa fa-heart" aria-hidden="true"></i></button>
                  <?php
                    } else {
                  ?>
                    <button class="card-link btn btn-outline-danger">
                    <i class="fa fa-heart" aria-hidden="true" style="color: red;"></i> </button>
                  <?php
                    }
                  ?>
              </form>
                <?php
                  $user = \Auth::user();
                  if ($user->id == $d->user_id){
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
                              <input type="hidden" name="id" value="{{ $d->id }}">
                              <button class="card-link btn btn-danger"> 削除 </button>
                            </form>
                          </div>
                        </div>
                      </div>
                    </div>
                <?php
                  }
                ?>
            @endguest
          </div>
        </div>
      @endforeach
    @endisset
  </div>
</div>
@endsection