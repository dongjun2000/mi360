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
                        <a href="">
                            <span>{{ $user->articles_count }}</span>
                        </a>
                    </li>
                    <li class="list-inline-item d-flex flex-column align-items-center" title="关注作者的用户数">
                        <span>粉丝</span>
                        <a href="{{ route('users.fans', $user) }}">
                            <span>{{ $user->fans_count }}</span>
                        </a>
                    </li>
                    <li class="list-inline-item d-flex flex-column align-items-center" title="收到了0个赞数">
                        <span>点赞</span>
                        <a href="">
                            <span>0</span>
                        </a>
                    </li>
                    <li class="list-inline-item d-flex flex-column align-items-center"
                        title="所有文章被收藏了0次">
                        <span>收藏</span>
                        <a href="">
                            <span>0</span>
                        </a>
                    </li>
                </ul>
            </li>
            <li class="list-group-item">
                <h1 class="pt-2 pb-2" title="{{ $user->name }}">{{ Str::limit($user->name, 12) }}
                    <i class="fa fa-mars text-primary"></i>
                    <i class="fa fa-venus text-danger"></i>
                </h1>
                <p title="工作单位与职位">
                    <i class="fa fa-suitcase"></i>
                    开发者
                     @
                    十堰梦航教育科技有限公司
                </p>
                <p title="地址">
                    <i class="fa fa-map-marker"></i>
                    深圳
                </p>
                <p title="网址">
                    <i class="fa fa-link"></i>
                    <a href="http://www.mi360.cn" target="_blank" class="text-muted">http://www.mi360.cn</a>
                </p>
                <p title="最后在线">
                    <i class="fa fa-desktop"></i>
                    1小时前
                </p>
            </li>
            <li class="list-group-item">
                这家伙太懒，懒得介绍自己~~~
            </li>
        </ul>
    </div>
    <div class="card-footer p-2 text-center">
        @if(Auth::check() && Auth::user()->id === $user->id)
            <a href="" class="btn btn-primary btn-block">编辑个人资料</a>
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