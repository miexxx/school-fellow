@extends('admin::layouts.main')

@section('content')

    @include('admin::search.system-permissions')

    <div class="row">
        <div class="col-md-12">
            <div class="box box-info">
                <div class="box-header with-border">
                    <h3 class="box-title">权限列表</h3>

                    <div class="pull-right">
                        <a href="{{ route('admin::permissions.import') }}" class="btn btn-sm btn-info">权限导入</a>
                    </div>

                    @include('admin::widgets.filter-btn-group', ['resetUrl' => route('admin::permissions.index')])
                </div>

                <div class="box-body table-responsive no-padding">
                    <table class="table">
                        <tbody>
                        <tr>
                            <th>ID</th>
                            <th>权限名</th>
                            <th>模块</th>
                            <th>Methods</th>
                            <th>Uri</th>
                            <th>创建时间</th>
                            <th>更新时间</th>
                        </tr>
                        @inject('methods', 'Tanmo\Admin\Presenters\MethodPresenter')
                        @foreach($permissions as $permission)
                            <tr>
                                <td>{{ $permission->id }}</td>
                                <td>{{ $permission->name }}</td>
                                <td>{{ $permission->module }}</td>
                                <td>{!! $methods->getMethodsLabel($permission->method) !!}</td>
                                <td><code>{{ $permission->uri }}</code></td>
                                <td>{{ $permission->created_at }}</td>
                                <td>{{ $permission->updated_at }}</td>
                            </tr>
                        @endforeach
                        </tbody>
                    </table>
                </div>
                <div class="box-footer">
                    {{ $permissions->links('admin::widgets.pagination') }}
                </div>
            </div>
        </div>
    </div>
@endsection