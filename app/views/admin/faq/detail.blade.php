@extends('admin.layouts.main')



@section("content")
    <div class="">
        <h3>
            Hỏi đáp - Chi tiết câu hỏi
        </h3>
    </div>
    <div class="row detail-faq margin-0">
        <div class="col-sm-12 col-md-12 col-lg-12 col-none-padding">
            <div class="row bg-grey-light padding-5 margin-0">
                <div class="col-md-1 col-sm-1 col-none-padding text-center">
                    @if($post_question['user']['avatar'])
                        <img width="80px" height="80px" src="{{URL::to('/')}}{{$post_question['user']['avatar']}}" alt="" class="avatar-pad2">
                    @else
                        <img width="80px" height="80px" src="{{URL::to('assets/global/img/no-image.png')}}" alt="" class="avatar-pad2">
                    @endif
                </div>
                <div class="col-md-11 col-sm-11 padding-left-5 margin-bottom-10">
                    <div class="row margin-0">
                        <div class="col-md-9 col-sm-9 col-none-padding">
                            <header><h4 class="bold">{{$post_question['title']}}</h4></header>
                        </div>
                        <div class="col-md- col-sm-3 text-right">
                            @if(Auth::check())
                                @if(Auth::user()->id == $post_question['user_id'])
                                    <button class="btn btn-sm bg-yellow-lemon btn-close-question tooltips" data-type="@if($post_question['status'] == 0){{'close'}}@else{{'open'}}@endif" data-original-title="@if($post_question['status'] == 0){{'Đóng'}}@else{{'Mở'}}@endif chủ đề" data-post-id="{{$post_question['id']}}">
                                        <i class="icon-@if($post_question['status'] == 0){{'lock'}}@else{{'lock-open'}}@endif white" style="font-size: 16px;">
                                        </i> <span>@if($post_question['status'] == 0){{'Đóng'}}@else{{'Mở'}}@endif</span>
                                    </button>

                                    <button class="btn btn-sm btn-danger btn-question-delete tooltips" data-post-id="{{$post_question['id']}}" data-original-title="Xóa câu hỏi">
                                        <i class="icon-trash white" style="font-size: 16px;">
                                        </i> <span>Xóa</span>
                                    </button>
                                @endif
                            @endif
                        </div>
                    </div>
                    <div>
                        Bởi: <a class="text-style" href="{{$post_question['user_url']}}">@if(empty($post_question['user']['fullname'])){{$post_question['user']['username']}}@else {{$post_question['user']['fullname']}}@endif</a>
                        - {{$post_question['latest_date']}}
                    </div>
                    <div class="grey"><span class="total-comment badge badge-default total-answer">{{$post_question['total_answer']}}</span> Phản hồi</div>
                    <div class="padding-top-10">
                        - {{$post_question['content']}}
                    </div>

                </div>
                <div class="row post-answer-wrapper margin-0">
                    @if(Auth::check())
                        <div class="col-md-1 padding-left-5 padding-right-5 text-right">
                            @if($post_question['user']['avatar'])
                                <img src="{{URL::to('/')}}{{Auth::user()->avatar}}" style="width: 48px; height: 48px;" alt="" class="avatar-pad2">
                            @else
                                <img src="{{URL::to('assets/global/img/no-image.png')}}" style="width: 48px; height: 48px;" alt="" class="avatar-pad2">
                            @endif                        </div>
                        <div class="col-md-11 col-none-padding">
                            <textarea style="width:100%; padding: 5px;" name="post-answer-input" id="post-answer-input" autofocus data-post-id="{{$post_question['id']}}" rows="2" placeholder="@if($post_question['status'] == 0){{'Nhập phản hồi...'}}@else{{'Chủ đề đã kết thúc...'}}@endif " @if($post_question['status'] == 1){{'disabled'}}@endif></textarea>
                        </div>
                    @else
                        <div class="italic grey">
                            <i class="icon-pencil grey"></i>
                            Hãy <span class="text-style require-login text-link " data-url="{{URL::current()}}">đăng nhập</span> để phản hồi câu hỏi này.

                        </div>

                    @endif
                </div>

            </div>
            <div class="row text-center grey-light padding-5 box-answer-load">......................<i class="icon-feather grey"></i>......................</div>
            <div class="row margin-0">
                <div class="col-sm-12 col-md-12 col-lg-12 answer-list-wrapper padding-0">
                    @if(count($arr_answer) > 0)
                        @foreach($arr_answer as $key=>$val)
                            <div class="media margin-bottom-10">
                                <a href="#" class="pull-left text-center">
                                    @if(!empty($val['user']['avatar']))
                                        <img width="60px" height="60px" src="{{URL::to('/')}}{{$val['user']['avatar']}}" alt="" class="media-object avatar-pad2">
                                    @else
                                        <img width="60px" height="60px" src="{{URL::to('assets/global/img/no-image.png')}}" alt="" class="media-object avatar-pad2">
                                    @endif
                                </a>

                                <div class="media-body">
                                    <div>
                                        <a class="text-style" href="{{$val['user_url']}}">@if(empty($val['user']['fullname'])){{$val['user']['username']}}@else {{$val['user']['fullname']}}@endif</a>
                                        - <span>{{$val['content']}}</span>
                                    </div>
                                    <span class="grey"> phản hồi - {{$val['latest_date']}}</span>
                                    <div><a href="#" class="btn btn-warning btn-xs btn-faq-delete" data-post-id="{{$val['id']}}" parent-id="{{$post_question['id']}}"><i class="icon-trash"></i> Xóa</a></div>
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
    </div>
@stop

@section("scripts")
    <script type="text/javascript">
        jQuery(document).ready(function () {
            function deleteAnswer(tag){
                tag.on('click', function(e){
                    var cf = confirm('Bạn muốn xóa phản hồi này?');
                    if(cf) {
                        e.preventDefault();
                        var self = $(this);
                        self.find('i').iconLoad('icon-trash');
                        self.prop('disabled', true);
                        $.ajax({
                            url: '{{Url::to('faq/xoa-cau-hoi')}}',
                            data: {post_id: self.attr('data-post-id'), parent_id: self.attr('parent-id')},
                            type: "post",
                            dataType: "json",
                            success: function (respon) {
                                console.log(respon);
                                if (respon.result) {
                                    self.closest('.media').fadeOut('slow', function () {
                                        $(this).remove();
                                        if (respon.total <= 0) {
                                            var str = '';
                                            str += '<div class="italic grey">';
                                            str += '<div class="italic grey">';
                                            str += '<i class="icon-pencil grey"></i>';
                                            str += 'Chưa có <span class="text-style text-link auto-answer">phản hồi</span> cho câu hỏi này.';
                                            str += '</div>';

                                            $('.answer-list-wrapper').append(str);
                                        }
                                    });
                                    $('.total-answer').text(respon.total_answer);
                                } else {
                                    alert('Xóa thất bại');
                                    self.prop('disabled', false);
                                    self.find('i').iconUnload('icon-trash');
                                }

                            }
                        });
                    }
                });
            }
            deleteAnswer($('.btn-faq-delete'));

            // dong chu de
            $('.btn-close-question').on('click', function(){
                var self = $(this);
                var type = 'open';
                var icon = '';
                if(self.attr('data-type') == 'open'){
                    icon = 'icon-lock-open';
                }else{
                    icon = 'icon-lock';
                }
                self.find('i').iconLoad(icon);
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
                        console.log(respon)
                        if(respon){
                            if(self.attr('data-type') == 'open'){
                                self.find('i').iconUnload('icon-lock');
                                self.attr('data-type', 'close');
                                self.attr('data-original-title', 'Đóng chủ đề');
                                self.find('span').text('Đóng');
                                $('#post-answer-input').prop({'disabled':false,'placeholder':'Nhập phản hồi...'});
                            }else{
                                self.find('i').iconUnload('icon-lock-open');
                                self.attr('data-type', 'open');
                                self.attr('data-original-title', 'Mở chủ đề');
                                self.find('span').text('Mở');
                                $('#post-answer-input').prop({'disabled':true,'placeholder':'Chủ đề đã kết thúc...'});
                            }
                            self.prop('disabled',false);
                        }else{
                            alert('Xin vui lòng thử lại')
                        }
                    }

                });
            })


            // them phan hoi
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
                                console.log(respon);
                                if (respon.success) {
                                    if(respon.total_row <=1){
                                        parent_tag.html('');
                                    }
                                    self.val('');
                                    var user_name = (respon.user.fullname.length <=0)? respon.user.username: respon.user.fullname;
                                    var html = '';
//                                    html += '<div class="media margin-bottom-10">';
                                    html += '<a href="#" class="pull-left text-center">';
                                    if(respon.user.avatar.length >0){
                                        html += '<img width="60px" height="60px" src="{{URL::to('/')}}'+respon.user.avatar+'" alt="" class="media-object avatar-pad2">';
                                    }
                                    else{
                                        html += '<img width="60px" height="60px" src="{{URL::to('assets/global/img/no-image.png')}}" alt="" class="media-object avatar-pad2">';
                                    }
                                    html += '</a>';

                                    html += '<div class="media-body">';
                                    html += '<div>';
                                    html += '<a class="text-style" href="'+respon.user_url+'">'+user_name+'</a>';
                                    html += '- <span>'+respon.content+'</span>';
                                    html += '</div>';
                                    html += '<span class="grey"> phản hồi - Vừa xong</span>';
                                    html += '<div><a href="#" class="btn btn-warning btn-xs btn-faq-delete" data-post-id="'+respon.id+'" parent-id="'+respon.parent_id+'"><i class="icon-trash"></i> Xóa</a></div>';
                                    html += '</div>';
//                                    html += '</div>';
                                    var bt_delete = $('<div/>',{class: 'media margin-bottom-10'}).append(html);
                                    parent_tag.prepend(bt_delete);
                                    $('.total-answer').text(respon.total_row);
                                    self.prop("disabled", false);
                                    self.focus();
                                    deleteAnswer(bt_delete.find('.btn-faq-delete'));
                                }
                            },
                            complete : function(){
                                $('.box-answer-load i').iconUnload('icon-feather');
                            }

                        });
                    }
                }
            });


            // xoa chu de
            // nut xoa chu de
            $('.btn-question-delete').on('click', function(e){
                e.stopPropagation();
                var cf = confirm('Bạn muốn xóa câu hỏi này? ');
                if(cf){
                    var self = $(this);
                    self.find('i').iconLoad('icon-trash');
                    $.ajax({
                        url: '{{Url::to('faq/xoa-cau-hoi')}}',
                        data: {post_id : self.attr('data-post-id'), post_type : 'faq-question'},
                        type: "post",
                        dataType: "json",
                        success: function (respon) {
                            console.log(respon)
                            if(respon.result){
                                window.location = '{{URL::to('qtri-choidau/hoi-dap')}}';
                            }else{
                                alert('Xóa thất bại');
                                self.find('i').iconUnload('icon-trash');
                            }

                        }
                    });
                }

            });
        });
    </script>
@stop