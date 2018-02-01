@extends('layouts.blog')
@section('title')首页@endsection
@section('content')

    @foreach($data as $post)
        <div class="post">

            <div class="post_title">
                <h1 class="left"><a href="{{ route('blog_view',['id' => $post->id]) }}">{{ $post->title }}</a></h1>
                <div class="post_date right">{{ $post->created_at }}</div>
                <div class="clearer">&nbsp;</div>
            </div>

            <div class="post_body">

                {!! $post->content !!}

                <div class="post_metadata">
                    <div class="content">
                        <div class="left">
                            作者：<a href="#">{{ $post->users->name }}</a>，标签：
                            @foreach($post->tags as $tag)
                                <a href="{{ route('blog_tags',['tag' => $tag->name]) }}">{{ $tag->name }}</a>@if(!last($post->tags)),@endif
                            @endforeach

                        </div>
                        <div class="right">
                            @if(Auth::check())
                            <span><a href="{{ route('blog_edit',['id' => $post->id]) }}">编辑</a></span>
                            <span><a href="javascript:;"
                                     class="link-delete"
                                     data-url="{{ route('blog_delete',['id' => $post->id]) }}">删除</a></span> |
                            @endif
                            <span class="comment"><a href="#">{{ $post->comments->count() }} Comments</a></span>
                        </div>
                        <div class="clearer">&nbsp;</div>
                    </div>
                </div>
            </div>

            <div class="post_bottom"></div>

        </div>
    @endforeach

    {{ $data->links('blog.page') }}

    @section('javascript')
        <script src="https://cdn.bootcss.com/jquery/3.2.0/jquery.min.js"></script>
        <script>
            $(".link-delete").click(function(){
                var url = $(this).data('url');
                if(confirm('删除后无法恢复，您确定要进行删除吗？')){
                    location.href = url;
                }
            });
        </script>
    @endsection

@endsection