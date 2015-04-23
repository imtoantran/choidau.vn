@extends("admin.layouts.main")
@section("content")
    {{--page--}}
    <div class="row margin-0 clear-fix" style="margin-bottom: 30px;">
        <div class="margin-top-15 col-md-5 " style="border-bottom: 1px solid #f5f5f5;"></div>
        <div class="col-md-2 text-center font-weight-600 grey" style="line-height: 32px;">Page Option</div>
        <div class="margin-top-15 col-md-5" style="border-bottom: 1px solid #f5f5f5;"></div>
    </div>
    @if(isset($page) && count($page))
        @foreach($page as $key=>$val)
            <div class="row">
                <div class="form-group clearfix" style="line-height: 32px;">
                    <label class="col-md-2 control-label">{{$val->title}}</label>
                    <div class="col-md-6">
                        <div class="input-group">
                            <select name="page-option" id="page-option" class="form-control social-input page-option-item" >
                                <option value="" class="grey">-- Chọn trang --</option>
                                @if(isset($page_option) && count($page_option))
                                    @foreach($page_option as $key1=>$val1)
                                        <option value="{{$val1->id}}" @if($val->content == $val1->id){{'selected'}}@endif>{{$val1->title}}</option>
                                    @endforeach
                                @endif
                            </select>
                        </div>
                    </div>

                    <div class="col-md-2 text-right">
                        <div class="portlet-body">
                            <input @if($val->status) {{"checked"}} @endif type="checkbox" name="social_status" class="social_status" id="{{$val->id}}"/>
                        </div>
                    </div>
                    <div class="col-md-1 padding-left-20">
                        <button class="btn btn-default btn-xs margin-bottom social-update" data-id="{{$val->id}}">
                            <i class="icon-floppy"></i> Lưu
                        </button>
                    </div>
                </div>
            </div>
        @endforeach
    @endif









    {{--facebook like box--}}
    <div class="row margin-0 clear-fix" style="margin-bottom: 30px;">
        <div class="margin-top-15 col-md-5 " style="border-bottom: 1px solid #f5f5f5;"></div>
        <div class="col-md-2 text-center font-weight-600 grey" style="line-height: 32px;">Facebook like box</div>
        <div class="margin-top-15 col-md-5" style="border-bottom: 1px solid #f5f5f5;"></div>
    </div>
    <div class="row">
        <div class="form-group clearfix" style="line-height: 32px;">
            <label class="col-md-2 control-label">{{$facebook_like_box->title}}</label>
            <div class="col-md-6">
                <div class="input-group">
                            <span class="input-group-addon">
                                <i class="icon-{{$facebook_like_box->icon}}"></i>
                            </span>
                    <input id="{{$facebook_like_box->id}}" name="{{$facebook_like_box->type}}" type="text" class="form-control social-input" value="{{$facebook_like_box->content}}">
                            <span class="input-group-addon">
                               <a href="#" class="tooltips social-cancel" data-original-title="Xóa văn bản"><i class="icon-cancel-squared"></i></a>
                            </span>
                </div>
            </div>
            <div class="col-md-2 text-right">
                <div class="portlet-body">
                    <input @if($facebook_like_box->status) {{"checked"}} @endif type="checkbox" name="social_status" class="social_status" id="{{$facebook_like_box->id}}"/>
                </div>
            </div>
            <div class="col-md-1 padding-left-20">
                <button class="btn btn-default btn-xs margin-bottom social-update" data-id="{{$facebook_like_box->id}}">
                    <i class="icon-floppy"></i> Lưu
                </button>
            </div>
        </div>
    </div>






    {{--info website--}}
    <div class="row margin-0 clear-fix" style="margin-bottom: 30px;">
        <div class="margin-top-15 col-md-5 " style="border-bottom: 1px solid #f5f5f5;"></div>
        <div class="col-md-2 text-center font-weight-600 grey" style="line-height: 32px;">Info web</div>
        <div class="margin-top-15 col-md-5" style="border-bottom: 1px solid #f5f5f5;"></div>
    </div>
            <div class="row">
                <div class="form-group clearfix" style="line-height: 32px;">
                    <label class="col-md-2 control-label">{{$hotline->title}}</label>
                    <div class="col-md-6">
                        <div class="input-group">
                            <span class="input-group-addon">
                                <i class="icon-{{$hotline->icon}}"></i>
                            </span>
                            <input id="{{$hotline->id}}" name="{{$hotline->type}}" type="text" class="form-control social-input" value="{{$hotline->content}}">
                            <span class="input-group-addon">
                               <a href="#" class="tooltips social-cancel" data-original-title="Xóa văn bản"><i class="icon-cancel-squared"></i></a>
                            </span>
                        </div>
                    </div>
                    <div class="col-md-2 text-right">
                        <div class="portlet-body">
                            <input @if($hotline->status) {{"checked"}} @endif type="checkbox" name="social_status" class="social_status" id="{{$hotline->id}}"/>
                        </div>
                    </div>
                    <div class="col-md-1 padding-left-20">
                        <button class="btn btn-default btn-xs margin-bottom social-update" data-id="{{$hotline->id}}">
                            <i class="icon-floppy"></i> Lưu
                        </button>
                    </div>
                </div>
            </div>


        <div class="row">
            <div class="form-group clearfix" style="line-height: 32px;">
                <label class="col-md-2 control-label">{{$email->title}}</label>
                <div class="col-md-6">
                    <div class="input-group">
                                     <span class="input-group-addon">
                                    <i class="icon-{{$email->icon}}"></i>
                                </span>
                        <input id="{{$email->id}}" name="{{$email->type}}" type="text" class="form-control social-input" value="{{$email->content}}">
                                <span class="input-group-addon">
                                   <a href="#" class="tooltips social-cancel" data-original-title="Xóa văn bản"><i class="icon-cancel-squared"></i></a>
                                </span>
                    </div>
                </div>
                <div class="col-md-2 text-right">
                    <div class="portlet-body">
                        <input @if($email->status) {{"checked"}} @endif type="checkbox" name="social_status" class="social_status" id="{{$email->id}}"/>
                    </div>
                </div>
                <div class="col-md-1 padding-left-20">
                    <button class="btn btn-default btn-xs margin-bottom social-update" data-id="{{$email->id}}">
                        <i class="icon-floppy"></i> Lưu
                    </button>
                </div>
            </div>
        </div>


    {{--</div>--}}
    <div class="row margin-0 clear-fix" style="margin-bottom: 30px;">
        <div class="margin-top-15 col-md-5 " style="border-bottom: 1px solid #f5f5f5;"></div>
        <div class="col-md-2 text-center font-weight-600 grey" style="line-height: 32px;">Mobile App</div>
        <div class="margin-top-15 col-md-5" style="border-bottom: 1px solid #f5f5f5;"></div>
    </div>


    {{--<div style="background-color: #f5f5f5; padding: 10px;">--}}
        @if(isset($mobile_app) && count($mobile_app))
            @foreach($mobile_app as $key=>$val)
                <div class="row">
                    <div class="form-group clearfix" style="line-height: 32px;">
                        <label class="col-md-2 control-label">{{$val->title}}</label>
                        <div class="col-md-6">
                            <div class="input-group">
                                 <span class="input-group-addon">
                                        <i class="icon-{{$val->icon}}"></i>
                                     <img width="60px"  src="{{URL::to($val->icon)}}" alt=""/>
                                 </span>
                                <input id="{{$val->id}}" name="{{$val->type}}" type="text" class="form-control social-input" value="{{$val->content}}">
                            <span class="input-group-addon">
                               <a href="#" class="tooltips social-cancel" data-original-title="Xóa văn bản"><i class="icon-cancel-squared"></i></a>
                            </span>
                            </div>
                        </div>
                        <div class="col-md-2 text-right">
                            <div class="portlet-body">
                                <input @if($val->status) {{"checked"}} @endif type="checkbox" name="social_status" class="social_status" id="{{$val->id}}"/>
                            </div>
                        </div>
                        <div class="col-md-1 padding-left-20">
                            <button class="btn btn-default btn-xs margin-bottom social-update" data-id="{{$val->id}}">
                                <i class="icon-floppy"></i> Lưu
                            </button>
                        </div>
                    </div>
                </div>
            @endforeach
        @endif
    {{--</div>--}}
    <div class="row margin-0 clear-fix" style="margin-bottom: 30px;">
        <div class="margin-top-15 col-md-5 " style="border-bottom: 1px solid #f5f5f5;"></div>
        <div class="col-md-2 text-center font-weight-600 grey" style="line-height: 32px;">Social Link</div>
        <div class="margin-top-15 col-md-5" style="border-bottom: 1px solid #f5f5f5;"></div>
    </div>


    @if(isset($social) && count($social))
        @foreach($social as $key=>$val)
            <div class="row">
                <div class="form-group clearfix" style="line-height: 32px;">
                    <label class="col-md-2 control-label">{{$val->title}}</label>
                    <div class="col-md-6">
                        <div class="input-group">
                            <span class="input-group-addon">
                                <i class="icon-{{$val->icon}}"></i>
                            </span>
                            <input id="{{$val->id}}" name="{{$val->type}}" type="text" class="form-control social-input" value="{{$val->content}}">
                            <span class="input-group-addon">
                               <a href="#" class="tooltips social-cancel" data-original-title="Xóa văn bản"><i class="icon-cancel-squared"></i></a>
                            </span>
                        </div>
                    </div>
                    <div class="col-md-2 text-right">
                            <div class="portlet-body">
                                <input @if($val->status) {{"checked"}} @endif type="checkbox" name="social_status" class="social_status" id="{{$val->id}}"/>
                            </div>
                    </div>
                    <div class="col-md-1 padding-left-20">
                        <button class="btn btn-default btn-xs margin-bottom social-update" data-id="{{$val->id}}">
                            <i class="icon-floppy"></i> Lưu
                        </button>
                    </div>
                </div>
            </div>
        @endforeach
    @endif
    <div class="margin-bottom-20"></div>
@stop

@section("scripts")
    <script type="text/javascript">
        $(document).ready(function () {
            function formatState (state) {
                if (!state.id) { return state.text; }
                var $state = $(
                        '<div><i class="icon-doc-text"></i> <span class="font-weight-600">'+ state.text+'</span></div>'
                );
                return $state;
            };
            $(".page-option-item").select2({templateResult: formatState});

            $("input[name=social_status]").bootstrapSwitch({
                size: "small",
                onColor: "success",
                offColor: "warning",
                onText: "Hiện",
                offText: "Ẩn"
            });

            $('.social-cancel').on('click',function(e){
                e.preventDefault();
                $(this).closest('.form-group').find('.social-input').val('');
            });

            // social update
            $('.social-update').on('click', function(){
                var self = $(this);
                var status = (self.closest('.form-group').find('.social_status').is(':checked'))?1:0;
                var link = self.closest('.form-group').find('.social-input').val();
                var social_id = self.attr('data-id');
                {{--var script_content = self.closest('.form-group').find('.script-content').val();--}}
                self.prop('disabled',true).find('i').iconLoad('icon-floppy');
                $.ajax({
                    type: "POST",
                    url: "{{URL::to('qtri-choidau/setting/social/update')}}",
                    data: {'social_id':social_id, 'social_status': status, 'social_link':link},
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