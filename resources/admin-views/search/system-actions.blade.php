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
            <form action="{{ route('admin::actions.index') }}" method="get" pjax-container>
                <div class="modal-body">
                    <div class="form">
                        <div class="form-group">
                            <div class="form-group">
                                <label>申请人微信名</label>
                                <input type="text" class="form-control" placeholder="微信名" name="nickname" value="{{ request('nickname') }}">
                            </div>
                        </div>
                        <div class="form-group">
                            <div class="form-group">
                                <label>活动标题</label>
                                <input type="text" class="form-control" placeholder="活动标题" name="title" value="{{ request('title') }}">
                            </div>
                        </div>
                        <div class="form-group">
                            <div class="form-group">
                                <label>申请人手机号</label>
                                <input type="text" class="form-control" placeholder="手机号" name="mobile" value="{{ request('mobile') }}">
                            </div>
                        </div>
                        <div class="form-group">
                            <div class="form-group">
                                <label>审核状态</label>
                                <select name="status" class="form-control">
                                    <option value="" selected></option>
                                    <option value="1">未审核</option>
                                    <option value="2">审核通过</option>
                                </select>
                            </div>
                        </div>
                        <div class="form-group">
                            <div class="form-group">
                                <label>创建时间</label>
                                <div class="input-group">
                                    <div class="input-group-addon">
                                        <i class="fa fa-calendar"></i>
                                    </div>
                                    <input type="text" class="form-control" id="created_at_start" placeholder="开始时间" name="created_at[start]" value="">
                                    <span class="input-group-addon" style="border-left: 0; border-right: 0;">-</span>
                                    <input type="text" class="form-control" id="created_at_end" placeholder="结束时间" name="created_at[end]" value="">
                                </div>
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
    $('#created_at_start').datetimepicker({"format":"YYYY-MM-DD HH:mm:ss","locale":"zh-CN"});
    $('#created_at_end').datetimepicker({"format":"YYYY-MM-DD HH:mm:ss","locale":"zh-CN","useCurrent":false});
    $("#created_at_start").on("dp.change", function (e) {
        $('#created_at_end').data("DateTimePicker").minDate(e.date);
    });
    $("#created_at_end").on("dp.change", function (e) {
        $('#created_at_start').data("DateTimePicker").maxDate(e.date);
    });


    $("#filter-modal .submit").click(function () {
        $("#filter-modal").modal('toggle');
        $('body').removeClass('modal-open');
        $('.modal-backdrop').remove();
    });
</script>