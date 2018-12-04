@extends('admin::layouts.main')

@section('content')
    <div class="row">
        <div class="col-md-12">
            <div class="box box-info">
                <div class="box-header with-border">
                    <h3 class="box-title">个人主页</h3>
                </div>
                <form id="post-form" class="form-horizontal" action="{{ route('admin::profile') }}" method="post" enctype="multipart/form-data" pjax-container>
                    {{ csrf_field() }}
                    {{ method_field('PUT') }}
                    <div class="box-body">
                        <div class="fields-group">
                            <div class="form-group">
                                <label for="username" class="col-sm-2 control-label">用户名</label>
                                <div class="col-sm-8">
                                    <div class="input-group">
                                        <span class="input-group-addon"><i class="fa fa-pencil"></i></span>
                                        <input type="text" id="username" name="username" value="{{ $user->username }}" class="form-control username" placeholder="输入 用户名">
                                    </div>
                                </div>
                            </div>
                            <div class="form-group">
                                <label for="name" class="col-sm-2 control-label">名称</label>
                                <div class="col-sm-8">
                                    <div class="input-group">
                                        <span class="input-group-addon"><i class="fa fa-pencil"></i></span>
                                        <input type="text" id="name" name="name" value="{{ $user->name }}" class="form-control name" placeholder="输入 名称">
                                    </div>
                                </div>
                            </div>
                            <div class="form-group">
                                <label for="password" class="col-sm-2 control-label">密码</label>
                                <div class="col-sm-8">
                                    <div class="input-group">
                                        <span class="input-group-addon"><i class="fa fa-eye-slash"></i></span>
                                        <input type="password" id="password" name="password" value="{{ $user->password }}" class="form-control password" placeholder="输入 密码">
                                    </div>
                                </div>
                            </div>
                            <div class="form-group">
                                <label for="password_confirmation" class="col-sm-2 control-label">确认密码</label>
                                <div class="col-sm-8">
                                    <div class="input-group">
                                        <span class="input-group-addon"><i class="fa fa-eye-slash"></i></span>
                                        <input type="password" id="password_confirmation" name="password_confirmation" value="{{ $user->password }}" class="form-control password_confirmation" placeholder="输入 确认密码">
                                    </div>
                                </div>
                            </div>
                            <div class="form-group">
                                <label for="avatar" class="col-sm-2 control-label">头像</label>
                                <div class="col-sm-8">
                                    <input type="file" class="avatar" name="avatar" id="avatar" data-initial-preview="{{ $user->avatar }}" data-initial-caption="{{ basename($user->avatar) }}">
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="box-footer">
                        <div class="btn-group pull-left">
                            <button type="reset" class="btn btn-warning">重置</button>
                        </div>
                        <div class="btn-group pull-right">
                            <button type="submit" id="submit-btn" class="btn btn-info pull-right" data-loading-text="<i class='fa fa-spinner fa-spin'></i> 提交">提交</button>
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
            $("input.avatar").fileinput({
                "overwriteInitial": false,
                "initialPreviewAsData": true,
                "browseLabel": "浏览",
                "showRemove": false,
                "showUpload": false,
                "allowedFileTypes": [
                    "image"
                ]
            });

            $("#post-form").bootstrapValidator({
                live: 'enable',
                feedbackIcons: {
                    valid: 'glyphicon glyphicon-ok',
                    invalid: 'glyphicon glyphicon-remove',
                    validating: 'glyphicon glyphicon-refresh'
                },
                fields: {
                    username:{
                        validators:{
                            notEmpty:{
                                message: '用户名不能为空'
                            }
                        }
                    },
                    name:{
                        validators:{
                            notEmpty:{
                                message: '名称不能为空'
                            }
                        }
                    },
                    password:{
                        validators:{
                            notEmpty:{
                                message:'密码不能为空'
                            }
                        }
                    },
                    password_confirmation:{
                        validators:{
                            notEmpty:{
                                message:'确认密码不能为空'
                            }
                        }
                    }
                }
            });

            $("#submit-btn").click(function () {
                var $form = $("#post-form");

                $form.bootstrapValidator('validate');
                if ($form.data('bootstrapValidator').isValid()) {
                    $form.submit();
                }
            })
        })
    </script>
@endsection