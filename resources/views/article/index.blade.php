@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row article-list">
            <div class="col-md-9">
                <div class="card">
                    <div class="card-header">
                        <ul class="nav nav-tabs card-header-tabs">
                            <li class="nav-item">
                                <a class="nav-link @if($category === 'commend') active @endif"
                                   href="{{ route('articles.index') }}">推荐文章</a>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link @if($category === 'hot') active @endif"
                                   href="{{ route('articles.hot') }}">热门文章</a>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link @if($category === 'new') active @endif"
                                   href="{{ route('articles.new') }}">最新文章</a>
                            </li>
                        </ul>
                    </div>
                    <div class="card-body">
                        <ul class="list-group list-group-flush list">
                            @foreach($articles as $article)
                                <li class="list-group-item">
                                    <div class="media">
                                        <div class="media-body">
                                            {{--文章标题--}}
                                            <h2 class="mt-2 mb-2 title">
                                                <a href="{{ route('articles.show', $article) }}"
                                                   title="{{ $article->title }}">{{ $article->title }}</a>
                                                <span class="badge badge-pill badge-success">
                                                    {{ $article->type }}
                                                </span>
                                            </h2>
                                            <ul class="list-inline">
                                                {{--作者信息--}}
                                                <li class="list-inline-item">
                                                    {{--作者头像--}}
                                                    <a href="{{ route('users.show', $article->user) }}">
                                                        <img src="{{ $article->user->avatar }}"
                                                             alt="{{$article->user->name}}"
                                                             title="{{$article->user->name}}" class="avatar-24">
                                                    </a>
                                                    {{--作者名--}}
                                                    <span>
                                                        <a href="{{ route('users.show', $article->user) }}"
                                                           title="{{$article->user->name}}">{{ $article->user->name }}</a>
                                                        在 {{ $article->created_at }} 发布于
                                                        <a href="" title="">self.文章</a>
                                                    </span>
                                                </li>
                                                <li class="list-inline-item">
                                                    <span>收藏数: {{ $article->collect }}</span>
                                                    <span class="line">/</span>
                                                    <span>点赞数: {{ $article->zan }}</span>
                                                    <span class="line">/</span>
                                                    <span>阅读数: {{ $article->read }}</span>
                                                </li>
                                            </ul>
                                            {{--文章简介--}}
                                            <p>{{ $article->intro }}...</p>
                                        </div>
                                        @if($article->pic)
                                            <img src="{{ $article->pic }}" class="align-self-center ml-3 rounded pic"
                                                 alt="{{ $article->title }}" title="{{ $article->title }}">
                                        @endif
                                    </div>
                                </li>
                            @endforeach
                        </ul>
                    </div>
                    <div class="card-footer">
                        {{ $articles->links() }}
                    </div>
                </div>
            </div>
            <div class="col-md-3">
                11
            </div>
        </div>
    </div>

@stop