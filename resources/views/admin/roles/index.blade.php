@php ($functionTitle = 'Roles')

@extends('layouts.page')

@section('title', $functionTitle . " - " . config('adminlte.title'))

@section('content_header')
    @component('components.breadcrumb')
        {{ $functionTitle }}
    @endcomponent
@stop

@section('content')
    <div class="row">
        <div class="col-xs-12">
            <div class="box box-primary">
                <div class="box-header">
                    <h3 class="box-title">{{ $functionTitle }}</h3>
                    <div class="box-tools">
                        <form>
                            <div class="input-group input-group-sm" style="width: 50px;">
                                <div class="input-group-btn">
                                    <a class="btn bg-purple btn-xs" href="{{ route('admin.roles.create')}}">Create</a>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
                <!-- /.box-header -->
                <div class="box-body table-responsive no-padding">
                    <table class="table table-bordered table-hover">
                        <tbody>
                        <tr>
                            <th width="5%">ID</th>
                            <th>Name</th>
                            <th>Slug</th>
                            <th width="15%">Created At</th>
                            <th width="15%">Updated At</th>
                            <th width="10%">Operation</th>
                        </tr>
                        @foreach ($roles as $role)
                            <tr>
                                <td>{{ $role->id }}</td>
                                <td>{{ $role->name }}</td>
                                <td>{{ $role->slug }}</td>
                                <td>{{ $role->created_at->format('Y-m-d H:i:s') }}</td>
                                <td>{{ $role->updated_at->format('Y-m-d H:i:s') }}</td>
                                <td>
                                    <a class="btn bg-olive btn-xs" href="{{ route('admin.roles.show', $role->id )}}">View</a>
                                    <a class="btn bg-navy btn-xs" href="{{ route('admin.roles.edit', $role->id )}}">Edit</a>
                                </td>
                            </tr>
                        @endforeach
                        </tbody>
                    </table>
                </div>
                <!-- /.box-body -->
                <div class="box-footer clearfix">
                    {{ $roles->links('components.pagination') }}
                </div>
            </div>
            <!-- /.box -->
        </div>
    </div>
@stop