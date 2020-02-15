@extends('../../layouts/my')
@section('title', 'Favorite')
@section('content')
<!-- View uploaded image -->
@include('../../layouts/posts', array('images'=>$images))
@include('../../layouts/pagination', ['page' => $page, 'maxPage' => $maxPage])
@endsection()