@php ($functionTitle = '用户详情')

@extends('layouts.page')

@section('title', $functionTitle . " - " . config('adminlte.title'))

@section('content_header')
    @component('components.breadcrumb')
        {{ $functionTitle }}
    @endcomponent
@stop

@section('content')
    @include('shared.flash')
    <div class="row">
        <div class="col-xs-12">
            <div class="box box-primary">
                <div class="box-header with-border">
                    <h3 class="box-title">{{ $functionTitle }}</h3>
                </div>

                <!-- /.box-header -->
                <div class="box-body form-horizontal">
                    <div class="form-group">
                        <label for="name" class="col-sm-2 control-label">昵称</label>
                        <div class="col-sm-6">
                            <p class="text-input">{{ $user->name }}</p>
                        </div>
                    </div>
                    <div class="form-group">
                        <label for="email" class="col-sm-2 control-label">用户名</label>
                        <div class="col-sm-6">
                            <p class="text-input">{{ $user->email }}</p>
                        </div>
                    </div>
                    <div class="form-group">
                        <label for="slug" class="col-sm-2 control-label">角色</label>
                        <div class="col-sm-10">
                            @foreach($user->roles as $role)
                                <div class="checkbox checkbox-inline" style="padding-left: 0">
                                    <label @if($loop->first) style="padding-left: 0" @endif>{{ $role->slug }}</label>
                                </div>
                            @endforeach
                        </div>
                    </div>
                    @foreach($permissions->groupBy('prefix') as $prefix => $permissionGroup)
                        <div class="form-group">
                            <label class="col-sm-2 control-label">
                                @if($loop->first)
                                    权限
                                @endif
                            </label>
                            <div class="col-sm-10">
                                <div class="checkbox checkbox-inline" style="padding-left: 0">
                                    <label style="padding-left: 0; width: 120px;"><strong>{{ $prefix }}</strong></label>
                                </div>
                                @foreach($permissionGroup as $permission)
                                    @if ($user->permissions->contains($permission))
                                        <div class="checkbox checkbox-inline">
                                            <label>{{ $permission->slug }}</label>
                                        </div>
                                    @else
                                        @foreach($user->roles as $role)
                                            @if ($role->permissions->contains($permission))
                                                <div class="checkbox checkbox-inline">
                                                    <label>{{ $permission->slug }}</label>
                                                </div>
                                                @php ($functionTitle = '添加新权限')

                                            @endif
                                        @endforeach
                                    @endif
                                @endforeach
                            </div>
                        </div>
                    @endforeach
                </div>
                <!-- /.box-body -->

                <div class="box-footer">
                    <a type="button" class="btn btn-primary" href="{{ route('admin.users.edit', $user->id) }}">编辑</a>
                    <a type="button" class="btn btn-default" href="{{ route('admin.users.index') }}">返回列表</a>
                </div>
            </div>
            <!-- /.box -->
        </div>
    </div>
@stop
