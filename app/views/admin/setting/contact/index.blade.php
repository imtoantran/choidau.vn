@extends("admin.layouts.main")
@section("content")
    <table id="contact" class="table table-striped table-hover">
        <thead>
        <tr>
            <th width="2%">ID</th>
            <th width="10%">Người gửi</th>
            <th width="10%">Email</th>
            <th width="20%">Chủ đề</th>
            <th>Nội dung</th>
            <th width="15%">Đăng lúc</th>
            <th width="120px" class="text-right">{{{ Lang::get('table.actions')}}}</th>
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
            oTable = $('#contact').dataTable({
                "sDom": "<'row'<'col-md-6'l><'col-md-6'f>r>t<'row'<'col-md-6'i><'col-md-6'p>>",
                "sPaginationType": "bootstrap",
                "oLanguage": {
                    "sLengthMenu": "_MENU_ records per page"
                },
                "bProcessing": true,
                "bServerSide": true,
                "ajax": "{{ URL::to('qtri-choidau/setting/contact/list') }}",
                "fnDrawCallback": function (oSettings) {
                    //xoa review
                    $('.contact-item-delete').on('click',function(e){
                        e.stopPropagation();
                        var cf = confirm('Bạn muốn xóa liên hệ này?');
                        if(cf){
                            var self = $(this);
                            self.find('i').iconLoad('icon-trash');
                            self.attr('disabled', true);
                            $.ajax({
                                url: '{{Url::to('qtri-choidau/setting/contact/delete')}}',
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
                    });
                }
            });

        });
    </script>
@stop