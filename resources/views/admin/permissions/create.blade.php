@php ($functionTitle = '添加新权限')

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
            <form method="post" action="{{ route('admin.permissions.store') }}" class="form-horizontal">
                <div class="box box-primary">
                    <div class="box-header with-border">
                        <h3 class="box-title">{{ $functionTitle }}</h3>
                    </div>

                    <!-- /.box-header -->
                    {{ csrf_field() }}
                    <div class="box-body">
                        <div class="form-group">
                            <label for="prefix" class="col-sm-2 control-label">分组</label>
                            <div class="col-sm-6">
                                <input type="text" class="form-control" name="prefix" id="prefix" placeholder="输入分组" autocomplete="off">
                            </div>
                        </div>
                        <div class="form-group">
                            <label for="name" class="col-sm-2 control-label">权限标识符</label>
                            <div class="col-sm-6">
                                <input type="text" class="form-control" name="name" id="name" placeholder="输入权限标识符" autocomplete="off">
                            </div>
                        </div>
                        <div class="form-group">
                            <label for="slug" class="col-sm-2 control-label">权限名</label>
                            <div class="col-sm-6">
                                <input type="text" class="form-control" name="slug" id="slug" placeholder="输入权限名" autocomplete="off">
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
