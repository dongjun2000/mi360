@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row">
            <div class="col-md-9">
                <div class="card">
                    <div class="card-header d-flex justify-content-between align-items-end">
                        <ul class="nav nav-tabs card-header-tabs">
                            @foreach(['index' => '最新问答', 'unanswered' => '等待回答', 'hot' => '热门问答'] as $key => $item)
                                <li class="nav-item">
                                    <a class="nav-link @if($key === $category) active @endif"
                                       href="{{ route("questions.{$key}") }}">{{ $item }}</a>
                                </li>
                            @endforeach
                        </ul>
                        @auth
                            <a class="btn btn-primary btn-sm" href="{{ route('questions.create') }}">提问题</a>
                        @endauth
                    </div>
                    <div class="card-body">
                        <ul class="list-group list-group-flush list">
                            @foreach($questions as $question)
                                <li class="list-group-item d-flex justify-content-around">
                                    <div class="col-3">
                                        <ul class="list-inline d-flex justify-content-between">
                                            <li class="list-inline-item d-flex flex-column align-items-center">
                                                <span>{{ $question->follow }}</span>
                                                <span>关注</span>
                                            </li>
                                            @switch($question->status)
                                                @case(0)
                                                <li class="list-inline-item d-flex flex-column align-items-center text-danger">
                                                    <span>{{ $question->answer }}</span>
                                                    <span>回答</span>
                                                </li>
                                                @break
                                                @case(1)
                                                <li class="list-inline-item d-flex flex-column align-items-center text-primary">
                                                    <span>{{ $question->answer }}</span>
                                                    <span>回答</span>
                                                </li>
                                                @break
                                                @case(2)
                                                <li class="list-inline-item d-flex flex-column align-items-center text-success">
                                                    <span>{{ $question->answer }}</span>
                                                    <span>解决</span>
                                                </li>
                                                @break
                                            @endswitch

                                            <li class="list-inline-item d-flex flex-column align-items-center">
                                                <span>{{ $question->read }}</span>
                                                <span>浏览</span>
                                            </li>
                                        </ul>
                                    </div>
                                    <div class="col-9">
                                        <ul class="list-inline">
                                            <li class="list-inline-item">
                                                <a href="{{ route('users.show', $question->laster_answer_user['id']) }}">{{ $question->laster_answer_user['name'] }}</a>
                                            </li>
                                            <li class="list-inline-item">
                                                <a href="">{{ Carbon\Carbon::parse($question->laster_answer_user['created_at'])->diffForHumans() }}
                                                    回答</a>
                                            </li>
                                        </ul>
                                        <h2 class="title float-left mr-3">
                                            <a href="{{ route('questions.show', $question) }}">{{ $question->title }}</a>
                                        </h2>
                                        {{--标签--}}
                                        @if(count($question->tags) > 0)
                                            <ul class="list-inline float-left">
                                                @foreach($question->tags as $tag)
                                                    <li class="list-inline-item">
                                                        <a class="tags" href="{{ route('tags.show', $tag->name) }}">{{ $tag->name }}</a>
                                                    </li>
                                                @endforeach
                                            </ul>
                                        @endif
                                    </div>
                                </li>
                            @endforeach
                        </ul>
                    </div>
                    <div class="card-footer d-flex justify-content-center">
                        {{ $questions->links() }}
                    </div>
                </div>
            </div>
            <div class="col-md-3">
                <div class="card">
                    <div class="card-header bg-primary text-white">
                        新手任务
                    </div>
                    <div class="card-body">
                        <ul class="list-group list-group-flush">
                            <li class="list-group-item">
                                <a href="">提出你的第一个问题</a>
                            </li>
                            <li class="list-group-item">
                                <a href="">回答一个你擅长的问题</a>
                            </li>
                            <li class="list-group-item">
                                <a href="">对内容进行投票</a>
                            </li>
                            <li class="list-group-item">
                                <a href="">阅读声望与权限的规范</a>
                            </li>
                            <li class="list-group-item">
                                <a href="">完善个人资料</a>
                            </li>
                        </ul>
                    </div>
                </div>
            </div>
        </div>
    </div>
@stop