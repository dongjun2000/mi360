@extends('layouts.app')

@section('content')
    <div class="container">
        {{--面包屑导航--}}
        <ol class="breadcrumb">
            <li class="breadcrumb-item"><a href="/" title="首页">首页</a></li>
            <li class="breadcrumb-item"><a href="{{ route('questions.index') }}" title="问答">问答</a></li>
            <li class="breadcrumb-item">{{ $question->title }}</li>
        </ol>
        <div class="row">
            <div class="col-md-9">
                <div class="card">
                    <div class="card-body detail">
                        {{--问答详情--}}
                        <h1 class="card-title">{{ $question->title }}</h1>
                        <ul class="list-inline">
                            <li class="list-inline-item">
                                <span>提问时间: {{ $question->created_at }}</span>
                            </li>
                            <li class="list-inline-item">
                                <span>关注数: {{ $question->follow }}</span>
                                <span class="line">/</span>
                                <span>浏览数: {{ $question->read }}</span>
                                <span class="line">/</span>
                                <span>回答数: {{ $question->answer }}</span>
                            </li>
                            @if(count($question->tags) > 0)
                                <li class="list-inline-item">
                                    <ul class="list-inline">
                                        @foreach($question->tags as $tag)
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

                        {{--问题内容--}}
                        <div class="card-text content">
                            {!! $question->content !!}
                        </div>

                        <div class="d-flex justify-content-between align-items-center">
                            <div class="pl-3">
                                <button class="btn btn-success btn-sm">关注 <span class="line">|</span> 0</button>
                                <button class="btn btn-primary btn-sm">收藏 <span class="line">|</span> 0</button>
                            </div>
                            <div class="pr-4 d-inline-flex align-items-center">
                                <a href="{{ route('users.show', $question->user) }}">
                                    <img class="avatar-48 mr-1" src="{{ $question->user->avatar }}"
                                         alt="{{ $question->user->name }}" title="{{ $question->user->name }}">
                                </a>
                                <div class="d-flex flex-column">
                                    <div>
                                        <a href="{{ route('users.show', $question->user) }}">{{ $question->user->name }}</a>
                                    </div>
                                    <span style="font-size: 13px">{{ $question->created_at }}提问</span>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="card mt-3">
                    <div class="card-body">
                        <ul class="list-group list-group-flush mt-3">
                            <li class="list-group-item">
                                <div class="media">
                                    <a href="">
                                        <img src="http://mi360.cc/imgs/default/face.jpg" class="align-self-start mr-3 avatar-48"
                                             alt="...">
                                    </a>
                                    <div class="media-body">
                                        <div class="mt-0">
                                            <a href="" class="font-weight-bold mr-2">董俊俊</a>
                                            <span class="font">2分钟前回答</span>
                                        </div>
                                        <div class="mt-2">
                                            {!! $question->content !!}
                                        </div>
                                        <div class="mt-2">
                                            <a href="">编辑</a>
                                            <a href="">删除</a>
                                        </div>
                                    </div>
                                </div>
                            </li>
                            <li class="list-group-item">
                                <div class="media">
                                    <a href="">
                                        <img src="http://mi360.cc/imgs/default/face.jpg" class="align-self-start mr-3 avatar-48"
                                             alt="...">
                                    </a>
                                    <div class="media-body">
                                        <div class="mt-0">
                                            <a href="" class="font-weight-bold mr-2">董俊俊</a>
                                            <span class="font">2分钟前回答</span>
                                        </div>
                                        <div class="mt-2">
                                            {!! $question->content !!}
                                        </div>
                                        <div class="mt-2">
                                            <a href="">编辑</a>
                                            <a href="">删除</a>
                                        </div>
                                    </div>
                                </div>
                            </li>
                            <li class="list-group-item">
                                <div class="media">
                                    <a href="">
                                        <img src="http://mi360.cc/imgs/default/face.jpg" class="align-self-start mr-3 avatar-48"
                                             alt="...">
                                    </a>
                                    <div class="media-body">
                                        <div class="mt-0">
                                            <a href="" class="font-weight-bold mr-2">董俊俊</a>
                                            <span class="font">2分钟前回答</span>
                                        </div>
                                        <div class="mt-2">
                                            {!! $question->content !!}
                                        </div>
                                        <div class="mt-2">
                                            <a href="">编辑</a>
                                            <a href="">删除</a>
                                        </div>
                                    </div>
                                </div>
                            </li>
                        </ul>
                    </div>
                </div>
            </div>
            <div class="col-md-3 mt-md-0 mt-3">
                <div style="position:sticky; top:15px;">
                    <ul class="list-group">
                        <li class="list-group-item disabled active">相似问题</li>
                        <li class="list-group-item"><a href="">Ajax实现的长轮询如何才能不阻塞同一时间内页面的其他Ajax请求（同域请求）呢？</a></li>
                        <li class="list-group-item"><a href="">php爬虫ajax请求地址怎么获取？</a></li>
                        <li class="list-group-item"><a href="">ajax 轮询php后台，当后台没有返回信息会关闭当前的ajax的请求吗</a></li>
                        <li class="list-group-item"><a href="">实际开发中比较流行的ph框架</a></li>
                        <li class="list-group-item"><a href="">php怎么设计帖子回复系统</a></li>
                    </ul>
                </div>

            </div>
        </div>
    </div>
@stop