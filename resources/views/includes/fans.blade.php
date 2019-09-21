@if($users->total() > 0)
    @foreach($users as $user)
        <li class="list-group-item">
            <div class="media">
                <a href="">
                    <img src="{{ $user->avatar }}" class="mr-3 avatar-48"
                         alt="..." title="">
                </a>
                <div class="media-body">
                    <h5 class="mt-0">
                        <a href="">{{ $user->name }}</a>
                    </h5>
                    <p title="工作单位与职位">
                        php开发者
                        @
                        十堰梦航教育科技有限公司
                    </p>
                    <p>这家伙太懒，懒得介绍自己~~~</p>
                </div>
            </div>
        </li>
    @endforeach
@else
    <li class="list-group-item">暂无关注你的用户！</li>
@endif