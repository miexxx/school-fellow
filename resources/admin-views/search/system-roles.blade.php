<div class="modal fade" id="filter-modal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                    <span class="sr-only">Close</span>
                </button>
                <h4 class="modal-title" id="myModalLabel">筛选</h4>
            </div>
            <form action="{{ route('admin::roles.index') }}" method="get" pjax-container>
                <div class="modal-body">
                    <div class="form">
                        <div class="form-group">
                            <div class="form-group">
                                <label>标识</label>
                                <input type="text" class="form-control" placeholder="标识" name="slug" value="{{ request('slug') }}">
                            </div>
                        </div>
                        <div class="form-group">
                            <div class="form-group">
                                <label>名称</label>
                                <input type="text" class="form-control" placeholder="名称" name="name" value="{{ request('name') }}">
                            </div>
                        </div>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="submit" class="btn btn-primary submit">提交</button>
                    <button type="reset" class="btn btn-warning pull-left">撤销</button>
                </div>
            </form>
        </div>
    </div>
</div>

<script>
    $("#filter-modal .submit").click(function () {
        $("#filter-modal").modal('toggle');
        $('body').removeClass('modal-open');
        $('.modal-backdrop').remove();
    });
</script>