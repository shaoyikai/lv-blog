<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml" dir="ltr">

<head profile="http://gmpg.org/xfn/11">
    <meta http-equiv="Content-Type" content="text/html; charset=UTF-8" />
    <meta name="description" content="description"/>
    <meta name="keywords" content="keywords"/>
    <meta name="author" content="author"/>
    <title>博客 @yield('title')</title>

    @section('css')
        <link rel="stylesheet" href="{{ asset('css') }}/style.css" type="text/css" media="screen" />
        <!--[if lte IE 7]>
        <link rel="stylesheet" type="text/css" href="{{ asset('css') }}/ie_fixes.css" media="screen" />
        <![endif]-->
    @show

</head>

<body>

<?php
$current_route = \Request::route()->getName();

// archieves
$sql_posts = "select date_format(created_at,'%Y-%m') as created_at_format,count(id) as num
from posts group by created_at_format order by created_at_format";

$posts = \Illuminate\Support\Facades\DB::select($sql_posts);
$dateArr = [];
foreach($posts as $p){
    $dateArr[$p->created_at_format] = $p->num;
}

// tags
$sql_tags = "select DISTINCT(`name`) as tag_name,count(id) as num
from tags group by tag_name";

$tags = \Illuminate\Support\Facades\DB::select($sql_tags);
$tagsArr = [];
foreach($tags as $t){
    $tagsArr[$t->tag_name] = $t->num;
}
?>
<div id="layout_wrapper">
    <div id="layout_edgetop"></div>

    <div id="layout_container">

        <div id="site_title">

            <h1 class="left"><a href="#">Tech Knowledge Blog</a></h1>
            <h2 class="right">Welcome to come here!</h2>

            <div class="clearer">&nbsp;</div>

        </div>

        <div id="top_separator"></div>

        <div id="navigation">

            <div id="tabs">

                <ul>
                    <li @if($current_route == 'blog_index'
                    || $current_route == 'blog_view'
                    || $current_route == 'blog_archives'
                    || $current_route == 'blog_tags'
                    || $current_route == 'blog_edit')class="current_page_item"@endif>
                        <a href="{{ route('blog_index') }}"><span>博客</span></a>
                    </li>
                    <li @if($current_route == 'blog_about')class="current_page_item"@endif>
                        <a href="{{ route('blog_about') }}"><span>关于</span></a>
                    </li>
                    @if(Auth::check())
                        <li @if($current_route == 'blog_create')class="current_page_item"@endif>
                            <a href="{{ route('blog_create') }}"><span>发表</span></a>
                        </li>
                    @endif
                    @if(!Auth::check())
                        <li><a href="{{ route('login') }}"><span>登录</span></a></li>
                    @endif
                </ul>

                <div class="clearer">&nbsp;</div>

            </div>

        </div>

        <div class="spacer h5"></div>

        <div id="main">

            <div class="left" id="main_left">

                <div id="main_left_content">

                @yield('content')

                </div>

            </div>

            @section('section-right')
                @include('layouts.blog-right')
            @show
            <div class="clearer">&nbsp;</div>

        </div>

        <div id="footer">
            <div class="left">&#169; 2008 胜有道</div>

            <div class="right"><a href="">It blog</a> from <a href="http://shengyoudao.com">shengyoudao.com</a></div>
            <div class="clearer">&nbsp;</div>
        </div>

    </div>
    <div id="layout_edgebottom"></div>
</div>
@section('javascript')

@show
</body>
</html>