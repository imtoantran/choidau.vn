@extends("admin.layouts.main")
@section("content")
    <div class="row margin-bottom-5">
        <div class="col-md-12">
            <a id="page-created" type="submit" class="btn btn-sm btn-primary" href="{{URL::to('qtri-choidau/setting/page/create')}}">
                <span class="icon icon-plus"></span>Tạo mới
            </a>
        </div>
    </div>
    <table id="page" class="table table-striped table-hover">
        <thead>
        <tr>
            <th width="2%">ID</th>
            <th>Tiêu đề</th>
            <th>Alias</th>
            <th>Ngày cập nhật</th>
            <th width="150px" class="text-right">{{{ Lang::get('table.actions')}}}</th>
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
            oTable = $('#page').dataTable({
                "sDom": "<'row'<'col-md-6'l><'col-md-6'f>r>t<'row'<'col-md-6'i><'col-md-6'p>>",
                "sPaginationType": "bootstrap",
                "oLanguage": {
                    "sLengthMenu": "_MENU_ records per page"
                },
                "bProcessing": true,
                "bServerSide": true,
                "ajax": "{{ URL::to('qtri-choidau/setting/page/list') }}",
                "fnDrawCallback": function (oSettings) {
                    console.log(oSettings);
                    //xoa review
                    $('.page-item-delete').on('click',function(e){
                        e.stopPropagation();
                        var cf = confirm('Bạn muốn xóa trang này?');
                        if(cf){
                            var self = $(this);
                            self.find('i').iconLoad('icon-trash');
                            self.attr('disabled', true);
                            $.ajax({
                                url: '{{Url::to('qtri-choidau/setting/page/delete')}}',
                                data: {id: self.attr('data-id')},
                                type: "post",
                                dataType: "json",
                                success: function (respon) {
                                    if(respon){
                                        var tag_body = self.closest('tbody');
                                        self.closest('tr').remove();
                                        if(tag_body.find('tr').length <=0){
                                            tag_body.append('<tr class="odd"><td valign="top" colspan="6" class="dataTables_empty">Không có dữ liệu.</td></tr>');
                                        }
                                    }else{
                                        self.find('i').iconUnload('icon-trash');
                                        self.attr('disabled', false);
                                    }
                                }
                            });
                        }
                    })

                    {{--// video confirm--}}
                    {{--$('.btn-confirm').on('click',function(e){--}}
                        {{--e.stopPropagation();--}}
                        {{--var self = $(this);--}}
                        {{--var action = self.attr('data-action');--}}
                        {{--self.find('i').iconLoad(self.find('i').attr('class'));--}}
                        {{--self.attr('disabled', true);--}}
                        {{--$.ajax({--}}
                            {{--url: '{{Url::to('qtri-choidau/media/video/update')}}',--}}
                            {{--data: {post_id: self.attr('data-post-id'), data_action:  action},--}}
                            {{--type: "post",--}}
                            {{--dataType: "json",--}}
                            {{--success: function (respon) {--}}
                                {{--if(respon){--}}
                                    {{--if(action == 'confirm'){--}}
                                        {{--self.find('i').iconUnload('icon-check-empty');--}}
                                        {{--self.attr('data-action','un-confirm');--}}
                                        {{--self.removeClass('btn-success').addClass('btn-default');--}}
                                    {{--}else{--}}
                                        {{--self.find('i').iconUnload('icon-check');--}}
                                        {{--self.attr('data-action','confirm');--}}
                                        {{--self.removeClass('btn-default').addClass('btn-success');--}}
                                    {{--}--}}
                                {{--}--}}
                                {{--self.attr('disabled', false);--}}
                            {{--}--}}
                        {{--});--}}
                    {{--});--}}

                    {{--//video delete--}}
                    {{--$('#video tbody tr').on('click', function(e){--}}
                        {{--var self = $(this);--}}
                        {{--var post_id = $(this).find('.btn-video-delete').attr('data-post-id');--}}
                        {{--console.log(post_id);--}}
                        {{--window.location = '{{Url::to('qtri-choidau/media/video/detail-video-')}}'+post_id;--}}
                    {{--})--}}

                }
            });

        });
    </script>
@stop