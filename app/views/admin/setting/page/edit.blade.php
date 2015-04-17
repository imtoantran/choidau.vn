@extends('admin.layouts.main')
@section("content")
    <div class="row">
        <div class="col-md-12">
            <form id="frm-page" class="form-horizontal" method="post" autocomplete="off" data-id="{{$page->id}}" >
                <input type="hidden" name="_token" value="{{{csrf_token()}}}"/>
                <div class="form-group">
                    <div class="col-sm-4">
                        <div class="input-group">
                            <span class="input-group-addon tooltips" data-original-title="Tiêu đề">
                                <i class="icon-tag"></i>
                            </span>
                            <input placeholder="Tiêu đề bài viết" class="form-control" type="text" name="title" id="title" required  value="{{$page->title}}"/>
                        </div>
                    </div>

                    <div class="col-sm-4">
                        <div class="input-group">
                            <span class="input-group-addon tooltips" data-original-title="Liên kết">
                                <i class="icon-link"></i>
                            </span>
                                <input placeholder="Liên kết đến bài viết" class="form-control" type="text" name="alias" id="alias" required value="{{$page->alias}}"/>
                        </div>
                    </div>
                    <div class="col-sm-4">
                        <button id="add-media" type="button" class="btn btn-sm btn-warning">
                            <span class="icon icon-upload-cloud"></span>Thêm hình
                        </button>
                        <button id="page-reset" type="reset" class="btn btn-sm btn-default tooltips" data-original-title="Làm mới">
                            <span class="icon icon-cancel-squared"></span>
                        </button>
                        <button id="page-save" type="submit" class="btn btn-sm btn-success">
                            <span class="icon icon-floppy"></span>Lưu
                        </button>

                        <a id="page-created" type="submit" class="btn btn-sm btn-primary pull-right" href="{{URL::to('qtri-choidau/setting/page/create')}}">
                            <span class="icon icon-plus"></span>Tạo mới
                        </a>
                    </div>

                </div>
                <div class="form-group">
                    <div class="col-md-12">
                        <div class="alert alert-warning"><strong>Url:</strong> {{URL::to('page/'.$page->id.'-'.$page->alias)}}</div>
                    </div>
                </div>
                <div class="form-group">
                    <div class="col-md-12">
                        <textarea id="editor" class="form-control full-width wysihtml5" name="content" rows="15" >{{$page->content}}</textarea>
                    </div>
                </div>
            </form>
        </div>
    </div>
    <div class="clearfix"></div>
@stop

@section("scripts")
    <script type="text/javascript">
        jQuery(document).ready(function () {
//            if ($('#editor').size() > 0) {
                tinymce.init({
                    selector: "#editor",
                    menubar: false,
                    plugins: [
                        "advlist autolink lists link image charmap print preview anchor",
                        "searchreplace visualblocks code fullscreen",
                        "insertdatetime media table contextmenu paste",
                        "autoresize",
                        "preview", "image", "code", "wordcount", "textcolor"
                    ],
                    toolbar: " code | preview | insertfile undo redo | styleselect | bold italic forecolor | alignleft aligncenter alignright alignjustify | bullist numlist outdent indent | link image "
                });
//            }

            $("#add-media").mediaupload({
                token:"{{Session::token()}}",
                url: "{{URL::to("media/upload")}}",
                "multi-select": true,
                complete: function (data) {
                    if (data != null) {
                        if (data.length) {
                            $.each(data, function (i, image) {
                                var ed = tinyMCE.get('editor');
                                var range = ed.selection.getRng();
                                var newNode = ed.getDoc().createElement("img");
                                newNode.src = image.src;
                                newNode.className = "img-responsive";
                                range.insertNode(newNode);
                            })
                        }
                    }
                }
            });

            $('#frm-page').submit(function (event) {
                event.preventDefault();
                var form = $(this);
                var id = form.attr('data-id');
                var title = form.find('#title').val();
                var alias = form.find('#alias').val();
                var content = tinyMCE.activeEditor.getContent();

                $.blockUI({message: '<div class="block-ui"><i class="icon-spin2 animate-spin"></i> Đang cập nhật</div>'});
                $.ajax({
                    type: "POST",
                    url: "{{URL::to('qtri-choidau/setting/page/save')}}",
                    data: {'id':id, 'title': title, 'alias': alias, 'content': content, 'action': 'update'},
                    dataType: 'json',
                    success: function (respon) {
                        if(!respon){
                            alert('Cập nhật không thành công, xin vui lòng kiểm tra lại.');
                        }
                    }
                    ,complete: function(){
                        $.unblockUI();
                    }
                });

            });
        });
    </script>
@stop