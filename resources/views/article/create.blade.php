@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-10">
                <form action="{{ route('articles.store') }}" method="post">
                    @csrf
                    <div class="card">
                        <div class="card-header d-flex justify-content-between align-items-center">
                            <strong>写文章</strong>
                            <button class="btn btn-success btn-sm">发表</button>
                        </div>
                        <div class="card-body">
                            <div class="form-group">
                                <select class="form-control" id="exampleFormControlSelect1" name="category_id">
                                    <option>==请选择文章分类==</option>
                                    @foreach($categories as $category)
                                        <option value="{{ $category->id }}">{{ $category->name }}</option>
                                    @endforeach
                                </select>
                                @error('category_id')
                                <small id="helpId" class="form-text text-danger">{{ $message }}</small>
                                @enderror
                            </div>

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
                                           placeholder="标题：美好的一天" value="{{ old('title') }}" required>
                                </div>
                                @error('title')
                                <small id="helpId" class="form-text text-danger">{{ $message }}</small>
                                @enderror
                            </div>
                            <div class="form-group">
                                <select class="form-control" name="tags[]" id="tags" multiple="multiple"></select>
                            </div>
                            <div class="form-group">
                                <textarea class="form-control" name="content" id="content" rows="10"
                                          style="resize: none">{{ old('content') }}</textarea>
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