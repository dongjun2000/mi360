@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row">
            <div class="col-md-2" style="position: sticky; top: 15px;">
                <div class="list-group">
                    <a href="#" class="list-group-item list-group-item-action active">
                        <i class="fa fa-home"></i>
                        我的主页
                    </a>
                    <a href="#" class="list-group-item list-group-item-action">
                        <i class="fa fa-file-text-o"></i>
                        我的文章
                    </a>
                    <a href="#" class="list-group-item list-group-item-action">
                        <i class="fa fa-question-circle-o"></i>
                        我的提问
                    </a>
                    <a href="#" class="list-group-item list-group-item-action " tabindex="-1"
                       aria-disabled="true">
                        <i class="fa fa-thumbs-o-up"></i>
                        我的回答
                    </a>
                    <a href="{{ route('follow', $user) }}" class="list-group-item list-group-item-action">
                        <i class="fa fa-eye"></i>
                        我的关注
                    </a>
                    <a href="{{ route('follow', $user) }}" class="list-group-item list-group-item-action">
                        <i class="fa fa-eye"></i>
                        我的粉丝
                    </a>
                    <a href="#" class="list-group-item list-group-item-action " tabindex="-1"
                       aria-disabled="true">
                        <i class="fa fa-heart-o"></i>
                        我的收藏
                    </a>
                </div>
            </div>
            <div class="col-md-7">
                {{--我的主页--}}

            </div>

            <div class="col-md-3">
                <div class="card author">
                    <div class="card-header">
                        作者
                    </div>
                    <div class="card-body">
                        <ul class="list-group list-group-flush">
                            <li class="list-group-item d-flex align-items-center justify-content-between">
                                <h5>{{ $user->name }}</h5>
                                <img src="{{ $user->avatar }}" class="ml-3 avatar-48" alt=""
                                     title="{{ $user->name }}">
                            </li>
                            <li class="list-group-item">
                                <ul class="list-inline d-flex justify-content-between">
                                    <li class="list-inline-item d-flex flex-column align-items-center" title="博客文章总数">

                                        <span>文章</span>
                                        <a href="">
                                            <span>{{ $user->articles_count }}</span>
                                        </a>
                                    </li>
                                    <li class="list-inline-item d-flex flex-column align-items-center" title="关注作者的用户数">
                                        <span>粉丝</span>
                                        <a href="{{ route('fans', $user) }}">
                                            <span>{{ $user->fans_count }}</span>
                                        </a>
                                    </li>
                                    <li class="list-inline-item d-flex flex-column align-items-center" title="收到了0个赞数">
                                        <span>点赞</span>
                                        <a href="">
                                            <span>0</span>
                                        </a>
                                    </li>
                                    <li class="list-inline-item d-flex flex-column align-items-center"
                                        title="所有文章被收藏了0次">
                                        <span>收藏</span>
                                        <a href="">
                                            <span>0</span>
                                        </a>
                                    </li>
                                </ul>
                            </li>
                            <li class="list-group-item">
                                这家伙太懒，懒得介绍自己~~~
                            </li>
                        </ul>
                    </div>
                    <div class="card-footer">
                        <div class="btn-group">
                            <a href="{{ route('users.follow', $user) }}"
                               class="btn btn-success text-white">{{ $followStatus ? '取消关注' : '关注我' }}</a>
                            <a class="btn btn-primary text-white">私信我</a>
                            <a class="btn btn-danger text-white">打赏我</a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    </div>
@stop