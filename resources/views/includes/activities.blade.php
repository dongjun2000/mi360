<div class="card">
    <div class="card-header">
        <i class="fa fa-comments"></i>
        动态
    </div>
    <div class="card-body p-2" style="height:600px; overflow: auto; overflow-x: hidden;">
        <ul class="list-group list-group-flush">
            @foreach($activities as $activity)
                @if($activity->properties['event'] === 'article.created')
                    <li class="list-group-item p-2">
                        <div class="media">
                            <a href="{{ route('users.show', $activity->user_id) }}">
                                <img src="{{ $activity->properties['user']['avatar'] }}"
                                     class="mr-2 avatar-38"
                                     alt="{{ $activity->properties['user']['name'] }}"
                                     title="{{ $activity->properties['user']['name'] }}">
                            </a>
                            <div class="media-body">
                                <div class="d-flex justify-content-between">
                                    <span class="font-weight-bold">{{ Str::limit($activity->properties['user']['name'], 10) }}</span>
                                    <span style="font-size: 12px;">{{ $activity->created_at->diffForHumans() }}</span>
                                </div>
                                <div style="font-size:12px">
                                    <span>{{ $activity->description }}</span>
                                    <figure class="figure">
                                        @if(isset($activity->properties['article']['pic']))
                                            <a href="{{ route('articles.show', $activity->subject_id) }}">
                                                <img src="{{ $activity->properties['article']['pic'] }}"
                                                     class="figure-img img-fluid rounded"
                                                     alt="{{ $activity->properties['article']['title'] }}"
                                                     title="{{ $activity->properties['article']['title'] }}">
                                            </a>
                                        @endif
                                        <figcaption class="figure-caption">
                                            <a href="{{ route('articles.show', $activity->subject_id) }}">
                                                {{ $activity->properties['article']['title'] }}
                                            </a>
                                        </figcaption>
                                    </figure>
                                </div>
                            </div>
                        </div>
                    </li>
                @elseif($activity->properties['event'] === 'question.created')
                    <li class="list-group-item p-2">
                        <div class="media">
                            <a href="{{ route('users.show', $activity->user_id) }}">
                                <img src="{{ $activity->properties['user']['avatar'] }}"
                                     class="mr-2 avatar-38"
                                     alt="{{ $activity->properties['user']['name'] }}"
                                     title="{{ $activity->properties['user']['name'] }}">
                            </a>
                            <div class="media-body">
                                <div class="d-flex justify-content-between">
                                    <span class="font-weight-bold">{{ Str::limit($activity->properties['user']['name'], 10) }}</span>
                                    <span style="font-size: 12px;">{{ $activity->created_at->diffForHumans() }}</span>
                                </div>
                                <div style="font-size:12px">
                                    <span>{{ $activity->description }}</span>
                                    <a href="{{ route('questions.show', $activity->subject_id) }}">
                                        {{ $activity->properties['question']['title'] }}
                                    </a>
                                </div>
                            </div>
                        </div>
                    </li>
                @elseif($activity->properties['event'] === 'answer.created')
                    <li class="list-group-item p-2">
                        <div class="media">
                            <a href="{{ route('users.show', $activity->user_id) }}">
                                <img src="{{ $activity->properties['user']['avatar'] }}"
                                     class="mr-2 avatar-38"
                                     alt="{{ $activity->properties['user']['name'] }}"
                                     title="{{ $activity->properties['user']['name'] }}">
                            </a>
                            <div class="media-body">
                                <div class="d-flex justify-content-between">
                                    <span class="font-weight-bold">{{ Str::limit($activity->properties['user']['name'], 10) }}</span>
                                    <span style="font-size: 12px;">{{ $activity->created_at->diffForHumans() }}</span>
                                </div>
                                <div style="font-size:12px">
                                    <span>{{ $activity->description }}</span>
                                    <a href="{{ route('questions.show', $activity->properties['question']['id']) }}">
                                        {{ $activity->properties['question']['title'] }}
                                    </a>
                                </div>
                            </div>
                        </div>
                    </li>
                @elseif($activity->properties['event'] === 'article.collected')
                    <li class="list-group-item p-2">
                        <div class="media">
                            <a href="{{ route('users.show', $activity->user_id) }}">
                                <img src="{{ $activity->properties['user']['avatar'] }}"
                                     class="mr-2 avatar-38"
                                     alt="{{ $activity->properties['user']['name'] }}"
                                     title="{{ $activity->properties['user']['name'] }}">
                            </a>
                            <div class="media-body">
                                <div class="d-flex justify-content-between">
                                    <span class="font-weight-bold">{{ Str::limit($activity->properties['user']['name'], 10) }}</span>
                                    <span style="font-size: 12px;">{{ $activity->created_at->diffForHumans() }}</span>
                                </div>
                                <div style="font-size:12px">
                                    <span>{{ $activity->description }}</span>
                                    <figure class="figure">
                                        @if(isset($activity->properties['article']['pic']))
                                            <a href="{{ route('articles.show', $activity->subject_id) }}">
                                                <img src="{{ $activity->properties['article']['pic'] }}"
                                                     class="figure-img img-fluid rounded"
                                                     alt="{{ $activity->properties['article']['title'] }}"
                                                     title="{{ $activity->properties['article']['title'] }}">
                                            </a>
                                        @endif
                                        <figcaption class="figure-caption">
                                            <a href="{{ route('articles.show', $activity->subject_id) }}">
                                                {{ $activity->properties['article']['title'] }}
                                            </a>
                                        </figcaption>
                                    </figure>
                                </div>
                            </div>
                        </div>
                    </li>
                @elseif($activity->properties['event'] === 'question.collected')
                    <li class="list-group-item p-2">
                        <div class="media">
                            <a href="{{ route('users.show', $activity->user_id) }}">
                                <img src="{{ $activity->properties['user']['avatar'] }}"
                                     class="mr-2 avatar-38"
                                     alt="{{ $activity->properties['user']['name'] }}"
                                     title="{{ $activity->properties['user']['name'] }}">
                            </a>
                            <div class="media-body">
                                <div class="d-flex justify-content-between">
                                    <span class="font-weight-bold">{{ Str::limit($activity->properties['user']['name'], 10) }}</span>
                                    <span style="font-size: 12px;">{{ $activity->created_at->diffForHumans() }}</span>
                                </div>
                                <div style="font-size:12px">
                                    <span>{{ $activity->description }}</span>
                                    <a href="{{ route('questions.show', $activity->subject_id) }}">
                                        {{ $activity->properties['question']['title'] }}
                                    </a>
                                </div>
                            </div>
                        </div>
                    </li>
                @elseif($activity->properties['event'] === 'question.followed')
                    <li class="list-group-item p-2">
                        <div class="media">
                            <a href="{{ route('users.show', $activity->user_id) }}">
                                <img src="{{ $activity->properties['user']['avatar'] }}"
                                     class="mr-2 avatar-38"
                                     alt="{{ $activity->properties['user']['name'] }}"
                                     title="{{ $activity->properties['user']['name'] }}">
                            </a>
                            <div class="media-body">
                                <div class="d-flex justify-content-between">
                                    <span class="font-weight-bold">{{ Str::limit($activity->properties['user']['name'], 10) }}</span>
                                    <span style="font-size: 12px;">{{ $activity->created_at->diffForHumans() }}</span>
                                </div>
                                <div style="font-size:12px">
                                    <span>{{ $activity->description }}</span>
                                    <a href="{{ route('questions.show', $activity->subject_id) }}">
                                        {{ $activity->properties['question']['title'] }}
                                    </a>
                                </div>
                            </div>
                        </div>
                    </li>
                @elseif($activity->properties['event'] === 'article.zan')
                    <li class="list-group-item p-2">
                        <div class="media">
                            <a href="{{ route('users.show', $activity->user_id) }}">
                                <img src="{{ $activity->properties['user']['avatar'] }}"
                                     class="mr-2 avatar-38"
                                     alt="{{ $activity->properties['user']['name'] }}"
                                     title="{{ $activity->properties['user']['name'] }}">
                            </a>
                            <div class="media-body">
                                <div class="d-flex justify-content-between">
                                    <span class="font-weight-bold">{{ Str::limit($activity->properties['user']['name'], 10) }}</span>
                                    <span style="font-size: 12px;">{{ $activity->created_at->diffForHumans() }}</span>
                                </div>
                                <div style="font-size:12px">
                                    <span>{{ $activity->description }}</span>
                                    <figure class="figure">
                                        @if(isset($activity->properties['article']['pic']))
                                            <a href="{{ route('articles.show', $activity->subject_id) }}">
                                                <img src="{{ $activity->properties['article']['pic'] }}"
                                                     class="figure-img img-fluid rounded"
                                                     alt="{{ $activity->properties['article']['title'] }}"
                                                     title="{{ $activity->properties['article']['title'] }}">
                                            </a>
                                        @endif
                                        <figcaption class="figure-caption">
                                            <a href="{{ route('articles.show', $activity->subject_id) }}">
                                                {{ $activity->properties['article']['title'] }}
                                            </a>
                                        </figcaption>
                                    </figure>
                                </div>
                            </div>
                        </div>
                    </li>
                @endif

            @endforeach
        </ul>
    </div>
</div>