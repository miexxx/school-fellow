@extends('admin::layouts.main')

@section('content')
    <div class="row">
        <div class="col-md-12">
            <div class="box box-info">
                <div class="box-header with-border">
                    <h3 class="box-title">权限导入</h3>
                    <div class="pull-right">
                        <a class="btn btn-sm btn-default" href="{{ route('admin::permissions.index') }}"><i class="fa fa-arrow-left"></i>&nbsp;返回</a>
                    </div>
                </div>

                <div class="box-body">
                    <textarea readonly class="form-control" name="" id="displayContainer" cols="30" rows="10"></textarea>
                </div>
                <div class="box-footer">
                    <iframe src="" name="hideFrame" frameborder="0" style="display: none">
                    </iframe>
                    <form action="{{ route('admin::permissions.import') }}" method="post" target="hideFrame">
                        {{ csrf_field() }}
                        <button type="submit" onclick="" class="btn btn-info">导入</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
@endsection

@section('script')
    <script>
        function displayMsg(msg) {
            $('#displayContainer').append(msg + "\n");
            var scrollTop = $("#displayContainer")[0].scrollHeight;
            $('#displayContainer').scrollTop(scrollTop);
        }
    </script>
@endsection