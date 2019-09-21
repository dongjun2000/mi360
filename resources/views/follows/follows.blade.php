@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row">
            <div class="col-md-2" style="position: sticky; top: 15px;">
                @include('includes.user_nav')
            </div>
            <div class="col-md-7">
                <div class="card">
                    <div class="card-body">
                        <h5 class="mb-2">
                            <i class="fa fa-gittip fa-2x"></i>
                            {{ $user->name }} 关注用户 ({{ $users->total() }})
                        </h5>
                        <ul class="list-group list-group-flush mt-3">
                            @include('includes.fans')
                        </ul>
                    </div>
                    <div class="card-footer d-flex justify-content-center">
                        {{ $users->links() }}
                    </div>
                </div>
            </div>

            <div class="col-md-3">
                @include('includes.user')
            </div>
        </div>
    </div>
@stop