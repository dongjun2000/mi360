<div class="card mt-3">
    <div class="card-header d-inline-flex justify-content-between">
        <strong>最近访客</strong>
        {{--<a href="">更多...</a>--}}
    </div>
    <div class="card-body">
        <ul class="list-inline d-flex justify-content-between flex-wrap mb-0">
            @if($visitors->count() > 0)
                @foreach($visitors as $visitor)
                    <li class="d-inline-flex flex-column align-items-center">
                        <a href="{{ route('users.show', $visitor->visitor) }}">
                        <img class="avatar-58" src="http://mi360.cc/imgs/default/face.jpg" alt="{{ $visitor->visitor_info['name'] }}" title="{{ $visitor->visitor_info['name'] }}">
                        </a>
                        <div class="d-flex flex-column justify-content-between align-items-center"
                             style="position: relative;">
                            <span style="font-size: 12px; position: absolute; top: -20px; color: #f9f9f9">{{ mb_substr($visitor->visitor_info['name'],0, 3) }}</span>
                            <span>{{ $visitor->updated_at->diffForHumans() }}</span>
                        </div>
                    </li>
                @endforeach
            @else
                <li class="d-inline-flex flex-column align-items-center">暂无访客！</li>
            @endif
        </ul>
    </div>
    <div class="card-footer">
        <ul class="list-inline d-flex justify-content-around mb-0">
            <li class="list-inline-item d-flex flex-column align-items-center" title="今日浏览：{{ $todayCount }}">
                <span>今日浏览</span>
                <span>{{ $todayCount }}</span>
            </li>
            <li class="list-inline-item d-flex flex-column align-items-center" title="总浏览量：{{ $user->visitor_total }}">
                <span>总浏览量</span>
                <span>{{ $user->visitor_total }}</span>
            </li>
        </ul>
    </div>
</div>