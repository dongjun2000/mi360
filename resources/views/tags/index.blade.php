@extends('layouts.app')

@section('script')
    <script>
        $(document).ready(function () {
            $('[data-toggle="popover"]').popover();
        });
    </script>
@stop

@section('content')
    <div class="container tags">
        <div class="row tag-list">
            @foreach($categories as $category)
                <div class="col-md-3">
                    <div class="title">{{ $category->name }}</div>
                    <ul class="list-inline">
                        @foreach($category->tags as $tag)
                            <li class="list-inline-item">
                                <a href="{{ route('tags.show', ['name' => $tag->name]) }}">
                                    @if(!empty($tag->icon))
                                        <img class="icon" src="{{ asset($tag->icon) }}" alt="{{ $tag->name }}"
                                             title="{{ $tag->name }}">
                                    @endif
                                    {{ $tag->name }}
                                </a>
                            </li>
                        @endforeach
                    </ul>
                </div>
            @endforeach
        </div>
    </div>
@stop