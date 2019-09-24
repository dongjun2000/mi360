@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row" data-pjax>
            <div class="col-md-2">
                <div class="card">
                    <div class="card-body p-0">
                        <div class="list-group list-group-flush">
                            <a href="" class="list-group-item list-group-item-action active disabled">
                                <span class="fa fa-list-ul mr-2"></span>
                                栏目
                            </a>
                            <a href="{{ route('home') }}" class="list-group-item list-group-item-action">
                                <i class="fa fa-heart"></i>
                                推荐阅读
                            </a>
                            <a href="{{ route('hottest') }}" class="list-group-item list-group-item-action">
                                <i class="fa fa-thumbs-o-up"></i>
                                近期热门
                            </a>
                            <a href="{{ route('newest') }}" class="list-group-item list-group-item-action">
                                <i class="fa fa-globe"></i>
                                最新内容
                            </a>
                        </div>
                    </div>
                </div>
                @include('includes.category')
            </div>
            <div class="col-md-7 mt-md-0 mt-3">
                <div class="card">
                    <div class="card-header">
                        @switch($tag)
                            @case('index')
                            <i class="fa fa-heart"></i>
                            推荐阅读
                            @break
                            @case('hottest')
                            <ul class="nav nav-tabs card-header-tabs">
                                @foreach([
                                    ['title' => '日热门', 'path' => 'hottest', 'time' => 'day'],
                                    ['title' => '周热门', 'path' => 'hottest/weekly', 'time' => 'weekly'],
                                    ['title' => '月热门', 'path' => 'hottest/monthly', 'time' => 'monthly']
                                ] as $item)
                                    <li class="nav-item">
                                        <a class="nav-link @if($item['time'] === $time) active @endif" href="{{ url($item['path']) }}">{{ $item['title'] }}</a>
                                    </li>
                                @endforeach
                            </ul>
                            @break
                            @case('newest')
                            <i class="fa fa-globe"></i>
                            最新内容
                            @break
                            @case('channel')
                            <i class="fa {{ $category->icon }}"></i>
                            {{ $category->name }}
                            @break
                        @endswitch
                    </div>
                    <div class="card-body">
                        <ul class="list-group list-group-flush list">
                            @include('includes.articles')
                        </ul>
                    </div>
                    <div class="card-footer d-flex justify-content-center">
                        {{ $articles->links() }}
                    </div>
                </div>
            </div>
            <div class="col-md-3 mt-md-0 mt-3">

            </div>
        </div>
    </div>
@endsection
