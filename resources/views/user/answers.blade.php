@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row">
            <div class="col-md-2" data-pjax>
                @include('includes.user_nav')
            </div>
            <div class="col-md-7">
                {{--我的主页--}}
                <div class="card">
                    <div class="card-body">
                        <div class="d-flex justify-content-between align-items-center">
                            <h5 class="mb-3" title="{{ $user->name }} 的回答">
                                <i class="fa fa-thumbs-o-up fa-2x"></i>
                                {{ Str::limit($user->name, 12) }} 的回答 ({{ $answers->total() }})
                            </h5>
                            <div class="btn-group d-inline-flex align-items-center">
                                <span>排序：</span>
                                <a href="{{ route('users.answers', [$user, 'sort' => 'created_at']) }}"
                                   class="btn btn-outline-success btn-sm">回答时间</a>
                                <a href="{{ route('users.answers', [$user, 'sort' => 'accept']) }}"
                                   class="btn btn-outline-primary btn-sm">被采纳</a>
                            </div>
                        </div>
                        <ul class="list-group list-group-flush">
                            @include('includes.answers')
                        </ul>
                    </div>
                    <div class="card-footer d-flex justify-content-center" data-pjax>
                        {{ $answers->links() }}
                    </div>
                </div>
            </div>

            <div class="col-md-3">
                @include('includes.user')
            </div>
        </div>
    </div>
@stop