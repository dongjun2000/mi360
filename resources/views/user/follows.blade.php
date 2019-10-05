<div class="card">
    <div class="card-header">
        <h5 title="{{ $user->name }} 关注用户">
            <i class="fa fa-gittip fa-2x"></i>
            {{ Str::limit($user->name, 12) }} 关注用户 ({{ $users->total() }})
        </h5>
    </div>
    <div class="card-body">
        <ul class="list-group list-group-flush mt-3">
            @include('includes.fans')
        </ul>
    </div>
    <div class="card-footer d-flex justify-content-center">
        {{ $users->links() }}
    </div>
</div>