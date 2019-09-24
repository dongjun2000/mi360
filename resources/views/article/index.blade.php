@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row article-list">
            <div class="col-md-9">
                <div class="card">
                    <div class="card-header d-flex justify-content-between align-items-end">
                        <ul class="nav nav-tabs card-header-tabs" data-pjax>
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
                        @auth
                            <a class="btn btn-primary btn-sm" href="{{ route('articles.create') }}">写文章</a>
                        @endauth
                    </div>
                    <div class="card-body">
                        <ul class="list-group list-group-flush list" data-pjax>
                            @include('includes.articles')
                        </ul>
                    </div>
                    <div class="card-footer d-flex justify-content-center" data-pjax>
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