@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row">
            <div class="col-md-2" data-pjax>
                @include('includes.user_nav')
            </div>
            <div class="col-md-7 mt-md-0 mt-3">
                {{--我的主页--}}
                <div class="card">
                    <div class="card-header">
                        <h5 title="{{ $user->name, 12 }} 的个人动态">
                            <i class="fa fa-rss fa-2x"></i>
                            {{ Str::limit($user->name, 12) }} 的个人动态
                        </h5>
                    </div>
                    <div class="card-body">


                        <ul class="list-group list-group-flush list">
                            @foreach($activities as $activity)
                                {{--发表文章--}}
                                @if($activity->properties['event'] === 'article.created' && $article = $activity->properties )

                                    <li class="list-group-item">
                                        <div class="media">
                                            <a href="">
                                                <img src="{{ $article['user']['avatar'] }}" class="mr-3 avatar-38"
                                                     alt="{{ $article['user']['name'] }}"
                                                     title="{{ $article['user']['name'] }}">
                                            </a>
                                            <div class="media-body">
                                                <div class="mt-2 d-flex justify-content-between">
                                                    <strong>{{ $activity->description }}</strong>
                                                    <span>{{ $activity->created_at->diffForHumans() }}</span>
                                                </div>
                                                <div class="media mt-3">
                                                    <div class="media-body">
                                                        <h2 class="mt-0 title">
                                                            <a href="{{ route('articles.show', $activity->subject_id) }}">
                                                                {{ $article['article']['title'] }}
                                                            </a>
                                                        </h2>
                                                        {{ $article['article']['intro'] }}
                                                    </div>
                                                    @if($article['article']['pic'])
                                                        <a href="{{ route('articles.show', $activity->subject_id) }}">
                                                            <img src="{{ $article['article']['pic'] }}"
                                                                 class="align-self-center ml-3 rounded pic"
                                                                 alt="{{ $article['article']['title'] }}"
                                                                 title="{{ $article['article']['title'] }}">
                                                        </a>
                                                    @endif
                                                </div>
                                            </div>
                                        </div>
                                    </li>
                                    {{--发布问题--}}
                                @elseif($activity->properties['event'] === 'question.created' && $question = $activity->properties)
                                    <li class="list-group-item">
                                        <div class="media">
                                            <a href="">
                                                <img src="{{ $question['user']['avatar'] }}" class="mr-3 avatar-38"
                                                     alt="{{ $question['user']['name'] }}"
                                                     title="{{ $question['user']['name'] }}">
                                            </a>
                                            <div class="media-body">
                                                <div class="mt-2 d-flex justify-content-between">
                                                    <strong>{{ $activity->description }}</strong>
                                                    <span>{{ $activity->created_at->diffForHumans() }}</span>
                                                </div>
                                                <div class="media mt-3">
                                                    <div class="media-body">
                                                        <h2 class="mt-0 title">
                                                            <a href="{{ route('questions.show', $activity->subject_id) }}">
                                                                {{ $question['question']['title'] }}
                                                            </a>
                                                        </h2>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </li>
                                @elseif($activity->properties['event'] === 'answer.created' && $answer = $activity->properties)
                                    <li class="list-group-item">
                                        <div class="media">
                                            <a href="">
                                                <img src="{{ $answer['user']['avatar'] }}" class="mr-3 avatar-38"
                                                     alt="{{ $answer['user']['name'] }}"
                                                     title="{{ $answer['user']['name'] }}">
                                            </a>
                                            <div class="media-body">
                                                <div class="mt-2 d-flex justify-content-between">
                                                    <strong>{{ $activity->description }}</strong>
                                                    <span>{{ $activity->created_at->diffForHumans() }}</span>
                                                </div>
                                                <div class="media mt-3">
                                                    <div class="media-body">
                                                        <h2 class="mt-0 title">
                                                            <i class="fa fa-question-circle-o fa-2x"></i>
                                                            <a href="{{ route('questions.show', $answer['question']['id']) }}">
                                                                {{ $answer['question']['title'] }}
                                                            </a>
                                                        </h2>
                                                        {{ $answer['answer']['content'] }}
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </li>
                                @endif
                                {{--TODO:: 招聘、点赞、关注...--}}
                            @endforeach
                        </ul>
                    </div>
                    <div class="card-footer" data-pjax>
                        {{ $activities->links() }}
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
                                <div class="d-flex flex-column justify-content-between align-items-center"
                                     style="position: relative;">
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