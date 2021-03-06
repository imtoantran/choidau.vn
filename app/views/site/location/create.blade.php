@extends('site.layouts.default')

@section('content')

    <section id="container">
        <div class="bg-primary">
            <div class="page-header padding-top-10 padding-left-20">
                <h2>Thêm địa điểm</h2>
                <span>Thêm địa điểm yêu thích của bạn để chia sẻ với cộng đồng ngay!</span>
            </div>

        </div>
        <form method="POST" name="location_create" id="location_create" class="form-horizontal choidau-form"
              role="form">
            <input type="hidden" name="_token" id="token-location" value="{{csrf_token()}}"/>
            {{--<input type="hidden" name="location_position" id="location_position" value="(10.776111111111112,106.69583333333334)"/>--}}
            <input type="hidden" name="location_position" id="location_position" value="" data-lat="" data-lng=""/>

            <div class="alert alert-danger display-hide">
                <button class="close location-alert-close" data-close="alert"></button>
                Xin vui lòng điền đầy đủ thông tin bên dưới.
            </div>
            <div class="alert alert-success display-hide">
                <button class="close location-alert-close" data-close="alert"></button>
                Tạo địa điểm thành công!
            </div>

            <!-- THÔNG TIN CƠ BẢN -->
            <div class="row">
                <div class="col-xs-10 col-sm-10 col-md-10 col-lg-10 col-xs-offset-1 col-sm-offset-1 col-md-offset-1 col-lg-offset-1 bg-grey-light padding-top-20">
                    <div class="col-md-10 col-md-offset-1">
                        <div class="form-group ">
                            <p class="btn btn-primary"><strong>Thông tin cơ bản</strong>
                            </p>
                        </div>

                        <div class="form-group">
                            <label for="location_name" class="col-sm-3 control-label"><strong>Tên địa
                                    điểm </strong><span class="required">*</span></label>

                            <div class="col-sm-9">
                                <input type="text" name="location_name" id="location_name" class="form-control" value=""
                                       title="">
                            </div>
                        </div>

                        <div class="form-group">
                            <label for="location_address_detail" class="col-sm-3 control-label"><strong>Địa chỉ</strong>
                                <span class="required">*</span></label>

                            <div class="col-sm-9">
                                <input type="text" name="location_address_detail" id="location_address_detail"
                                       class="form-control" value="" title="">
                            </div>
                        </div>

                        <div class="form-group">
                            <label for="location_province" class="col-sm-3 control-label"><strong>Tỉnh thành </strong>
                                <span class="required">*</span></label>

                            <div class="col-sm-5">
                                <select name="location_province" id="location_province" class="form-control" title="">
                                    <option value="">-- Chọn Tỉnh/ Thành phố --</option>
                                    @if (Cache::has('listProvince'))

                                        <?php   $listProvince = Cache::get('listProvince');?>

                                    @else
                                        <?php $listProvince = Province::all();?>

                                        <?php Cache::forever('listProvince', $listProvince);?>

                                    @endif

                                    @foreach($listProvince as $item)
                                        <option value="{{$item->id}}">{{$item->name}}</option>
                                    @endforeach

                                </select>
                            </div>
                            <div class="col-sm-4">
                                <select name="location_district" id="location_district" class="form-control" title="">
                                    <option value="" data-lat="" data-lng="" selected>-- Chọn Quận/ Huyện --</option>
                                </select>
                            </div>
                        </div>

                        <div class="form-group">
                            <label for="location_address_nearly" class="col-sm-3 control-label"><strong>Gần khu
                                    vực</strong></label>

                            <div class="col-sm-9">
                                <input type="text" name="location_address_nearly" id="location_address_nearly"
                                       class="form-control" value="" title="">
                            </div>
                        </div>

                        <div class="form-group">
                            <label for="location_detail_address" class="col-sm-3 control-label"><strong>Địa chỉ chi
                                    tiết</strong></label>

                            <div class="col-sm-9">
                                <input type="text" name="location_detail_address" id="location_detail_address"
                                       class="form-control" value="" title="">
                            </div>
                        </div>

                        <div class="form-group">
                            <label for="location_phone" class="col-sm-3 control-label"><strong>Điện
                                    thoại</strong></label>

                            <div class="col-sm-9">
                                <input type="text" name="location_phone" id="location_phone" class="form-control"
                                       value="" title="">
                            </div>
                        </div>

                        <div class="form-group">
                            <label for="location_email" class="col-sm-3 control-label"><strong>Email</strong></label>

                            <div class="col-sm-9">
                                <input type="text" name="location_email" id="location_email" class="form-control"
                                       value="" title="">
                            </div>
                        </div>

                        <div class="form-group">
                            <label for="location_website"
                                   class="col-sm-3 control-label"><strong>Website</strong></label>

                            <div class="col-sm-9">
                                <input type="text" name="location_website" id="location_website" class="form-control"
                                       value="" title="">
                            </div>
                        </div>

                        <div class="form-group">
                            <label for="location_description" class="col-sm-3 control-label"><strong>Mô tả địa
                                    điểm</strong></label>

                            <div class="col-sm-9">
                                <textarea name="location_description" id="location_description" class="form-control"
                                          value="" title=""></textarea>
                            </div>
                        </div>


                        {{--anh dai dien--}}
                        <div class="form-group">
                            <label class="col-sm-3 control-label"><strong>Ảnh đại diện</strong></label>

                            <div class="col-sm-4 col-md-3 col-lg-3 location-wrapper-img">
                                    <div class="add-picture vertically-centered" style="">
                                        <button id="btn-add-profile-picture" type="button"
                                                class="form-control yellow btn btn-warning text-left" style="color:#fff!important;"><i class="icon-picture" style="font-size: 1.3em;"></i> Chọn ảnh
                                        </button>
                                    </div>
                                    <div class="text-center">
                                        <img id="location-img-url" class="hidden" data-url="/assets/global/img/no-image.png" src="{{asset('assets/global/img/no-image.png')}}" width="100px" alt=""/>
                                        <button type="button" id="location-img-btn-close" class="no-padding hidden location-img-btn-close-item tooltips" data-original-title="Bỏ chọn">
                                                 <i class="icon-cancel-circled"></i>
                                        </button>
                                    </div>
                            </div>
                        </div>

                        {{--album anh--}}
                        <div class="form-group">
                            <label class="col-sm-3 control-label"><strong>Album ảnh</strong></label>

                            <div class="col-sm-9 col-md-9 col-lg-9 location-wrapper-img">
                                <div class="row">
                                    <div class="col-md-4"
                                         style="position: relative;" >
                                        <div class="add-picture vertically-centered" style="">
                                            <button id="btn-add-image" type="button"
                                                    class="form-control yellow btn btn-warning text-left" style="color:#fff!important;"><i
                                                        class="icon-file-image" style="font-size: 1.3em;"></i> Thêm ảnh
                                            </button>
                                        </div>
                                    </div>
                                </div>
                                <div class="row location-album-wrapper">
                                </div>
                            </div>
                        </div>


                        {{--cap nhat vi tri--}}
                        <div class="form-group">
                            <label class="col-sm-3 control-label"><strong>Vị trí</strong></label>

                            <div class="col-sm-4 col-md-3 col-lg-3">
                                <button id="btn-update-position" type="button"
                                        class="form-control yellow btn btn-warning" style="color:#fff!important;"><i class="icon-location pull-left"
                                                                                       style="font-size: 1.3em;"></i>
                                    Cập nhật vị trí
                                </button>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <!-- THÔNG TIN CƠ BẢN END-->

            {{--<!-- THÔNG TIN KHÁC -->--}}
            <div class="row margin-top-15">
                <div class="col-xs-10 col-sm-10 col-md-10 col-lg-10 col-xs-offset-1 col-sm-offset-1 col-md-offset-1 col-lg-offset-1 bg-grey-light padding-top-20">
                    <div class="col-md-10 col-md-offset-1">
                        <div class="form-group ">
                            <p class="btn btn-primary"><strong>Thông tin khác</strong></p>
                        </div>

                        <div class="form-group">
                            <label for="location_price_min" class="col-sm-3 control-label"><strong>Giá thấp
                                    nhất</strong></label>

                            <div class="col-sm-9">
                                <input type="text" name="location_price_min" id="location_price_min"
                                       class="form-control" value="" title="">
                            </div>
                        </div>
                        <div class="form-group">
                            <label for="location_price_max" class="col-sm-3 control-label"><strong>Giá cao nhất</strong></label>

                            <div class="col-sm-9">
                                <input type="text" name="location_price_max" id="location_price_max"
                                       class="form-control" value="" title="">
                            </div>
                        </div>

                        <div class="form-group ">

                            <label for="input" class="col-sm-3 control-label"><strong>Giờ hoạt động</strong></label>

                            <div class="col-sm-9 location-time-action">
                                <table id="" class="table table-bordered table-striped table-condensed flip-content">
                                    <thead>
                                    <tr>
                                        <th class="text-center">Thứ</th>
                                        <th>Giờ bắt đầu</th>
                                        <th>Giờ kết thúc</th>
                                    </tr>
                                    </thead>
                                    <tbody>
                                    <tr>
                                        <td>
                                            <label class="location-time-check-lbl">
                                                <div class="checker"><span>
														<input data-thu="2" class="location-time-check" type="checkbox"
                                                               id="location-time-check-t2" checked></span></div>
                                                Hai
                                            </label>
                                        </td>
                                        <td>
                                            <div class="input-group">
                                                <input id="location-time-start-t2" type="text"
                                                       class="form-control timepicker  timepicker-no-seconds location-time-2"
                                                       value="6:00 AM">
													<span class="input-group-btn">
													<button class="btn default" type="button"><i class="icon-clock"></i>
                                                    </button>
													</span>
                                            </div>
                                        </td>
                                        <td>
                                            <div class="input-group">
                                                <input id="location-time-end-t2" type="text"
                                                       class="form-control timepicker timepicker-no-seconds location-time-2"
                                                       value="11:00 PM">
													<span class="input-group-btn">
													<button class="btn default" type="button"><i class="icon-clock"></i>
                                                    </button>
													</span>
                                            </div>
                                        </td>
                                    </tr>

                                    <tr>
                                        <td>
                                            <label class="location-time-check-lbl">
                                                <div class="checker"><span>
														<input data-thu="3" class="location-time-check" type="checkbox"
                                                               id="location-time-check-t3" checked></span></div>
                                                Ba
                                            </label>
                                        </td>
                                        <td>
                                            <div class="input-group">
                                                <input id="location-time-start-t3" type="text"
                                                       class="form-control timepicker  timepicker-no-seconds location-time-3"
                                                       value="6:00 AM">
													<span class="input-group-btn">
													<button class="btn default" type="button"><i class="icon-clock"></i>
                                                    </button>
													</span>
                                            </div>
                                        </td>
                                        <td>
                                            <div class="input-group">
                                                <input id="location-time-end-t3" type="text"
                                                       class="form-control timepicker timepicker-no-seconds location-time-3"
                                                       value="11:00 PM">
													<span class="input-group-btn">
													<button class="btn default" type="button"><i class="icon-clock"></i>
                                                    </button>
													</span>
                                            </div>
                                        </td>
                                    </tr>

                                    <tr>
                                        <td>
                                            <label class="location-time-check-lbl">
                                                <div class="checker"><span>
														<input data-thu="4" class="location-time-check" type="checkbox"
                                                               id="location-time-check-t4" checked></span></div>
                                                Tư
                                            </label>
                                        </td>
                                        <td>
                                            <div class="input-group">
                                                <input id="location-time-start-t4" type="text"
                                                       class="form-control timepicker  timepicker-no-seconds location-time-4"
                                                       value="6:00 AM">
													<span class="input-group-btn">
													<button class="btn default" type="button"><i class="icon-clock"></i>
                                                    </button>
													</span>
                                            </div>
                                        </td>
                                        <td>
                                            <div class="input-group">
                                                <input id="location-time-end-t4" type="text"
                                                       class="form-control timepicker timepicker-no-seconds location-time-4"
                                                       value="11:00 PM">
													<span class="input-group-btn">
													<button class="btn default" type="button"><i class="icon-clock"></i>
                                                    </button>
													</span>
                                            </div>
                                        </td>
                                    </tr>

                                    <tr>
                                        <td>
                                            <label class="location-time-check-lbl">
                                                <div class="checker"><span>
														<input data-thu="5" class="location-time-check" type="checkbox"
                                                               id="location-time-check-t3" checked></span></div>
                                                Năm
                                            </label>
                                        </td>
                                        <td>
                                            <div class="input-group">
                                                <input id="location-time-start-t5" type="text"
                                                       class="form-control timepicker  timepicker-no-seconds location-time-5"
                                                       value="6:00 AM">
													<span class="input-group-btn">
													<button class="btn default" type="button"><i class="icon-clock"></i>
                                                    </button>
													</span>
                                            </div>
                                        </td>
                                        <td>
                                            <div class="input-group">
                                                <input id="location-time-end-t5" type="text"
                                                       class="form-control timepicker timepicker-no-seconds location-time-5"
                                                       value="11:00 PM">
													<span class="input-group-btn">
													<button class="btn default" type="button"><i class="icon-clock"></i>
                                                    </button>
													</span>
                                            </div>
                                        </td>
                                    </tr>

                                    <tr>
                                        <td>
                                            <label class="location-time-check-lbl">
                                                <div class="checker"><span>
														<input data-thu="6" class="location-time-check" type="checkbox"
                                                               id="location-time-check-t6" checked></span></div>
                                                Sáu
                                            </label>
                                        </td>
                                        <td>
                                            <div class="input-group">
                                                <input id="location-time-start-t6" type="text"
                                                       class="form-control timepicker  timepicker-no-seconds location-time-6"
                                                       value="6:00 AM">
													<span class="input-group-btn">
													<button class="btn default" type="button"><i class="icon-clock"></i>
                                                    </button>
													</span>
                                            </div>
                                        </td>
                                        <td>
                                            <div class="input-group">
                                                <input id="location-time-end-t6" type="text"
                                                       class="form-control timepicker timepicker-no-seconds location-time-6"
                                                       value="11:00 PM">
													<span class="input-group-btn">
													<button class="btn default" type="button"><i class="icon-clock"></i>
                                                    </button>
													</span>
                                            </div>
                                        </td>
                                    </tr>

                                    <tr>
                                        <td>
                                            <label class="location-time-check-lbl">
                                                <div class="checker"><span>
														<input data-thu="7" class="location-time-check" type="checkbox"
                                                               id="location-time-check-t7" checked></span></div>
                                                Bảy
                                            </label>
                                        </td>
                                        <td>
                                            <div class="input-group">
                                                <input id="location-time-start-t7" type="text"
                                                       class="form-control timepicker  timepicker-no-seconds location-time-7"
                                                       value="6:00 AM">
													<span class="input-group-btn">
													<button class="btn default" type="button"><i class="icon-clock"></i>
                                                    </button>
													</span>
                                            </div>
                                        </td>
                                        <td>
                                            <div class="input-group">
                                                <input id="location-time-end-t7" type="text"
                                                       class="form-control timepicker timepicker-no-seconds location-time-7"
                                                       value="11:00 PM">
													<span class="input-group-btn">
													<button class="btn default" type="button"><i class="icon-clock"></i>
                                                    </button>
													</span>
                                            </div>
                                        </td>
                                    </tr>
                                    <tr>
                                        <td>
                                            <label class="location-time-check-lbl">
                                                <div class="checker"><span>
														<input data-thu="8" class="location-time-check" type="checkbox"
                                                               id="location-time-check-t8" checked></span></div>
                                                Chủ nhật
                                            </label>
                                        </td>
                                        <td>
                                            <div class="input-group">
                                                <input id="location-time-start-t8" type="text"
                                                       class="form-control timepicker  timepicker-no-seconds location-time-8"
                                                       value="6:00 AM">
													<span class="input-group-btn">
													<button class="btn default" type="button"><i class="icon-clock"></i>
                                                    </button>
													</span>
                                            </div>
                                        </td>
                                        <td>
                                            <div class="input-group">
                                                <input id="location-time-end-t8" type="text"
                                                       class="form-control timepicker timepicker-no-seconds location-time-8"
                                                       value="11:00 PM">
													<span class="input-group-btn">
													<button class="btn default" type="button"><i class="icon-clock"></i>
                                                    </button>
													</span>
                                            </div>
                                        </td>
                                    </tr>
                                    </tbody>
                                </table>
                            </div>
                        </div>

                        {{--danh muc mon an--}}
                        <div class="form-group">
                            <label for="input" class="col-sm-3 control-label"><strong>Danh mục món ăn</strong></label>

                            <div class="col-sm-9 padding-right-0">
                                <div class="portlet box green">
                                    <div class="portlet-title">
                                        <div class="caption">Thực đơn bao gồm</div>
                                        <div class="tools">
                                            <button id="location-food-add" type="button" class="btn btn-default btn-xs">
                                                <i class="icon-plus"></i></button>
                                        </div>
                                    </div>
                                    <div class="portlet-body">
                                        <div class="table-responsive" style="max-height: 202px;">
                                            <table id="location-mn-food"
                                                   class="table table-bordered table-striped table-condensed flip-content">
                                                <thead>
                                                <tr>
                                                    <th>Tên món</th>
                                                    <th>Giá</th>
                                                    <th>Loại món</th>
                                                </tr>
                                                </thead>
                                                <tbody>
                                                <tr>
                                                    <td class="location-food-empty" colspan="3"><i
                                                                class="icon-check-empty"> </i> Danh mục đang rỗng.
                                                    </td>
                                                </tr>
                                                </tbody>
                                            </table>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        {{--end danh muc mon an--}}

                        {{--danh mục tien ich--}}
                        <div class="form-group">
                            <label for="input" class="col-sm-3 control-label"><strong>Danh mục tiện ích</strong></label>

                            <div class="col-sm-9 padding-right-0">
                                <div class="portlet box green">
                                    <div class="portlet-title">
                                        <div class="caption">Danh mục bao gồm</div>
                                        <div class="tools">
                                            <button id="location-food-utility-add" type="button"
                                                    class="btn btn-default btn-xs"><i class="icon-plus"></i></button>
                                        </div>
                                    </div>
                                    <div class="portlet-body">
                                        <div class="table-responsive" style="max-height: 202px;">
                                            <table id="location-mn-utility"
                                                   class="table table-bordered table-striped table-condensed flip-content">
                                                <thead>
                                                <tr>
                                                    <th>Tên tiện ích</th>
                                                </tr>
                                                </thead>
                                                <tbody>
                                                <tr>
                                                    <td class="location-utility-empty"><i class="icon-check-empty"> </i>Danh
                                                        mục đang rỗng.
                                                    </td>
                                                </tr>
                                                </tbody>
                                            </table>

                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        {{--end danh muc tien ich--}}
                    </div>
                </div>
            </div>
            <!-- THUỘC DANH MUC -->
            <div class="row margin-top-15">
                <div class="col-xs-10 col-sm-10 col-md-10 col-lg-10 col-xs-offset-1 col-sm-offset-1 col-md-offset-1 col-lg-offset-1 bg-grey-light padding-top-20">
                    <div class="col-md-10 col-md-offset-1">
                        <div class="form-group ">
                            <p class="btn btn-primary col-xs-3"><strong>Thuộc danh mục</strong></p>

                            <div class="col-sm-9">
                                <select name="location_category" id="location_category" class="form-control" value=""
                                        title="">
                                    <option></option>
                                </select>
                            </div>
                        </div>

                    </div>
                </div>
            </div>


            <!-- THUỘC DANH MUC -->
            {{--<!-- THÔNG TIN KHÁC END-->--}}

            <!-- SUBMIT -->
            <div class="row margin-top-15">
                <div class="col-xs-10 col-sm-10 col-md-10 col-lg-10 col-xs-offset-1 col-sm-offset-1 col-md-offset-1 col-lg-offset-1 padding-top-20">
                    <div class="col-md-10 col-md-offset-1">
                        <div class="form-group">
                            <button type="submit" class="btn yellow btn-block" style="color:#fff!important;"><strong>+ Thêm địa điểm</strong></button>
                        </div>
                    </div>
                </div>
            </div>
            <!-- SUBMIT -->
        </form>
    </section>
@stop
@section('js_script')
    Location.initLocationCreate();
@stop
@section("scripts")
    <script>
        $('#location_province').select2();
        $('#location_district').select2();

        // luuhoabk - bat su kien upload anh dai dien cho dia diem
        $("#btn-add-profile-picture").mediaupload({
            url: "{{URL::to("media/upload")}}",
            token: "{{Session::token()}}",
            "multi-select":false,
            complete: function (images) {
                $('#location-img-url').attr({'src':URL+'/'+images[0].thumbnail,'data-url':images[0].src}).removeClass('hidden').fadeIn();
                $(this).removeClass('hidden').fadeIn('fast');

                $('#location-img-btn-close').removeClass('hidden').fadeIn('fast');
                // bat su kien close cho nut bo chon avatar
                $('#location-img-btn-close').click(function(){
                    $(this).addClass('hidden').fadeOut('fast');
                    $('#location-img-url').fadeOut('fast').attr({'src':URL+'/assets/global/img/no-image.png','data-url':'/assets/global/img/no-image.png'});
                });;
            }
        });

        // luuhoabk - bat su kien upload album anh cho dia diem
        $("#btn-add-image").mediaupload({
            url: "{{URL::to("media/upload")}}",
            token: "{{Session::token()}}",
            complete: function (images) {
                $.each(images, function(key,val){
                    var strHTML = '';
                    strHTML +='<img class="img-responsive" src="'+URL+val.thumbnail+'" alt=""/>';
                    strHTML +='<button data-post-id="'+val.id+'" data-img="'+val.src+'" type="button" class="no-padding location-img-btn-close-item" title="Thôi chọn hình" style="margin-left:0px;"><i class="icon-cancel-circled"></i></button>';
                    var htmlTag  = $('<div/>',{class:'col-md-3'}).append(strHTML);

                    htmlTag.find('button').on('click',function(){
                        $(this).closest('.col-md-3').fadeOut('slow').remove();
                    });
                    $('.location-album-wrapper').append(htmlTag);
                });

            }
        });
    </script>
@stop