@extends('admin::layouts.main')

@section('content')

    @include('admin::search.system-members')

    <div class="row">
        <div class="col-md-12">
            <div class="box box-info">
                <div class="box-header with-border">
                    <h3 class="box-title">会员列表</h3>

                    @include('admin::widgets.filter-btn-group', ['resetUrl' => route('admin::members.index')])
                </div>

                <div class="box-body table-responsive no-padding">
                    <table class="table">
                        <tbody>
                        <tr>
                            <th>头像</th>
                            <th>用户名</th>
                            <th>性别</th>
                            <th>所在地</th>
                            <th>微信号</th>
                            <th>手机号</th>
                            <th>OpenId</th>
                            <th>创建时间</th>
                            <th>更新时间</th>
                            <th>操作</th>
                        </tr>
                        @foreach($users as $user)
                            <tr>
                                <td><img src="{{ $user->avatarurl }}" class="img-circle" alt="avatar" width="50" height="50"></td>
                                <td><span class="label label-success">{{ $user->nickname }}</span></td>
                                <td><span class="label label-primary">{{ $user->gender }}</span></td>
                                <td><span class="label label-danger">{{$user->city}}</span></td>
                                <td><span class="label label-default">V+ :</span><span class="label label-warning">{{$user->wechat}}</span></td>
                                <td><span class="label label-default">Mobile :</span><span class="label label-info">{{$user->mobile}}</span></td>
                                <td><span class="label label-info">{{$user->openId->open_id}}</span></td>
                                <td>{{ $user->created_at }}</td>
                                <td>{{ $user->updated_at }}</td>
                                <td>
                                        <a href="javascript:void(0);" data-id="{{ $user->id }}" class="grid-row-delete btn btn-danger btn-sm" role="button">
                                            <i class="fa fa-trash">删除</i>
                                        </a>
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
    @include('admin::js.grid-row-delete', ['url' => route('admin::members.index')])
@endsection