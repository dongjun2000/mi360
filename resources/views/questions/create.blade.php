@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-10">
                <form action="{{ route('questions.store') }}" method="post">
                    @csrf
                    <div class="card">
                        <div class="card-header d-flex justify-content-between align-items-center">
                            <strong>提问题</strong>
                            <button class="btn btn-success btn-sm">发布问题</button>
                        </div>
                        <div class="card-body">
                            <div class="form-group">
                                <input type="text" id="title"
                                       class="form-control @error('title') is-invalid @enderror" name="title"
                                       placeholder="标题：一句话说清问题，用问号结尾" required>
                                @error('title')
                                <small id="helpId" class="form-text text-danger">{{ $message }}</small>
                                @enderror
                            </div>

                            <div class="form-group">
                                <select class="form-control" name="tags[]" id="tags" multiple="multiple"></select>
                            </div>

                            <div class="form-group">
                                <textarea class="form-control" name="content" id="content" rows="10"
                                          style="resize: none">
                                    <p>1.描述你的问题</p>

                                    <p>2.贴上相关代码（请勿用图片代替代码）</p>

                                    <p>3.贴上报错信息</p>

                                    <p>4.已经尝试过哪些方法仍然没解决（附上相关链接）</p>
                                </textarea>
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

        $('#tags').select2({
            placeholder: '选择相关标签',
            maximumInputLength: 10,
            ajax: {
                delay: 250,
                url: "{{ route('tags.search') }}",
                data: function (params) {
                    console.log(params.term);
                    var query = {
                        key: params.term,
                    };
                    return query;
                },
                dataType: 'json',
                processResults: function (data) {
                    // ajax返回结果格式转换
                    data.results = $.map(data.results, function (obj) {
                        obj.text = obj.text || obj.name;
                        return obj;
                    });
                    return data;
                }
            }
        });
    </script>
@stop