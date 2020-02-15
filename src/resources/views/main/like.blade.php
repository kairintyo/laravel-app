@extends('../../layouts/my')
@section('title', 'Like')
@section('content')
<div class="container">
  <h2>投稿</h2>
  <div class="card mb-3" style="max-width: 1080px;">
    <div class="row no-gutters">
      <div class="col-md-4">
        <img src="data:image/png;base64,{{ $image->image }}" class="card-img-top" alt="...">
      </div>
      <div class="col-md-8">
        <div class="card-body">
          <h3 class="card-title">{{ $image->caption }}</h3>
          <p class="card-text text-muted">
            Posted by <a href="/user?user_id={{ $image->user_id }}">{{ App\User::where('id', $image->user_id)->first()->github_id }} </a>
          </p>
        </div>
      </div>
    </div>
  </div>
  <hr>

  <h2>いいねしたユーザー</h2>
  <!-- View uploaded image -->
  @isset ($users)
    @foreach ($users as $user)
      <a href="/user?user_id={{ $user->id }}">
        <div class="card mb-3" style="max-width: 270px;">
          <div class="row no-gutters">
            <div class="col-md-4">
              <img src="https://github.com/{{ $user->github_id }}.png" class="card-img" alt="..." height="100">
            </div>
            <div class="col-md-8">
              <div class="card-body">
                <h5 class="card-title">{{ $user->github_id }}</h5>
              </div>
            </div>
          </div>
        </div>
      </a>
    @endforeach
  @endisset
</div>
@endsection