@php ($functionTitle = '编辑角色')

@extends('layouts.page')

@section('title', $functionTitle . " - " . config('adminlte.title'))

@section('content_header')
    @component('components.breadcrumb')
        {{ $functionTitle }}
    @endcomponent
@stop

@section('content')
    @include('shared.errors')
    <div class="row">
        <div class="col-xs-12">
            <form method="post" action="{{ route('admin.roles.update', $role->id) }}" class="form-horizontal">
                <div class="box box-primary">
                    <div class="box-header with-border">
                        <h3 class="box-title">{{ $functionTitle }}</h3>
                    </div>

                    <!-- /.box-header -->
                    {{ method_field('PATCH') }}
                    {{ csrf_field() }}
                    <div class="box-body">
                        <div class="form-group">
                            <label for="name" class="col-sm-2 control-label">角色标识符</label>
                            <div class="col-sm-6">
                                <input type="text" class="form-control" name="name" id="name" value="{{ $role->name }}" placeholder="输入角色名" autocomplete="off">
                            </div>
                        </div>
                        <div class="form-group">
                            <label for="slug" class="col-sm-2 control-label">角色名</label>
                            <div class="col-sm-6">
                                <input type="text" class="form-control" name="slug" id="slug" value="{{ $role->slug }}" placeholder="输入角色标识符" autocomplete="off">
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
                                        <div class="checkbox checkbox-inline">
                                            <label>
                                                <input type="checkbox" name="permission_ids[]" value="{{ $permission->id }}" {{ $role->permissions->contains($permission) ? 'checked' : '' }} >
                                                {{ $permission->slug }}
                                            </label>
                                        </div>
                                    @endforeach
                                </div>
                            </div>
                        @endforeach
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
