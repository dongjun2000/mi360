<div class="list-group">
    @foreach($navs as $key => $item)
        <a href="{{ route("users.{$key}", $user) }}"
           class="p-3 d-flex justify-content-between align-items-center list-group-item list-group-item-action @if($key === $tag) active @endif">
            <span>
                <i class="fa {{ $item['icon'] }}"></i>
                {{ $item['title'] }}
            </span>
            @if(isset($item['num']))
                <span class="badge badge-primary badge-pill bg-secondary">{{ $item['num'] }}</span>
            @endif
        </a>
    @endforeach
</div>