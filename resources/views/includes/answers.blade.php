@if($answers->count() > 0)
    @foreach($answers as $answer)
        <li class="list-group-item">
            <div class="media">
                <a href="{{ route('users.show', $answer->user) }}">
                    <img src="{{ $answer->user->avatar }}"
                         class="align-self-start mr-3 avatar-48"
                         alt="{{ $answer->user->name }}">
                </a>
                <div class="media-body">
                    <div class="mt-0">
                        <a href="{{ route('users.show', $answer->user) }}"
                           class="font-weight-bold mr-2">{{ $answer->user->name }}</a>
                        <span class="font">{{ $answer->created_at }}
                            回答了： <a href="{{ route('questions.show', $answer->question) }}" title="{{ $answer->question->title }}">{{ $answer->question->title }}</a></span>
                    </div>
                    <div class="mt-2">
                        {!! $answer->content !!}
                    </div>
                    <div class="mt-2 d-inline-flex">
                        @can('update', $answer)
                            <a href="{{ route('answers.edit', $answer) }}"
                               class="btn btn-success btn-sm mr-2">编辑</a>
                        @endcan
                        @can('delete', $answer)
                            <form action="{{ route('answers.destroy', $answer) }}"
                                  method="post" onsubmit="return confirm('真的要删除该评论？')">
                                @csrf @method('DELETE')
                                <button class="btn btn-danger btn-sm">删除</button>
                            </form>
                        @endcan
                    </div>
                </div>
                @if($answer->accept)
                    <div class="align-self-center mr-3 ml-5 text-success d-flex flex-column align-items-center">
                        <i class="fa fa-check-circle accepted-check-icon"
                           style="font-size: 24px"></i>
                        <span>已采纳</span>
                    </div>
                @endif
            </div>
        </li>
    @endforeach
@else
    <li class="list-group-item">暂无回答！</li>
@endif