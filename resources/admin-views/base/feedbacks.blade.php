@extends('admin::layouts.main')

@section('content')

    @include('admin::search.system-feedbacks')

    <div class="row">
        <div class="col-md-12">
            <div class="box box-info">
                <div class="box-header with-border">
                    <h3 class="box-title">校友认证申请列表</h3>

                    @include('admin::widgets.filter-btn-group', ['resetUrl' => route('admin::feedbacks.index')])
                </div>

                <div class="box-body table-responsive no-padding">
                    <table class="table">
                        <tbody>
                        <tr>
                            <th>反馈人头像</th>
                            <th>反馈人微信名</th>
                            <th>反馈人联系方式</th>
                            <th>反馈时间</th>
                            <th>查看状态</th>
                            <th>操作</th>
                        </tr>
                        @foreach($feedbacks as $feedback)
                            <tr>
                                <td><img src="{{ $feedback->user->avatarurl }}" class="img-circle" alt="avatar" width="50" height="50"></td>
                                <td><span class="label label-success">{{ $feedback->user->nickname }}</span></td>
                                <td><span class="label label-default">Mobile :</span><span class="label label-danger">{{ $feedback->user->mobile }}</span></td>
                                <td>{{ $feedback->created_at }}</td>
                                <td>@if($feedback->status =="未查看")<span class="label label-warning">@else<span class="label label-success">@endif{{ $feedback->status }}</span></td>
                                <td>
                                        <a href="javascript:void(0);" data-id="{{ $feedback->id }}" class="see-content btn btn-info btn-sm" role="button" data-toggle="modal" data-target="#myModal">
                                            查看
                                        </a>
                                        <a href="javascript:void(0);" data-id="{{ $feedback->id }}" class="grid-row-delete btn btn-danger btn-sm" role="button">
                                            删除
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
                                                反馈内容
                                            </h4>
                                        </div>
                                        <div class="modal-body">
                                            <textarea style="width: 100%; height: 200px">{{$feedback->content}}</textarea>
                                        </div>
                                        <div class="modal-footer">
                                            <button type="button" class="btn btn-primary close-content" data-dismiss="modal">
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
                    {{ $feedbacks->links('admin::widgets.pagination') }}
                </div>


            </div>
        </div>
    </div>
@endsection

@section('script')
    @include('admin::js.grid-row-delete', ['url' => route('admin::feedbacks.index')])
    <script>
        $(function () {
            $('.see-content').click(function(){

                var id = $(this).data('id');
                $.ajax({
                    type:"get",
                    dataType:"json",
                    data:{
                        _token:LA.token
                    },
                    url:"/admin/base/content/"+id,
                });
            });

            $('.close-content').click(function(){
                $.pjax.reload('#pjax-container');
            });
        });
    </script>
@endsection