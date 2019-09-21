@if($questions->total() > 0)
    @foreach($questions as $question)
        <li class="list-group-item d-flex justify-content-around">
            <div class="col-3">
                <ul class="list-inline d-flex justify-content-between">
                    <li class="list-inline-item d-flex flex-column align-items-center">
                        <span>{{ $question->follow }}</span>
                        <span>关注</span>
                    </li>
                    @switch($question->status)
                        @case(0)
                        <li class="list-inline-item d-flex flex-column align-items-center text-danger">
                            <span>{{ $question->answer }}</span>
                            <span>回答</span>
                        </li>
                        @break
                        @case(1)
                        <li class="list-inline-item d-flex flex-column align-items-center text-primary">
                            <span>{{ $question->answer }}</span>
                            <span>回答</span>
                        </li>
                        @break
                        @case(2)
                        <li class="list-inline-item d-flex flex-column align-items-center text-success">
                            <span>{{ $question->answer }}</span>
                            <span>解决</span>
                        </li>
                        @break
                    @endswitch

                    <li class="list-inline-item d-flex flex-column align-items-center">
                        <span>{{ $question->read }}</span>
                        <span>浏览</span>
                    </li>
                </ul>
            </div>
            <div class="col-9">
                <ul class="list-inline" style="font-size:12px">
                    <li class="list-inline-item">
                        <a href="{{ route('users.show', $question->laster_answer_user['id']) }}">{{ $question->laster_answer_user['name'] }}</a>
                    </li>
                    <li class="list-inline-item">
                        <a href="">{{ Carbon\Carbon::parse($question->laster_answer_user['created_at'])->diffForHumans() }}
                            @if($question->laster_answer_user['type'])
                                回答
                            @else
                                创建
                            @endif

                        </a>
                    </li>
                </ul>
                <h2 class="title float-left mr-3 mt-1">
                    <a href="{{ route('questions.show', $question) }}">{{ $question->title }}</a>
                </h2>
                {{--标签--}}
                @if(count($question->tags) > 0)
                    <ul class="list-inline float-left">
                        @foreach($question->tags as $tag)
                            <li class="list-inline-item">
                                <a class="tags"
                                   href="{{ route('tags.show', $tag->name) }}">{{ $tag->name }}</a>
                            </li>
                        @endforeach
                    </ul>
                @endif
            </div>
        </li>
    @endforeach
@else
    <li class="list-group-item d-flex justify-content-around">暂无提问！</li>
@endif