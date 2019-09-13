@extends('layouts.app')

@section('css')
    <link rel="stylesheet"
          href="{{ asset('vendor/unisharp/laravel-ckeditor/plugins/codesnippet/lib/highlight/styles/zenburn.css') }}">
@stop

@section('script')
    <script src="{{ asset('vendor/unisharp/laravel-ckeditor/plugins/codesnippet/lib/highlight/highlight.pack.js') }}"></script>
    <script type="text/javascript">
        hljs.initHighlightingOnLoad();
    </script>
@stop

@section('content')
    <div class="container">
        {{--面包屑导航--}}
        <ol class="breadcrumb">
            <li class="breadcrumb-item"><a href="/" title="首页">首页</a></li>
            <li class="breadcrumb-item"><a href="{{ route('article.index') }}" title="编程">编程</a></li>
            <li class="breadcrumb-item active">{{ $article->title }}</li>
        </ol>

        <div class="row article-show">
            <div class="col-md-9">
                <div class="card">
                    <div class="card-body detail">
                        {{--文章标题--}}
                        <h1 class="card-title">{{ $article->title }}</h1>
                        <ul class="list-inline">
                            <li class="list-inline-item">
                                <span class="badge badge-pill badge-success">{{ $article->type }}</span>
                            </li>
                            <li class="list-inline-item">
                                发布时间: {{ $article->created_at }}
                            </li>
                            <li class="list-inline-item">
                                <span>收藏数: {{ $article->collect }}</span>
                                <span class="line">/</span>
                                <span>点赞数: {{ $article->zan }}</span>
                                <span class="line">/</span>
                                <span>阅读数: {{ $article->read }}</span>
                            </li>
                            @if(count($article->tags))
                                <li class="list-inline-item">
                                    <ul class="list-inline">
                                        @foreach($article->tags as $tag)
                                            <li class="list-inline-item">
                                                <a class="tags" href="{{ route('tags.show', $tag->name) }}">
                                                    @if(!empty($tag->icon))
                                                        <img class="icon" src="{{ asset($tag->icon) }}"
                                                             alt="{{ $tag->name }}"
                                                             title="{{ $tag->name }}">
                                                    @endif
                                                    {{ $tag->name }}
                                                </a>
                                            </li>
                                        @endforeach
                                    </ul>
                                </li>
                            @endif
                        </ul>

                        {{--文章内容--}}
                        <div class="card-text content">
                            {!! $article->content !!}
                        </div>

                        <div class="text-muted text-center mt-5">
                            <button class="btn btn-success btn-lg mr-md-2">点赞 <span
                                        class="line">|</span> {{ $article->zan }}</button>
                            <button class="btn btn-primary btn-lg ml-md-2">收藏 <span
                                        class="line">|</span> {{ $article->collect }}</button>
                        </div>
                    </div>

                </div>
            </div>
            <div class="col-md-3">
                {{--作者信息--}}
                <div class="card author">
                    <div class="card-header title">
                        作者
                    </div>
                    <div class="card-body info">
                        <ul class="list-group list-group-flush">
                            <li class="list-group-item d-flex align-items-center justify-content-between">
                                <h5>{{ $article->user->name }}</h5>
                                <img src="{{ $article->user->avatar }}" class="ml-3 avatar-48" alt=""
                                     title="{{ $article->user->name }}">
                            </li>
                            <li class="list-group-item">
                                <ul class="list-inline d-flex justify-content-between">
                                    <li class="list-inline-item d-flex flex-column align-items-center" title="博客文章总数">
                                        <span>文章</span>
                                        <span>0</span>
                                    </li>
                                    <li class="list-inline-item d-flex flex-column align-items-center" title="关注作者的用户数">
                                        <span>粉丝</span>
                                        <span>0</span>
                                    </li>
                                    <li class="list-inline-item d-flex flex-column align-items-center" title="收到了0个赞数">
                                        <span>点赞</span>
                                        <span>0</span>
                                    </li>
                                    <li class="list-inline-item d-flex flex-column align-items-center"
                                        title="所有文章被收藏了0次">
                                        <span>收藏</span>
                                        <span>0</span>
                                    </li>
                                </ul>
                            </li>
                            <li class="list-group-item">
                                这家伙太懒，懒得介绍自己~~~
                            </li>
                        </ul>
                    </div>
                    <div class="card-footer">
                        <button class="btn btn-success btn-block">关注我</button>
                    </div>
                </div>

            </div>
        </div>

    </div>
@stop