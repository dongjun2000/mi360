@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row">
            <div class="col-md-3">
                <div class="card" style="position: sticky; top: 15px;">
                    <div class="card-body p-0">
                        <div class="list-group list-group-flush">
                            <a href="{{ route('messages.index') }}"
                               class="list-group-item list-group-item-action text-center">
                                <i class="fa fa-envelope-o"></i>
                                私信
                            </a>
                            <a href="{{ route('notifications.index') }}"
                               class="list-group-item list-group-item-action text-center">
                                <i class="fa fa-bell-o"></i>
                                通知
                            </a>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-md-9">
                <div class="card">
                    <div class="card-header d-flex justify-content-between align-items-center">
                        <h5>
                            <i class="fa fa-envelope"></i>
                            我的通知
                        </h5>
                        <div class="btn-group">
                            <a href="{{ route('notifications.index', ['filter' => 'unread']) }}"
                               class="btn btn-danger">未读</a>
                            <a href="{{ route('notifications.index') }}" class="btn btn-success">全部</a>
                        </div>
                    </div>
                    <div class="card-body">
                        <ul class="list-group list-group-flush">
                            @if(count($notifications) > 0)
                            @foreach($notifications as $notification)
                                @include('notifications.' . snake_case(class_basename($notification->type)))
                            @endforeach
                                @else
                            <li class="list-group-item">暂无新通知</li>
                            @endif
                        </ul>
                    </div>
                    <div class="card-footer text-muted">
                        @if($filter !== 'unread')
                            {{ $notifications->links() }}
                        @endif
                    </div>
                </div>
            </div>
        </div>
    </div>
@stop