@php ($functionTitle = 'Permission Information')

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
                        <label for="prefix" class="col-sm-2 control-label">Prefix</label>
                        <div class="col-sm-6">
                            <p class="text-input">{{ $permission->prefix }}</p>
                        </div>
                    </div>
                    <div class="form-group">
                        <label for="name" class="col-sm-2 control-label">Name</label>
                        <div class="col-sm-6">
                            <p class="text-input">{{ $permission->name }}</p>
                        </div>
                    </div>
                    <div class="form-group">
                        <label for="slug" class="col-sm-2 control-label">Slug</label>
                        <div class="col-sm-6">
                            <p class="text-input">{{ $permission->slug }}</p>
                        </div>
                    </div>
                </div>
                <!-- /.box-body -->

                <div class="box-footer">
                    <a type="button" class="btn btn-primary" href="{{ route('admin.permissions.edit', $permission->id) }}">Edit</a>
                    <a type="button" class="btn btn-default" href="{{ route('admin.permissions.index') }}">Back to List</a>
                </div>
            </div>
            <!-- /.box -->
        </div>
    </div>
@stop