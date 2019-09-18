@extends('layouts.app')

@section('content')
    <div class="container">
        {{--面包屑导航--}}
        <ol class="breadcrumb">
            <li class="breadcrumb-item"><a href="/" title="首页">首页</a></li>
            <li class="breadcrumb-item"><a href="{{ route('tags.index') }}" title="标签">标签</a></li>
            <li class="breadcrumb-item"><a href="{{ route('tags.show', $tag->name) }}">{{ $tag->name }}</a></li>
            <li class="breadcrumb-item">
                @switch($label)
                    @case('show')
                    标签动态
                    @break
                    @case('info')
                    标签百科
                    @break
                    @case('questions')
                    相关问答
                    @break
                    @case('article')
                    相关文章
                    @break
                @endswitch
            </li>
        </ol>
        <div class="row">
            <div class="col-md-9">
                <div class="jumbotron" style="padding-top: 20px; padding-bottom: 20px">
                    <div class="row">
                        <a class="tags" href="{{ route('tags.show', $tag->name) }}" style="font-weight: 700">
                            @if(!empty($tag->icon))
                                <img class="icon" src="{{ asset($tag->icon) }}" alt="{{ $tag->name }}"
                                     title="{{ $tag->name }}">
                            @endif
                            {{ $tag->name }}
                        </a>
                        <button class="btn btn-primary btn-sm ml-2">已关注 <span class="line">|</span> 0</button>
                    </div>
                    <div class="row mt-4">
                        {{ $tag->intro }}...
                    </div>
                </div>
                <div class="card">
                    <div class="card-header">
                        <ul class="nav nav-tabs card-header-tabs">
                            <li class="nav-item">
                                <a class="nav-link @if($label === 'show') active @endif"
                                   href="{{ route('tags.show', $tag->name) }}">标签动态</a>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link @if($label === 'questions') active @endif"
                                   href="{{ route('tags.questions', $tag->name) }}">相关问答</a>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link @if($label === 'article') active @endif"
                                   href="{{ route('tags.article', $tag->name) }}">相关文章</a>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link @if($label === 'info') active @endif"
                                   href="{{ route('tags.info', $tag->name) }}">标签百科</a>
                            </li>
                        </ul>
                    </div>
                    <div class="card-body">
                        {{--label页 加载不同的模板--}}
                        @switch($label)
                            @case('show')
                            @include('tags._show')
                            @break
                            @case('info')
                            @include('tags._info')
                            @break
                            @case('article')
                            @include('tags._article')
                            @break
                            @case('questions')
                            @include('tags._questions')
                            @break
                        @endswitch
                    </div>
                    @if(isset($items) && count($items) > 0)
                        <div class="card-footer">
                            {{ $items->links() }}
                        </div>
                    @endif
                </div>
            </div>
            <div class="col-md-3">2</div>
        </div>
    </div>
@stop