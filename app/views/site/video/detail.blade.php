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
{{--@section('sidebar')--}}
    {{--@include("site.faq.sidebar")--}}
{{--@stop--}}

{{-- Content --}}
@section('content')

    <div class="col-sm-12 col-md-12 col-lg-12 col-none-padding margin-bottom-15">
        <div class="row question-detial-head margin-none">
            <div class="col-sm-12 col-md-12 col-lg-12 col-none-padding">
                <div class="row">
                    <div class="col-md-12">
                        <div class="bg-primary page-title">
                            <header>VIDEO</header>
                            <small>Cùng chia sẻ những video hot nhất mà bạn có...</small>
                        </div>
                    </div>
                </div>

                <div class="row margin-tb-10">
                    <div class="col-md-6 ">
                        <div class="margin-bottom-10">
                            <i class="icon-youtube" style="font-size: 1.5em;"></i>
                            <span class="font-weight-600 font-14px">{{$video['title']}}</span>
                        </div>
                        <div> -
                            <span class="grey">Đăng bởi:</span>
                            <a href="{{$video['user_url']}}" class="font-weight-600">{{$video['user_name']}}</a>
                            - <span class="grey italic">{{$video['date']}}</span>
                        </div>
                        <div class="margin-tb-5">
                            - <span class="color-red">{{$video['view_count']}}</span> <span class="grey italic">lượt xem</span>
                            - <span class="color-red comment-count">{{$video['comment_count']}}</span> <span class="grey italic">Bình luận</span>
                        </div>
                        <div class="margin-tb-5">
                          - <span class="grey font-weight-600">Địa điểm:</span> <a class="green font-weight-600" href="{{$video['location_url']}}">
                                <i class="icon-location"></i>
                                {{$video['location']}}
                            </a>
                        </div>
                        <div style="border-top: 1px solid #ddd;" class="margin-bottom-5 margin-top-15"></div>
                        <div class="text-justify">
                            <i class="icon-doc grey tooltips" data-original-title="Mô tả chi tiết"></i>
                            @if(empty($video['description']))
                                <span class="text-justify grey italic"> Chưa có mô tả. </span>
                            @else
                                <span> {{$video['description']}} </span>
                            @endif
                        </div>


                        <div style="border-top: 1px solid #ddd;" class="margin-bottom-5 margin-top-20"></div>

                        {{--comment--}}
                        <div class="row margin-none">
                            @if(Auth::check())
                                <div class="col-md-1 col-sm-1 padding-0">
                                    @if($user['avatar'])
                                        <img style="padding: 2px; margin: 0px;" src="{{URL::to('/')}}{{Auth::user()->avatar}}" alt="" class="avatar-pad2 img-responsive">
                                    @else
                                        <img style="padding: 2px; margin: 0px;" src="{{URL::to('assets/global/img/no-image.png')}}" alt="" class="avatar-pad2 img-responsive">
                                    @endif
                                </div>
                                <div class="col-md-11 col-sm-11 col-none-padding">
                                    <input style="padding: 12px 5px 12px 10px; width: 100%; border: 1px solid #ddd; margin-left: 5px;" name="comment" id="comment" autofocus data-post-id="{{$video['id']}}" rows="2" placeholder="Hãy để lại bình luận của bạn về video này">
                                </div>
                            @else
                                <div class="italic grey">
                                    <i class="icon-pencil grey"></i>
                                    Hãy <span class="text-style require-login text-link " data-url="{{URL::current()}}">đăng nhập</span> để bình luận cho video này.
                                </div>

                            @endif
                        </div>

                    </div>
                    <div class="col-md-4 col-md-offset-1">
                        <iframe width="100%" height="200px" src="http://www.youtube.com/embed/{{$video['guid']}}?html5=1"></iframe>
                    </div>
                </div>
            </div>
        </div>



        <div class="row text-center grey-light padding-5 box-answer-load">......................<i class="icon-feather grey"></i>......................</div>
        {{--list answer--}}
        <div class="row">

            <div class="col-sm-12 col-md-12 col-lg-12 answer-list-wrapper">
                @if(count($comment) > 0)
                    @foreach($comment as $key=>$val)
                        <div class="media">
                            <a href="#" class="pull-left text-center">
                                @if(!empty($val['user_avatar']))
                                    <img src="{{URL::to('/')}}{{$val['user_avatar']}}" alt="" class="media-object avatar-pad2">
                                @else
                                    <img src="{{URL::to('assets/global/img/no-image.png')}}" alt="" class="media-object avatar-pad2">
                                @endif
                            </a>

                            <div class="media-body">
                                <div>
                                    <a class="text-style" href="{{$val['user_url']}}">{{$val['user_name']}}</a>
                                    - <span>{{$val['content']}}</span>
                                </div>
                                <span class="grey"> phản hồi - <span class="italic font-12px">{{$val['latest_date']}}</span></span>
                            </div>
                        </div>
                    @endforeach
                    {{ $comment->links() }}

                @else
                    <div class="italic grey">
                        <i class="icon-pencil grey"></i>
                        Chưa có <span class="text-style text-link auto-comment">bình luận</span> cho video này.
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
            $('.auto-comment').click(function(){
                $('#comment').focus();
            });
            $('#comment').keypress(function (e) {
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
                                'post_type': 'comment',
                                'post_id': post_id
                            },
                            dataType: 'json',
                            success: function (respon) {
                                console.log(respon);
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
                                    $('.comment-count').text(respon.total_row);
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



        });
    </script>
@stop