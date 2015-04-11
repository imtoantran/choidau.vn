@extends("admin.layouts.main")
@section("content")
    @if(isset($location))
        <div class="row">
            <div class="col-md-6 col-sm-6 margin-none">
                <select class="form-control select2me" lang="vi" name="location-list" id="location-list">
                    <option value="">Chọn địa điểm...</option>
                    @foreach($location as $key=>$val)
                        <option value="{{$val['id']}}" @if(isset($location_id)))@if($val['id'] == $location_id){{'selected'}}@endif @endif>{{$val['name']}}</option>
                    @endforeach
                </select>
            </div>
            <div class="col-md-1 col-sm-1">
                <a href="{{URL::to('qtri-choidau/media/image/user-location')}}" class="btn btn-success btn-sm"> Tất cả</a>
            </div>
            @if(isset($goto_location) && !empty($goto_location))
                <div class="col-md-2 col-sm-2">
                    <a href="{{$goto_location}}" class="btn btn-default btn-sm">
                         Đến địa điểm
                        <i class="icon-export"></i>
                    </a>
                </div>
            @endif
        </div>
    @endif
    <div class="row">
        <div class="col-md-12 col-sm-12">
            <div class="row">
            @if(count($images_events))
                @foreach($images_events as $key=>$val)
                            <div class="col-md-2 col-sm-2 text-center margin-top-20 media-image-item">
                                <div style="background-color: #f8f8f8!important;  border: 1px solid #ddd !important;">
                                    <div style="padding: 5px; position: relative;" class="text-left">
                                        <a href="#" class="red image-item-delete" data-image-id="{{$val->id}}" data-type="{{$type_image}}" data-parent-id="{{$val->parent_id}}" style="position: absolute; top: 5px;right: 5px; background-color: #fff; border: 1px solid #ddd;">
                                            <i class="icon-trash"></i>
                                        </a>
                                        <a class="image-item-edit" href="{{URL::to('qtri-choidau/media/image-').$type_image.'-'.$val->id.'-'.$val->parent_id.'/edit'}}" style="position: absolute; top: 30px;right: 5px; background-color: #fff; border: 1px solid #ddd;">
                                            <i class="icon-wrench"></i>
                                        </a>
                                        <img class="text-left img-responsive" src="{{$val->thumbnail}}" style="background-color: #fff; padding: 3px; border: 1px solid #f9f9f9;">
                                    </div>
                                    <div style="background-color: #e5e5e5; padding: 5px; margin: 2px;" class="tooltips" data-original-title="{{$val->title}}">
                                        {{Str::limit($val->title,15)}}
                                    </div>
                                </div>
                            </div>
                @endforeach
            @else
                <div class="col-sm-12 col-md-12">
                    Danh sách rỗng.
                </div>
            @endif
            </div>

        </div>
    </div>
    <div class="margin-tb-10"> {{ $images_events->links() }} </div>

    {{--<div class="row">--}}
        {{--<div class="col-md-12 col-sm-12">--}}
            {{--<div class="row">--}}
                {{--@if(count($images_review))--}}
                    {{--@foreach($images_review as $key=>$val)--}}

                        {{--<div class="col-md-2 col-sm-2 text-center margin-top-20 padding-5">--}}
                            {{--<img src="{{$val->thumbnail}}">--}}
                        {{--</div>--}}
                    {{--@endforeach--}}
                {{--@else--}}
                    {{--<div class="col-sm-12 col-md-12">--}}
                        {{--Danh sách rỗng.--}}
                    {{--</div>--}}
                {{--@endif--}}
            {{--</div>--}}

        {{--</div>--}}
    {{--</div>--}}

    {{--<div class="margin-tb-10"> {{ $images_review->links() }} </div>--}}
@stop

@section("scripts")
    <script type="text/javascript">
        $(document).ready(function () {
            $('.select2me').select2({
                templateResult: formatState
            });

            //load image for location
            $('#location-list').on('change',function(){
                var self = $(this);
                var location_id = self.val();
                if(location_id !=''){
                    window.location = '{{URL::to('qtri-choidau/media/image/user-location-')}}'+location_id;
                }
            });

            //delete image
            $(".image-item-delete").on('click', function(e){
                e.preventDefault();
                var cf = confirm('Bạn muốn xóa tấm ảnh này?');
                if(cf){
                    var self = $(this);
                    self.find('i').iconLoad('icon-trash');
                    $.ajax({
                        url: '{{URL::to('qtri-choidau/media/image/delete')}}',
                        type: 'post',
                        data: {
                            image_id: self.attr('data-image-id'),
                            data_type : self.attr('data-type'),
                            parent_id: self.attr('data-parent-id')
                        },
                        dataType: "json",
                        success: function (respon) {
                            console.log(respon);
                            if(respon){
                                self.closest('.media-image-item').remove();
                            }else{
                                alert('Xóa thất bại, hãy tải lại trang và thử lại.');
                            }
                        },
                        complete: function(){
                            self.find('i').iconUnload('icon-trash');
                        }
                    });
                }
            })


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