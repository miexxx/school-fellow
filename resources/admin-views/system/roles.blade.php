@extends('admin::layouts.main')

@section('content')

    @include('admin::search.system-roles')

    <div class="row">
        <div class="col-md-12">
            <div class="box box-info">
                <div class="box-header with-border">
                    <h3 class="box-title">角色列表</h3>

                    <div class="btn-group pull-right">
                        <a href="{{ route('admin::roles.create') }}" class="btn btn-sm btn-success">
                            <i class="fa fa-save"></i>&nbsp;&nbsp;新增
                        </a>
                    </div>

                    @include('admin::widgets.filter-btn-group', ['resetUrl' => route('admin::roles.index')])
                </div>

                <div class="box-body table-responsive no-padding">
                    <table class="table">
                        <tbody>
                        <tr>
                            <th>ID</th>
                            <th>标识</th>
                            <th>名称</th>
                            <th>创建时间</th>
                            <th>更新时间</th>
                            <th>操作</th>
                        </tr>
                        @foreach($roles as $role)
                            <tr>
                                <td>{{ $role->id }}</td>
                                <td>{{ $role->slug }}</td>
                                <td><span class="label label-primary">{{ $role->name }}</span></td>
                                <td>{{ $role->created_at }}</td>
                                <td>{{ $role->updated_at }}</td>
                                <td>
                                    @if(Admin::user()->can('update', $role))
                                        <a href="{{ route('admin::roles.edit', $role->id) }}">
                                            <i class="fa fa-edit"></i>
                                        </a>
                                    @endif
                                    @if(Admin::user()->can('destroy', $role))
                                        <a href="javascript:void(0);" data-id="{{ $role->id }}" class="grid-row-delete">
                                            <i class="fa fa-trash"></i>
                                        </a>
                                    @endif
                                </td>
                            </tr>
                        @endforeach
                        </tbody>
                    </table>
                </div>
                <div class="box-footer">
                    {{ $roles->links('admin::widgets.pagination') }}
                </div>
            </div>
        </div>
    </div>
@endsection

@section('script')
    @include('admin::js.grid-row-delete', ['url' => route('admin::roles.index')])
@endsection