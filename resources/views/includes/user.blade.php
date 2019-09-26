<div class="card">
    <div class="card-body p-1">
        <ul class="list-group list-group-flush">
            <li class="list-group-item p-3">
                <img src="{{ $user->avatar }}" alt="{{ $user->name }}"
                     title="{{ $user->name }}" style="width:100%;">
            </li>
            <li class="list-group-item">
                <ul class="list-inline d-flex justify-content-between">
                    <li class="list-inline-item d-flex flex-column align-items-center" title="博客文章总数">

                        <span>文章</span>
                        <a href="{{ route('users.articles', $user) }}">
                            <span>{{ $user->article }}</span>
                        </a>
                    </li>
                    <li class="list-inline-item d-flex flex-column align-items-center" title="关注作者的用户数">
                        <span>粉丝</span>
                        <a href="{{ route('users.fans', $user) }}">
                            <span>{{ $user->fans_count }}</span>
                        </a>
                    </li>
                    <li class="list-inline-item d-flex flex-column align-items-center" title="收到了{{ $user->zan }}个赞数">
                        <span>点赞</span>
                        <a href="">
                            <span>{{ $user->zan }}</span>
                        </a>
                    </li>
                    <li class="list-inline-item d-flex flex-column align-items-center"
                        title="所有文章被收藏了{{ $user->collect }}次">
                        <span>收藏</span>
                        <a href="">
                            <span>{{ $user->collect }}</span>
                        </a>
                    </li>
                </ul>
            </li>
            <li class="list-group-item">
                <h1 class="pt-2 pb-2" title="{{ $user->name }}">{{ Str::limit($user->name, 12) }}
                    @if($user->gender)
                        <i class="fa fa-mars text-primary" title="男"></i>
                    @else
                        <i class="fa fa-venus text-danger" title="女"></i>
                    @endif
                </h1>
                <p title="工作单位与职位">
                    @if($user->position)
                        <i class="fa fa-suitcase"></i>
                        {{ $user->position }}
                    @endif
                    @if($user->company) @
                        {{ $user->company }}
                    @endif
                </p>
                @if($user->city)
                    <p title="地址">
                        <i class="fa fa-map-marker"></i>
                        {{ $user->city }}
                    </p>
                @endif
                @if($user->website)
                    <p title="网址">
                        <i class="fa fa-link"></i>
                        <a href="{{ $user->website }}" target="_blank" class="text-muted">{{ $user->website }}</a>
                    </p>
                @endif
                <p title="最后在线">
                    <i class="fa fa-desktop"></i>
                    {{ !is_null($user->logtime) ? $user->logtime->diffForHumans() : $user->created_at->diffForHumans() }}
                </p>
            </li>
            <li class="list-group-item">
                {{ $user->intro ?: '这家伙太懒，懒得介绍自己~~~' }}
            </li>
        </ul>
    </div>
    <div class="card-footer p-2 text-center">
        @if(Auth::check() && Auth::user()->id === $user->id)
            <a href="{{ route('users.settings') }}" class="btn btn-primary btn-block">编辑个人资料</a>
        @else
            <div class="btn-group">
                <a href="{{ route('users.follow', $user) }}"
                   class="btn btn-success text-white">{{ $followStatus ? '取消关注' : '关注我' }}</a>
                <a href="#" class="btn btn-primary text-white">私信我</a>
                <a href="#" class="btn btn-danger text-white">打赏我</a>
            </div>
        @endif
    </div>
</div>