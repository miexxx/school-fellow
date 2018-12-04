@extends('admin::layouts.main')

@section('content')

    @include('admin::search.system-logs')

    <div class="row">
        <div class="col-md-12">
            <div class="box box-info">
                <div class="box-header with-border">
                    <h3 class="box-title">操作日志</h3>
                    @include('admin::widgets.filter-btn-group', ['resetUrl' => route('admin::logs.index')])
                </div>

                <div class="box-body table-responsive no-padding">
                    <table class="table">
                        <tbody>
                        <tr>
                            <th>ID</th>
                            <th>用户</th>
                            <th>Method</th>
                            <th>路径</th>
                            <th>Ip</th>
                            <th>输入</th>
                            <th>创建时间</th>
                        </tr>
                        @inject('logPresenter', 'Tanmo\Admin\Presenters\LogPresenter')
                        @foreach($logs as $log)
                            <tr>
                                <td>{{ $log->id }}</td>
                                <td>{{ $log->user->name }}</td>
                                <td>{!! $logPresenter->getMethod($log->method) !!}</td>
                                <td><span class="label label-info">{{ $log->path }}</span></td>
                                <td><span class="label label-primary">{{ $log->ip }}</span></td>
                                <td><code>{!! $logPresenter->getInput($log->input) !!}</code></td>
                                <td>{{ $log->created_at }}</td>
                            </tr>
                        @endforeach
                        </tbody>
                    </table>
                </div>
                <div class="box-footer">
                    {{ $logs->links('admin::widgets.pagination') }}
                </div>
            </div>
        </div>
    </div>
@endsection