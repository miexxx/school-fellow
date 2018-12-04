@extends('admin::layouts.main')

@section('content')

    @include('admin::search.system-users')

    <div class="row">
        <div class="col-md-12">
            <div class="box box-info">
                <div class="box-header with-border">
                    <h3 class="box-title">用户列表</h3>

                    <div class="btn-group pull-right">
                        <a href="{{ route('admin::users.create') }}" class="btn btn-sm btn-success">
                            <i class="fa fa-save"></i>&nbsp;&nbsp;新增
                        </a>
                    </div>

                    @include('admin::widgets.filter-btn-group', ['resetUrl' => route('admin::users.index')])
                </div>

                <div class="box-body table-responsive no-padding">
                    <table class="table">
                        <tbody>
                        <tr>
                            <th>ID</th>
                            <th>头像</th>
                            <th>用户名</th>
                            <th>名称</th>
                            <th>角色</th>
                            <th>状态</th>
                            <th>创建时间</th>
                            <th>更新时间</th>
                            <th>操作</th>
                        </tr>
                        @inject('userPresenter', 'Tanmo\Admin\Presenters\UserPresenter')
                        @foreach($users as $user)
                            <tr>
                                <td>{{ $user->id }}</td>
                                <td><img src="{{ $user->avatar }}" class="img-circle" alt="avatar" width="50" height="50"></td>
                                <td>{{ $user->username }}</td>
                                <td>{{ $user->name }}</td>
                                <td>{!! $userPresenter->getRolesLabel($user->roles->pluck('name')) !!}</td>
                                <td>{!! $userPresenter->getStateLabel($user->state) !!}</td>
                                <td>{{ $user->created_at }}</td>
                                <td>{{ $user->updated_at }}</td>
                                <td>
                                    @if(Admin::user()->can('update', $user))
                                        <a href="{{ route('admin::users.edit', $user->id) }}">
                                            <i class="fa fa-edit"></i>
                                        </a>
                                    @endif
                                    @if(Admin::user()->can('destroy', $user))
                                        <a href="javascript:void(0);" data-id="{{ $user->id }}" class="grid-row-delete">
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
                    {{ $users->links('admin::widgets.pagination') }}
                </div>
            </div>
        </div>
    </div>
@endsection

@section('script')
    @include('admin::js.grid-row-delete', ['url' => route('admin::users.index')])
@endsection