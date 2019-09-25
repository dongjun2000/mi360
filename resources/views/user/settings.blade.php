@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row">
            <div class="col-md-3">
                <div class="card">
                    <div class="card-body p-0">
                        <div class="list-group list-group-flush">
                            <a href="{{ route('users.settings') }}"
                               class="list-group-item list-group-item-action text-center">
                                <i class="fa fa-user"></i>
                                个人信息
                            </a>
                            <a href="" class="list-group-item list-group-item-action text-center">
                                <i class="fa fa-image"></i>
                                修改头像
                            </a>
                            <a href="" class="list-group-item list-group-item-action text-center">
                                <i class="fa fa-bell"></i>
                                消息通知
                            </a>
                            <a href="" class="list-group-item list-group-item-action text-center">
                                <i class="fa fa-id-card-o"></i>
                                账号绑定
                            </a>
                            <a href="" class="list-group-item list-group-item-action text-center">
                                <i class="fa fa-mobile-phone"></i>
                                账号手机
                            </a>
                            <a href="" class="list-group-item list-group-item-action text-center">
                                <i class="fa fa-lock"></i>
                                修改密码
                            </a>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-md-9">
                <form action="{{ route('users.settings') }}" method="post" enctype="multipart/form-data">
                    @csrf
                    <div class="card">
                        <div class="card-header">
                            <h5>
                                <i class="fa fa-edit fa-2x"></i>
                                修改资料
                            </h5>
                        </div>
                        <div class="card-body">
                            <div class="form-group">
                                <label for="name">用户名：</label>
                                <input type="text"
                                       class="form-control" name="name" id="name" value="{{ $user->name }}">
                                @error('name')
                                <small id="helpId" class="form-text text-danger">{{ $message }}</small>
                                @else
                                    <small class="form-text text-muted">用户名只能修改两次，请谨慎操作</small>
                                    @enderror
                            </div>
                            <div class="form-group">
                                <label for="gender">性别：</label>
                                <select class="form-control" name="gender" id="gender">
                                    <option value="1" @if($user->gender) selected @endif>男</option>
                                    <option value="0" @if(!$user->gender) selected @endif>女</option>
                                </select>
                                @error('gender')
                                <small class="form-text text-danger">{{ $message }}</small>
                                @enderror
                            </div>
                            <div class="form-group">
                                <label for="github">GitHub Name：</label>
                                <input type="text"
                                       class="form-control" name="github" id="github" value="{{ $user->github }}">
                                @error('github')
                                <small class="form-text text-danger">{{ $message }}</small>
                                @else
                                    <small class="form-text text-muted">请跟 GitHub 上保持一致</small>
                                    @enderror
                            </div>
                            <div class="form-group">
                                <label for="realname">真实姓名：</label>
                                <input type="text"
                                       class="form-control" name="realname" id="realname" value="{{ $user->realname }}">
                                @error('realname')
                                <small class="form-text text-danger">{{ $message }}</small>
                                @else
                                    <small class="form-text text-muted">如：梦小航</small>
                                    @enderror
                            </div>
                            <div class="form-group">
                                <label for="city">城市：</label>
                                <input type="text"
                                       class="form-control" name="city" id="city" value="{{ $user->city }}">
                                @error('city')
                                <small class="form-text text-danger">{{ $message }}</small>
                                @else
                                    <small class="form-text text-muted">如：北京、广州</small>
                                    @enderror
                            </div>
                            <div class="form-group">
                                <label for="company">公司或组织名称：</label>
                                <input type="text"
                                       class="form-control" name="company" id="company" value="{{ $user->company }}">
                                @error('company')
                                <small class="form-text text-danger">{{ $message }}</small>
                                @else
                                    <small class="form-text text-muted">如：阿里巴巴</small>
                                    @enderror
                            </div>
                            <div class="form-group">
                                <label for="position">职位：</label>
                                <input type="text"
                                       class="form-control" name="position" id="position" value="{{ $user->position }}">
                                @error('position')
                                <small class="form-text text-danger">{{ $message }}</small>
                                @else
                                    <small class="form-text text-muted">如：技术小组长</small>
                                    @enderror
                            </div>
                            <div class="form-group">
                                <label for="website">个人网站：</label>
                                <input type="text"
                                       class="form-control" name="website" id="website" value="{{ $user->website }}"
                                       placeholder="http://">
                                @error('website')
                                <small class="form-text text-danger">{{ $message }}</small>
                                @else
                                    <small class="form-text text-muted">如：https://www.mi360.cn</small>
                                    @enderror
                            </div>
                            <div class="form-group">
                                <label for="weixin_qrcode">微信账号二维码：</label>
                                <input type="file"
                                       class="form-control" name="weixin_qrcode" id="weixin_qrcode"
                                       value="{{ $user->weixin_qrcode }}">
                                @error('weixin_qrcode')
                                <small class="form-text text-danger">{{ $message }}</small>
                                @else
                                    <small class="form-text text-muted">你的微信个人账号，或者订阅号</small>
                                    @enderror
                                    @if($user->weixin_qrcode)
                                        <img src="{{ $user->weixin_qrcode }}" class="rounded w-25">
                                    @endif
                            </div>
                            <div class="form-group">
                                <label for="pay_qrcode">支付二维码：</label>
                                <input type="file"
                                       class="form-control" name="pay_qrcode" id="pay_qrcode"
                                       value="{{ $user->pay_qrcode }}">
                                @error('pay_qrcode')
                                <small class="form-text text-danger">{{ $message }}</small>
                                @else
                                    <small class="form-text text-muted">文章打赏时使用，微信支付二维码</small>
                                    @enderror
                                    @if($user->pay_qrcode)
                                        <img src="{{ $user->pay_qrcode }}" class="rounded w-25">
                                    @endif
                            </div>
                            <div class="form-group">
                                <label for="intro">个人简介：</label>
                                <textarea type="text"
                                          class="form-control" name="intro" id="intro" rows="3"
                                          style="resize: none">{{ $user->intro }}</textarea>
                                @error('intro')
                                <small class="form-text text-danger">{{ $message }}</small>
                                @else
                                    <small class="form-text text-muted">请一句话介绍你自己</small>
                                    @enderror
                            </div>

                        </div>
                        <div class="card-footer">
                            <button type="submit" class="btn btn-success">应用修改</button>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
@stop