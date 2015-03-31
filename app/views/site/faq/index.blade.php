@extends('site.layouts.right_sidebar')
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
@section('sidebar')
    @include("site.faq.sidebar")
@stop

{{-- Content --}}
@section('content')

    <div class="col-sm-12 col-md-9 col-lg-9 padding-left-0">
        <!-- first row -->
        <div class="row">
            <!-- header left -->
            <div class="col-sm-6 col-md-8 col-lg-8">
                <div class="bg-primary page-title">
                    <header style="font-weight: 600;">Hỏi thành viên ({{count($arr_question)}})</header>
                    <small>Diễn đàn trao đổi giữa các members...</small>
                </div></div>
            <!-- header left end -->
            <!-- tao chu de -->
            <div class="col-sm-6 col-md-4 col-lg-4 padding-left-0">

                <div href="#" class="page-title bg-yellow-lemon text-center btn-popup-faq-class @if(Auth::check()){{'btn-popup-faq'}}@else{{'require-login'}}@endif" data-url="{{URL::current()}}">
                    <i class="icon-edit white" style="font-size: 20px; line-height: 16px;"></i> Tạo chủ đề
                </div>
            </div>
            <!-- tao chu de end -->
        </div>
        <!-- first row end-->

        <!-- comment items -->
        <div class="row faq-question-wrapper margin-tb-5">
            <div class="col-xs-12 col-sm-12 col-md-12 col-lg-12 blog-item ">
                @if(count($arr_question) > 0)
                    @foreach($arr_question as $key=>$val)
                        <div class="media">
                            <a href="{{$val['user_url']}}" class="pull-left text-center">
                                @if($val['user_question']['avatar'])
                                    <img src="{{URL::to('/')}}{{$val['user_question']['avatar']}}" alt="" class="media-object avatar-pad2">
                                @else
                                    <img src="{{URL::to('assets/global/img/no-image.png')}}" alt="" class="media-object avatar-pad2">
                                @endif

                                <small class="font-bold">
                                    @if(empty($val['user_question']['fullname'])){{$val['user_question']['username']}}@else {{$val['user_question']['fullname']}}@endif
                                </small>
                            </a>
                            <a href="{{URL::to('faq/cau-hoi-'.$val['id'].'.html')}}" class="pull-right text-center">
                                <div class="reply-count"><b>{{$val['total_answer']}}</b></div>
                                <small>phản hồi</small>
                            </a>
                            <div class="media-body">
                                <header class="text-primary"><strong><a href="{{URL::to('faq/cau-hoi-'.$val['id'].'.html')}}">{{$val['title']}}</a></strong></header>
                                <p>
                                    {{$val['content']}}
                                </p>
                                <small class="pull-right">{{$val['total_answer']}} phản hồi - {{$val['latest_date']}}</small>
                            </div>
                        </div>
                    @endforeach
                <div class="margin-tb-10"> {{ $arr_question->links() }} </div>
                @else
                    <div class="italic grey">
                        <i class="icon-folder-empty grey"></i>
                        Chủ đề đang rỗng.
                    </div>
                @endif
            </div>
        </div>
        <!-- items end -->
    </div>
    @include("site.faq.create-popup")
@stop


@section('scripts')
<script type="text/javascript">
    jQuery(document).ready(function () {
        $('.btn-popup-faq').on('click',function(){
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