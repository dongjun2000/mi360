<li class="list-group-item">
    <div class="media">
        <a href="{{ route('users.show', $notification->data['user']['id']) }}">
            <img src="{{ $notification->data['user']['avatar'] }}"
                 class="mr-3 avatar-48" alt=""
                 title="">
        </a>
        <div class="media-body">
            <h5>
                <a href="{{ route('users.show', $notification->data['user']['id']) }}">{{ $notification->data['user']['name'] }}</a>
            </h5>
            <span class="badge badge-pill badge-success">点赞</span>
            {{
                $notification->data['is_zan'] ?
                "我觉得您{$notification->data['article']['type']}的这篇文章很不错！所以我给了您一个大大的赞！👍" :
                "不好意思，我觉得您{$notification->data['article']['type']}的这篇文章可能没有那么好，所以我取消了点赞~~~"
            }}

            <div class="media border rounded mt-3 p-3">
                <div class="media-body">
                    {{--文章标题--}}
                    <p class="mt-2 mb-2 title">
                        <a href="{{ route('articles.show', $notification->data['article']['id']) }}">
                            {{ $notification->data['article']['title'] }}
                        </a>
                    </p>
                    {{--文章简介--}}
                    <p>{{ $notification->data['article']['intro'] }}...</p>
                </div>
                @if($notification->data['article']['pic'])
                    <a href="{{ route('articles.show', $notification->data['article']['id']) }}">
                        <img src="{{ $notification->data['article']['pic'] }}"
                             class="ml-3 rounded" style="width:64px;height: 64px;">
                    </a>
                @endif
            </div>


        </div>
    </div>
</li>