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
{{--@section('sidebar')--}}
    {{--@include("site.faq.sidebar")--}}
{{--@stop--}}

{{-- Content --}}
@section('content')

    <div class="row margin-top-10">
        <!-- header left -->
        <div class="col-sm-6 col-md-8 col-lg-8 ">
            <div class="bg-primary page-title">
                <header>VIDEO</header>
                <small>Cùng chia sẻ những video hot nhất mà bạn có...</small>
            </div></div>
        <!-- header left end -->
        <!-- tao chu de -->
        <div class="col-xs-12 col-sm-6 col-md-4 col-lg-4">
            <div class="page-title bg-yellow-lemon text-center">
                <div href="#" style="padding: 7px 5px;" class="btn-popup-faq-class page-title bg-yellow-lemon text-center @if(Auth::check()){{'btn-popup-video'}}@else{{'require-login'}}@endif" data-url="{{URL::current()}}">
                    <i class="icon-edit white" style="font-size: 20px; line-height: 16px;"></i> <span>Tạo chủ đề</span>
                </div>
            </div>
        </div>
        <!-- tao chu de end -->
    </div>
    <!-- content end-->
    <!-- Video items -->
    <div class="row margin-top-10">
        <!-- video item -->

        <div class="col-xs-12 col-sm-6 col-md-4 col-lg-4">
            <div class="video-item">
                <div align="" class="embed-responsive embed-responsive-16by9">
                    <object>
                        <embed src="https://www.youtube.com/v/GdtPdmcu54Q?showinfo=0">
                    </object>
                </div>
                <div><a href="#"><b>Hấp dẫn mọi ánh nhìn...</b></a></div>
                <small>Được đăng bởi karilyne 10/01/2015 - 21 lượt xem</small>
            </div>
        </div>

        <!-- video item end -->
    </div>
    <!-- Video items end -->
    <!-- imtoantran -->
    </div>

    @include("site.video.create-popup")
@stop


@section('scripts')
<script type="text/javascript">
    jQuery(document).ready(function () {
        $('.btn-popup-video').on('click',function(){
            $('#popup-faq-create').modal('show');
        });

        $('#frm-create-faq').submit(function(e){
            e.preventDefault();
            var self = $(this);
            $.ajax({
                url: '{{URL::to('faq/tao-chu-de.html')}}',
                type: 'post',
                data: self.serialize(),
                success: function(respon){
                    if(respon){
                        alert('Thêm câu hỏi thành công.');
                    }else{
//                        alert('')
                    }
                    window.location = '{{URL::current()}}';
                }
            })

        });
    });
</script>
@stop