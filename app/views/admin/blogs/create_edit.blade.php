@extends('admin.layouts.main')

{{-- Content --}}
@section('content')
    {{-- Edit Blog Form --}}
    <form class="form-horizontal" method="post"
          action="@if (isset($post)){{ URL::to('qtri-choidau/blog/' . $post->id . '/edit') }}@endif" autocomplete="off">
    <div class="col-xs-9 col-sm-9 col-md-9 col-lg-9">
    <!-- Tabs -->
    <ul class="nav nav-tabs">
        <li class="active"><a href="#tab-general" data-toggle="tab">General</a></li>
        <li><a href="#tab-meta-data" data-toggle="tab">Meta data</a></li>
    </ul>
    <!-- ./ tabs -->

        <!-- CSRF Token -->
        <input type="hidden" name="_token" value="{{{ csrf_token() }}}"/>
        <!-- ./ csrf token -->
        @if(isset($catId))
            <input name="catId" value="{{$catId}}" type="hidden"/>
            @endif
                    <!-- Tabs Content -->
            <div class="tab-content">
                <!-- General tab -->
                <div class="tab-pane active" id="tab-general">
                    <!-- Post Title -->
                    <div class="form-group {{{ $errors->has('title') ? 'error' : '' }}}">
                        <div class="col-md-12">
                            <input placeholder="Tiêu đề bài viết" class="form-control" type="text" name="title" id="title"
                                   value="{{{ Input::old('title', isset($post) ? $post->title : null) }}}"/>
                            {{ $errors->first('title', '<span class="help-block">:message</span>') }}
                        </div>
                    </div>
                    <!-- ./ post title -->

                    <!-- Content -->
                    <div class="form-group {{{ $errors->has('content') ? 'has-error' : '' }}}">
                        <div class="col-md-12">
                            <textarea class="form-control full-width wysihtml5" name="content" value="content"
                                      rows="10">{{{ Input::old('content', isset($post) ? $post->content : null) }}}</textarea>
                            {{ $errors->first('content', '<span class="help-block">:message</span>') }}
                        </div>
                    </div>
                    <!-- ./ content -->
                </div>
                <!-- ./ general tab -->

                <!-- Meta Data tab -->
                <div class="tab-pane" id="tab-meta-data">
                    <!-- Meta Title -->
                    <div class="form-group {{{ $errors->has('meta-title') ? 'error' : '' }}}">
                        <div class="col-md-12">
                            <label class="control-label" for="meta-title">Meta Title</label>
                            <input class="form-control" type="text" name="meta-title" id="meta-title"
                                   value="{{{ Input::old('meta-title', isset($post) ? $post->meta_title : null) }}}"/>
                            {{ $errors->first('meta-title', '<span class="help-block">:message</span>') }}
                        </div>
                    </div>
                    <!-- ./ meta title -->

                    <!-- Meta Description -->
                    <div class="form-group {{{ $errors->has('meta-description') ? 'error' : '' }}}">
                        <div class="col-md-12 controls">
                            <label class="control-label" for="meta-description">Meta Description</label>
                            <input class="form-control" type="text" name="meta-description" id="meta-description"
                                   value="{{{ Input::old('meta-description', isset($post) ? $post->meta_description : null) }}}"/>
                            {{ $errors->first('meta-description', '<span class="help-block">:message</span>') }}
                        </div>
                    </div>
                    <!-- ./ meta description -->

                    <!-- Meta Keywords -->
                    <div class="form-group {{{ $errors->has('meta-keywords') ? 'error' : '' }}}">
                        <div class="col-md-12">
                            <label class="control-label" for="meta-keywords">Meta Keywords</label>
                            <input class="form-control" type="text" name="meta-keywords" id="meta-keywords"
                                   value="{{{ Input::old('meta-keywords', isset($post) ? $post->meta_keywords : null) }}}"/>
                            {{ $errors->first('meta-keywords', '<span class="help-block">:message</span>') }}
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
                <label for="featured_post">Đánh dấu bài viết nổi bật.</label>
            </div>
        </div>
        <div class="portlet solid">
            <div class="portlet-title">
                <div class="caption">Hình ảnh tiêu biểu</div>
            </div>
            <div class="portlet-body">
                <div class="featured-image-wrap">
                    <img src="{{asset("assets/global/img/no-image.png")}}">
                </div>
            </div>
        </div>
        <!-- Form Actions -->
        <div class="form-group">
            <div class="col-md-12">
                <element class="btn-cancel btn-xs close_popup">Hủy</element>
                <button type="reset" class="btn btn-xs btn-default">Khôi phục</button>
                <button type="submit" class="btn btn-xs btn-success">Lưu</button>
            </div>
        </div>
        <!-- ./ form actions -->

    </div>
        <div class="clearfix"></div>
    </form>
@stop

@section("scripts")
    <script src="{{asset("assets/global/plugins/uploadify/jquery.uploadify.min.js")}}"></script>
    <script type="text/javascript">
        $(document).ready(function () {
            $('.close_popup').click(function () {
                parent.oTable.fnReloadAjax();
                parent.jQuery.fn.colorbox.close();
                return false;
            });

            $('#deleteForm').submit(function (event) {
                var form = $(this);
                $.ajax({
                    type: form.attr('method'),
                    url: form.attr('action'),
                    data: form.serialize()
                }).done(function () {
                    parent.jQuery.colorbox.close();
                    parent.oTable.fnReloadAjax();
                }).fail(function () {
                });
                event.preventDefault();
            });

            if ($('.wysihtml5').size() > 0) {
                tinymce.init({
                    selector: ".wysihtml5",
                    menubar: false,
                    plugins: [
                        "advlist autolink lists link image charmap print preview anchor",
                        "searchreplace visualblocks code fullscreen",
                        "insertdatetime media table contextmenu paste",
                        "autoresize",
                        "preview", "image", "code", "wordcount", "textcolor"
                    ],
                    toolbar: " code | preview | insertfile undo redo | styleselect | bold italic forecolor backcolor | alignleft aligncenter alignright alignjustify | bullist numlist outdent indent | link image "
                });
            }
        });
    </script>
@stop

@section("styles")
    <link rel="stylesheet" href="{{asset("assets/global/plugins/uploadify/uploadify.css")}}"/>
    @stop