@extends('../../layouts/my')
@section('title', 'User')
@section('content')
<div class="container">
  <div>
  <h2>プロフィール</h2>
  </div>
  <div class="card mb-3" style="max-width: 540px;">
    <div class="row no-gutters">
      <div class="col-md-4">
        <img src="https://github.com/{{ $user->github_id }}.png" class="card-img" alt="...">
      </div>
      <div class="col-md-8">
        <div class="card-body">
          <h5 class="card-title">{{ $user->github_id }}</h5>
          <p class="card-text">
            <ul>
              <li>いいね数 : {{ $likes }}</li>
              <li>投稿数 : {{ $posts }}</li>
            </ul>
          </p>
        </div>
      </div>
    </div>
  </div>
  <hr>
    <!-- View uploaded image -->
  @include('../../layouts/posts', array('images'=>$images))
  @include('../../layouts/pagination', ['page' => $page, 'maxPage' => $maxPage])
</div>
@endsection
