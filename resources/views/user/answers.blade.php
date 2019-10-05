<div class="card">
    <div class="card-header d-flex justify-content-between align-items-center">
        <h5 title="{{ $user->name }} 的回答">
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
    <div class="card-body">
        <ul class="list-group list-group-flush">
            @include('includes.answers')
        </ul>
    </div>
    <div class="card-footer d-flex justify-content-center" data-pjax>
        {{ $answers->links() }}
    </div>
</div>