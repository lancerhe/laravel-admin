@php ($functionTitle = 'Users')

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
                </div>
                <!-- /.box-header -->
                <div class="box-body table-responsive no-padding">
                    <table class="table table-bordered table-hover">
                        <tbody>
                        <tr>
                            <th width="5%">ID</th>
                            <th width="25%">Name</th>
                            <th width="30%">E-Mail</th>
                            <th width="15%">Created At</th>
                            <th width="15%">Updated At</th>
                            <th width="10%">Operation</th>
                        </tr>
                        @foreach ($users as $user)
                            <tr>
                                <td>{{ $user->id }}</td>
                                <td>{{ $user->name }}</td>
                                <td>{{ $user->email }}</td>
                                <td>{{ $user->created_at->format('Y-m-d H:i:s') }}</td>
                                <td>{{ $user->updated_at->format('Y-m-d H:i:s') }}</td>
                                <td>
                                    <a class="btn bg-navy btn-xs" href="{{ route('admin.users.edit', $user->id )}}">Edit</a>
                                    <a class="btn bg-olive btn-xs" href="{{ route('admin.users.show', $user->id )}}">View</a>
                                </td>
                            </tr>
                        @endforeach
                        </tbody>
                    </table>
                </div>
                <!-- /.box-body -->
                <div class="box-footer clearfix">
                    {{ $users->links('components.pagination') }}
                </div>
            </div>
            <!-- /.box -->
        </div>
    </div>
@stop