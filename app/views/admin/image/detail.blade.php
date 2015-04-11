@extends("admin.layouts.main")
@section("content")
    {{--{{var_dump($image[0])}}--}}
    <div class="row">
        {{--image--}}
        <div class="col-md-6 col-sm-6 text-center">
            <img class="avatar-pad2 img-responsive" src="{{$image[0]->guid}}" alt=""/>
        </div>

        {{--form--}}
        <div class="col-md-6 col-sm-6">
            <form action="#" role="form" id="frm-image-detail" class="form-horizontal">
                <input type="hidden" id="image_type" name="image_type" value="{{$image_type}}">
                <input type="hidden" id="image_id" name="image_id" value="{{$image_id}}">
                <input type="hidden" id="parent_id" name="parent_id" value="{{$parent_id}}">
                <div class="form-body">
                    <div class="form-group">
                        <label class="col-md-3 control-label" for=""></label>
                        <label class="col-md-7 control-label text-left">
                            <a href="{{URL::to("qtri-choidau/media/image/user-".$image_type)}}"><i class="icon-back"></i><small> Quay lại</small></a>
                        </label>
                    </div>
                    <div class="form-group">
                        <label class="col-md-3 control-label" for="">Tiêu đề</label>
                        <label class="col-md-7 control-label text-left">{{$image[0]->title}}</label>
                    </div>

                    {{--caption--}}
                    <div class="form-group">
                        <label class="col-md-3 control-label" for="">Alternative text</label>
                        <div class="col-md-7">
                            <div class="input-group">
                                <span class="input-group-addon">
                                    <i class="icon-stackexchange"></i>
                                </span>
                                <input type="text" id="alternative_text" name="alternative_text" class="form-control" placeholder="Alternative text" value="{{$image[0]->alternative_text}}" required>
                            </div>
                        </div>
                    </div>

                    {{--caption--}}
                    <div class="form-group">
                        <label class="col-md-3 control-label" for="">Caption</label>
                        <div class="col-md-7">
                            <div class="input-group">
                                <span class="input-group-addon">
                                    <i class="icon-tag"></i>
                                </span>
                                <input type="text" id="caption" name="caption" class="form-control" placeholder="Caption" value="{{$image[0]->caption}}" required>
                            </div>
                        </div>
                    </div>

                    {{--caption--}}
                    <div class="form-group">
                        <label class="col-md-3 control-label" for="">Description</label>
                        <div class="col-md-7">
                            <div class="input-group">
                                <span class="input-group-addon">
                                    <i class="icon-sun"></i>
                                </span>
                                <input type="text" id="description" name="description" class="form-control" placeholder="Description" value="{{$image[0]->descrip}}">
                            </div>
                        </div>
                    </div>

                    <div class="form-actions bottom">
                        <div class="row">
                            <div class="col-md-offset-3 col-md-9">
                                <button type="submit" class="btn green">Cập nhật</button>
                                <button type="reset" class="btn default">Hủy</button>
                            </div>
                        </div>
                    </div>
                </div>
            </form>
        </div>
    </div>
@stop

@section("scripts")
    <script type="text/javascript">
        $(document).ready(function () {

            $('#frm-image-detail').submit(function(e){
                e.preventDefault();
                var self= $(this);
                var alternative_text = $('#alternative_text').val();
                var caption = $('#caption').val();
                $.blockUI({message: '<div class="block-ui"><i class="icon-spin2 animate-spin alert"></i>Đang cập nhật</div>'});
                $.ajax({
                    url: '{{URL::to('qtri-choidau/media/image/edit')}}',
                    type: 'post',
                    data: {frm_image :self.serialize()},
                    dataType: "json",
                    success: function (respon) {
                       if(respon){
                       }else{
                           alert('Cập nhật thất bại, Xin vui lòng thử lại.')
                       }
                    },
                    complete: function(){
                        $.unblockUI();
                    }
                });
            });

            {{--$('.select2me').select2({--}}
                {{--templateResult: formatState--}}
            {{--});--}}

            {{--//load image for location--}}
            {{--$('#location-list').on('change',function(){--}}
                {{--var self = $(this);--}}
                {{--var location_id = self.val();--}}
                {{--if(location_id !=''){--}}
                    {{--window.location = '{{URL::to('qtri-choidau/media/image/user-location-')}}'+location_id;--}}
                {{--}--}}
            {{--});--}}

            {{--//delete image--}}
            {{--$(".image-item-delete").on('click', function(e){--}}
                {{--e.preventDefault();--}}
                {{--var self = $(this);--}}
                {{--self.find('i').iconLoad('icon-trash');--}}
                {{--console.log('chay');--}}
                {{--$.ajax({--}}
                    {{--url: '{{URL::to('qtri-choidau/media/image/delete')}}',--}}
                    {{--type: 'post',--}}
                    {{--data: {--}}
                        {{--image_id: self.attr('data-image-id'),--}}
                        {{--data_type : self.attr('data-type'),--}}
                        {{--parent_id: self.attr('data-parent-id')--}}
                    {{--},--}}
                    {{--dataType: "json",--}}
                    {{--success: function (respon) {--}}
                        {{--if(respon){--}}
                            {{--self.closest('.media-image-item').remove();--}}
                        {{--}else{--}}
                            {{--alert('Xóa thất bại, hãy tải lại trang và thử lại.');--}}
                        {{--}--}}
                    {{--},--}}
                    {{--complete: function(){--}}
                        {{--self.find('i').iconUnload('icon-trash');--}}
                    {{--}--}}
                {{--});--}}
            {{--})--}}


        });

        function formatState (state) {
            if (!state.id) { return state.text; }
            var $state = $(
                    '<div><i class="icon-location-outline"></i> <span class="font-weight-600">'+ state.text+'</span></div>'
            );
            return $state;
        };
    </script>
@stop