<div class="card">
    <div class="card-header d-flex justify-content-between align-items-center">
        <h5 title="{{$user->name}} 的提问">
            <i class="fa fa-question-circle-o fa-2x"></i>
            {{ Str::limit($user->name, 12) }} 的提问 ({{ $questions->total() }})
        </h5>
        <div class="btn-group d-inline-flex align-items-center">
            <span>排序：</span>
            <a href="{{ route('users.questions', [$user, 'sort' => 'created_at']) }}"
               class="btn btn-outline-success btn-sm">提问时间</a>
            <a href="{{ route('users.questions', [$user, 'sort' => 'answer']) }}"
               class="btn btn-outline-primary btn-sm">回答数</a>
            <a href="{{ route('users.questions', [$user, 'sort' => 'follow']) }}"
               class="btn btn-outline-danger btn-sm">关注数</a>
            <a href="{{ route('users.questions', [$user, 'sort' => 'read']) }}"
               class="btn btn-outline-dark btn-sm">浏览数</a>
        </div>
    </div>
    <div class="card-body">
        <ul class="list-group list-group-flush list">
            @include('includes.questions')
        </ul>
    </div>
    <div class="card-footer d-flex justify-content-center" data-pjax>
        {{ $questions->links() }}
    </div>
</div>