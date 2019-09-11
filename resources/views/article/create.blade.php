@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-10">
                <form action="{{ route('article.store') }}" method="post">
                    @csrf
                    <div class="card">
                        <div class="card-header d-flex justify-content-between align-items-center">
                            <strong>写文章</strong>
                            <button class="btn btn-success btn-sm">发表</button>
                        </div>
                        <div class="card-body">
                            <div class="form-group">
                                <div class="input-group">
                                    <div class="input-group-prepend">
                                        <label for="name">
                                            <select id="name" class="custom-select" name="type">
                                                <option value="1" selected>原创</option>
                                                <option value="2">转载</option>
                                                <option value="3">翻译</option>
                                            </select>
                                        </label>
                                    </div>
                                    <input type="text" id="title"
                                           class="form-control @error('title') is-invalid @enderror" name="title"
                                           placeholder="标题：美好的一天" required>
                                </div>
                                @error('title')
                                <small id="helpId" class="form-text text-danger">{{ $message }}</small>
                                @enderror
                            </div>

                            <div class="form-group">
                                <input type="text" class="form-control tags" name="tags" id="tags"
                                       placeholder="标签，如：php,Laravel(用逗号,分隔)">
                            </div>

                            <div class="form-group">
                                <textarea class="form-control" name="content" id="content" rows="10"
                                          style="resize: none"></textarea>
                                @error('content')
                                <small id="helpId" class="form-text text-danger">{{ $message }}</small>
                                @enderror
                            </div>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
@stop

@section('script')
    <script src="/vendor/unisharp/laravel-ckeditor/ckeditor.js"></script>
    <script src="/vendor/unisharp/laravel-ckeditor/adapters/jquery.js"></script>
    <script>
        $('textarea').ckeditor({
            height: 400
        });
    </script>
@stop