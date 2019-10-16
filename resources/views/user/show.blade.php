@extends('layouts.app')

@section('title', $user->name . '的个人主页')

@section('content')
    <div class="container">
        <div class="row" data-pjax>
            <div class="col-md-2">
                <div class="list-group" style="position: sticky; top: 15px;">
                    @foreach($navs as $key => $item)
                        <a href="{{ route("users.{$key}", $user) }}"
                           class="p-3 d-flex justify-content-between align-items-center list-group-item list-group-item-action @if($key === $tag) active @endif">
            <span>
                <i class="fa {{ $item['icon'] }}"></i>
                {{ $item['title'] }}
            </span>
                            @if(isset($item['num']))
                                <span class="badge badge-primary badge-pill bg-secondary">{{ $item['num'] }}</span>
                            @endif
                        </a>
                    @endforeach
                </div>
            </div>
            <div class="col-md-7">
                @include('user.' . $tag)
            </div>

            <div class="col-md-3">
                {{--用户信息--}}
                @include('includes.user')

                {{--最近访客--}}
                @include('includes.visitor', ['user' => $user])
            </div>
        </div>
    </div>
@stop




