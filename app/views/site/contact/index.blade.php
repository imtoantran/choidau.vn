@extends('site.layouts.default')
{{-- Content --}}
@section('content')
    <div class="clearfix" style="margin-bottom: 40px; margin-top: 40px;">
        <form id="contact_form" action="#" method="POST">
            <input type="hidden" name="_token" value="{{{ Session::getToken() }}}">
            <div class="col-md-5">
                <div class="row">
                    <div class="col-md-12" style="font-size: 1.5em; padding:20px;">
                        <i class="icon-website-circled grey" style="font-size: 20px;"></i> <span class="font-yellow-gold">Choi dau</span>
                    </div>
                </div>
                <div class="row">
                   <div class="col-md-12" style="border:1px solid #e6e6e6; padding:2px;">
                       <div data-lat="{{$web_map[0]}}" data-long="{{$web_map[1]}}" id="gmail-contact" class="gmaps col-xs-12 col-sm-12 col-md-12 col-lg-12 gmaps-location  margin-none"  style="height: 200px;" >
                       </div>
                   </div>
                </div>
                <div class="row">
                    <div class="col-md-12" style="font-weight: 500; padding-top: 10px;">
                        {{$web_info}}
                    </div>
                </div>
            </div>

            <div class="col-md-7">
                <div class="contact-wrapper">
                    <div class="clearfix text-center" style="margin-bottom: 20px; margin-top: 20px; font-size: 1.5em;"><i class="icon-vcard grey" style="font-size: 20px;"></i> Liên hệ</div>

                    <div  style="padding: 30px; background-color: #f9f9f9; border: 1px solid #e7e7e7;">
                        <div class="form-group clearfix">
                            <label class="col-lg-3 col-md-3 col-sm-3 control-label">Tên của bạn <span class="red">*</span></label>
                            <div class="col-xs-12 col-sm-12 col-md-9 col-lg-9">
                                <div class="input-group">
                                    <span class="input-group-addon"> <i class="icon-vcard"></i></span>
                                    <input placeholder="Tên của bạn *" class="form-control" name="message_name" id="message_name" pattern=".{5,}" title="Ít nhất 5 ký tự" required  value="@if(Auth::check()){{Auth::user()->display_name()}}@endif">
                                </div>
                            </div>
                        </div>
                        <div class="form-group clearfix">
                            <label class="col-lg-3 col-md-3 col-sm-3 control-label">Email của bạn <span class="red">*</span></label>
                            <div class="col-xs-12 col-sm-12 col-md-9 col-lg-9">
                                <div class="input-group">
                                    <span class="input-group-addon"> <i class="icon-email"></i></span>
                                    <input type="email" placeholder="Email của bạn *" class="form-control" name="message_email" required title="Email của bạn example@host.com" value="@if(Auth::check()){{Auth::user()->email}}@endif">
                                </div>
                            </div>
                        </div>
                        <div class="form-group clearfix">
                            <label class="col-lg-3 col-md-3 col-sm-3 control-label">Tóm tắt <span class="red">*</span></label>
                            <div class="col-xs-12 col-sm-12 col-md-9 col-lg-9">
                                <div class="input-group">
                                    <span class="input-group-addon"> <i class="icon-quote-left"></i></span>
                                    <input placeholder="Tóm tắt nội dung" class="form-control" name="message_title" required>
                                </div>
                            </div>
                        </div>
                        <div class="form-group clearfix">
                            <label class="col-lg-3 col-md-3 col-sm-3 control-label">Nội dung <span class="red">*</span></label>
                            <div class="col-xs-12 col-sm-12 col-md-9 col-lg-9">
                                <textarea name="message_content" title="Nội dung phải từ 6 kí tự." placeholder="Chi tiết thông điệp" rows="5" class="form-control" required style="max-width: 100%;min-width: 100%;min-height: 150px;"></textarea>
                            </div>
                        </div>

                        <div class="form-group clearfix">
                            <label class="col-lg-3 col-md-3 col-sm-3 control-label"></label>
                            <div class="col-xs-12 col-sm-12 col-md-9 col-lg-9">
                                <button type="submit" class="btn btn-success" > Gửi</button>
                                <button type="reset" class="btn btn-default tooltips" data-original-title="Hủy"><i class="icon-arrows-cw"></i></button>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

        </form>
    </div>


@stop
@section('scripts')
    <script src="http://maps.googleapis.com/maps/api/js?sensor=true&amp;libraries=places"></script>
    <script src="{{asset('assets/admin/pages/scripts/maps-google.js')}}"></script>
    <script src="{{asset('assets/global/plugins/gmaps/gmaps.min.js')}}"></script>

    <script type="text/javascript">
    jQuery(document).ready(function () {
        var position_lat = $('#gmail-contact').attr('data-lat')
        var position_lng = $('#gmail-contact').attr('data-long')
        var map = new GMaps({
            div: '#gmail-contact',
            lat: position_lat,
            lng: position_lng,
            zoom: 12
        });
        map.addMarker({
            lat: position_lat,
            lng: position_lng
        });


        $('#contact_form').submit(function(e){
            e.preventDefault();
            $.ajax({
                url: '{{URL::to('lien-he/tao-moi.html')}}',
                type: 'post',
                data: $(this).serialize(),
                success: function(respon){
                    if(respon){
                        var htmlBox = "";
                        htmlBox += '<div class="clearfix"><div class="col-md-12 padding-0">';
                        htmlBox += '<div class="portlet light bg-inverse margin-bottom-0">';
                        htmlBox += '<div class="portlet-title">';
                        htmlBox += '<div class="caption font-purple-plum">';
                        htmlBox += '<i class="icon-place font-purple-plum"></i>';
                        htmlBox += '<span class="caption-subject bold font-green"> Choidau thông báo:</span>';

                        htmlBox += '</div>';
                        htmlBox += '</div>';
                        htmlBox += '<div class="portlet-body ">';
                        htmlBox += '<p>Xin chào <label class="color-red">'+$('#message_name').val()+'</label> !</p>';
                        htmlBox += '<p>Bạn vừa góp ý kiến thành công !</p>';
                        htmlBox += '<p class="italic grey"><i class="icon-alert"></i> Cảm ơn bạn vì  đã đồng hành cùng <label class="green"><strong>Choidau</strong></label>. Mọi đóng góp ý kiến của bạn sẽ được ghi nhận và xử lý nhanh nhất.</p>';
                        htmlBox += '<div class="margin-top-20 text-center">';
                        htmlBox += '<a href="{{URL::to('/')}}" class="btn btn btn-warning btn-sm">';
                        htmlBox += '<i class="icon-logout" style="color: #444;"></i> Trang chủ </a>';
                        htmlBox += '</div>';
                        htmlBox += '</div>';
                        htmlBox += '</div>';
                        htmlBox += '</div>';

                        bootbox.dialog({
                            message: htmlBox,
                            closeButton: false
                        });
                    }
                }
            });
        })
    });
</script>
@stop