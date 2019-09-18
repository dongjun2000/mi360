@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row">
            <div class="col-md-2">
                <div class="list-group">
                    <a href="#" class="list-group-item list-group-item-action active">我的主页</a>
                    <a href="#" class="list-group-item list-group-item-action">个人动态</a>

                    <a href="#" class="list-group-item list-group-item-action">我关注的</a>
                    <a href="#" class="list-group-item list-group-item-action">我的文章</a>
                    <a href="#" class="list-group-item list-group-item-action">我的提问</a>
                    <a href="#" class="list-group-item list-group-item-action " tabindex="-1"
                       aria-disabled="true">我的回答</a>
                </div>
            </div>
            <div class="col-md-7">
                <div class="card">
                    <div class="card-body">
                        123
                    </div>
                </div>
            </div>
            <div class="co-md-3">
                <div class="card author">
                    <div class="card-header title">
                        作者
                    </div>
                    <div class="card-body info">
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
                                        <span>0</span>
                                    </li>
                                    <li class="list-inline-item d-flex flex-column align-items-center" title="关注作者的用户数">
                                        <span>粉丝</span>
                                        <span>0</span>
                                    </li>
                                    <li class="list-inline-item d-flex flex-column align-items-center" title="收到了0个赞数">
                                        <span>点赞</span>
                                        <span>0</span>
                                    </li>
                                    <li class="list-inline-item d-flex flex-column align-items-center"
                                        title="所有文章被收藏了0次">
                                        <span>收藏</span>
                                        <span>0</span>
                                    </li>
                                </ul>
                            </li>
                            <li class="list-group-item">
                                这家伙太懒，懒得介绍自己~~~
                            </li>
                        </ul>
                    </div>
                    <div class="card-footer">
                        <button class="btn btn-success btn-block">关注我</button>
                    </div>
                </div>
            </div>
        </div>
    </div>
    </div>
@stop