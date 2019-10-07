<li class="list-group-item">
    <div class="media">
        <a href="{{ route('users.show', $notification->data['fans']['id']) }}">
            <img src="{{ $notification->data['fans']['avatar'] }}"
                 class="mr-3 avatar-48" alt=""
                 title="">
        </a>
        <div class="media-body">
            <h5>
                <a href="{{ route('users.show', $notification->data['fans']['id']) }}">{{ $notification->data['fans']['name'] }}</a>
            </h5>
            <span class="badge badge-pill badge-success">关注</span>
            {{ $notification->data['is_follow'] ? '我对您很感兴趣，并且关注了你！👀' : '不好意思，我觉得我们可能不合适，所以我取消了对您的关注！' }}
        </div>
    </div>
</li>