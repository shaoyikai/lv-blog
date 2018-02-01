@extends('layouts.blog')
@section('title')关于@endsection
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
            <h1>关于</h1>
        </div>

        <div class="post_body">
            <p>It's me! A php web developer engineer.</p>
        </div>

    </div>
@endsection