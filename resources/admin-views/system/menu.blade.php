@extends('admin::layouts.main')

@section('content')
    <div class="row">
        <div class="col-md-12">
            <div class="box">
                <div class="box-header">
                    <div class="btn-group">
                        <a class="btn btn-primary btn-sm {{ $id }}-tree-tools" data-action="expand">
                            <i class="fa fa-plus-square-o"></i>&nbsp;&nbsp;展开
                        </a>
                        <a class="btn btn-primary btn-sm {{ $id }}-tree-tools" data-action="collapse">
                            <i class="fa fa-minus-square-o"></i>&nbsp;&nbsp;收起
                        </a>
                    </div>

                    <div class="btn-group pull-right">
                        <a href="{{ route('admin::menu.create') }}" class="btn btn-sm btn-success">
                            <i class="fa fa-save"></i>&nbsp;&nbsp;新增
                        </a>
                    </div>

                    <div class="btn-group pull-right" style="margin-right: 10px">
                        <a class="btn btn-info btn-sm  {{ $id }}-save"><i class="fa fa-save"></i>&nbsp;保存</a>
                    </div>
                </div>
                <div class="box-body table-responsive no-padding">
                    <div class="dd" id="{{ $id }}">
                        <ol class="dd-list">
                            @each($branchView, $items, 'branch')
                        </ol>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection

@section('script')
    @include('admin::js.grid-row-delete', ['url' => route('admin::menu.index')])
    <script>
        $('#{{ $id }}').nestable({});

        $('.{{ $id }}-tree-tools').on('click', function(e){
            var target = $(e.target),
                action = target.data('action');
            if (action === 'expand') {
                $('.dd').nestable('expandAll');
            }
            if (action === 'collapse') {
                $('.dd').nestable('collapseAll');
            }
        });

        $('.{{ $id }}-save').click(function () {
            var serialize = $('#{{ $id }}').nestable('serialize');

            $.post("{{ route('admin::menu.order') }}", {
                    _token: LA.token,
                    _order: JSON.stringify(serialize)
                },
                function(data){
                    if (data.status) {
                        toastr.success('保存成功 !');
                    }
                    else {
                        toastr.success('保存失败 !');
                    }
                    $.pjax.reload('#pjax-container');
                });
        });
    </script>
@endsection
