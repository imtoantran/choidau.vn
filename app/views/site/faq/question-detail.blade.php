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
        <div class="row question-detial-head margin-none">
            <div class="col-sm-12 col-md-12 col-lg-12 col-none-padding">
                <div class="row ">
                    <div class="col-md-2 col-sm-2 col-none-padding text-center">
                        @if($post_question['user']['avatar'])
                            <img width="100px" src="{{URL::to('/')}}{{$post_question['user']['avatar']}}" alt="" class="avatar-pad2">
                        @else
                            <img width="100px" src="{{URL::to('assets/global/img/no-image.png')}}" alt="" class="avatar-pad2">
                        @endif
                    </div>
                    <div class="col-md-10 col-sm-10 col-none-padding">
                        <div class="row margin-none">
                            <div class="col-md-9 col-sm-9 col-none-padding">
                                <header><h2>{{$post_question['title']}}</h2></header>
                            </div>
                            <div class="col-md-3 col-sm-3 text-right">
                                @if(Auth::check())
                                    @if(Auth::user()->id == $post_question['user_id'])
                                        <button class="btn btn-sm bg-yellow-lemon @if($post_question['status'] == 0){{'btn-close-question'}}@endif  tooltips" data-type="close" data-original-title="@if($post_question['status'] == 0){{'Đóng câu hỏi'}}@else{{'Câu hỏi này đã đóng.'}}@endif" data-post-id="{{$post_question['id']}}">
                                            <i class="icon-@if($post_question['status'] == 0){{'lock'}}@else{{'cancel'}}@endif white" style="font-size: 16px;">
                                            </i> <span>@if($post_question['status'] == 0){{'Đóng'}}@else{{'Đã đóng'}}@endif</span>
                                        </button>
                                    @endif
                                @endif
                            </div>
                        </div>
                        <div>
                            Bởi: <a class="text-style" href="{{$post_question['user_url']}}">@if(empty($post_question['user']['fullname'])){{$post_question['user']['username']}}@else {{$post_question['user']['fullname']}}@endif</a>
                            - {{$post_question['latest_date']}}
                        </div>
                        <div class="grey"><span class="total-comment badge badge-default total-answer">{{count($arr_answer)}}</span> Phản hồi</div>
                        <div class="padding-top-10">
                            - {{$post_question['content']}}
                        </div>
                    </div>
                </div>

                {{--post answer--}}
                <div class="row post-answer-wrapper">
                    @if(Auth::check())
                        <div class="col-md-1 padding-left-5">
                            @if($post_question['user']['avatar'])
                                <img src="{{URL::to('/')}}{{Auth::user()->avatar}}" alt="" class="avatar-pad2">
                            @else
                                <img src="{{URL::to('assets/global/img/no-image.png')}}" alt="" class="avatar-pad2">
                            @endif                        </div>
                        <div class="col-md-11 col-none-padding">
                            <textarea name="post-answer-input" id="post-answer-input" autofocus data-post-id="{{$post_question['id']}}" rows="2" placeholder="@if($post_question['status'] == 0){{'Nhập phản hồi...'}}@else{{'Chủ đề đã kết thúc...'}}@endif " @if($post_question['status'] == 1){{'disabled'}}@endif></textarea>
                        </div>
                    @else
                        <div class="italic grey">
                            <i class="icon-pencil grey"></i>
                            Hãy <span class="text-style require-login text-link " data-url="{{URL::current()}}">đăng nhập</span> để phản hồi câu hỏi này.

                        </div>

                    @endif
                </div>

            </div>
        </div>



        <div class="row text-center grey-light padding-5 box-answer-load">......................<i class="icon-feather grey"></i>......................</div>
        {{--list answer--}}
        <div class="row">

            <div class="col-sm-12 col-md-12 col-lg-12 answer-list-wrapper">
                @if(count($arr_answer) > 0)
                    @foreach($arr_answer as $key=>$val)
                        <div class="media">
                            <a href="#" class="pull-left text-center">
                                @if(!empty($val['user']['avatar']))
                                    <img src="{{URL::to('/')}}{{$val['user']['avatar']}}" alt="" class="media-object avatar-pad2">
                                @else
                                    <img src="{{URL::to('assets/global/img/no-image.png')}}" alt="" class="media-object avatar-pad2">
                                @endif
                            </a>

                            <div class="media-body">
                                <div>
                                    <a class="text-style" href="{{$val['user_url']}}">@if(empty($val['user']['fullname'])){{$val['user']['username']}}@else {{$val['user']['fullname']}}@endif</a>
                                    - <span>{{$val['content']}}</span>
                                </div>
                                <span class="grey"> phản hồi - {{$val['latest_date']}}</span>
                            </div>
                        </div>
                    @endforeach
                    {{ $arr_answer->links() }}

                @else
                    <div class="italic grey">
                        <i class="icon-pencil grey"></i>
                        Chưa có <span class="text-style text-link auto-answer">phản hồi</span> cho câu hỏi này.

                    </div>
                @endif
            </div>
        </div>
    </div>
    @include("site.faq.create-popup")
@stop

@section('scripts')
    <script type="text/javascript">
        jQuery(document).ready(function () {
            $('.auto-answer').click(function(){
                $('#post-answer-input').focus();
            });
            $('#post-answer-input').keypress(function (e) {
                var parent_tag = $('.answer-list-wrapper');
                var self = $(this);
                var code = e.keyCode || e.which;
                if (code == 13) { //Enter keycode
                    var content = self.val();
                    var post_id = self.attr('data-post-id');
                    $('.box-answer-load i').iconLoad('icon-feather');
                    if ($.trim(content).length <= 0) {
                        alert('Phản hồi không được để trống');
                        self.focus();
                        $('.box-answer-load i').iconUnload('icon-feather');
                        return false;
                    } else {
                        self.prop("disabled", true);
                        $.ajax({
                            type: "POST",
                            url: "{{URL::to('thanh-vien/comment-post')}}",
                            data: {
                                'comment_content': content,
                                'post_type': 'faq-answer',
                                'post_id': post_id
                            },
                            dataType: 'json',
                            success: function (respon) {
                                if (respon.success) {
                                    if(respon.total_row <=1){
                                        parent_tag.html('');
                                    }
                                    self.val('');
                                    var user_name = (respon.user.fullname.length <=0)? respon.user.username: respon.user.fullname;
                                    var html = '';
                                        html += '<div class="media">';
                                        html += '<a href="#" class="pull-left text-center">';
                                            if(respon.user.avatar.length >0){
                                                html += '<img src="{{URL::to('/')}}'+respon.user.avatar+'" alt="" class="media-object avatar-pad2">';
                                            }
                                            else{
                                                html += '<img src="{{URL::to('assets/global/img/no-image.png')}}" alt="" class="media-object avatar-pad2">';
                                            }
                                        html += '</a>';

                                        html += '<div class="media-body">';
                                        html += '<div>';
                                        html += '<a class="text-style" href="'+respon.user_url+'">'+user_name+'</a>';
                                        html += '- <span>'+respon.content+'</span>';
                                        html += '</div>';
                                        html += '<span class="grey"> phản hồi - Vừa xong</span>';
                                        html += '</div>';
                                        html += '</div>';
                                    parent_tag.prepend(html);
                                    $('.total-answer').text(respon.total_row);
                                    self.prop("disabled", false);
                                    self.focus();
                                }
                            },
                            complete : function(){
                                $('.box-answer-load i').iconUnload('icon-feather');
                            }

                        });
                    }
                }
            });


            // dong/ mo chu de
            $('.btn-close-question').on('click', function(){
                var cf = confirm('Bạn muốn đóng câu hỏi này?');
                if(cf){
                    var self = $(this);
                    var icon = '';
                    if(self.attr('data-type') == 'close'){
                        self.find('i').iconLoad('icon-lock');
                        self.prop('disabled',true);
                        $.ajax({
                            type: "POST",
                            url: "{{URL::to('thanh-vien/close-question')}}",
                            data: {
                                'post_type': self.attr('data-type'),
                                'post_id': self.attr('data-post-id')
                            },
                            dataType: 'json',
                            success: function (respon) {
                                if(respon){

                                    self.find('i').iconUnload('icon-cancel');
                                    self.attr('data-original-title', 'Câu hỏi đã đóng');
                                    self.find('span').text('Đã đóng');
                                    $('#post-answer-input').prop({'disabled':true,'placeholder':'Câu hỏi này đã kết thúc...'});
                                }else{
                                    alert('Xin vui lòng thử lại');
                                }
                            }

                        });
                    }
                }


            })
        });
    </script>
@stop