@php ($functionTitle = 'User Edit')

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
            <form method="post" action="{{ route('admin.users.update', $user->id) }}" class="form-horizontal">
                <div class="box box-primary">
                    <div class="box-header with-border">
                        <h3 class="box-title">{{ $functionTitle }}</h3>
                    </div>

                    <!-- /.box-header -->
                    {{ method_field('PATCH') }}
                    {{ csrf_field() }}
                    <div class="box-body">
                        <div class="form-group">
                            <label for="name" class="col-sm-2 control-label">Name</label>
                            <div class="col-sm-6">
                                <input type="text" class="form-control" name="name" id="name" value="{{ $user->name }}" placeholder="Enter name" autocomplete="off">
                            </div>
                        </div>
                        <div class="form-group">
                            <label for="email" class="col-sm-2 control-label">E-Mail</label>
                            <div class="col-sm-6">
                                <input type="text" class="form-control" name="email" id="email" value="{{ $user->email }}" placeholder="Enter email" autocomplete="off">
                            </div>
                        </div>
                        <div class="form-group">
                            <label for="password" class="col-sm-2 control-label">Password</label>
                            <div class="col-sm-6">
                                <input type="password" name="password" id="password" class="form-control" value="{{ old('password') }}">
                            </div>
                        </div>

                        <div class="form-group">
                            <label for="password_confirmation" class="col-sm-2 control-label">Confirm Password</label>
                            <div class="col-sm-6">
                                <input type="password" name="password_confirmation" id="password_confirmation" class="form-control" value="{{ old('password_confirmation') }}">
                            </div>
                        </div>
                        <div class="form-group">
                            <label for="slug" class="col-sm-2 control-label">Roles</label>
                            <div class="col-sm-10">
                                @foreach($roles as $role)
                                    <div class="checkbox checkbox-inline" style="padding-left: 0">
                                        <label>
                                            <input type="checkbox" name="role_ids[]" value="{{ $role->id }}" {{ $user->roles->contains($role) ? 'checked' : '' }} >
                                            {{ $role->slug }}
                                        </label>
                                    </div>
                                @endforeach
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
                                        <div class="checkbox checkbox-inline">
                                            <label>
                                                <input type="checkbox" name="permission_ids[]" value="{{ $permission->id }}" {{ $user->permissions->contains($permission) ? 'checked' : '' }}>
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
                        <button type="submit" class="btn btn-primary">Submit</button>
                        <a class="btn btn-default" href="{{ URL::previous() }}">Back</a>
                    </div>
                </div>
                <!-- /.box -->
            </form>
        </div>
    </div>
@stop