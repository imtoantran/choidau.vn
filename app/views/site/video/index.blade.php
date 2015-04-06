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

    <div class="row margin-top-10">
        <!-- header left -->
        <div class="col-sm-6 col-md-8 col-lg-8 ">
            <div class="bg-primary page-title">
                <header>VIDEO</header>
                <small>Cùng chia sẻ những video hot nhất mà bạn có...</small>
            </div>
        </div>
        <!-- header left end -->
        <!-- tao chu de -->
        <div class="col-xs-12 col-sm-6 col-md-4 col-lg-4">
            <a href="{{URL::to('video/tao-moi.html')}}" class="btn bg-yellow-lemon btn-load-add-video  @if(Auth::check()){{'btn-popup-video'}}@else{{'require-login'}}@endif " style="width: 100%; font-weight: 600; padding: 12px;" data-url="{{URL::current()}}">
                <i class="icon-plus white" style="font-size: 20px; line-height: 16px;"></i> <span>Thêm video của bạn</span>
            </a>
        </div>
        <!-- tao chu de end -->
    </div>
    <!-- content end-->
    <!-- Video items -->
    <div class="row margin-top-10">
        <!-- video item -->
        @if(count($videos)>0)
            @foreach($videos as $key=>$val)
                <div class="col-xs-12 col-sm-6 col-md-4 col-lg-4" style="margin-bottom: 30px;">
                    <div class="video-item">
                        <div align="" class="embed-responsive embed-responsive-16by9">
                            <iframe src="http://www.youtube.com/embed/{{$val['guid']}}?html5=1"></iframe>
                        </div>
                        <div style="height: 35px;">
                            <a href="{{URL::to('video/chi-tiet-video-'.$val['id'].'.html')}}" class="tooltips" data-original-title="{{$val['title']}}">
                                <b>{{$val['title_limit']}}</b>
                            </a>
                        </div>
                        <small style="font-size: 1em;">Được đăng bởi <a class="bold" href="{{$val['user_url']}}">{{$val['user_name']}}</a> <span class="italic grey">{{$val['date']}}</span> - <span class="font-weight-600">{{$val['viewcount']}}</span> <span class="grey italic">lượt xem</span></small>
                    </div>

                </div>
            @endforeach
        @else

            <div class="col-md-12 co-xs-12 font-weight-600" style="font-size: 1.2em;">
               <i class="icon-folder-empty" style="font-size: 1.2em;"></i> <span>Chưa có video</span>
            </div>
        @endif


        <!-- video item end -->
    </div>
    <!-- Video items end -->
    <!-- imtoantran -->
    </div>

{{--    @include("site.video.create-popup")--}}
@stop


@section('scripts')
<script type="text/javascript">
    jQuery(document).ready(function () {
        {{--$('.btn-popup-video').on('click',function(){--}}
            {{--$('#popup-faq-create').modal('show');--}}
        {{--});--}}

        {{--$('#frm-create-faq').submit(function(e){--}}
            {{--e.preventDefault();--}}
            {{--var self = $(this);--}}
            {{--$.ajax({--}}
                {{--url: '{{URL::to('faq/tao-chu-de.html')}}',--}}
                {{--type: 'post',--}}
                {{--data: self.serialize(),--}}
                {{--success: function(respon){--}}
                    {{--if(respon){--}}
                        {{--alert('Thêm câu hỏi thành công.');--}}
                    {{--}else{--}}
{{--//                        alert('')--}}
                    {{--}--}}
                    {{--window.location = '{{URL::current()}}';--}}
                {{--}--}}
            {{--})--}}

        {{--});--}}
    });
</script>
@stop