@extends('admin::layouts.main')

@section('content')

    @include('admin::search.system-actions')

    <div class="row">
        <div class="col-md-12">
            <div class="box box-info">
                <div class="box-header with-border">
                    <h3 class="box-title">活动申请列表</h3>

                    @include('admin::widgets.filter-btn-group', ['resetUrl' => route('admin::actions.index')])
                </div>

                <div class="box-body table-responsive no-padding">
                    <table class="table">
                        <tbody>
                        <tr>
                            <th>审核人头像</th>
                            <th>审核人微信名</th>
                            <th>活动标题</th>
                            <th>活动级别</th>
                            <th>活动费用</th>
                            <th>活动地址</th>
                            <th>活动报名时间</th>
                            <th>申请时间</th>
                            <th>联系方式</th>
                            <th>状态</th>
                            <th>审核</th>
                        </tr>
                        @foreach($actions as $action)
                            <tr>
                                <td><img src="{{ $action->user->avatarurl }}" class="img-circle" alt="avatar" width="50" height="50"></td>
                                <td><span class="label label-success">{{ $action->user->nickname }}</span></td>
                                <td><span class="label label-warning">{{ $action->title }}</span></td>
                                <td><span class="label label-info">{{$action->type}}</span></td>
                                {{--<td><span class="label label-default">V+ :</span><span class="label label-warning">{{$user->wechat}}</span></td>--}}
                                {{--<td><span class="label label-default">Mobile :</span><span class="label label-info">{{$user->mobile}}</span></td>--}}
                                <td><span class="label label-info">{{$action->pay}}</span></td>
                                <td><span class="label label-info">{{$action->province.$action->city.$action->adr_detail}}</span></td>
                                <td><span class="label label-info">{{$action->begin_time.'---'.$action->over_time}}</span></td>
                                <td>{{ $action->created_at }}</td>
                                <td><span class="label label-default">Mobile :</span><span class="label label-danger">{{ $action->user->mobile }}</span></td>
                                <td>@if($action->status =="未审核")<span class="label label-warning">@else<span class="label label-success">@endif{{ $action->status }}</span></td>
                                <td>
                                    @if($action->status =="未审核")
                                        <a href="javascript:void(0);" data-id="{{ $action->id }}" class="grid-row-success btn btn-info btn-sm" role="button">
                                            同意
                                        </a>
                                        <a href="javascript:void(0);" data-id="{{ $action->id }}" class="grid-row-reject btn btn-danger btn-sm" role="button">
                                            拒接
                                        </a>
                                    @else
                                        <a href="javascript:void(0);" data-id="{{ $action->id }}" class="grid-row-reject btn btn-danger btn-sm" role="button">
                                            拒接
                                        </a>
                                    @endif
                                        <a href="javascript:void(0);" data-id="{{ $action->id }}" class="see-content btn btn-primary btn-sm" role="button" data-toggle="modal" data-target="#myModal">
                                            查看
                                        </a>
                                </td>
                            </tr>





                            <div class="modal fade" id="myModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
                                <div class="modal-dialog">
                                    <div class="modal-content">
                                        <div class="modal-header">
                                            <button type="button" class="close" data-dismiss="modal" aria-hidden="true">
                                                &times;
                                            </button>
                                            <h4 class="modal-title" id="myModalLabel">
                                                活动内容
                                            </h4>
                                        </div>
                                        <div class="modal-body">


                                            <div id="myCarousel" class="carousel slide">
                                                <!-- 轮播（Carousel）指标 -->
                                                <ol class="carousel-indicators">
                                                    <li data-target="#myCarousel" data-slide-to="0" class="active"></li>
                                                    <li data-target="#myCarousel" data-slide-to="1"></li>
                                                </ol>
                                                <!-- 轮播（Carousel）项目 -->
                                                <div class="carousel-inner">
                                                    @foreach($action->covers as $key=>$file)
                                                        @if($key==0)<div class="item active">@else   <div class="item"> @endif
                                                        <img src="{{$file->path}}" style="width: 635px; height: 250px">
                                                        </div>
                                                    @endforeach
                                                </div>
                                                <!-- 轮播（Carousel）导航 -->
                                                <a class="left carousel-control" href="#myCarousel" role="button" data-slide="prev">
                                                    <span class="glyphicon glyphicon-chevron-left" aria-hidden="true"></span>
                                                    <span class="sr-only">Previous</span>
                                                </a>
                                                <a class="right carousel-control" href="#myCarousel" role="button" data-slide="next">
                                                    <span class="glyphicon glyphicon-chevron-right" aria-hidden="true"></span>
                                                    <span class="sr-only">Next</span>
                                                </a>
                                            </div>





                                            <textarea style="width: 100%; height: 200px">{{$action->content}}</textarea>
                                        </div>
                                            <hr>
                                        <div class="modal-footer">
                                            <button type="button" class="btn btn-primary" data-dismiss="modal">
                                                关闭
                                            </button>
                                        </div>
                                    </div><!-- /.modal-content -->
                                </div><!-- /.modal -->
                            </div>

                        @endforeach
                        </tbody>
                    </table>
                </div>
                <div class="box-footer">
                    {{ $actions->links('admin::widgets.pagination') }}
                </div>
            </div>
        </div>
    </div>
@endsection

@section('script')
    @include('admin::js.grid-row-reject', ['url' => route('admin::actions.index')])
    @include('admin::js.grid-row-success', ['url' => route('admin::actions.index')])
@endsection