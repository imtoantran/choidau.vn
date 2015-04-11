@extends("admin.layouts.main")
@section("content")
    <table id="video" class="table table-striped table-hover">
        <thead>
        <tr>
            <th>Tiêu đề</th>
            <th width="10%">Lượt xem</th>
            <th width="10%">Bình luận</th>
            <th width="10%">Đăng bởi</th>
            <th width="10%">Địa điểm</th>
            <th width="12%">Ngày đăng</th>
            <th width="150px" class="text-right">{{{ Lang::get('table.actions') }}}</th>
        </tr>
        </thead>
        <tbody>
        </tbody>
    </table>
@stop

@section("scripts")
    <script type="text/javascript">
        var oTable;
        $(document).ready(function () {
            oTable = $('#video').dataTable({
                "sDom": "<'row'<'col-md-6'l><'col-md-6'f>r>t<'row'<'col-md-6'i><'col-md-6'p>>",
                "sPaginationType": "bootstrap",
                "oLanguage": {
                    "sLengthMenu": "_MENU_ records per page"
                },
                "bProcessing": true,
                "bServerSide": true,
                "ajax": "{{ URL::to('qtri-choidau/media/video/load') }}",
                "fnDrawCallback": function (oSettings) {
//                    console.log(oSettings);
                    {{--//xoa review--}}
                    $('.btn-video-delete').on('click',function(e){
                        e.stopPropagation();
                        var cf = confirm('Bạn muốn xóa video này?');
                        if(cf){
                            var self = $(this);
                            self.find('i').iconLoad('icon-trash');
                            self.attr('disabled', true);
                            $.ajax({
                                url: '{{Url::to('qtri-choidau/media/video/delete')}}',
                                data: {post_id: self.attr('data-post-id')},
                                type: "post",
                                dataType: "json",
                                success: function (respon) {
                                    if(respon){
                                        var tag_body = self.closest('tbody');
                                        self.find('i').iconUnload('icon-trash');
                                        self.closest('tr').remove();
                                        if(tag_body.find('tr').length <=0){
                                            tag_body.append('<tr class="odd"><td valign="top" colspan="6" class="dataTables_empty">Không có dữ liệu.</td></tr>');
                                        }
                                    }else{
                                        self.attr('disabled', false);
                                    }
                                }
                            });
                        }
                    })

                    // video confirm
                    $('.btn-confirm').on('click',function(e){
                        e.stopPropagation();
                        var self = $(this);
                        var action = self.attr('data-action');
                        self.find('i').iconLoad(self.find('i').attr('class'));
                        self.attr('disabled', true);
                        $.ajax({
                            url: '{{Url::to('qtri-choidau/media/video/update')}}',
                            data: {post_id: self.attr('data-post-id'), data_action:  action},
                            type: "post",
                            dataType: "json",
                            success: function (respon) {
                                if(respon){
                                    if(action == 'confirm'){
                                        self.find('i').iconUnload('icon-check-empty');
                                        self.attr('data-action','un-confirm');
                                        self.removeClass('btn-success').addClass('btn-default');
                                    }else{
                                        self.find('i').iconUnload('icon-check');
                                        self.attr('data-action','confirm');
                                        self.removeClass('btn-default').addClass('btn-success');
                                    }
                                }
                                self.attr('disabled', false);
                            }
                        });
                    });


                    //video confirm
                    $('#video tbody tr').on('click', function(e){
                        var self = $(this);
                        var post_id = $(this).find('.btn-video-delete').attr('data-post-id');
                        console.log(post_id);
                        window.location = '{{Url::to('qtri-choidau/media/video/detail-video-')}}'+post_id;
                    })


                    {{--//update state review--}}
                    {{--$('.review-change-status').on('change', function(){--}}
                        {{--var self = $(this);--}}
                        {{--var post_id = self.attr('data-post-id');--}}
                        {{--var status = self.find('option:selected').val();--}}
                        {{--$.blockUI({message: '<div class="block-ui"><i class="icon-spin2 animate-spin"></i> Đang cập nhật</div>'});--}}
                        {{--$.ajax({--}}
                            {{--url: '{{Url::to('qtri-choidau/location/actionreview')}}',--}}
                            {{--data: {post_id: post_id, status: status, data_action:  'update_status'},--}}
                            {{--type: "post",--}}
                            {{--dataType: "json",--}}
                            {{--success: function (respon) {--}}
                            {{--},--}}
                            {{--complete: function(){--}}
                                {{--$.unblockUI();--}}
                            {{--}--}}
                        {{--});--}}
                    {{--});--}}

                    {{--// chi tiet review--}}
                    {{--$('#review_wrapper').find('tbody tr').on('click', function(){--}}
                    {{--var self = $(this);--}}
                    {{--var post_id = $(this).find('btn-review-confirm').attr('data-post-id');--}}
                    {{--window.location = '{{Url::to('qtri-choidau')}}}';--}}
                    {{--});--}}
                }
            });

        });
    </script>
@stop