@extends('layouts.blog')
@section('title')编辑文章@endsection
@section('section-right')@endsection
@section('css')
    @parent()
    <link rel="stylesheet" href="{{ asset('css') }}/blog.css" type="text/css" media="screen" />
    <style type="text/css">
        #main_left{width:100%;}
    </style>
@endsection
@section('content')

    <div class="post">

        <div class="post_title">
            <h1>编辑文章</h1>
        </div>

        <div class="post_body">
            <form action="{{ route('blog_edit_store',['id' => $post->id]) }}" method="post">
                <div class="form-group">
                    <label for="title">标题</label>
                    <input type="text" name="title" id="title" value="{{ $post->title }}">
                </div>

                <div class="form-group">
                    <label for="content">内容</label>
                    <textarea name="content" id="content" style="width:750px;height:300px;">{{ $post->content }}</textarea>
                </div>

                <div class="form-group">
                    <label for="tags">标签</label>
                    <input type="text" id="tags" name="tags"
                           placeholder="多个的话以空格分割"
                           value="@foreach($post->tags as $tag){{ $tag->name }} @endforeach">
                    <span style="opacity: 0.6">如：PHP js</span>
                </div>

                <div class="form-group">
                    <input type="hidden" name="_token" value="{{ csrf_token() }}">
                    <input type="submit" value="提交">
                </div>
            </form>

            @if (count($errors) > 0)
                <div class="alert alert-danger">
                    <ul>
                        @foreach ($errors->all() as $error)
                            <li style="color:darkred;">{{ $error }}</li>
                        @endforeach
                    </ul>
                </div>
            @endif

        </div>
    </div>
@endsection

@section('javascript')
    <script charset="utf-8" src="{{ asset('editor') }}/kindeditor-all-min.js"></script>
    <script charset="utf-8" src="{{ asset('editor') }}/lang/zh-CN.js"></script>
    <script>
        KindEditor.ready(function(K) {
            window.editor = K.create('#content',{
                uploadJson : '{{ asset('editor') }}/php/upload_json.php',
                fileManagerJson : '{{ asset('editor') }}/php/file_manager_json.php',
                allowFileManager : true
            });
        });
    </script>
@endsection