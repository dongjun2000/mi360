@if($articles->count() > 0)
    @foreach($articles as $article)
        <li class="list-group-item">
            <div class="media">
                <div class="media-body">
                    {{--文章标题--}}
                    <h2 class="mt-2 mb-2 title">
                        <a href="{{ route('articles.show', $article) }}"
                           title="{{ $article->title }}">{{ $article->title }}</a>
                        <span class="badge badge-pill badge-success">
                                                    {{ $article->type }}
                                                </span>
                    </h2>
                    <ul class="list-inline">
                        {{--作者信息--}}
                        <li class="list-inline-item">
                            {{--作者头像--}}
                            <a href="{{ route('users.show', $article->user) }}">
                                <img src="{{ $article->user->avatar }}"
                                     alt="{{$article->user->name}}"
                                     title="{{$article->user->name}}" class="avatar-24">
                            </a>
                            {{--作者名--}}
                            <span>
                                <a href="{{ route('users.show', $article->user) }}"
                                   title="{{$article->user->name}}">{{ $article->user->name }}</a>
                                在 {{ $article->created_at }} 发布
                            </span>
                        </li>
                        <li class="list-inline-item">
                            <span>收藏数: {{ $article->collect }}</span>
                            <span class="line">/</span>
                            <span>点赞数: {{ $article->zan }}</span>
                            <span class="line">/</span>
                            <span>阅读数: {{ $article->read }}</span>
                        </li>
                    </ul>
                    {{--文章简介--}}
                    <p>{{ $article->intro }}...</p>
                </div>
                @if($article->pic)
                    <a href="{{ route('articles.show', $article) }}">
                        <img src="{{ $article->pic }}"
                             class="align-self-center ml-3 rounded pic"
                             alt="{{ $article->title }}" title="{{ $article->title }}">
                    </a>
                @endif
            </div>
        </li>
    @endforeach
@else
    <li class="list-group-item">暂无文章！</li>
@endif