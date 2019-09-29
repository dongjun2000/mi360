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
                                @if($activity->properties['event'] === 'article.created' && $article = $activity->properties)

                                    <li class="list-group-item">
                                        <div class="media">
                                            <div class="media-body">
                                                <div class="mt-2 d-flex justify-content-between">
                                                    <div>
                                                        <span class="font-weight-bold">
                                                            {{ $article['user']['name'] }}
                                                        </span>
                                                        {{ $activity->description }}
                                                    </div>
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
                                            <div class="media-body">
                                                <div class="mt-2 d-flex justify-content-between">
                                                    <div>
                                                        <span class="font-weight-bold">
                                                            {{ $question['user']['name'] }}
                                                        </span>
                                                        {{ $activity->description }}
                                                    </div>
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
                                            <div class="media-body">
                                                <div class="mt-2 d-flex justify-content-between">
                                                    <div>
                                                        <span class="font-weight-bold">
                                                            {{ $answer['user']['name'] }}
                                                        </span>
                                                        {{ $activity->description }}
                                                    </div>
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
                                                        {!! $answer['answer']['content'] !!}
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </li>
                                @elseif($activity->properties['event'] === 'article.collected' && $article = $activity->properties)
                                    <li class="list-group-item">
                                        <div class="media">
                                            <div class="media-body">
                                                <div class="mt-2 d-flex justify-content-between">
                                                    <div>
                                                        <span class="font-weight-bold">
                                                            {{ $article['user']['name'] }}
                                                        </span>
                                                        {{ $activity->description }}
                                                    </div>
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
                                @elseif($activity->properties['event'] === 'question.collected' && $question = $activity->properties)
                                    <li class="list-group-item">
                                        <div class="media">
                                            <div class="media-body">
                                                <div class="mt-2 d-flex justify-content-between">
                                                    <div>
                                                        <span class="font-weight-bold">
                                                            {{ $question['user']['name'] }}
                                                        </span>
                                                        {{ $activity->description }}
                                                    </div>
                                                    <span>{{ $activity->created_at->diffForHumans() }}</span>
                                                </div>
                                                <div class="media mt-3">
                                                    <div class="media-body">
                                                        <h2 class="mt-0 title">
                                                            <a href="{{ route('articles.show', $activity->subject_id) }}">
                                                                {{ $question['question']['title'] }}
                                                            </a>
                                                        </h2>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </li>
                                @elseif($activity->properties['event'] === 'question.followed' && $question = $activity->properties)
                                    <li class="list-group-item">
                                        <div class="media">
                                            <div class="media-body">
                                                <div class="mt-2 d-flex justify-content-between">
                                                    <div>
                                                        <span class="font-weight-bold">
                                                            {{ $question['user']['name'] }}
                                                        </span>
                                                        {{ $activity->description }}
                                                    </div>
                                                    <span>{{ $activity->created_at->diffForHumans() }}</span>
                                                </div>
                                                <div class="media mt-3">
                                                    <div class="media-body">
                                                        <h2 class="mt-0 title">
                                                            <a href="{{ route('articles.show', $activity->subject_id) }}">
                                                                {{ $question['question']['title'] }}
                                                            </a>
                                                        </h2>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </li>
                                @elseif($activity->properties['event'] === 'article.zan' && $article = $activity->properties)
                                    <li class="list-group-item">
                                        <div class="media">
                                            <div class="media-body">
                                                <div class="mt-2 d-flex justify-content-between">
                                                    <div>
                                                        <span class="font-weight-bold">
                                                            {{ $article['user']['name'] }}
                                                        </span>
                                                        {{ $activity->description }}
                                                    </div>
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
                                @elseif($activity->properties['event'] === 'user.followed' && $users = $activity->properties)
                                    <li class="list-group-item">
                                        <div class="media">
                                            <div class="media-body">
                                                <div class="mt-2 d-flex justify-content-between">
                                                    <div>
                                                        <span class="font-weight-bold">{{ $users['fan']['name'] }}</span>
                                                        {{ $activity->description }}
                                                    </div>
                                                    <span>{{ $activity->created_at->diffForHumans() }}</span>
                                                </div>
                                                <div class="media mt-3">
                                                    <a href="{{ route('users.show', $activity->subject_id) }}">
                                                        <img src="{{ $users['follow']['avatar'] }}"
                                                             class="mr-3 avatar-48"
                                                             alt="{{ $users['follow']['name'] }}" title="{{ $users['follow']['name'] }}">
                                                    </a>
                                                    <div class="media-body">
                                                        <h5 class="mt-0">
                                                            <a href="{{ route('users.show', $activity->subject_id) }}">{{ $users['follow']['name'] }}</a>
                                                        </h5>
                                                        <p title="工作单位与职位">
                                                            @if($users['follow']['position'])
                                                                {{ $users['follow']['position'] }}
                                                                @
                                                            @endif
                                                            {{ $users['follow']['company'] }}
                                                        </p>
                                                        <p>{{ $users['follow']['intro'] ?: '这家伙太懒，懒得介绍自己~~~' }}</p>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </li>
                                @endif
                                {{--TODO:: 招聘...--}}
                            @endforeach
                        </ul>
                    </div>
                    <div class="card-footer" data-pjax>
                        {{ $activities->links() }}
                    </div>
                </div>
            </div>

            <div class="col-md-3 mt-md-0 mt-3">
                {{--用户信息--}}
                @include('includes.user')

                {{--最近访客--}}
                @include('includes.visitor', ['user' => $user])
            </div>
        </div>
    </div>
@stop