<div class="card mt-3">
    <div class="card-body p-0">
        <div class="list-group list-group-flush">
            <a href="" class="list-group-item list-group-item-action active disabled">
                <span class="fa fa-list-ul mr-2"></span>
                技术频道
            </a>
            @foreach($categories as $category)
                <a href="{{ route('channel', $category->name) }}"
                   class="list-group-item list-group-item-action">
                    <i class="fa {{ $category->icon }}"></i>
                    {{ $category->name }}
                </a>
            @endforeach
        </div>
    </div>
</div>