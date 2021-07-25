@php ($functionTitle = '个人信息编辑')

@extends('layouts.page')

@section('title', $functionTitle . " - " . config('adminlte.title'))

@section('content')
    @include('shared.errors')
    <div class="row">
        <div class="col-xs-12">
            <form method="post" action="{{ route('profile.update') }}" class="form-horizontal">
                <div class="box box-primary">
                    <div class="box-header with-border">
                        <h3 class="box-title">{{ $functionTitle }}</h3>
                    </div>

                    <!-- /.box-header -->
                    {{ method_field('PATCH') }}
                    {{ csrf_field() }}
                    <div class="box-body">
                        <div class="form-group">
                            <label for="nick_name" class="col-sm-2 control-label">名称</label>
                            <div class="col-sm-6">
                                <input type="text" disabled class="form-control" name="name" id="name" value="{{ $user->name }}" placeholder="输入昵称" autocomplete="off">
                            </div>
                        </div>
                        <div class="form-group">
                            <label for="email" class="col-sm-2 control-label">用户名</label>
                            <div class="col-sm-6">
                                <input type="text" class="form-control" name="email" id="email" value="{{ $user->email }}" placeholder="输入用户名" autocomplete="off">
                            </div>
                        </div>
                        <div class="form-group">
                            <label for="password" class="col-sm-2 control-label">密码</label>
                            <div class="col-sm-6">
                                <input type="password" name="password" id="password" class="form-control" value="{{ old('password') }}">
                            </div>
                        </div>

                        <div class="form-group">
                            <label for="password_confirmation" class="col-sm-2 control-label">确认密码</label>
                            <div class="col-sm-6">
                                <input type="password" name="password_confirmation" id="password_confirmation" class="form-control" value="{{ old('password_confirmation') }}">
                            </div>
                        </div>
                    </div>
                    <!-- /.box-body -->

                    <div class="box-footer">
                        <button type="submit" class="btn btn-primary">保存</button>
                        <a class="btn btn-default" href="{{ URL::previous() }}">返回</a>
                    </div>
                </div>
                <!-- /.box -->
            </form>
        </div>
    </div>
@stop
