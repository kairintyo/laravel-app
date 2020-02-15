<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    {{-- CSRF token --}}
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>@yield('title')</title>

    {{-- CSS --}}
    <link href="{{ asset('css/app.css') }}" rel="stylesheet">
</head>

<body>
<div id="app">
    {{-- Header / Navbars --}}
    <nav class="navbar sticky-top navbar-expand-lg navbar-dark bg-dark">
        <div class="container">
            {{-- Logo --}}
            <a class="navbar-brand" href="{{ url('/home') }}">
                <img src="https://github.com/kairintyo.png" width="30" height="30" class="d-inline-block align-top" alt="">
                KuApp
            </a>
            <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>

            <div class="collapse navbar-collapse" id="navbarSupportedContent">
                {{-- Navbar on left --}}
                <ul class="navbar-nav mr-auto">
                    {{-- Latest, Ranking --}}
                    <li class="nav-item active">
                        <a class="nav-link" href="/home"> 投稿一覧 <span class="sr-only">(current)</span></a>
                    </li>
                </ul>

                {{-- Navbar on center / Search --}}
                <form class="form-inline my-2 my-lg-0" action="/search" method="get">
                    <input class="form-control mr-sm-2" type="search" placeholder="部分一致検索" aria-label="Search" name="target">
                    <button class="btn btn-outline-success my-2 my-sm-0" type="submin">検索</button>
                </form>

                {{-- Navbar on right --}}
                <ul class="navbar-nav ml-auto">
                    {{-- Post --}}
                    <li class="nav-item">
                        @guest
                            <a class="btn btn-success" href="{{ url('/') }}" id="new-post">新規投稿</a>
                        @else
                            <a class="btn btn-success" href="{{ url('/post') }}" id="new-post">新規投稿</a>
                        @endguest
                    </li>

                    {{-- Profile, Favorites, Login/Logout --}}
                    @guest
                        {{-- Dropdown menu --}}
                        <li class="nav-item dropdown">
                            <a class="nav-link dropdown-toggle" href="#" id="dropdown-user" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                Guest <span class="caret"></span>
                            </a>
                            <div class="dropdown-menu dropdown-menu-right" aria-labelledby="dropdown-user">
                                <a class="dropdown-item" href="{{ url('/') }}">プロフィール</a>
                                <div class="dropdown-divider"></div>
                                <a class="dropdown-item" href="{{ url('/') }}"> ログイン </a>
                            </div>
                        </li>
                    @else
                        {{-- Dropdown menu --}}
                        <li class="nav-item dropdown">
                            <a class="nav-link dropdown-toggle" href="#" id="dropdown-user" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                {{ auth()->user()->github_id }} <span class="caret"></span>
                            </a>
                            <div class="dropdown-menu dropdown-menu-right" aria-labelledby="dropdown-user">
                                <a class="dropdown-item" href="{{ url('/user?user_id='.auth()->user()->id) }}">プロフィール</a>
                                <a class="dropdown-item" href="{{ url('/favo') }}">お気に入り</a>
                                <div class="dropdown-divider"></div>
                                <a class="dropdown-item" href="{{ url('/logout') }}">ログアウト</a>
                            </div>
                        </li>
                    @endguest
                </ul>
            </div>
        </div>
    </nav>

    {{-- Main contents --}}
    <main class="py-4">
        @yield('content')
        @yield('posts')
        @yield('pagination')
    </main>
</div>

{{-- JavaScript --}}
<script src="{{ asset('js/app.js') }}"></script>
</body>
</html>