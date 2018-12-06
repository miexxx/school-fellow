<script>
    $('.grid-row-success').unbind('click').click(function() {

        var id = $(this).data('id');

        swal({
                title: "是否同意该申请?",
                type: "warning",
                showCancelButton: true,
                confirmButtonColor: "#DD6B55",
                confirmButtonText: "确认",
                closeOnConfirm: false,
                cancelButtonText: "取消"
            },
            function(){
                $.ajax({
                    method: 'post',
                    url: '{{ $url }}' + '/success/' + id,
                    data: {
                        _token:LA.token
                    },
                    success: function (data) {
                        $.pjax.reload('#pjax-container');

                        if (typeof data === 'object') {
                            if (data.status) {
                                swal(data.message, '', 'success');
                            } else {
                                swal(data.message, '', 'error');
                            }
                        }
                    }
                });
            });
    });
</script>