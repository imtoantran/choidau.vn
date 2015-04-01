@extends("admin.layouts.main")
@section("content")
    <table id="faq" class="table table-striped table-hover">
        <thead>
            <tr>
                <th>Chủ đề</th>
                <th>Người tạo</th>
                <th>Tạo lúc</th>
                <th width="150">Action</th>
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
            oTable = $('#faq').dataTable({
                "sDom": "<'row'<'col-md-6'l><'col-md-6'f>r>t<'row'<'col-md-6'i><'col-md-6'p>>",
                "sPaginationType": "bootstrap",
                "oLanguage": {
                    "sLengthMenu": "_MENU_ records per page"
                },
                "bProcessing": true,
                "bServerSide": true,
                "ajax": "{{ URL::to('qtri-choidau/get-table')}}",
                "fnDrawCallback": function (oSettings) {
                    $('#faq').find('tbody tr').css('cursor','pointer');
                    // nut xoa chu de
                    $('.btn-faq-delete').on('click', function(e){
                        e.stopPropagation();
                        var cf = confirm('Bạn muốn xóa câu hỏi này? ');
                        if(cf) {
                            var self = $(this);
                            $.ajax({
                                url: '{{Url::to('faq/xoa-cau-hoi')}}',
                                data: {
                                    post_id: self.attr('data-post-id'),
                                    post_type: 'faq-question',
                                    parent_id: self.attr('parent-id')
                                },
                                type: "post",
                                dataType: "json",
                                success: function (respon) {
                                    console.log(respon)
                                    if (respon.result) {
                                        var tag_body = self.closest('tbody');
                                        self.closest('tr').fadeOut('slow', function () {
                                            $(this).remove();
                                            if (respon.total <= 0) {
                                                var str = '';
                                                str += '<tr class="odd" style="cursor: pointer;"><td valign="top" colspan="4" class="dataTables_empty">Không có dữ liệu</td></tr>';
                                                tag_body.append(str);
                                            }
                                        });
                                    } else {
                                        alert('Xóa thất bại');
                                    }
                                }
                            });
                        }
                    });

                    // nut dong chu de
                    $('.btn-faq-close').on('click', function(e){
                        e.stopPropagation();

                        var self = $(this);
                        $.ajax({
                            type: "POST",
                            url: "{{URL::to('thanh-vien/close-question')}}",
                            data: {
                                'post_type': self.attr('data-type'),
                                'post_id': self.attr('data-post-id')
                            },
                            dataType: 'json',
                            success: function (respon) {
                                console.log(respon)
                                if(respon){
                                    if(self.attr('data-type') == 'open'){
                                        self.attr('data-type', 'close');
                                        self.text('Đóng');
                                    }else{
                                        self.attr('data-type', 'open');
                                        self.text('Mở');
                                    }
//                                    self.prop('disabled',false);
                                }else{
                                    alert('Xin vui lòng thử lại')
                                }
                            }

                        });

                    });

                    // xem chi tiet chu de
                    $('#faq').find('tbody tr').on('click', function(){
                        var self = $(this);
                        var post_id = self.find('.btn-faq-delete').attr('data-post-id');
                        window.location = '{{URL::to('qtri-choidau/hoi-dap-')}}'+post_id;
                    })


                }
            });
        });
    </script>
@stop