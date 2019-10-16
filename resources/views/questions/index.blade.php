@extends('layouts.app')

@section('title')
@switch($category)
        @case('index')最新的问题@break
        @case('unanswered')等待回答的问题@break
        @case('hot')热门的问题@break
@endswitch
@stop

@section('content')
    <div class="container">
        <div class="row">
            <div class="col-md-9">
                <div class="card">
                    <div class="card-header d-flex justify-content-between align-items-end">
                        <ul class="nav nav-tabs card-header-tabs" data-pjax>
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
                            @include('includes.questions')
                        </ul>
                    </div>
                    <div class="card-footer d-flex justify-content-center" data-pjax>
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