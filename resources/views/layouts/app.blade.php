<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="keywords" content="@yield('keywords')">
    <meta name="description" content="@yield('description')">
    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>@hasSection('title')@yield('title') - @endif{{ config('app.name', '编程故事') }} - 一个技术问答分享社区</title>

    <!-- Fonts -->
    <link rel="dns-prefetch" href="//fonts.gstatic.com">
    <link href="https://fonts.googleapis.com/css?family=Nunito" rel="stylesheet">

    <link href="//netdna.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css" rel="stylesheet">

    <!-- Styles -->
    <link href="{{ mix('css/app.css') }}" rel="stylesheet">

    @yield('css')
</head>
<body>
<div id="pjax-container">
    <header>
        <nav class="navbar navbar-expand-md navbar-light bg-light shadow-sm">
            <div class="container">
                <a class="navbar-brand" href="{{ url('/') }}" data-pjax>
                    {{ config('app.name', '编程故事') }}
                </a>
                <button class="navbar-toggler" type="button" data-toggle="collapse"
                        data-target="#navbarSupportedContent"
                        aria-controls="navbarSupportedContent" aria-expanded="false"
                        aria-label="{{ __('Toggle navigation') }}">
                    <span class="navbar-toggler-icon"></span>
                </button>

                <div class="collapse navbar-collapse" id="navbarSupportedContent">
                    <!-- Left Side Of Navbar -->
                    <ul class="navbar-nav mr-auto" data-pjax>
                        <li class="nav-item">
                            <a href="/" class="nav-link active">首页</a>
                        </li>
                        <li class="nav-item" data-pjax>
                            <a href="{{ route('articles.index') }}" class="nav-link">编程</a>
                        </li>
                        <li class="nav-item">
                            <a href="{{ route('questions.index') }}" class="nav-link">问答</a>
                        </li>
                        <li class="nav-item">
                            <a href="" class="nav-link">专栏</a>
                        </li>
                        <li class="nav-item">
                            <a href="" class="nav-link">招聘</a>
                        </li>
                        <li class="nav-item dropdown">
                            <a id="navbarDropdown" class="nav-link dropdown-toggle" href="#" role="button"
                               data-toggle="dropdown" aria-haspopup="true" aria-expanded="false" v-pre>
                                发现 <span class="caret"></span>
                            </a>

                            <div class="dropdown-menu dropdown-menu-left" aria-labelledby="navbarDropdown">
                                <a class="dropdown-item" href="{{ route('tags.index') }}">
                                    <i class="fa fa-tags"></i>标签
                                </a>
                                <div class="dropdown-divider"></div>
                                <a class="dropdown-item" href="">
                                    <i class="fa fa-signal"></i>排行榜
                                </a>
                            </div>
                        </li>
                    </ul>
                    <form class="form-inline ml-auto">
                        <input class="form-control mr-sm-2" type="search" placeholder="Search" aria-label="Search">
                        <button class="btn btn-success my-2 my-sm-0" type="submit">
                            <i class="fa fa-search"></i>
                        </button>
                    </form>
                    <!-- Right Side Of Navbar -->
                    <ul class="navbar-nav ml-auto align-items-center">
                        <!-- Authentication Links -->
                        @guest
                            <li class="nav-item" data-pjax>
                                <a class="nav-link" href="{{ route('login') }}">登录</a>
                            </li>
                            @if (Route::has('register'))
                                <li class="nav-item" data-pjax>
                                    <a class="nav-link" href="{{ route('register') }}">注册</a>
                                </li>
                            @endif
                        @else
                            {{--操作菜单--}}
                            <li class="nav-item dropdown">
                                <a id="navbarDropdown" class="nav-link dropdown-toggle" href="#" role="button"
                                   data-toggle="dropdown" aria-haspopup="true" aria-expanded="false" v-pre>
                                    <i class="fa fa-plus"></i>创建
                                </a>

                                <div class="dropdown-menu dropdown-menu-right" aria-labelledby="navbarDropdown">
                                    <a href="{{ route('questions.create') }}" class="dropdown-item">
                                        <i class="fa fa-question"></i>提问题
                                    </a>
                                    <div class="dropdown-divider"></div>
                                    <a href="{{ route('articles.create') }}" class="dropdown-item">
                                        <i class="fa fa-pencil"></i>
                                        写文章
                                    </a>
                                </div>
                            </li>

                            <li class="ml-3" style="position: relative;">
                                <a href="{{ route('notifications.index', ['filter' => 'unread']) }}" class="text-muted" title="新通知">
                                    <i class="fa fa-bell-o"></i>
                                    <span class="badge badge-danger badge-pill"
                                          style="position: absolute; top: -8px;left: 6px">{{ Auth::user()->inform > 99 ? '99+' : Auth::user()->inform }}</span>
                                </a>
                            </li>

                            <li class="ml-3" style="position: relative;">
                                <a href="{{ route('messages.index') }}" class="text-muted" title="新私信">
                                    <i class="fa fa-envelope-o"></i>
                                    <span class="badge badge-danger badge-pill"
                                          style="position: absolute; top: -8px;left: 6px">{{ Auth::user()->message > 99 ? '99+' : Auth::user()->message  }}</span>
                                </a>
                            </li>

                            {{--用户信息--}}
                            <li class="nav-item dropdown ml-3" data-pjax>
                                <a id="navbarDropdown" class="nav-link dropdown-toggle" href="#" role="button"
                                   data-toggle="dropdown" aria-haspopup="true" aria-expanded="false" v-pre>
                                    <img src="{{ Auth::user()->avatar }}" alt="{{ Auth::user()->name }}"
                                         title="{{ Auth::user()->name }}" class="avatar-38"> <span class="caret"></span>
                                </a>

                                <div class="dropdown-menu dropdown-menu-right" aria-labelledby="navbarDropdown">
                                    <a class="dropdown-item" href="{{ route('users.show', Auth::user()) }}">
                                        <i class="fa fa-home"></i>我的主页
                                    </a>
                                    <div class="dropdown-divider"></div>
                                    <a class="dropdown-item" href="{{ route('users.settings') }}">
                                        <i class="fa fa-user"></i>
                                        个人设置
                                    </a>
                                    <div class="dropdown-divider"></div>
                                    <a class="dropdown-item" href="{{ route('users.collects', Auth::user()) }}">
                                        <i class="fa fa-heart"></i>我的收藏
                                    </a>
                                    <div class="dropdown-divider"></div>
                                    <a class="dropdown-item" href="{{ route('logout') }}"
                                       onclick="event.preventDefault();
                                                     document.getElementById('logout-form').submit();">
                                        <i class="fa fa-sign-in"></i>退出
                                    </a>
                                    <form id="logout-form" action="{{ route('logout') }}" method="POST"
                                          style="display: none;">
                                        @csrf
                                    </form>
                                </div>
                            </li>
                        @endguest
                    </ul>
                </div>
            </div>
        </nav>
    </header>
    <main class="py-4" id="app">
        @yield('content')
    </main>
    <footer class="container-fluid bg-dark">
        <div class="container">
            <div class="row pt-3">
                <div class="col-12 text-center text-white-50">
                    <ul class="list-inline">
                        <li class="list-inline-item">
                            <a href="http://beian.miit.gov.cn/" target="_blank" class="text-white-50">鄂ICP备18011339号</a>
                        </li>
                        <li class="list-inline-item">
                            copyright © 2019
                        </li>
                        <li class="list-inline-item">
                            <a href="/" class="text-white-50">编程故事</a>
                        </li>
                        <li class="list-inline-item">
                            十堰梦航教育科技有限公司版权所有
                        </li>
                    </ul>
                </div>
            </div>
        </div>
    </footer>
</div>
<!-- Scripts -->
<script src="{{ mix('js/app.js') }}"></script>
<script src="https://cdn.bootcss.com/jquery.pjax/2.0.1/jquery.pjax.min.js"></script>
<script src="{{ asset('plugin/pjax/pjax.js') }}"></script>

@yield('script')

</body>
</html>
