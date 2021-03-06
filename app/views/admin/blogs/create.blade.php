@extends('admin.layouts.main')

{{-- Content --}}
@section('content')
    {{-- Edit Blog Form --}}
    {{--{{var_dump(isset($post))}}--}}
    <div class="row">
        <form id="blog_create" class="form-horizontal" method="post" action="#" autocomplete="off">
            <div class="col-xs-9 col-sm-9 col-md-9 col-lg-9">
                <!-- CSRF Token -->
                <input type="hidden" name="_token" value="{{{ csrf_token() }}}"/>
                <!-- ./ csrf token -->
                    <input name="catId" value="{{$catId}}" type="hidden"/>

                    <!-- Tabs Content -->
                    <div class="tab-content">
                        <!-- General tab -->
                        <div class="tab-pane active" id="tab-general">
                            <!-- Post Title -->
                            <div class="form-group">
                                <div class="col-md-12">
                                    <input placeholder="Tiêu đề bài viết" class="form-control" type="text" name="title" id="title" value="" required/>
                                </div>
                            </div>
                            <div class="form-group">
                                <div class="col-sm-10">
                                    <button id="add-media" type="button" class="btn btn-xs btn-success">
                                        <span class="icon icon-upload-cloud"></span>
                                        Thêm hình
                                    </button>
                                </div>
                            </div>

                            <!-- ./ post title -->

                            <!-- Content -->
                            <div class="form-group">
                                <div class="col-md-12">
                                    <textarea id="editor" class="form-control full-width wysihtml5" name="content" value="content"  rows="10"></textarea>
                                </div>
                            </div>
                            <!-- ./ content -->
                        </div>
                        <!-- ./ general tab -->

                        <!-- Meta Data tab -->
                        <div class="tab-pane" id="tab-meta-data">
                            <!-- Meta Title -->
                            <div class="form-group">
                                <div class="col-md-12">
                                    <label class="control-label" for="meta-title">Meta Title</label>
                                    <input class="form-control" type="text" name="meta-title" id="meta-title" value="{{{ Input::old('meta-title', isset($post) ? $post->meta_title : null) }}}"/>
                                </div>
                            </div>
                            <!-- ./ meta title -->

                            <!-- Meta Description -->
                            <div class="form-group">
                                <div class="col-md-12 controls">
                                    <label class="control-label" for="meta-description">Meta Description</label>
                                    <input class="form-control" type="text" name="meta-description" id="meta-description" value=""/>
                                </div>
                            </div>
                            <!-- ./ meta description -->

                            <!-- Meta Keywords -->
                            <div class="form-group">
                                <div class="col-md-12">
                                    <label class="control-label" for="meta-keywords">Meta Keywords</label>
                                    <input class="form-control" type="text" name="meta-keywords" id="meta-keywords" value=""/>
                                </div>
                            </div>
                            <!-- ./ meta keywords -->
                        </div>
                        <!-- ./ meta data tab -->
                    </div>
                    <!-- ./ tabs content -->

            </div>
            <div class="col-xs-3 col-sm-3 col-md-3 col-lg-3">
                <div class="portlet solid">
                    <div class="portlet-title">
                        <div class="caption">Bài viết nổi bật</div>
                    </div>
                    <div class="portlet-body">
                        <input type="checkbox" name="featured_post" id=""/>
                    </div>
                </div>
                <div class="portlet solid">
                    <div class="portlet-title">
                        <div class="caption">Hình đại diện</div>
                    </div>
                    <div class="portlet-body">
                        <div class="media">
                            <div id="featured_image">
                                <img class="media-object" src="{{URL::to('assets/global/img/no-image.png')}}">
                            </div>
                        </div>
                    </div>
                </div>
                <!-- Form Actions -->
                <div class="portlet solid">
                    <div class="portlet-body">
                        <div class="form-group">
                            <div class="col-md-12">
                                <button type="reset" class="btn btn-xs btn-info"><span class="icon icon-cancel"></span>Hủy
                                </button>
                                <button type="submit" class="btn btn-xs btn-success">
                                    <i class="icon-floppy"></i> Lưu
                                </button>
                            </div>
                        </div>
                    </div>
                </div>
                <!-- ./ form actions -->

            </div>
            <div class="clearfix"></div>
            <input name="featured_image" value="" type="hidden"/>
        </form>
    </div>
    <div class="clearfix"></div>
@stop

@section("scripts")
    <script type="text/javascript">
        $(document).ready(function () {
            $('.close_popup').click(function () {
                parent.oTable.fnReloadAjax();
                return false;
            });

            $('#blog_create').submit(function (event) {
                event.preventDefault();
                var form = $(this);
                $.blockUI({message: '<div class="block-ui"><i class="icon-spin2 animate-spin"></i> Đang lưu bài viết </div>'});
                $.ajax({
                    url:'{{URL::to('qtri-choidau/blog/create')}}',
                    type:"post",
                    dataType:"json",
                    data:form.serialize()+'&content_tiny='+tinyMCE.activeEditor.getContent(),
                    success:function(response){
                        if(response){
                            window.location = '{{URL::to('qtri-choidau/blog/')}}/'+response+'/edit';
                        }else{
                            alert('Lỗi bài viết!, Xin vui lòng thử lại.');
                        }
                    },
                    complete:function(){
                        $.unblockUI();
                    }
                });
            });

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


            $("input[name=featured_post]").bootstrapSwitch({
                size: "small",
                onColor: "danger",
                offColor: "warning",
                onText: "Bật",
                offText: "Tắt"
            });

            $("#featured_image").mediaupload({
                token:"{{Session::token()}}",
                url: "{{URL::to("media/upload")}}",
                "multi-select": false,
                complete: function (data) {
                    $("#featured_image").html("<img src='" + data[0].src + "'/>");
                    $("input[name=featured_image]").val(data[0].id);
                }
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
        });
    </script>
@stop

@section("styles")
@stop