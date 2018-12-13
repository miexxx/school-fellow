@extends('admin::layouts.main')

@section('content')
    <div class="row">
        <div class="col-md-12">
            <div class="box box-info">
                <div class="box-header with-border">
                    <h3 class="box-title">关于我们/技术支持</h3>
                    <div class="box-tools">
                        <div class="btn-group pull-right" style="margin-right: 10px">
                            <a class="btn btn-sm btn-default form-history-back"><i class="fa fa-refresh"></i>&nbsp;刷新</a>
                        </div>
                    </div>
                </div>
                <form id="post-form" class="form-horizontal" action="{{route('admin::about.store')}}" method="post" enctype="multipart/form-data" pjax-container>
                    {{ csrf_field() }}
                    <div class="box-body">
                        <div class="fields-group">
                            <div class="form-group">
                                <label for="content" class="col-sm-2 control-label">关于我们</label>
                                <div class="col-sm-8">
                                    <textarea class="form-control" id="about-editor" rows="8" name="aboutContent" placeholder="关于我们">{{$about->content}}</textarea>
                                </div>
                            </div>


                        </div>

                        <div class="fields-group">
                            <div class="form-group">
                                <label for="content" class="col-sm-2 control-label">技术支持</label>
                                <div class="col-sm-8">
                                    <textarea class="form-control" id="skill-editor" rows="8" name="skillContent" placeholder="技术支持">{{$skill->content}}</textarea>
                                </div>
                            </div>


                        </div>
                    </div>
                    <div class="box-footer">
                        <div class="btn-group pull-left">
                            <button type="reset" class="btn btn-warning">重置</button>
                        </div>
                        <div class="btn-group pull-right">
                            <span id="prompt-info" style="color:#f00;"></span>
                            <button type="button" id="submit-btn"  class="btn btn-info pull-right" data-loading-text="<i class='fa fa-spinner fa-spin'></i> 提交">提交</button>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
@endsection

@section('script')
    <script>
        $(function () {
            $('.form-history-back').on('click', function (event) {
                event.preventDefault();
                location.reload();
            });

            var about_editor = new Simditor({
                textarea: $('#about-editor'),
                upload: {
                    //处理上传图片的URL
                    url: '{{ route('admin::upload.upload_image') }}',
                    //防止crsf跨站请求
                    params: { _token: '{{ csrf_token() }}' },
                    //服务器端获取图片的键值
                    fileKey: 'upload_file',
                    //最多允许上传图片数
                    connectionCount: 3,
                    //上传时关闭页面提醒
                    leaveConfirm: '文件上传中，关闭此页面将取消上传。'
                },
                //支持图片黏贴
                pasteImage: true,
            });

            var skill_editor = new Simditor({
                textarea: $('#skill-editor'),
                upload: {
                    //处理上传图片的URL
                    url: '{{ route('admin::upload.upload_image') }}',
                    //防止crsf跨站请求
                    params: { _token: '{{ csrf_token() }}' },
                    //服务器端获取图片的键值
                    fileKey: 'upload_file',
                    //最多允许上传图片数
                    connectionCount: 3,
                    //上传时关闭页面提醒
                    leaveConfirm: '文件上传中，关闭此页面将取消上传。'
                },
                //支持图片黏贴
                pasteImage: true,
            });

            $('#submit-btn').on('click', function (event) {
                $('#post-form').submit();
                swal("提交成功！","请继续操作！","success");
            });
        });
    </script>
@endsection