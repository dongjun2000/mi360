@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row">
            <div class="col-md-2">
                <div class="list-group">
                    <a href="#" class="list-group-item list-group-item-action active">我的主页</a>
                    <a href="#" class="list-group-item list-group-item-action">个人动态</a>

                    <a href="#" class="list-group-item list-group-item-action">我关注的</a>
                    <a href="#" class="list-group-item list-group-item-action">我的文章</a>
                    <a href="#" class="list-group-item list-group-item-action">我的提问</a>
                    <a href="#" class="list-group-item list-group-item-action " tabindex="-1" aria-disabled="true">我的回答</a>
                </div>
            </div>
            <div class="col-md-7">
                <div class="card">
                    <div class="card-body">
                        123
                    </div>
                </div>
            </div>
            <div class="co-md-3">
                <div class="card">
                    <div class="card-header">
                        Header
                    </div>
                    <div class="card-body">
                        <h4 class="card-title">Title</h4>
                        <p class="card-text">Text</p>
                    </div>
                    <div class="card-footer text-muted">
                        Footer
                    </div>
                </div>
            </div>
        </div>
    </div>
@stop