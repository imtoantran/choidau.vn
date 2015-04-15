@extends("admin.layouts.main")
@section("content")
    <div class="row">
        <div class="col-md-12 pull-right">

        </div>
	</div>

    <div class="tabbable">
        <ul class="nav nav-tabs">
            <li class="active">
                <a href="#tab_head" data-toggle="tab">
                    Trong thẻ head
                    @if(count($script_head)>0)
                        <span class="badge badge-success">{{count($script_head)}}</span>
                    @endif
                </a>
            </li>
            <li>
                <a href="#tab_after_open_body" data-toggle="tab">
                    Sau thẻ mở body
                    @if(count($script_after_open_body)>0)
                        <span class="badge badge-success">{{count($script_after_open_body)}}</span>
                    @endif
                </a>
            </li>
            <li>
                <a href="#tab_before_close_body" data-toggle="tab">
                    Trước thẻ đóng body
                    @if(count($script_before_close_body)>0)
                        <span class="badge badge-success">{{count($script_before_close_body)}}</span>
                    @endif
                </a>
            </li>
            <li>
                <a href="#tab_insert_script" data-toggle="tab" class="font-weight-600">
                    <i class="icon-doc-add"></i>
                    Chèn Script
                </a>
            </li>


        </ul>
        <div class="tab-content no-space">
            {{--tab_head--}}
            <div class="tab-pane active" id="tab_head">
                <div class="form-body">
                    @if(count($script_head)>0)
                        @foreach($script_head as $key=>$val)
                            <div class="form-group clearfix">
                                <label class="col-md-2 control-label">{{$val->title}}:</label>
                                <div class="col-md-8">
                                    <textarea class="form-control maxlength-handler script-content" rows="4">{{$val->content}}</textarea>
                                </div>
                                <div class="col-md-2">
                                    <button class="btn btn-default btn-sm margin-bottom script-update" data-id="{{$val->id}}">
                                        <i class="icon-floppy"></i> Lưu
                                    </button>
                                    <button class="btn btn-danger btn-sm margin-bottom script-delete" data-id="{{$val->id}}">
                                        <i class="icon-trash"></i> Xóa
                                    </button>
                                </div>
                            </div>
                        @endforeach
                    @else
                        <div class="alert alert-warning">
                            <i class="icon-warning-empty"></i>
                            Script đang rỗng.
                        </div>
                    @endif
                </div>
            </div>

            {{--tab_after_open_body--}}
            <div class="tab-pane" id="tab_after_open_body">
                <div class="form-body">
                    @if(count($script_after_open_body)>0)
                        @foreach($script_after_open_body as $key=>$val)
                            <div class="form-group clearfix">
                                <label class="col-md-2 control-label">{{$val->title}}:</label>
                                <div class="col-md-8">
                                    <textarea class="form-control maxlength-handler script-content" rows="4">{{$val->content}}</textarea>
                                </div>
                                <div class="col-md-2">
                                    <button class="btn btn-default btn-sm margin-bottom script-update" data-id="{{$val->id}}">
                                        <i class="icon-floppy"></i> Lưu
                                    </button>
                                    <button class="btn btn-danger btn-sm margin-bottom script-delete" data-id="{{$val->id}}">
                                        <i class="icon-trash"></i> Xóa
                                    </button>
                                </div>
                            </div>
                        @endforeach
                    @else
                        <div class="alert alert-warning">
                            <i class="icon-warning-empty"></i>
                            Script đang rỗng.
                        </div>
                    @endif
                </div>
            </div>


            {{--tab_before_close_body--}}
            <div class="tab-pane" id="tab_before_close_body">
                <div class="form-body">
                    @if(count($script_before_close_body)>0)
                        @foreach($script_before_close_body as $key=>$val)
                            <div class="form-group clearfix">
                                <label class="col-md-2 control-label">{{$val->title}}:</label>
                                <div class="col-md-8">
                                    <textarea class="form-control maxlength-handler script-content" rows="4">{{$val->content}}</textarea>
                                </div>
                                <div class="col-md-2">
                                    <button class="btn btn-default btn-sm margin-bottom script-update" data-id="{{$val->id}}">
                                        <i class="icon-floppy"></i> Lưu
                                    </button>
                                    <button class="btn btn-danger btn-sm margin-bottom script-delete" data-id="{{$val->id}}">
                                        <i class="icon-trash"></i> Xóa
                                    </button>
                                </div>
                            </div>
                        @endforeach
                    @else
                        <div class="alert alert-warning">
                            <i class="icon-warning-empty"></i>
                            Script đang rỗng.
                        </div>
                    @endif
                </div>
            </div>


            {{--insert script--}}
            <div class="tab-pane" id="tab_insert_script">
                <div class="form-body">
                    <form class="form-horizontal" role="form" id="frm-insert-script" name="frm-insert-script">
                        <div class="form-group">
                            <label class="control-label col-sm-2" for="email">Tiêu đề:</label>
                            <div class="col-sm-8">
                                <input type="text" class="form-control" id="script-title" name="script-title" placeholder="Nhập tiêu đề" required>
                            </div>
                        </div>

                        <div class="form-group">
                            <label class="control-label col-sm-2" for="email">Nội dung:</label>
                            <div class="col-sm-8">
                                <textarea class="form-control maxlength-handler" id="script-content" name="script-content" rows="4" placeholder="Nội dung script" required></textarea>
                            </div>
                        </div>

                        <div class="form-group">
                            <label class="control-label col-sm-2" for="email">Vị trí:</label>
                            <div class="col-sm-8">
                                <select class="table-group-action-input form-control" id="script-type" name="script-type" required>
                                    <option value="">Chọn vị trí chèn...</option>
                                    <option value="p1">Trong thẻ head</option>
                                    <option value="p2">Sau thẻ mở body</option>
                                    <option value="p3">Trước thẻ đóng body</option>
                                </select>
                            </div>
                        </div>

                        <div class="form-group">
                            <div class="col-sm-offset-2 col-sm-10">
                                <button type="submit" class="btn btn-sm btn-success">Lưu</button>
                                <button type="reset" class="btn btn-sm btn-default">Hủy</button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
@stop

@section("scripts")
    <script type="text/javascript">
        $(document).ready(function () {

            // script delete
            $('.script-delete').on('click', function(){
                var cf = confirm('Bạn muốn xóa Script này ?');
                if(cf){
                    var self = $(this);
                    var script_id = self.attr('data-id');
                    self.prop('disabled',true).find('i').iconLoad('icon-trash');
                    $.ajax({
                        type: "POST",
                        url: "{{URL::to('qtri-choidau/setting/script/delete')}}",
                        data: {'script_id': script_id},
                        dataType: 'json',
                        success: function (respon) {
                            if(respon){
                                self.closest('.form-group').remove();
                            }else{
                                alert('Xóa không thành công, xin vui lòng thử lại.');
                            }
                        },
                        complete: function(){ self.iconUnload('icon-trash');}
                    });
                }
            });

            // script update
            $('.script-update').on('click', function(){
                var self = $(this);
                var script_id = self.attr('data-id');
                var script_content = self.closest('.form-group').find('.script-content').val();
                self.prop('disabled',true).find('i').iconLoad('icon-floppy');
                $.ajax({
                    type: "POST",
                    url: "{{URL::to('qtri-choidau/setting/script/update')}}",
                    data: {'script_id': script_id, 'script_content':script_content},
                    dataType: 'json',
                    success: function (respon) {
                        if(!respon){
                            alert('Cập nhật không thành công, xin vui lòng kiểm tra lại.');
                        }
                    },
                    complete: function(){
                        self.prop('disabled',false).find('i').iconUnload('icon-floppy');
                    }
                });
            });

            // script insert
            $('#frm-insert-script').submit(function(e){
                e.preventDefault();
                var self = $(this);
                $.ajax({
                    type: "POST",
                    url: "{{URL::to('qtri-choidau/setting/script/insert')}}",
                    data: {'insert_script': self.serialize()},
                    dataType: 'json',
                    success: function (respon) {
                        if(respon){
                            alert('Chèn script thành công.');
                        }else{
                            alert('Chèn script không thành công, Xin vui lòng thử lại.');
                        }
                        window.location = '{{URL::to('qtri-choidau/setting/script')}}';

                    }
                });
            });
        });
    </script>
@stop