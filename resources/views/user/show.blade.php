@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row">
            <div class="col-md-2">
                @include('includes.user_nav')
            </div>
            <div class="col-md-7 mt-md-0 mt-3">
                {{--我的主页--}}
                <div class="card">
                    <div class="card-body">
                        <h5 class="mb-3" title="{{ $user->name, 12 }} 的个人动态">
                            <i class="fa fa-rss fa-2x"></i>
                            {{ Str::limit($user->name, 12) }} 的个人动态
                        </h5>
                    </div>
                </div>
            </div>

            <div class="col-md-3 mt-md-0 mt-3">
                @include('includes.user')

                {{--最近访客--}}
                <div class="card mt-3">
                    <div class="card-header d-inline-flex justify-content-between">
                        <strong>最近访客</strong>
                        <a href="">更多...</a>
                    </div>
                    <div class="card-body">
                        <ul class="list-inline d-flex justify-content-between flex-wrap mb-0">
                            <li class="d-inline-flex flex-column align-items-center">
                                <img class="avatar-58" src="http://mi360.cc/imgs/default/face.jpg" alt="" title="">
                                <div class="d-flex flex-column justify-content-between align-items-center" style="position: relative;">
                                    <span style="position: absolute; top: -20px; color: #f9f9f9">董俊</span>
                                    <span>14:30</span>
                                </div>
                            </li>
                            <li class="d-inline-flex flex-column align-items-center">
                                <img class="avatar-58" src="http://mi360.cc/imgs/default/face.jpg" alt="" title="">
                                <div class="d-flex flex-column justify-content-between" style="position: relative;">
                                    <span style="position: absolute; top: -20px; color: #f9f9f9">董俊</span>
                                    <span>昨天</span>
                                </div>
                            </li>
                            <li class="d-inline-flex flex-column align-items-center">
                                <img class="avatar-58" src="http://mi360.cc/imgs/default/face.jpg" alt="" title="">
                                <div class="d-flex flex-column justify-content-between" style="position: relative;">
                                    <span style="position: absolute; top: -20px; color: #f9f9f9">董俊</span>
                                    <span>前天</span>
                                </div>
                            </li>
                            <li class="d-inline-flex flex-column align-items-center">
                                <img class="avatar-58" src="http://mi360.cc/imgs/default/face.jpg" alt="" title="">
                                <div class="d-flex flex-column justify-content-between" style="position: relative;">
                                    <span style="position: absolute; top: -20px; color: #f9f9f9">董俊</span>
                                    <span>前天</span>
                                </div>
                            </li>
                        </ul>
                    </div>
                    <div class="card-footer">
                        <ul class="list-inline d-flex justify-content-around mb-0">
                            <li class="list-inline-item d-flex flex-column align-items-center" title="今日浏览">
                                <span>今日浏览</span>
                                <a href="">
                                    0
                                </a>
                            </li>
                            <li class="list-inline-item d-flex flex-column align-items-center" title="收到了0个赞数">
                                <span>总浏览量</span>
                                <a href="">
                                    0
                                </a>
                            </li>
                        </ul>
                    </div>
                </div>
            </div>
        </div>
    </div>
@stop