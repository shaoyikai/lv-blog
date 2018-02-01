@extends('layouts.blog')
@section('title')归档@endsection
@section('content')
    {{ $list->appends(['tag' => 'js'])->links('blog.page') }}
    <div class="post">
        <div class="post_title">
            <h1>Tag for &#8216;{{ request()->get('tag') }}&#8217; </h1>
        </div>

        <div class="post_body nicelist">

            <ol>
                @foreach($list as $key=>$value)
                <li @if($key%2 == 0)class="alt"@endif>

                    <div class="archive_title">
                        <a href="{{ route('blog_view',['id'=>$value->id]) }}">{{$value->title}}</a>
                    </div>

                    <div class="archive_postinfo">
                        <div class="date">
                            发表于：{{ $value->created_at }}
                            <a href="#">4 comments</a>
                        </div>
                    </div>

                </li>
                @endforeach
            </ol>
        </div>
    </div>

    {{ $list->appends(['tag' => 'js'])->links('blog.page') }}
@endsection