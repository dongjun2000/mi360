@if($users->total() > 0)
    @foreach($users as $user)
        <li class="list-group-item">
            <div class="media">
                <a href="{{ route('users.show', $user) }}">
                    <img src="{{ $user->avatar }}" class="mr-3 avatar-48"
                         alt="{{ $user->name }}" title="{{ $user->name }}">
                </a>
                <div class="media-body">
                    <h5 class="mt-0">
                        <a href="{{ route('users.show', $user) }}" title="{{ $user->name }}">{{ $user->name }}</a>
                    </h5>
                    <p title="工作单位与职位">
                        @if(!is_null($user->position))
                            {{ $user->position }}
                            @
                        @endif
                        {{ $user->company }}
                    </p>
                    <p title="自我介绍">{{ $user->intro ?: '这家伙太懒，懒得介绍自己~~~' }}</p>
                </div>
            </div>
        </li>
    @endforeach
@else
    <li class="list-group-item">暂无关注你的用户！</li>
@endif