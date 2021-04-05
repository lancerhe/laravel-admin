@php ($functionTitle = 'New Role')

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
            <form method="post" action="{{ route('admin.roles.store') }}" class="form-horizontal">
                <div class="box box-primary">
                    <div class="box-header with-border">
                        <h3 class="box-title">{{ $functionTitle }}</h3>
                    </div>

                    <!-- /.box-header -->
                    {{ csrf_field() }}
                    <div class="box-body">
                        <div class="form-group">
                            <label for="name" class="col-sm-2 control-label">Name</label>
                            <div class="col-sm-6">
                                <input type="text" class="form-control" name="name" id="name" placeholder="Enter name" autocomplete="off">
                            </div>
                        </div>
                        <div class="form-group">
                            <label for="slug" class="col-sm-2 control-label">Slug</label>
                            <div class="col-sm-6">
                                <input type="text" class="form-control" name="slug" id="slug" placeholder="Enter slug" autocomplete="off">
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
                                                <input type="checkbox" name="permission_ids[]" value="{{ $permission->id }}">
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
