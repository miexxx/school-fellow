@extends('admin::layouts.main')

@section('content')

    @include('admin::search.system-userSchools')

    <div class="row">
        <div class="col-md-12">
            <div class="box box-info">
                <div class="box-header with-border">
                    <h3 class="box-title">校友认证申请列表</h3>

                    @include('admin::widgets.filter-btn-group', ['resetUrl' => route('admin::userSchools.index')])
                </div>

                <div class="box-body table-responsive no-padding">
                    <table class="table">
                        <tbody>
                        <tr>
                            <th>头像</th>
                            <th>微信名</th>
                            <th>真实名字</th>
                            <th>入学年月</th>
                            <th>专业名称</th>
                            <th>学校名称</th>
                            <th>申请时间</th>
                            <th>联系方式</th>
                            <th>审核</th>
                        </tr>
                        @foreach($userSchools as $userSchool)
                            <tr>
                                <td><img src="{{ $userSchool->user->avatarurl }}" class="img-circle" alt="avatar" width="50" height="50"></td>
                                <td><span class="label label-success">{{ $userSchool->user->nickname }}</span></td>
                                <td><span class="label label-warning">{{ $userSchool->name }}</span></td>
                                <td><span class="label label-info">{{$userSchool->entrance_time}}</span></td>
                                {{--<td><span class="label label-default">V+ :</span><span class="label label-warning">{{$user->wechat}}</span></td>--}}
                                {{--<td><span class="label label-default">Mobile :</span><span class="label label-info">{{$user->mobile}}</span></td>--}}
                                <td><span class="label label-info">{{$userSchool->major}}</span></td>
                                <td><span class="label label-info">{{$userSchool->school_name}}</span></td>
                                <td>{{ $userSchool->created_at }}</td>
                                <td><span class="label label-danger">{{ $userSchool->user->mobile }}</span></td>
                                <td>
                                    @if($userSchool->status =="未审核")
                                        <a href="javascript:void(0);" data-id="{{ $userSchool->id }}" class="grid-row-delete btn btn-danger btn-sm" role="button">
                                            点击通过
                                        </a>
                                    @endif
                                </td>
                            </tr>
                        @endforeach
                        </tbody>
                    </table>
                </div>
                <div class="box-footer">
                    {{ $userSchools->links('admin::widgets.pagination') }}
                </div>
            </div>
        </div>
    </div>
@endsection

@section('script')
    @include('admin::js.grid-row-delete', ['url' => route('admin::userSchools.index')])
@endsection