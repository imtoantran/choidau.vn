@extends('site.layouts.default')
@section('topa')
    <!-- banner -->
    <div class="row margin-bottom-10 margin-top-10">
        <div class="col-xs-12 col-sm-12 col-md-12 col-lg-12">
            <div class="banner-top">
                <img src="http://www.collectivehospitality.co.nz/media/1228/col_H_fingerfood.jpg" class="img-responsive" alt="Image">
            </div>
        </div>
    </div>
    <!-- banner end -->
@stop

{{-- Content --}}
@section('content')
    <div class="container">
        <div class="bg-primary">
            <div class="page-header padding-top-10 padding-left-20">
                <h2>Thêm video </h2>
                <span>Thêm VIDEO yêu thích của bạn để chia sẻ với cộng đồng ngay!</span>
            </div>
        </div>
        <form action="#" name="frm-create-video" id="frm-create-video" method="POST" class="form-horizontal margin-bottom-0" role="form">
            <div class="row">

                <div class="col-xs-10 col-sm-10 col-md-10 col-lg-10 col-xs-offset-1 col-sm-offset-1 col-md-offset-1 col-lg-offset-1 bg-grey padding-top-20">
                    <div class="col-md-10 col-md-offset-1">
                        <div class="form-group">
                            <p class="btn btn-primary"><strong>Thông tin video</strong></p>
                        </div>
                        <!-- </div> -->
                        {{--title--}}
                        <div class="form-group">
                            <label for="input" class="col-sm-3 control-label"><strong>Tiêu đề</strong><span class="require"> *</span> </label>
                            <div class="col-sm-9">
                                <input type="text" name="video-title" id="video-title" class="form-control" value="" required="required" title="" placeholder="Nhập tiêu đề cho video">
                            </div>
                        </div>

                        {{--link video--}}
                        <div class="form-group">
                            <label for="input" class="col-sm-3 control-label"><strong>Link video</strong><span class="require"> *</span> </label>
                            <div class="col-sm-9">
                                <input type="text" name="video-link" id="video-link" data-url="" data-valid="false" class="form-control" value="" required="required" placeholder="https://www.youtube.com/xxxxxxx" title="">
                            </div>
                        </div>

                        {{--embed video--}}
                        <div class="form-group">
                            <label for="input" class="col-sm-3 control-label"></label>
                            <div class="col-sm-9" id="embed-video">
                            </div>
                        </div>

                        {{--discription video--}}
                        <div class="form-group">
                            <label for="input" class="col-sm-3 control-label"><strong>Mô tả</strong></label>
                            <div class="col-sm-9">
                                <textarea name="description" id="description" class="form-control" cols="30" rows="5" placeholder="Mô tả chi tiết về video..."></textarea>
                            </div>
                        </div>

                        <div class="form-group">
                            <label for="input" class="col-sm-3 control-label"><strong>Địa điểm </strong><span class="require"> *</span> </label>
                            <div class="col-sm-9" lang="vi" >
                                <select class="form-control select2me" lang="vi" name="location-list" id="location-list">

                                    <option value="">Chọn địa điểm...</option>
                                    @foreach($location as $key=>$val)
                                        <option value="{{$val['id']}}">{{$val['name']}}</option>
                                    @endforeach

                                </select>
                            </div>
                        </div>


                        <!-- ----------------------------------------------------- -->

                        <div class="col-sm-9 col-sm-offset-3 margin-tb-5">
                            <i class="icon-info-circled"></i>
                            <span class="italic" style="color: #949292;">Hãy chọn một địa điểm, hoặc
                                <a class="bold" href="{{URL::to('dia-diem/tao-dia-diem')}}">tạo mới</a>
                                nếu chưa có</span>
                        </div>

                        <!-- submit -->
                        <div class="col-xs-12">
                            <div class="alert alert-danger display-none  alert-error">
                                <button type="button" class="close alert-close"></button>
                                <span>Xin vui lòng điền đầy đủ thông tin bên dưới.</span>
                            </div>
                            <div class="alert alert-success display-none">
                                <button type="button" class="close alert-close"></button>
                                Tạo địa điểm thành công!
                            </div>
                            <div class="form-group">
                                <button type="submit" class="btn btn bg-yellow-lemon btn-create-video form-control">
                                    <strong>+ Đăng video</strong>
                                </button>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

        </form>
    </div>

@stop


@section('scripts')
<script type="text/javascript">

    function formatState (state) {
        if (!state.id) { return state.text; }
        var $state = $(
                '<div><i class="icon-location-outline"></i> <span class="font-weight-600">'+ state.text+'</span></div>'
        );
        return $state;
    };
    jQuery(document).ready(function () {
        $('.select2me').select2({
            templateResult: formatState
        });
        $('#video-link').on('change', function(){
            var _self = $(this);
            var video_id = _self.val().replace('https://www.youtube.com/watch?v=','');
            var posit = video_id.indexOf('&');
            if(posit != -1){
                video_id = video_id.substring(0,posit);
            }
            var video_url = 'http://www.youtube.com/embed/'+video_id+'?html5=1';
            var url_check_video = 'https://gdata.youtube.com/feeds/api/videos/'+video_id+'?v=2&alt=json';
            var str ='';

            $.ajax({
                type:     "get",
                url:      url_check_video,
                dataType: "json",
                error: function(xhr, status, error){
                    str = '<div class="alert alert-danger"><i class="icon-attention" style="color: #D35B6F"></i> Không tìm thấy liên kết đến video</div>';
                    $('#embed-video').html(str);
                    $('#video-link').attr('data-valid','false');
                },
                success: function (respon) {
                    var viewCount = respon.entry.yt$statistics.viewCount;
//                    alert(viewCount);
                    str = '<iframe src="'+video_url+'"></iframe>';
                    $('#embed-video').html(str);
                    $('#video-link').attr({'data-valid':'true','data-url': video_id});

                }
            });
        });

        $('#frm-create-video').submit(function(e){
            e.preventDefault();
            var self = $(this);
            var location_id = $('#location-list').val();
            var video_title = $('#video-title').val();
            var description = $('#description').val();
            var video_link = $('#video-link').attr('data-url');
            var isLinkVideo = $('#video-link').attr('data-valid');
            var str_error = '';
            var isSubmit = true;
            if(location_id == ''){
                str_error += '<div><i class="icon-location" style="color: #D35B6F"></i> Hãy chọn địa điểm cho video</div>';
                isSubmit = false;
            }
            if(isLinkVideo == 'false'){
                str_error += '<div><i class="icon-youtube-play" style="color: #D35B6F"></i> Link video không hợp lệ</div>';
                isSubmit = false;
            }

            if(isSubmit){
                $.blockUI({message: '<div class="block-ui"><i class="icon-spin2 animate-spin"></i> Đang thêm video</div>'});
                $.ajax({
                    url  : '{{URL::to('dia-diem/tao-video')}}',
                    type : "post",
                    data :{
                        location_id : location_id,
                        video_title : video_title,
                        video_link  : video_link,
                        description  : description
                    },
                    dataType: "json",
                    success: function (respon) {
                        if(respon.is_save){
                            var htmlBox = "";
                            htmlBox += '<div class="container-fluid"><div class="col-md-12">';
                            htmlBox += '<div class="portlet light bg-inverse">';
                            htmlBox += '<div class="portlet-title">';
                            htmlBox += '<div class="caption font-purple-plum">';
                            htmlBox += '<i class="icon-place font-purple-plum"></i>';
                            htmlBox += '<span class="caption-subject bold font-green"> Choidau thông báo:</span>';

                            htmlBox += '</div>';
                            htmlBox += '</div>';
                            htmlBox += '<div class="portlet-body ">';
                            htmlBox += '<p>Xin chào <label class="color-red">'+respon.user_name+'</label> !</p>';
                            htmlBox += '<p>Bạn vừa thêm video <label class="label label-success label-sm bold">'+video_title+'</label> thành công !</p>';
                            htmlBox += '<p class="italic grey"><i class="icon-alert"></i> Xin vui lòng chờ admin xác nhận video này trong thời gian sớm nhất.</p>';
                            htmlBox += '<div class="margin-top-20">';
                            htmlBox += '<a href="{{URL::to('video.html')}}" class="btn btn-danger btn-sm">';
                            htmlBox += '<i class="icon-eye color-white"></i> Đi đến video </a> ';
                            htmlBox += '<a href="{{URL::to('video/tao-moi.html')}}" class="btn btn btn-default btn-sm">';
                            htmlBox += '<i class="icon-plus" style="color: #444;"></i> Tạo video khác </a>';
                            htmlBox += '</div>';
                            htmlBox += '</div>';
                            htmlBox += '</div>';
                            htmlBox += '</div>';

                            bootbox.dialog({
                                message: htmlBox,
                                closeButton: true
                            });
                            $('.bootbox button.close').hide();
                            $('.modal-dialog').css({'width':'50%','margin-top':'100px'});
                            $('.modal-content').css('background-color','#f7f7f0');
                        }else{
                            console.log(respon);
                            alert('Sự cố kết nối, vui lòng thử lại.')
                        }
                    },
                    complete: function(){
                        $.unblockUI();
                    }
                });
            }else{
                self.find('.alert-error').fadeIn('fast');
                self.find('.alert-error span').html(str_error);
            }
        });

        $('.alert-close').on('click',function(e){
            e.stopPropagation();
            $(this).parent().fadeOut('fast');
        })

    });
</script>
@stop