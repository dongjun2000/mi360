@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row">
            <div class="col-md-2" style="position: sticky; top: 15px;">
                @include('includes.user_nav')
            </div>
            <div class="col-md-7">
                {{--我的主页--}}
                <div class="card">
                    <div class="card-body">
                        123123
                    </div>
                </div>
            </div>

            <div class="col-md-3">
                @include('includes.user')
            </div>
        </div>
    </div>
@stop