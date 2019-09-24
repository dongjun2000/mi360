@extends('layouts.app')

@section('css')
    <link rel="stylesheet"
          href="{{ asset('vendor/unisharp/laravel-ckeditor/plugins/codesnippet/lib/highlight/styles/zenburn.css') }}">
@stop

@section('content')
    <div class="container">
        {{--面包屑导航--}}
        <ol class="breadcrumb" data-pjax>
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
                                <button class="btn btn-success btn-sm">关注 <span
                                            class="line">|</span> {{ $question->follow }}</button>
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
                        <h5 class="mb-2">{{ count($answers) }} 个回答</h5>
                        <ul class="list-group list-group-flush mt-3">
                            @include('includes.answers')
                        </ul>
                    </div>
                </div>

                <div class="card mt-3">
                    <form action="{{ route('answers.store') }}" method="post">
                        @csrf
                        <input type="hidden" name="question_id" value="{{ $question->id }}">
                        <div class="card-header d-flex justify-content-between align-items-center">
                            <strong>撰写答案</strong>
                            <button class="btn btn-success btn-sm">提交答案</button>
                        </div>
                        <div class="card-body">
                            <div class="form-group">
                                <textarea class="form-control" name="content" id="content" rows="3"
                                          style="resize: none;"></textarea>
                                @error('content')
                                <small id="helpId" class="form-text text-danger">{{ $message }}</small>
                                @enderror
                            </div>
                        </div>
                    </form>
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

@section('script')
    <script src="{{ asset('vendor/unisharp/laravel-ckeditor/plugins/codesnippet/lib/highlight/highlight.pack.js') }}"></script>
    <script type="text/javascript">
        hljs.initHighlightingOnLoad();
    </script>

    <script src="/vendor/unisharp/laravel-ckeditor/ckeditor.js"></script>
    <script src="/vendor/unisharp/laravel-ckeditor/adapters/jquery.js"></script>
    <script>
        $('textarea').ckeditor({
            height: 150
        });
    </script>
@stop