@extends('errors.layout')

@section('title', 'HTTP 404')

@section('message')
    <div class="d-flex justify-content-around align-items-center">
        <div>
            <h1>杯具啊！</h1>
            <p>
                HTTP 404……
                <br>
                可能这个页面已经飞走了
            </p>
            <a href="{{ route('home') }}" class="btn btn-primary">回首页</a>
        </div>
        <img src="{{ asset('imgs/default/404.svg') }}" alt="404" title="404">
    </div>
@stop

@section('css')
    <style>
        .d-flex {
            padding: 80px 0;
            display: flex;
        }

        .justify-content-around {
            justify-content: space-around;
        }

        .align-items-center {
            align-items: center;
        }

        .btn {
            display: block;
            width: 60px;
            height: 30px;
            line-height: 30px;
            text-align: center;
            border-radius: 3px;
        }

        .btn-primary {
            color: #fff;
            background-color: #00B0E8;
        }

        a.btn {
            text-decoration: none;
        }

        a.btn:hover {
            background-color: #0f74a8;
        }
    </style>
@stop

