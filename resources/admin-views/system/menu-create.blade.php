@extends('admin::layouts.main')

@section('content')
    <div class="row">
        <div class="col-md-12">
            <div class="box box-info">
                <div class="box-header with-border">
                    <h3 class="box-title">创建</h3>

                    <div class="box-tools">
                        <div class="btn-group pull-right" style="margin-right: 10px">
                            <a class="btn btn-sm btn-default form-history-back"><i class="fa fa-arrow-left"></i>&nbsp;返回</a>
                        </div>
                    </div>
                </div>
                <form id="post-form" class="form-horizontal" action="{{ route('admin::menu.store') }}" method="post" enctype="multipart/form-data" pjax-container>
                    {{ csrf_field() }}
                    <div class="box-body">
                        <div class="fields-group">
                            <div class="form-group">
                                <label for="parent_id" class="col-sm-2 control-label">父级菜单</label>
                                <div class="col-sm-8">
                                    <select style="width: 100%;" name="parent_id" id="parent_id" tabindex="-1" data-placeholder="选择父级菜单" class="form-control parent_id select2-hidden-accessible">
                                        @foreach($options as $key => $option)
                                            <option value="{{ $key }}">{!! $option !!}</option>
                                        @endforeach
                                    </select>
                                </div>
                            </div>
                            <div class="form-group">
                                <label for="title" class="col-sm-2 control-label">标题</label>
                                <div class="col-sm-8">
                                    <div class="input-group">
                                        <span class="input-group-addon"><i class="fa fa-pencil"></i></span>
                                        <input type="text" id="title" name="title" value="" class="form-control title" placeholder="输入 标题">
                                    </div>
                                </div>
                            </div>
                            <div class="form-group  ">
                                <label for="icon" class="col-sm-2 control-label">图标</label>
                                <div class="col-sm-8">
                                    <div class="input-group">
                                        <span class="input-group-addon"><i class="fa fa-pencil"></i></span>
                                        <input style="width: 140px" type="text" id="icon" name="icon" value="fa-bars" class="form-control icon" placeholder="输入 图标" />
                                    </div>
                                </div>
                            </div>
                            <div class="form-group">
                                <label for="permission_id" class="col-sm-2 control-label">绑定权限</label>
                                <div class="col-sm-8">
                                    <select style="width: 100%;" name="permission_id" id="permission_id" tabindex="-1" data-placeholder="绑定权限" class="form-control permission_id select2-hidden-accessible">
                                        <option value=""></option>
                                        @foreach($permissions as $permission)
                                            <option value="{{ $permission->id }}">{{ $permission->module }} - {{ $permission->name }}</option>
                                        @endforeach
                                    </select>
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
        $('.form-history-back').on('click', function (event) {
            event.preventDefault();
            history.back(1);
        });

        $('.parent_id').select2({
            "allowClear": true
        });

        $('.permission_id').select2({
            "allowClear": true
        });

        $('.icon').iconpicker({
            placement:'bottomLeft'
        });
    </script>
@endsection