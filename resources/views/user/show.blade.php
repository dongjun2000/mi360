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
                @include('includes.user')
            </div>
        </div>
    </div>
    </div>
@stop