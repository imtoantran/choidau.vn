@extends('admin.layouts.main')
@section("content")
    <div class="row" style="background-color: #f7f7f7; margin: 0px;">
        <div class="col-md-12">
            <div class="row" style="padding: 10px;">
                <div class="col-md-8" style="font-size: 1.5em;">
                    <i class="icon-website-circled grey" style="font-size: 20px;"></i> <span class="font-yellow-gold">Cập nhật thông tin</span>
                </div>
                <div class="col-md-4 text-right">
                    <button id="add-media" type="button" class="btn btn-sm btn-warning">
                        <span class="icon icon-upload-cloud"></span>Thêm hình
                    </button>

                    <button id="contact-save-info" class="btn btn-sm btn-success">
                        <i class="icon-floppy"></i>
                        Cập nhật
                    </button>
                </div>
            </div>
            <div class="row mmargin-top-10">
                <div class="col-md-12">
                    <textarea id="editor" class="form-control full-width wysihtml5" name="content" rows="15" >{{$web_info}}</textarea>
                </div>
            </div>
        </div>
    </div>
@stop

@section("scripts")

    <script type="text/javascript">
        jQuery(document).ready(function () {
            tinymce.init({
                selector: "#editor",
                menubar: true,
                plugins: [
                    "advlist autolink lists link image charmap print preview anchor",
                    "searchreplace visualblocks code fullscreen",
                    "insertdatetime media table contextmenu paste",
                    "autoresize",
                    "preview", "image", "code", "wordcount", "textcolor"
                ],
                toolbar: " code | preview | insertfile undo redo | styleselect | bold italic forecolor | alignleft aligncenter alignright alignjustify | bullist numlist outdent indent | link image "
            });

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

            $('#contact-save-info').on('click', function(){
                var content = tinyMCE.activeEditor.getContent();
                $.blockUI({message: '<div class="block-ui"><i class="icon-spin2 animate-spin"></i> Đang cập nhật thông tin </div>'});
                $.ajax({
                    url: '{{URL::to('qtri-choidau/setting/contact/web-info/update')}}',
                    type: "post",
                    data: {content: content},
                    dataType: "json",
                    success: function (respon) {
                        if(respon){
                        }else{
                            alert('Cập nhật thất bại, Xin vui lòng thử lại.');
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