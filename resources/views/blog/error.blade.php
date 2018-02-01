@extends('layouts.blog')
@section('title')出错了@endsection
@section('section-right')@endsection
@section('css')
    @parent()
    <style type="text/css">
        #main_left{width:100%;}
        .post{
            min-height:380px;}
    </style>
@endsection
@section('content')

    <div class="post">

        <div class="post_title">
            <h1>Oh~ my god! what are you doing?</h1>
        </div>

        <div class="post_body">
            <p>{{ request()->get('message') }}，点此 <a href="javascript:window.history.go(-1)">返回</a></p>
        </div>

    </div>
@endsection