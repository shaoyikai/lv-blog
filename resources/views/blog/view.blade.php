@extends('layouts.blog')
@section('title'){{ $post->title }}@endsection
@section('content')

    <div class="post" id="post-28">

        <div class="post_title">
            <h1 class="left">{{ $post->title }}</h1>
            <div class="post_date right">{{ $post->created_at }}</div>
            <div class="clearer">&nbsp;</div>
        </div>

        <div class="post_body">

            <p>{!! $post->content !!}</p>

            <div class="post_metadata">
                <div class="content">
                    <div class="left">
                        作者：<a href="#">{{ $post->users->name }}</a>，标签：
                        @foreach($post->tags as $tag)
                            <a href="#">{{ $tag->name }}</a>@if(!last($post->tags)),@endif
                        @endforeach
                    </div>
                    <div class="right"><span class="comment"><a href="#respond">留言</a></span></div>
                    <div class="clearer">&nbsp;</div>
                </div>
            </div>

        </div>

        <div class="post_bottom"></div>

    </div>

    <div class="post" id="comments">

        <div class="post_title">
            <h1>{{ count($post->comments) }} Responses to &#8220;{{ $post->title }}&#8221;</h1>
        </div>

        <div class="post_body nicelist">

            <ol>

                <?php $i=0;?>
                @foreach($post->comments as $comment)
                    <li @if($i%2==0)class="alt"@endif>
                        <div class="comment_gravatar left">
                            <img alt="" src="{{ asset('img') }}/sample-gravatar.jpg" height="32" width="32"/>
                        </div>

                        <div class="comment_author left">
                            <span class="comment">name{{ $comment->users_id }}</span>
                            <div class="date"><a href="#">{{ $comment->created_at }}</a></div>
                        </div>

                        <div class="clearer">&nbsp;</div>

                        <div class="body">
                            <p>{{ $comment->content }}</p>
                        </div>

                    </li>
                @endforeach
            </ol>

        </div>

    </div>

    <div class="post" id="respond">

        <div class="post_title"><h1>留言</h1></div>

        <div class="post_body">

            <form action="#" method="post" id="commentform">

                <p>欢迎留下您的观点</p>

                <p>
                    <input type="text" name="author" id="author" size="22" tabindex="1" class="styled"/> <label
                            for="author">
                        <small>您的称呼</small>
                    </label>
                </p>

                <p><textarea name="comment" id="comment" cols="100%" rows="6" tabindex="2"></textarea></p>

                <p><input type="image" src="{{ asset('img') }}/button_submit.gif" tabindex="3"/></p>

            </form>

        </div>

        <div class="post_bottom"></div>

    </div>
@endsection