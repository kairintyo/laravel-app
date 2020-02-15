@extends('../../layouts/my')
@section('title', 'Home')
@section('content')
<!-- View uploaded image -->
@include('../../layouts/posts', array('images'=>$images))
@include('../../layouts/pagination', ['page' => $page, 'maxPage' => $maxPage])
@endsection
