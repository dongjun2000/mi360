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
        <ol class="breadcrumb" data-pjax>
            <li class="breadcrumb-item"><a href="/" title="首页">首页</a></li>
            <li class="breadcrumb-item"><a href="{{ route('articles.index') }}" title="编程">编程</a></li>
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
                            @if($article->tags->count())
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
                            @if($article->pic)
                                <div class="text-center mb-3">
                                    <img src="{{ $article->pic }}" alt="{{ $article->title }}"
                                         title="{{ $article->title }}">
                                </div>
                            @endif
                            {!! $article->content !!}
                        </div>

                        <div class="d-flex justify-content-center mt-5">
                            <form action="{{ route('articles.zan', $article) }}" method="post">
                                @csrf
                                <button class="btn btn-success btn-lg mr-md-2">{{ $zanStatus ? '取消点赞' : '点赞' }} <span
                                            class="line">|</span> {{ $article->zan }}</button>
                            </form>
                            <form action="" method="post">
                                @csrf
                                <button class="btn btn-primary btn-lg ml-md-2">收藏 <span
                                            class="line">|</span> {{ $article->collect }}</button>
                            </form>
                        </div>
                    </div>
                </div>
                {{--评论表单区--}}
                <div class="card mt-3">
                    <form action="{{ route('comments.store') }}" method="post">
                        @csrf
                        <input type="hidden" name="article_id" value="{{ $article->id }}">
                        <div class="card-header d-flex justify-content-between align-items-center">
                            <strong>评论</strong>
                            <button class="btn btn-success btn-sm">发表评论</button>
                        </div>
                        <div class="card-body">
                            <div class="form-group">
                                <textarea required class="form-control" name="content" id="content" rows="3"
                                          placeholder="文明社会，理性评论"></textarea>
                                @error('content')
                                <small id="helpId" class="form-text text-danger">{{ $message }}</small>
                                @enderror
                            </div>
                        </div>
                    </form>
                </div>
                {{--评论列表区--}}
                @if(isset($comments[0]))
                    <div class="card mt-3">
                        <div class="card-body">
                            <h5 class="mb-2">用户评论</h5>
                            <ul class="list-group list-group-flush mt-3">
                                @foreach($comments[0] as $comment)
                                    <li class="list-group-item">
                                        <div class="media">
                                            <a href="{{ route('users.show', $comment->user) }}">
                                                <img src="{{ $comment->user->avatar }}" class="mr-3 avatar-48"
                                                     alt="{{ $comment->user->name }}">
                                            </a>
                                            <div class="media-body">
                                                <div class="mt-0">
                                                    <a href="{{ route('users.show', $comment->user->id) }}"
                                                       class="font-weight-bold mr-2">{{ $comment->user->name }}</a>
                                                    <span class="font">{{ $comment->created_at->diffForHumans() }}
                                                        评论了文章： {{ $article->title }}</span>
                                                </div>
                                                <div class="mt-2">
                                                    {!! $comment->content !!}
                                                </div>
                                                <div class="mt-2 d-inline-flex">
                                                    <a href="#collapseExample{{ $comment->id }}" data-toggle="collapse"
                                                       class="btn btn-success btn-sm mr-2">回复</a>

                                                    {{--@can('update', $comment)--}}
                                                    {{--<a href="{{ route('comments.edit', $comment) }}"--}}
                                                    {{--class="btn btn-info text-white btn-sm mr-2">编辑</a>--}}
                                                    {{--@endcan--}}

                                                    @can('delete', $comment)
                                                        <form action="{{ route('comments.destroy', $comment) }}"
                                                              method="post" onsubmit="return confirm('真的要删除该评论？')">
                                                            @csrf @method('DELETE')
                                                            <button class="btn btn-danger btn-sm">删除</button>
                                                        </form>
                                                    @endcan
                                                </div>
                                                <form action="{{ route('comments.store') }}" method="post"
                                                      class="mt-2 collapse" id="collapseExample{{ $comment->id }}">
                                                    @csrf
                                                    <input type="hidden" name="pid" value="{{ $comment->id }}">
                                                    <input type="hidden" name="article_id" value="{{ $article->id }}">
                                                    <input type="hidden" name="reply_user_id"
                                                           value="{{ $comment->user->id }}">
                                                    <div class="input-group mb-3">
                                                        <textarea required type="text" class="form-control" id="content"
                                                                  name="content" placeholder="文明社会，理性评论"
                                                                  rows="1"></textarea>
                                                        <div class="input-group-append">
                                                            <button class="btn btn-success" type="submit"
                                                                    id="button-addon2">添加回复
                                                            </button>
                                                        </div>
                                                    </div>
                                                </form>
                                                @if(isset($comments[$comment->id]))
                                                    @foreach($comments[$comment->id] as $child)
                                                        <div class="media mt-3">
                                                            <a href="#">
                                                                <img src="{{ $child->user->avatar }}"
                                                                     class="mr-3 avatar-48"
                                                                     alt="{{ $child->user->name }}">
                                                            </a>
                                                            <div class="media-body">
                                                                <div class="mt-0">
                                                                    <a href="{{ route('users.show', $child->user) }}"
                                                                       class="font-weight-bold mr-2">{{ $child->user->name }}</a>
                                                                    <span class="font">{{ $child->created_at->diffForHumans() }}
                                                                        回复了</span>
                                                                    <a href="{{ route('users.show', $child->user) }}"
                                                                       class="font-weight-bold">{{ $child->reply_user->name }}</a>
                                                                </div>
                                                                <div class="mt-2">
                                                                    {!! $child->content !!}
                                                                </div>
                                                                <div class="mt-2 d-inline-flex">
                                                                    <a href="#collapseExample{{ $child->id }}"
                                                                       data-toggle="collapse"
                                                                       class="btn btn-success btn-sm mr-2">回复</a>

                                                                    {{--@can('update', $child)--}}
                                                                    {{--<a href="{{ route('comments.edit', $child) }}"--}}
                                                                    {{--class="btn btn-info text-white btn-sm mr-2">编辑</a>--}}
                                                                    {{--@endcan--}}

                                                                    @can('delete', $child)
                                                                        <form action="{{ route('comments.destroy', $child) }}"
                                                                              method="post"
                                                                              onsubmit="return confirm('真的要删除该评论？')">
                                                                            @csrf @method('DELETE')
                                                                            <button class="btn btn-danger btn-sm">删除
                                                                            </button>
                                                                        </form>
                                                                    @endcan
                                                                </div>
                                                                <form action="{{ route('comments.store') }}"
                                                                      method="post" class="mt-2 collapse"
                                                                      id="collapseExample{{ $child->id }}">
                                                                    @csrf
                                                                    <input type="hidden" name="pid"
                                                                           value="{{ $comment->id }}">
                                                                    <input type="hidden" name="article_id"
                                                                           value="{{ $article->id }}">
                                                                    <input type="hidden" name="reply_user_id"
                                                                           value="{{ $child->user->id }}">
                                                                    <div class="input-group mb-3">
                                                                        <textarea required type="text"
                                                                                  class="form-control"
                                                                                  id="content" name="content"
                                                                                  placeholder="文明社会，理性评论"
                                                                                  rows="1"></textarea>
                                                                        <div class="input-group-append">
                                                                            <button class="btn btn-success"
                                                                                    type="submit" id="button-addon2">
                                                                                添加回复
                                                                            </button>
                                                                        </div>
                                                                    </div>
                                                                </form>
                                                            </div>
                                                        </div>
                                                    @endforeach
                                                @endif
                                            </div>
                                        </div>
                                    </li>
                                @endforeach
                            </ul>
                        </div>
                    </div>
                @endif
            </div>

            <div class="col-md-3 mt-md-0 mt-3">
                {{--作者信息--}}
                <div class="card author">
                    <div class="card-header">
                        作者
                    </div>
                    <div class="card-body">
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