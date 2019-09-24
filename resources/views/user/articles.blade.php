@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row" data-pjax>
            <div class="col-md-2">
                @include('includes.user_nav')
            </div>
            <div class="col-md-7">
                {{--我的主页--}}
                <div class="card">
                    <div class="card-body">
                        <div class="d-flex justify-content-between align-items-center">
                            <h5 class="mb-3" title="{{ $user->name }} 的文章">
                                <i class="fa fa-file-text-o fa-2x"></i>
                                {{ Str::limit($user->name, 12) }} 的文章 ({{ $articles->total() }})
                            </h5>
                            <div class="btn-group d-inline-flex align-items-center">
                                <span>排序：</span>
                                <a href="{{ route('users.articles', [$user, 'sort' => 'created_at']) }}"
                                   class="btn btn-outline-success btn-sm">发表时间</a>
                                <a href="{{ route('users.articles', [$user, 'sort' => 'collect']) }}"
                                   class="btn btn-outline-primary btn-sm">收藏数</a>
                                <a href="{{ route('users.articles', [$user, 'sort' => 'zan']) }}"
                                   class="btn btn-outline-danger btn-sm">点赞数</a>
                                <a href="{{ route('users.articles', [$user, 'sort' => 'read']) }}"
                                   class="btn btn-outline-dark btn-sm">阅读数</a>
                            </div>
                        </div>

                        <ul class="list-group list-group-flush list">
                            @include('includes.articles')
                        </ul>
                    </div>
                    <div class="card-footer d-flex justify-content-center">
                        {{ $articles->links() }}
                    </div>
                </div>
            </div>

            <div class="col-md-3">
                @include('includes.user')
            </div>
        </div>
    </div>
@stop