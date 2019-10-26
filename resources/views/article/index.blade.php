@extends('layouts.app')

@section('title', \App\Article::Category[$category])

@section('content')
    <div class="container">
        <div class="row article-list">
            <div class="col-md-9">
                <div class="card">
                    <div class="card-header d-flex justify-content-between align-items-end">
                        <ul class="nav nav-tabs card-header-tabs" data-pjax>
                            @foreach(\App\Article::Category as $key => $value)
                                <li class="nav-item">
                                    <a class="nav-link @if($category === $key) active @endif"
                                       href="{{ route('articles.' . $key) }}">{{ $value }}</a>
                                </li>
                            @endforeach
                        </ul>
                        @auth
                            <a class="btn btn-primary btn-sm" href="{{ route('articles.create') }}">写文章</a>
                        @endauth
                    </div>
                    <div class="card-body">
                        <ul class="list-group list-group-flush list">
                            @include('includes.articles')
                        </ul>
                    </div>
                    <div class="card-footer d-flex justify-content-center" data-pjax>
                        {{ $articles->links() }}
                    </div>
                </div>
            </div>
            <div class="col-md-3">
                {{--侧边栏--}}
            </div>
        </div>
    </div>

@stop