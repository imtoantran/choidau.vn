@extends("admin.layouts.main")
@section("content")
    <div class="row">
        <div class="col-md-12 pull-right">

        </div>
	</div>

    <div class="tabbable">
        <ul class="nav nav-tabs">
            @if(count($script_ads))
                @foreach($script_ads as $key=>$val)
                    <li class="@if($key == 0){{'active'}}@endif">
                        <a href="#{{$val->position}}" data-toggle="tab">
                            {{$val->title}}
                        </a>
                    </li>
                @endforeach
            @endif()
        </ul>
        <div class="tab-content no-space">
            {{--tab_head--}}

            @if(count($script_ads))
                @foreach($script_ads as $key=>$val)
                    <div class="tab-pane @if($key == 0){{'active'}}@endif" id="{{$val->position}}">
                        <div class="form-body">
                            <div class="form-group clearfix">
                                <label class="col-md-1 control-label">Mô tả:</label>
                                <div class="col-md-8">
                                    <span class="grey">{{$val->description}}</span>
                                </div>
                            </div>
                        </div>
                        <div class="form-body">
                            <div class="form-group clearfix">
                                <label class="col-md-1 control-label"> code:</label>
                                <div class="col-md-8">
                                    <textarea class="form-control maxlength-handler ads-content" rows="15">{{$val->content}}</textarea>
                                </div>
                                <div class="col-md-2">
                                    <button class="btn btn-success btn-sm margin-bottom ads-update" data-id="{{$val->id}}">
                                        <i class="icon-floppy"></i> Lưu
                                    </button>
                                </div>
                            </div>
                        </div>
                    </div>
                @endforeach
            @endif
        </div>
    </div>
@stop

@section("scripts")
    <script type="text/javascript">
        $(document).ready(function () {
            // script update
            $('.ads-update').on('click', function(){
                var self = $(this);
                var ads_id = self.attr('data-id');
                var ads_content = self.closest('.form-group').find('.ads-content').val();
                self.prop('disabled',true).find('i').iconLoad('icon-floppy');
                $.ajax({
                    type: "POST",
                    url: "{{URL::to('qtri-choidau/ads/update')}}",
                    data: {'ads_id': ads_id, 'ads_content':ads_content},
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
        });
    </script>
@stop