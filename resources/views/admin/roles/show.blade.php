@php ($functionTitle = 'Role Information')

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
                        <label for="name" class="col-sm-2 control-label">Name</label>
                        <div class="col-sm-6">
                            <p class="text-input">{{ $role->name }}</p>
                        </div>
                    </div>
                    <div class="form-group">
                        <label for="email" class="col-sm-2 control-label">Slug</label>
                        <div class="col-sm-6">
                            <p class="text-input">{{ $role->slug }}</p>
                        </div>
                    </div>
                    @foreach($permissions->groupBy('prefix') as $prefix => $permissionGroup)
                        <div class="form-group">
                            <label class="col-sm-2 control-label">
                                @if($loop->first)
                                    Permissions
                                @endif
                            </label>
                            <div class="col-sm-10">
                                <div class="checkbox checkbox-inline" style="padding-left: 0">
                                    <label style="padding-left: 0; width: 120px;"><strong>{{ $prefix }}</strong></label>
                                </div>
                                @foreach($permissionGroup as $permission)
                                    @if ($role->permissions->contains($permission))
                                        <div class="checkbox checkbox-inline">
                                            <label>{{ $permission->slug }}</label>
                                        </div>
                                    @endif
                                @endforeach
                            </div>
                        </div>
                    @endforeach
                </div>
                <!-- /.box-body -->

                <div class="box-footer">
                    <a type="button" class="btn btn-primary" href="{{ route('admin.roles.edit', $role->id) }}">Edit</a>
                    <a type="button" class="btn btn-default" href="{{ route('admin.roles.index') }}">Back to List</a>
                </div>
            </div>
            <!-- /.box -->
        </div>
    </div>
@stop