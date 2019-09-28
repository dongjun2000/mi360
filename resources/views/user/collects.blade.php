@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row" data-pjax>
            <div class="col-md-2">
                @include('includes.user_nav')
            </div>
            <div class="col-md-7">
                <div class="card">
                    <div class="card-header">
                        <ul class="nav nav-tabs card-header-tabs">
                            <li class="nav-item">
                                <a class="nav-link @if($type == 'articles') active @endif"
                                   href="{{ route('users.collects', [$user, 'type' => 'articles']) }}">收藏的文章</a>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link @if($type == 'questions') active @endif"
                                   href="{{ route('users.collects', [$user, 'type' => 'questions']) }}">收藏的问答</a>
                            </li>
                        </ul>
                    </div>
                    <div class="card-body p-2">
                        <ul class="list-group list-group-flush">
                            @foreach($models as $model)
                                <li class="list-group-item"><a href="{{ route($type . '.show', $model) }}">{{ $model->title }}</a></li>
                            @endforeach
                        </ul>
                    </div>
                    <div class="card-footer">
                        {{ $models->links() }}
                    </div>
                </div>
            </div>

            <div class="col-md-3">
                @include('includes.user')
            </div>
        </div>
    </div>
@stop