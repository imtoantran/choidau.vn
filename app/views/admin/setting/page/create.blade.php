@extends('admin.layouts.main')
@section("content")
    <div class="row">
        <div class="col-md-12">
            <form id="frm-page" class="form-horizontal" method="post" autocomplete="off">
                <input type="hidden" name="_token" value="{{{csrf_token()}}}"/>
                <div class="form-group">
                    <div class="col-sm-4">
                        <div class="input-group">
                            <span class="input-group-addon tooltips" data-original-title="Tiêu đề">
                                <i class="icon-tag"></i>
                            </span>
                            <input placeholder="Tiêu đề bài viết" class="form-control" type="text" name="title" id="title" value="" required/>
                        </div>
                    </div>

                    <div class="col-sm-4">
                        <div class="input-group">
                            <span class="input-group-addon tooltips" data-original-title="Tiêu đề thân thiện">
                                <i class="icon-link"></i>
                            </span>
                                <input placeholder="Tiêu đề thân thiện" class="form-control" type="text" name="alias" id="alias" value="" required/>
                        </div>
                    </div>
                    <div class="col-sm-4">
                        <button id="add-media" type="button" class="btn btn-sm btn-warning">
                            <span class="icon icon-upload-cloud"></span>Thêm hình
                        </button>
                        <button id="page-reset" type="reset" class="btn btn-sm btn-default tooltips" data-original-title="Làm mới">
                            <span class="icon icon-cancel-squared"></span>
                        </button>
                        <button id="page-save" type="submit" class="btn btn-sm btn-success pull-right">
                            <span class="icon icon-floppy"></span>Lưu
                        </button>

                        {{--<a id="page-created" type="submit" class="btn btn-sm btn-primary pull-right" href="{{URL::to('qtri-choidau/setting/page/create')}}">--}}
                            {{--<span class="icon icon-plus"></span>Tạo mới--}}
                        {{--</a>--}}
                    </div>

                </div>

                <div class="form-group">
                    <div class="col-md-12">
                        <textarea id="editor-create" class="form-control full-width wysihtml5" name="content" rows="15"></textarea>
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
            $('input#title').on('change', function(){
                var title = $(this).val() ;
                    title = $.trim(title); // xoa khoang trang thua o dau
                    title = bodauTiengViet(title); // chuyen hoa->thuong / loai bo dau

                if(title.length>0){
                    $('#alias').val(title);
                }
            });

            tinymce.init({
                selector: "#editor-create",
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

            function bodauTiengViet(str) {
                str = str.toLowerCase();
                str = str.replace(/à|á|ạ|ả|ã|â|ầ|ấ|ậ|ẩ|ẫ|ă|ằ|ắ|ặ|ẳ|ẵ/g,"a");
                str = str.replace(/è|é|ẹ|ẻ|ẽ|ê|ề|ế|ệ|ể|ễ/g,"e");
                str = str.replace(/ì|í|ị|ỉ|ĩ/g,"i");
                str = str.replace(/ò|ó|ọ|ỏ|õ|ô|ồ|ố|ộ|ổ|ỗ|ơ|ờ|ớ|ợ|ở|ỡ/g,"o");
                str = str.replace(/ù|ú|ụ|ủ|ũ|ư|ừ|ứ|ự|ử|ữ/g,"u");
                str = str.replace(/ỳ|ý|ỵ|ỷ|ỹ/g,"y");
                str = str.replace(/đ/g,"d");
                str = str.replace( /[\s\n\r]+/g,' ');
                str = str.replace(/[^a-z0-9_-]/gi, '-'); // Chuyen ki tu dac biet -> "-"s
                return str;
            }

            $("#add-media").mediaupload({
                token:"{{Session::token()}}",
                url: "{{URL::to("media/upload")}}",
                "multi-select": true,
                complete: function (data) {
                    if (data != null) {
                        if (data.length) {
                            $.each(data, function (i, image) {
                                var ed = tinyMCE.get('editor-create');
                                var range = ed.selection.getRng();
                                var newNode = ed.getDoc().createElement("img");
                                newNode.className = "img-responsive";
                                newNode.src = image.src;
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

                $.blockUI({message: '<div class="block-ui"><i class="icon-spin2 animate-spin"></i> Đang lưu trang </div>'});
                $.ajax({
                    type: "POST",
                    url: "{{URL::to('qtri-choidau/setting/page/save')}}",
                    data: {'id':id, 'title': title, 'alias': alias, 'content': content, 'action': 'create'},
                    dataType: 'json',
                    success: function (respon) {
                        if(respon != -1){
                            window.location = '{{URL::to('qtri-choidau/setting/page/')}}-'+respon+'/edit';
                        }else{
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