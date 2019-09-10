@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">验证邮箱地址</div>

                <div class="card-body">
                    @if (session('resent'))
                        <div class="alert alert-success" role="alert">
                            重置密码的链接已经发送到您的邮箱，请注意查收~
                        </div>
                    @endif

                    如果您没有收到重置密码的邮件, <a href="{{ route('verification.resend') }}">点击这里重新发送</a>.
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
