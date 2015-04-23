//var Auth = function () {
//    return {
//        check: function (url) {
//            var result = 0;
//            $.ajax({
//                type: "POST",
//                url: URL + "/thanh-vien/check-login",
//                data: {
//                    'url': url
//                },
//                async: false,
//                success: function (data) {
//                    if (data == 1){
//                        result = 1;
//                    }
//                }
//            });
//            return result;
//        }
//    };
//
//}();

var Layout = function () {
    // IE mode
    var isRTL = false;
    var isIE8 = false;
    var isIE9 = false;
    var isIE10 = false;
    var isIE11 = false;
    var responsiveHandlers = [];

    function handleUniform() {
        if (!jQuery().uniform) {
            return;
        }
        var test = $("input[type=checkbox]:not(.toggle), input[type=radio]:not(.toggle, .star)");
        if (test.size() > 0) {
            test.each(function () {
                if ($(this).parents(".checker").size() == 0) {
                    $(this).show();
                    $(this).uniform();
                }
            });
        }
    }

    var handleMobiMenu = function () {
        $(".mobi_menubar").on("click", function (event) {
            event.preventDefault();//the default action of the event will not be triggered

            $('.header-navigation').toggle(300);
        });
    }

    var handleMobiSearch = function () {
        $(".mobi_search").on("click", function (event) {
            event.preventDefault();//the default action of the event will not be triggered

            $('.box-search').toggle(300);
        });
    }

    var handleComponentLayout = function () {

        /**btb select*/
        $("section.person-content .person-content-item .person-type-scopy ul li").click(function () {
            // alert('ád');select2me
            var value = $(this).html();
            var id = $(this).attr('value_id');
            var item_parend = $(this).parents("section.person-content .person-content-item .person-type-scopy");
            var item = item_parend.find("button").first();
            item.html(value);
            item.attr('value_id', id);
            //   alert(item.html());
        });
        /***/
    }

    var handleBlog = function () {
        var userBlog_id = $('.person-header-username').attr('id_u_blo');
        var id_user_auth = $(".item-status-value").attr('user_auth_id');





        /*-------------end đang status*/

        $(document).on("click", "a.btn-blog-post-like", function () {
            var parent_item_element = $(this).parents('div.person-content-item');
            var input_element = parent_item_element.find('input.item-status-value');
            var lab_like_element = parent_item_element.find('span.lab-blog-post-like');
            var btn_like_element = parent_item_element.find('a.btn-blog-post-like');
            var post_id = input_element.attr('post_id');
            var user_auth_id = input_element.attr('user_auth_id');
            var user_author_id = input_element.attr('user_author_id');
            var type_action_like = $(this).attr('type_action_like');


            $.ajax({
                type: "POST",
                url: URL + "/trang-ca-nhan/trang-thai.html",
                dataType: 'JSON',

                data: {
                    'post_id': post_id,
                    'user_auth_id': user_auth_id,
                    'user_author_id': user_author_id,
                    'type_edit': 'like_status',
                    'type_action_like': type_action_like,
                    'userBlog_id': userBlog_id

                },
                sync: false,
                success: function (data_1) {
                    if (data_1.type_action_like === 'type_action_like') {
                        lab_like_element.html(data_1.number_like);
                        btn_like_element.attr('type_action_like', 'type_action_dislike');
                        btn_like_element.html('Đã thích');
                    } else {
                        lab_like_element.html(data_1.number_like);
                        btn_like_element.attr('type_action_like', 'type_action_like');
                        btn_like_element.html('Thích');
                    }
                }
            });
        });


        /***
         * like status
         *
         * */


        $(document).on("click", "a.btn-blog-post-like", function () {
            var parent_item_element = $(this).parents('div.person-content-item');
            var input_element = parent_item_element.find('input.item-status-value');
            var lab_like_element = parent_item_element.find('span.lab-blog-post-like');
            var btn_like_element = parent_item_element.find('a.btn-blog-post-like');
            var post_id = input_element.attr('post_id');
            var user_auth_id = input_element.attr('user_auth_id');
            var user_author_id = input_element.attr('user_author_id');
            var type_action_like = $(this).attr('type_action_like');


            $.ajax({
                type: "POST",
                url: URL + "/trang-ca-nhan/trang-thai.html",
                dataType: 'JSON',

                data: {
                    'post_id': post_id,
                    'user_auth_id': user_auth_id,
                    'user_author_id': user_author_id,
                    'type_edit': 'like_status',
                    'type_action_like': type_action_like,
                    'userBlog_id': userBlog_id

                },
                sync: false,
                success: function (data_1) {
                    if (data_1.type_action_like == 'type_action_like') {
                        lab_like_element.html(data_1.number_like);
                        btn_like_element.attr('type_action_like', 'type_action_dislike');
                        btn_like_element.html('Đã thích');
                    } else {
                        lab_like_element.html(data_1.number_like);
                        btn_like_element.attr('type_action_like', 'type_action_like');
                        btn_like_element.html('Thích');
                    }
                }
            });
        });


        $(".btn-blog-post-like1").click(function () {
            var parent_item_element = $(this).parents('div.person-content-item');
            var input_element = parent_item_element.find('input.item-status-value');
            var lab_like_element = parent_item_element.find('span.lab-blog-post-like');
            var btn_like_element = parent_item_element.find('a.btn-blog-post-like');
            var post_id = input_element.attr('post_id');
            var user_auth_id = input_element.attr('user_auth_id');
            var user_author_id = input_element.attr('user_author_id');
            var type_action_like = $(this).attr('type_action_like');


            $.ajax({
                type: "POST",
                url: URL + "/trang-ca-nhan/trang-thai.html",
                dataType: 'JSON',

                data: {
                    'post_id': post_id,
                    'user_auth_id': user_auth_id,
                    'user_author_id': user_author_id,
                    'type_edit': 'like_status',
                    'type_action_like': type_action_like,
                    'userBlog_id': userBlog_id

                },
                sync: false,
                success: function (data_1) {

                    // alert(data_1.number_like);

                    if (data_1.type_action_like == 'type_action_like') {
                        lab_like_element.html(data_1.number_like);
                        btn_like_element.attr('type_action_like', 'type_action_dislike');
                        btn_like_element.html('Đã thích');
                    } else {
                        lab_like_element.html(data_1.number_like);
                        btn_like_element.attr('type_action_like', 'type_action_like');
                        btn_like_element.html('Thích');
                    }

                    //   alert()
                    // lab_like_element.html(data_1);
                }
            });

        });
        /**------------end dislike*/


        /**
         * comment blog
         * */


        $(document).on("click", "a.btn-blog-post-comment", function () {
            var parent_item_element = $(this).parents('div.person-content-item');
            var input_comment_element = parent_item_element.find('input.txt-blog-post-comment');
            input_comment_element.focus();
        });

        $(document).on("keyup", "input.txt-blog-post-comment", function (e) {

            if (e.keyCode == 13) {
                var parent_item_element = $(this).parents('div.person-content-item');
                var input_element = parent_item_element.find('input.item-status-value');
                var parent_vt_element = parent_item_element.find("div.list-blog-post-comment");

                var post_id = input_element.attr('post_id');
                var content_comment = $(this).val();
                //    alert(parent_vt_element.html());
                $.ajax({
                    type: "POST",
                    url: URL + "/trang-ca-nhan/trang-thai.html",
                    data: {
                        'post_id': post_id,
                        'type_edit': 'comment_post',
                        'content_comment': content_comment,
                        'userBlog_id': userBlog_id

                    },
                    dataType: 'JSON',
                    success: function (data_1) {
                        //    alert(data_1.date_at);
                        var html_item_comment = '   <div  class="col-md-12 article-img-text lab-blog-post-item-comment col-none-padding" i_user="' + data_1.id_user + '" i_comment="' + data_1.id_comment + '">';
                        html_item_comment += '     <div class="row margin-none">';
                        html_item_comment += '       <img class="col-md-1 col-ms-1 avatar-pad2" src="' + data_1.avatar_user + '" alt="">';
                        html_item_comment += '           <a style="font-size: 16px" class="lab-blog-post-content-comment" >' + data_1.username + '</a>' + data_1.date_at;
                        html_item_comment += '             <span class="col-md-11 col-ms-11 col-xs-11 txt-blog-post-comment" value="" >' + data_1.content + '</span>';
                        html_item_comment += '       </div><div class="btn-blog-post-comment-delete"><i class="icon-pencil-3"></i></div> </div>';
                        //  alert(data_1);

                        parent_item_element.find("span.lab-blog-post-number-comment").html(data_1.number_comment);

                        parent_vt_element.append(html_item_comment);
                    }
                });
                $(this).val('');
            }

        });

        $(document).on("click", "div.btn-blog-post-comment-delete", function () {
            var parent_post_element = $(this).parents("div.person-content-item");
            var parent_item_element = $(this).parents("div.lab-blog-post-item-comment");
            var id_comment = parent_item_element.attr('i_comment');
            var id_user = parent_item_element.attr('i_user');
            var id_parent_comment = parent_post_element.find("input.item-status-value").attr('post_id');

            $.ajax({
                type: "POST",
                url: URL + "/trang-ca-nhan/trang-thai.html",
                data: {
                    'id_comment': id_comment,
                    'id_user': id_user,
                    'id_parent_comment': id_parent_comment,
                    'type_edit': 'comment_delete',
                    'userBlog_id': userBlog_id

                },
                sync: true,
                success: function (data_1) {
                    //   $( data_1 ).insertAfter( ".form-add-status");
                    parent_post_element.find("span.lab-blog-post-number-comment").html(data_1);
                    parent_item_element.hide();
                }
            });

        });

        $(document).on("click", "li.btn-blog-post-status-delete", function () {
            var parent_item_element = $(this).parents('div.person-content-item');
            var input_element = parent_item_element.find('input.item-status-value');
            var id_status = input_element.attr('post_id');


            bootbox.confirm("Bạn chắc chắn muốn xoá trạng thái này ?", function (result) {
                if (result) {
                    $.ajax({
                        type: "POST",
                        url: URL + "/trang-ca-nhan/trang-thai.html",
                        data: {
                            'id_status': id_status,
                            'type_edit': 'status_delete',
                            'userBlog_id': userBlog_id
                        },
                        sync: true,
                        success: function (data_1) {
                            // $( data_1 ).insertAfter( ".form-add-status");
                            //  $("#feed-blog-post-top").append(data_1);

                            parent_item_element.hide();
                        }
                    });
                }
            });
            /*  */

        });


        /****
         *
         *TagMenu Bạn Bè Blog
         *
         *
         * ------------------------------------------------------------------*/

        $('.btn-friend').loadActionFriend();
        $('.btn-friend-suggest').loadActionFriend();

        $("#btn-tag-blog-friend").click(function () {
            var tagListFriend = $(".person-friends-list");
            var userBlog_id = $(".person-header-username").attr("id_u_blo");
            $.ajax({
                type: "POST",
                url: URL + "/trang-ca-nhan/list-ban-be.html",
                dataType: 'JSON',
                data: {
                    'userBlog_id': userBlog_id
                },
                success: function (respon) {
                    if(respon.length>0){
                        $("span.person-friends-list-total").html(respon.length);
                        var html = '';
                        $.each(respon, function(key, val){
                            html += '<article class="person-friends-item col-md-4 col-sm-6 col-xs-12">';
                                html += '<div class="media">';
                                html += '<a href="'+URL+'/trang-ca-nhan/'+val.username+'.html" class="pull-left"><img src="'+val.avatar+'" alt="" class="media-object"> </a>';
                                    html += '<div class="media-body">';
                                        html += '<header><a href="'+URL+'/trang-ca-nhan/'+val.username+'.html" class="media-heading text-1em2">'+((val.fullname)?val.fullname:val.username)+'</a></header>';
                                        if(val.user_login_id != val.id){
                                            html += '<p>'+val.mutual_friend_count+' bạn chung</p>';
                                            html += '<div style="margin-top: -5px;">';
                                                var state_user = val.state_user;
                                                var state_friend = val.state_friend;

                                                if(state_user != null){
                                                    html += '<button class="btn btn-default btn-sm-8 btn-friend" data-type="delete" friend_id="'+val.id+'" style="margin:0px;" ><i class="icon-user-delete" style="font-size: 1.2em;"></i>Hủy</button>';
                                                    if(state_user['status_id'] == 35){
                                                        html += '<span class="italic text-grey font-10px sub-alert"> Đã gửi lời mời</span>';
                                                    }else{
                                                        html += '<span class="italic text-grey font-10px sub-alert"> Đã kết bạn</span>'
                                                    }
                                                }else if(state_friend !=null){
                                                    if(state_friend['status_id'] == 35){
                                                        html += '<button class="btn btn-default btn-sm-8 btn-friend" data-type="confirm" friend_id="'+val.id+'" style="margin:0px;" ><i class="icon-user-add" style="font-size: 1.2em;"></i>Chấp nhận</button>';
                                                        html += '<span class="italic text-grey font-10px sub-alert"> Đang chờ</span>';
                                                    }else{
                                                        html += '<button class="btn btn-default btn-sm-8 btn-friend" data-type="delete" friend_id="'+val.id+'" style="margin:0px;" ><i class="icon-user-delete" style="font-size: 1.2em;"></i>Hủy</button>';
                                                        html += '<span class="italic text-grey font-10px sub-alert"> Đã kết bạn</span>'
                                                    }
                                                }else{
                                                    html += '<button class="btn btn-default btn-sm-8 btn-friend" data-type="add" friend_id="'+val.id+'" style="margin:0px;" ><i class="icon-user-add" style="font-size: 1.2em;"></i>Kết bạn</button>';
                                                    html += '<span class="italic text-grey font-10px sub-alert"></span>'
                                                }
                                            html += '</div>';
                                        }
                                    html += '</div>';
                                html += '</div>';
                            html += '</article>';
                        });
                        tagListFriend.html(html);
                        $('.btn-friend').loadActionFriend();
                        //luuhoanote

                    }
                    else{
                        tagListFriend.html('<div style="background-color: #fff; padding: 10px;"><i class="icon-warning-empty"></i>Chưa có bạn.</div>');
                        $("span.person-friends-list-total").html('');
                    }
                }
            });
        });

        $("#btn-tag-blog-photo").click(function () {
            var element_list_friend = $(".blog-photo-list-content").html();
            var userBlog_id = $(".person-header-username").attr("id_u_blo");

            var is_val = $(".blog-photo-list-content").attr('is_val');
            if (is_val != '1') {
                $('.blog-photo-list-content').html('<i class="icon-spin4 animate-spin"></i> loading...');
                $.ajax({
                    type: "POST",
                    url: URL + "/trang-ca-nhan/list-hinh-anh.html",
                    data: {
                        'id_user_blog': userBlog_id
                    },
                    sync: false,
                    success: function (data_1) {
                        $(".blog-photo-list-content").html(data_1.html);
                        $(".blog-photo-list-content").attr('is_val', '1');
                        //   $("span.person-friends-list-total").html(data_1.total);
                    },
                    dataType: 'JSON'
                });

            }


        });
        //
        //$('.require_login').login()
        //
        ////luuhoabk - kiem tra login
        //$(".require-login").click(function (e) {
        //    e.preventDefault();
        //    var url_after_login = $(this).attr('data-url');
        //
        //    var islog = Auth.check(url_after_login);
        //    if (islog == 1 && url_after_login != "") {
        //        window.location.replace(url_after_login);
        //    }else{
        //        $('#popup-login').modal('show');
        //    }
        //});
        /**Tag check in*/
        //$("#btn-tag-blog-checkin").click(function () {
        //
        //    var element_list_friend = $(".blog-checkin-list-content").html();
        //    var userBlog_id = $(".person-header-username").attr("id_u_blo");
        //
        //    var is_val = $(".blog-checkin-list-content").attr('is_val');
        //
        //    if (is_val != '1') {
        //        $('.blog-checkin-list-content').html('<i class="icon-spin4 animate-spin"></i> loading...');
        //        $.ajax({
        //            type: "POST",
        //            url: URL + "/trang-ca-nhan/list-check-in.html",
        //            data: {
        //                'userBlog_id': userBlog_id
        //            },
        //            sync: false,
        //            success: function (data_1) {
        //                $(".blog-checkin-list-content").html(data_1.html);
        //                $(".blog-checkin-list-content").attr('is_val', '1');
        //
        //            },
        //            dataType: 'JSON'
        //        });
        //
        //    }
        //
        //
        //});

        /**end Tab check in*/


        /**Tab location like*/
        $("#btn-tag-blog-location-like").click(function () {

            var element_list_friend = $(".blog-photo-list-content").html();
            var userBlog_id = $(".person-header-username").attr("id_u_blo");

            var is_val = $(".blog-location-like-list-content").attr('is_val');
            if (is_val != '1') {
                $('.blog-location-like-list-content').html('<i class="icon-spin4 animate-spin"></i> loading...');
                $.ajax({
                    type: "POST",
                    url: URL + "/trang-ca-nhan/list-location-like.html",
                    data: {
                        'userBlog_id': userBlog_id
                    },
                    sync: false,
                    success: function (data_1) {
                        $(".blog-location-like-list-content").html(data_1.html);
                        $(".blog-location-like-list-content").attr('is_val', '1');
                    },
                    dataType: 'JSON'
                });
            }
        });
    };

    //luuhoabk
    var handleLogin = function () {
        $('#frm-login-popup').submit(function(e){
            e.preventDefault();
            $(".btn-login-popup-choidau").trigger('click');
        });

        $(".btn-login-popup-choidau").click(function () {
            var btnlogin = $(this);
            var alert = '';
            var email = $("#username_popup_login").val();
            var password = $("#password_popup_login").val();
            var remember = $("input#remember_popup_login").attr('checked');
                remember = (remember == 'checked')? 1 : 0;
            var _token = $("#_token").val();

            var alert_login = $('.alert-popup-login');

            if(email.length <= 0){
                alert_login.html('<div class="alert alert-danger margin-none padding-5 "><div class="text-center">Vui lòng nhập email hoặc username.</div></div>').fadeIn();
                return false;
            }
            if(password.length <= 0){
                alert_login.html('<div class=" alert alert-danger margin-none padding-5 "><div class="text-center">Vui lòng nhập mật khẩu.</div></div>').fadeIn();
                return false;
            }

            var tag_icon =  $('.btn-login-popup-choidau i');
            tag_icon.iconLoad('icon-login-2');
            btnlogin.attr('disabled','disabled');
            $.ajax({
                type: "POST",
                url: URL + "/thanh-vien/dang-nhap.html",
                data: {
                    'email': email,
                    'password': password,
                    'remember': remember,
                    '_token': _token
                },
                dataType: 'JSON',
                //async: false,
                success: function (data) {
                    console.log(data);


                    if(data.url != ""){
                        window.alert("Đăng nhập thành công.");
                        $('.modal').modal("hide");
                        window.location.replace(data.url);
                    }else{
                        alert_login.fadeOut().fadeIn();

                        switch(data.err_msg){
                            case 0:
                                alert_login.html('<div class="alert alert-danger margin-none padding-5 "><div class="text-center">Bạn đăng nhập sai quá nhiều lần. Vui lòng kiểm tra lại.</div></div>').fadeIn();
                                break;
                            case 1:
                                alert_login.html('<div class="alert alert-danger margin-none padding-5 "><div class="text-center">Tài khoản chưa được xác thực.</div></div>').fadeIn();
                                break;
                            case 2:
                                alert_login.html('<div class="alert alert-danger margin-none padding-5 "><div class="text-center">Đăng nhập thất bại, tên đăng nhập hoặc mật khẩu không đúng.</div></div>').fadeIn();
                                break;
                            default:
                                alert_login.html('<div class="alert alert-success margin-none padding-5 "><div class="text-center">Đăng nhập thành công.</div></div>').fadeIn();
                                break;
                        }
                    }
                },
                complete: function () {
                    btnlogin.removeAttr('disabled');
                    tag_icon.iconUnload('icon-login-2');
                }
            });

        });

        //login facebook
        $('.login-face-btn').click(function(){
            var btnlogin_fb = $(this);
            var current_url = $(this).attr('data-url');
            var tag_icon =  $('.login-face-btn i');
            tag_icon.iconLoad('icon-facebook');
            btnlogin_fb.attr('disabled','disabled')
            $.ajax({
                url: URL + "/thanh-vien/login-facebook",
                type : 'post',
                data : {'current_url': current_url},

                success : function(response) {
                    window.location.assign(response);
                },
                complete : function(r) {
                    btnlogin_fb.removeAttr('disabled');
                    tag_icon.iconUnload('icon-facebook');
                }
            });
        })

        $('.login-google-btn').click(function(){
            var btnlogin_gg = $(this);
            var current_url = $(this).attr('data-url');
            var tag_icon =  $('.login-google-btn i');
            tag_icon.iconLoad('icon-googleplus-rect-1');
            btnlogin_gg.attr('disabled','disabled')
            $.ajax({
                url: URL + "/thanh-vien/login-google",
                type : 'post',
                data : {'current_url': current_url},

                success : function(response) {

                    window.location.assign(response);
                },
                complete : function(r) {
                    btnlogin_gg.removeAttr('disabled');
                }
            });
        })

    }

    var handlePostAction = function () {
        /*----spam post-----------*/
        $(".btn-post-spam").click(function () {

            var element_parent = $(this).parents('.item-post-element-parent');
            var element_data = element_parent.find('.input-data-value-post');
            var id_post = element_data.attr('i_p');
            var id_user = element_data.attr('i_u');
            var type_action = $(this).attr('type_action');

            $.ajax({
                type: "POST",
                url: URL + "/post/action-click-post",
                data: {
                    'id_user_like': id_user,
                    'id_post': id_post,
                    'type_action': type_action
                },
                sync: false,
                success: function (data_1) {

                    element_parent.find(".lab_num_spam").html(data_1.number_like);
                    if (data_1.is_like == '0') {
                        element_parent.find(".lab_text_spam").html('Báo cáo xấu ');
                    } else {
                        element_parent.find(".lab_text_spam").html('Đã Báo cáo xấu ');

                    }
                }, dataType: 'JSON'
            });
        });
        /*----end spam post-----------*/

    }

    // noi de code chung
    var handleCommon = function () {
        $('#provinceList').on('change', function(){
            var province_id = $(this).val();
            var html ='';
            $('.btn-search-location i').iconLoad('icon-search');
            $.ajax({
                url: URL+"/location/getList",
                type: 'post',
                data: {'province_id': province_id},
                dataType: 'json',
                success: function(respon){
                    window.location = window.location.href;
                    //console.log(respon);
                    //$.each(respon, function(key,value){
                    //    if(key == 0){
                    //        $('#select2-location-search-list-container').text(value.name);
                    //    }
                    //    var location = value.location;
                    //    html += '<option value="'+value.id+'" data-url="'+value.url+'">- '+value.name+'</option>';
                    //});
                    //$('#location-search-list').html(html);
                }
                ,complete: function(){
                    $('.btn-search-location i').iconUnload('icon-search');
                }
            });
        });

        $('.btn-search-all-location').on('click',function(e){
            e.preventDefault();
            var html ='';
            $('.btn-search-location i').iconLoad('icon-search');
            $.ajax({
                url: URL+"/location/getList",
                type: 'post',
                data: {'province_id':'all'},
                dataType: 'json',
                success: function(respon){
                    $.each(respon, function(key,value){
                        if(key == 0){
                            $('#select2-location-search-list-container').text(value.name);
                        }
                        var location = value.location;
                        html += '<option value="'+value.id+'" data-url="'+value.url+'">- '+value.name+'</option>';
                    });
                    $('#location-search-list').html(html);
                }
                ,complete: function(){
                    $('.btn-search-location i').iconUnload('icon-search');
                }
            });
        });

        $('.btn-search-location').on('click',function(e){
            e.preventDefault();
            var location_id = $('#location-search-list').val();
            if(location_id == -1){
                alert('Hãy chọn một địa điểm.');
            }else{
                var url = $('#location-search-list').find(":selected").attr('data-url');
                if(url.length >0){
                    window.location = url;
                }else{
                    console.log('Lỗi kết nối đến địa điểm.');
                }
            }

        });


        //luuhoabk - select2 cho thanh pho
        function formatProvinceList (state) {
            if (!state.id) { return state.text; }
            var $state = $(
                '<div><i class="icon-location"></i> <span class="font-weight-600">'+ state.text+'</span></div>'
            );
            return $state;
        };

        $('#provinceList').select2({
            templateResult: formatProvinceList
        });
        $('#location-search-list').select2();

        // luuhoabk - kich hoat tooltip
        $(".tooltips").tooltip({  disabled: true });

        //luuhoabk - kiem tra login
        $(".require-login").click(function (e) {
            e.preventDefault();
            console.log('eee');
            var url = $(this).attr('data-url');
            $(this).login({callback: function(respon){
                if(respon){
                    window.location.replace(url)
                }else{
                    $('#popup-login').modal('show');
                }
            }});
        });


        //--luuhoabk - sticker
        var stickyNavTop = $('.header-middle-right').offset().top;

        var stickyNav = function() {
            var scrollTop = $(window).scrollTop();

            if (scrollTop > stickyNavTop) {
                $('.header-middle-right').addClass('sticky',function(){
                    $(this).find('.sticker-left').removeClass('col-md-8 col-md-offset-0').addClass('col-md-7 col-md-offset-1');
                    $(this).find('.sticker-right').removeClass('col-md-4 col-md-offset-right-0').addClass('col-md-3 col-md-offset-right-1');
                });
            } else {
                $('.sticker-left').removeClass('col-md-7 col-md-offset-1').addClass('col-md-8 col-md-offset-0');
                $('.sticker-right').removeClass('col-md-3 col-md-offset-right-1').addClass('col-md-4 col-md-offset-right-0');
                $('.header-middle-right').removeClass('sticky');

            }
        }
        stickyNav();
        $(window).scroll(function() {
            stickyNav();
        });
    }

    return {
        init: function () {
            handleCommon();
            handleMobiMenu();
            handleMobiSearch();
            handleComponentLayout();
            handleBlog();
            handlePostAction();
            handleLogin();
        },

        initUniform: function (els) {
            if (els) {
                jQuery(els).each(function () {
                    if ($(this).parents(".checker").size() == 0) {
                        $(this).show();
                        $(this).uniform();
                    }
                });
            } else {
                handleUniform();
            }
        },

        // wrapper function to scroll(focus) to an element
        scrollTo: function (el, offeset) {
            var pos = (el && el.size() > 0) ? el.offset().top : 0;
            if (el) {
                if ($('body').hasClass('page-header-fixed')) {
                    pos = pos - $('.header').height();
                }
                pos = pos + (offeset ? offeset : -1 * el.height());
            }

            jQuery('html,body').animate({
                scrollTop: pos
            }, 'slow');
        },

        scrollTop: function () { App.scrollTo(); },

        initSliderLocation: function (containerId) {

            var _SlideshowTransitions = [
                //Fade in L
                {$Duration: 1200, x: 0.3, $During: { $Left: [0.3, 0.7] }, $Easing: { $Left: $JssorEasing$.$EaseInCubic, $Opacity: $JssorEasing$.$EaseLinear }, $Opacity: 2 }
                //Fade out R
                , { $Duration: 1200, x: -0.3, $SlideOut: true, $Easing: { $Left: $JssorEasing$.$EaseInCubic, $Opacity: $JssorEasing$.$EaseLinear }, $Opacity: 2 }
                //Fade in R
                , { $Duration: 1200, x: -0.3, $During: { $Left: [0.3, 0.7] }, $Easing: { $Left: $JssorEasing$.$EaseInCubic, $Opacity: $JssorEasing$.$EaseLinear }, $Opacity: 2 }
                //Fade out L
                , { $Duration: 1200, x: 0.3, $SlideOut: true, $Easing: { $Left: $JssorEasing$.$EaseInCubic, $Opacity: $JssorEasing$.$EaseLinear }, $Opacity: 2 }

                //Fade in T
                , { $Duration: 1200, y: 0.3, $During: { $Top: [0.3, 0.7] }, $Easing: { $Top: $JssorEasing$.$EaseInCubic, $Opacity: $JssorEasing$.$EaseLinear }, $Opacity: 2, $Outside: true }
                //Fade out B
                , { $Duration: 1200, y: -0.3, $SlideOut: true, $Easing: { $Top: $JssorEasing$.$EaseInCubic, $Opacity: $JssorEasing$.$EaseLinear }, $Opacity: 2, $Outside: true }
                //Fade in B
                , { $Duration: 1200, y: -0.3, $During: { $Top: [0.3, 0.7] }, $Easing: { $Top: $JssorEasing$.$EaseInCubic, $Opacity: $JssorEasing$.$EaseLinear }, $Opacity: 2 }
                //Fade out T
                , { $Duration: 1200, y: 0.3, $SlideOut: true, $Easing: { $Top: $JssorEasing$.$EaseInCubic, $Opacity: $JssorEasing$.$EaseLinear }, $Opacity: 2 }

                //Fade in LR
                , { $Duration: 1200, x: 0.3, $Cols: 2, $During: { $Left: [0.3, 0.7] }, $ChessMode: { $Column: 3 }, $Easing: { $Left: $JssorEasing$.$EaseInCubic, $Opacity: $JssorEasing$.$EaseLinear }, $Opacity: 2, $Outside: true }
                //Fade out LR
                , { $Duration: 1200, x: 0.3, $Cols: 2, $SlideOut: true, $ChessMode: { $Column: 3 }, $Easing: { $Left: $JssorEasing$.$EaseInCubic, $Opacity: $JssorEasing$.$EaseLinear }, $Opacity: 2, $Outside: true }
                //Fade in TB
                , { $Duration: 1200, y: 0.3, $Rows: 2, $During: { $Top: [0.3, 0.7] }, $ChessMode: { $Row: 12 }, $Easing: { $Top: $JssorEasing$.$EaseInCubic, $Opacity: $JssorEasing$.$EaseLinear }, $Opacity: 2 }
                //Fade out TB
                , { $Duration: 1200, y: 0.3, $Rows: 2, $SlideOut: true, $ChessMode: { $Row: 12 }, $Easing: { $Top: $JssorEasing$.$EaseInCubic, $Opacity: $JssorEasing$.$EaseLinear }, $Opacity: 2 }

                //Fade in LR Chess
                , { $Duration: 1200, y: 0.3, $Cols: 2, $During: { $Top: [0.3, 0.7] }, $ChessMode: { $Column: 12 }, $Easing: { $Top: $JssorEasing$.$EaseInCubic, $Opacity: $JssorEasing$.$EaseLinear }, $Opacity: 2, $Outside: true }
                //Fade out LR Chess
                , { $Duration: 1200, y: -0.3, $Cols: 2, $SlideOut: true, $ChessMode: { $Column: 12 }, $Easing: { $Top: $JssorEasing$.$EaseInCubic, $Opacity: $JssorEasing$.$EaseLinear }, $Opacity: 2 }
                //Fade in TB Chess
                , { $Duration: 1200, x: 0.3, $Rows: 2, $During: { $Left: [0.3, 0.7] }, $ChessMode: { $Row: 3 }, $Easing: { $Left: $JssorEasing$.$EaseInCubic, $Opacity: $JssorEasing$.$EaseLinear }, $Opacity: 2, $Outside: true }
                //Fade out TB Chess
                , { $Duration: 1200, x: -0.3, $Rows: 2, $SlideOut: true, $ChessMode: { $Row: 3 }, $Easing: { $Left: $JssorEasing$.$EaseInCubic, $Opacity: $JssorEasing$.$EaseLinear }, $Opacity: 2 }

                //Fade in Corners
                , { $Duration: 1200, x: 0.3, y: 0.3, $Cols: 2, $Rows: 2, $During: { $Left: [0.3, 0.7], $Top: [0.3, 0.7] }, $ChessMode: { $Column: 3, $Row: 12 }, $Easing: { $Left: $JssorEasing$.$EaseInCubic, $Top: $JssorEasing$.$EaseInCubic, $Opacity: $JssorEasing$.$EaseLinear }, $Opacity: 2, $Outside: true }
                //Fade out Corners
                , { $Duration: 1200, x: 0.3, y: 0.3, $Cols: 2, $Rows: 2, $During: { $Left: [0.3, 0.7], $Top: [0.3, 0.7] }, $SlideOut: true, $ChessMode: { $Column: 3, $Row: 12 }, $Easing: { $Left: $JssorEasing$.$EaseInCubic, $Top: $JssorEasing$.$EaseInCubic, $Opacity: $JssorEasing$.$EaseLinear }, $Opacity: 2, $Outside: true }

                //Fade Clip in H
                , { $Duration: 1200, $Delay: 20, $Clip: 3, $Assembly: 260, $Easing: { $Clip: $JssorEasing$.$EaseInCubic, $Opacity: $JssorEasing$.$EaseLinear }, $Opacity: 2 }
                //Fade Clip out H
                , { $Duration: 1200, $Delay: 20, $Clip: 3, $SlideOut: true, $Assembly: 260, $Easing: { $Clip: $JssorEasing$.$EaseOutCubic, $Opacity: $JssorEasing$.$EaseLinear }, $Opacity: 2 }
                //Fade Clip in V
                , { $Duration: 1200, $Delay: 20, $Clip: 12, $Assembly: 260, $Easing: { $Clip: $JssorEasing$.$EaseInCubic, $Opacity: $JssorEasing$.$EaseLinear }, $Opacity: 2 }
                //Fade Clip out V
                , { $Duration: 1200, $Delay: 20, $Clip: 12, $SlideOut: true, $Assembly: 260, $Easing: { $Clip: $JssorEasing$.$EaseOutCubic, $Opacity: $JssorEasing$.$EaseLinear }, $Opacity: 2 }
            ];

            var options = {
                $AutoPlay: true,                                    //[Optional] Whether to auto play, to enable slideshow, this option must be set to true, default value is false
                $AutoPlayInterval: 1500,                            //[Optional] Interval (in milliseconds) to go for next slide since the previous stopped if the slider is auto playing, default value is 3000
                $PauseOnHover: 1,                                   //[Optional] Whether to pause when mouse over if a slider is auto playing, 0 no pause, 1 pause for desktop, 2 pause for touch device, 3 pause for desktop and touch device, 4 freeze for desktop, 8 freeze for touch device, 12 freeze for desktop and touch device, default value is 1
                $DragOrientation: 3,                                //[Optional] Orientation to drag slide, 0 no drag, 1 horizental, 2 vertical, 3 either, default value is 1 (Note that the $DragOrientation should be the same as $PlayOrientation when $DisplayPieces is greater than 1, or parking position is not 0)
                $ArrowKeyNavigation: true,   			            //[Optional] Allows keyboard (arrow key) navigation or not, default value is false
                $SlideDuration: 800,                                //Specifies default duration (swipe) for slide in milliseconds

                $SlideshowOptions: {                                //[Optional] Options to specify and enable slideshow or not
                    $Class: $JssorSlideshowRunner$,                 //[Required] Class to create instance of slideshow
                    $Transitions: _SlideshowTransitions,            //[Required] An array of slideshow transitions to play slideshow
                    $TransitionsOrder: 1,                           //[Optional] The way to choose transition to play slide, 1 Sequence, 0 Random
                    $ShowLink: true                                 //[Optional] Whether to bring slide link on top of the slider when slideshow is running, default value is false
                },

                $ArrowNavigatorOptions: {                           //[Optional] Options to specify and enable arrow navigator or not
                    $Class: $JssorArrowNavigator$,                  //[Requried] Class to create arrow navigator instance
                    $ChanceToShow: 1                                //[Required] 0 Never, 1 Mouse Over, 2 Always
                },

                $ThumbnailNavigatorOptions: {                       //[Optional] Options to specify and enable thumbnail navigator or not
                    $Class: $JssorThumbnailNavigator$,              //[Required] Class to create thumbnail navigator instance
                    $ChanceToShow: 2,                               //[Required] 0 Never, 1 Mouse Over, 2 Always
                    $ActionMode: 1,                                 //[Optional] 0 None, 1 act by click, 2 act by mouse hover, 3 both, default value is 1
                    $SpacingX: 8,                                   //[Optional] Horizontal space between each thumbnail in pixel, default value is 0
                    $DisplayPieces: 10,                             //[Optional] Number of pieces to display, default value is 1
                    $ParkingPosition: 360                           //[Optional] The offset position to park thumbnail
                }
            };

            var jssor_slider1 = new $JssorSlider$(containerId, options);
            //responsive code begin
            //you can remove responsive code if you don't want the slider scales while window resizes
            function ScaleSlider() {
                var parentWidth = jssor_slider1.$Elmt.parentNode.clientWidth;
                if (parentWidth)
                    jssor_slider1.$ScaleWidth(Math.max(Math.min(parentWidth, 800), 300));
                else
                    $Jssor$.$Delay(ScaleSlider, 30);
            }

            ScaleSlider();
            $Jssor$.$AddEvent(window, "load", ScaleSlider);

            $Jssor$.$AddEvent(window, "resize", $Jssor$.$WindowResizeFilter(window, ScaleSlider));
            $Jssor$.$AddEvent(window, "orientationchange", ScaleSlider);
            //responsive code end
        }
    };

}();

//-----luuhoabk ------

//-- luuhoabk - login
$.fn.login = function(userOptions){
    var options = $.extend(null, userOptions);
    return $(this).each(function(){
        var self = $(this);
        var url = self.attr('data-url');

        $.ajax({
            type: "POST",
            url: URL + "/thanh-vien/check-login",
            data: {
                'url': url
            },
            async: false,
            success: function (respon) {
                options.callback.call(null,respon);
            }
        });
    });
}
//-- END luuhoabk - login

$.fn.iconLoad = function(iclass){
    $(this).removeClass(iclass).addClass('animate-spin icon-spin3');
}
$.fn.iconUnload = function(iclass){
    $(this).removeClass('animate-spin icon-spin3').addClass(iclass);
}

var formatDate = function(strDate){
    return strDate.substr(10, 6)+' '+strDate.substr(8, 2)+'/'+ strDate.substr(5, 2)+'/'+strDate.substr(0, 4);
}
// luuhoabk - action friend
$.fn.loadActionFriend = function(){
    $(this).on('click',function(){
        var self = $(this);
        var friend_type = $(this).attr('data-type');
        if(friend_type == 'add'){
            self.addFriend({callback: function(respon){
                if(respon){
                    self.html('<i class="icon-user-add black"> </i>Hủy');
                    self.attr('data-type','delete');
                    self.parent().find('.sub-alert').html(' Đã gửi lời mời');
                }
            }});
        }else if(friend_type == 'delete'){
            self.delFriend({callback: function(respon){
                if(respon){
                    self.html('<i class="icon-user-add black"> </i>Kết bạn');
                    self.attr('data-type','add');
                    self.parent().find('.sub-alert').html(' Chưa kết bạn');
                }
            }});
        }else if(friend_type == 'confirm'){
            self.confirmFriend({callback: function(respon){
                if(respon){
                    self.html('<i class="icon-user-add black"> </i>Hủy');
                    self.attr('data-type','delete');
                    self.parent().find('.sub-alert').html('Đã kết bạn');
                }
            }});
        }
        if($('.total-confirm-friends')[0]){
            var tagConfirm = $('.total-confirm-friends');
            var totalConfirm = parseInt(tagConfirm.text())-1;
            if(totalConfirm > 0){
                tagConfirm.text(totalConfirm);
            }else{
                $('.wrapper-confirm-friends').html('');
            }
        }
    });
}
// END luuhoabk - action friend

// luuhoabk - add friend
$.fn.addFriend = function(userOptions){
    $.extend(options, userOptions);
    var options = $.extend(null,userOptions);

    return $(this).each(function(){
        var self = $(this);
        var friend_id = $(this).attr('friend_id');
        self.find('i').iconLoad('icon-user-add');
        $.ajax({
             type: "POST",
             url: URL + "/trang-ca-nhan/ban-be.html",
             data: {
                 'friend_id': friend_id,
                 'type_edit': 'request_add_friend'
             },
             success: function (respon) {
                 options.callback.call(null,respon);
             },
             complete: function(){
                 self.find('i').iconUnload('icon-user-delete');
             }
        });
    });
};
// END luuhoabk - add friend

// luuhoabk - delete friend
$.fn.delFriend = function(userOptions){
    $.extend(options, userOptions);
    var options = $.extend(null,userOptions);

    return $(this).each(function(){
        var self = $(this);
        var r = confirm("Bạn thật sự muốn hủy?");
        if(r == true){
            var friend_id = $(this).attr('friend_id');
            self.find('i').iconLoad('icon-user-delete');
            $.ajax({
                type: "POST",
                url: URL + "/trang-ca-nhan/ban-be.html",
                data: {
                    'friend_id': friend_id,
                    'type_edit': 'request_delete_friend'
                },
                success: function (respon) {
                    options.callback.call(null,respon);
                },
                complete: function(){
                    self.find('i').iconUnload('icon-user-add');
                }
            });
        }
    });
};
// END luuhoabk - delete friend

// luuhoabk - confirm friend
$.fn.confirmFriend = function(userOptions){
    $.extend(options, userOptions);
    var options = $.extend(null,userOptions);

    return $(this).each(function(){
        var self = $(this);
        var friend_id = $(this).attr('friend_id');
        self.find('i').iconLoad('icon-user-add');
        $.ajax({
            type: "POST",
            url: URL + "/trang-ca-nhan/ban-be.html",
            data: {
                'friend_id': friend_id,
                'type_edit': 'request_confirm_friend'
            },
            success: function (respon) {
                options.callback.call(null,respon);
            },
            complete: function(){
                self.find('i').iconUnload('icon-user-delete');
            }
        });

    });
};
// END luuhoabk confirm friend

// luuhoabk - blog privacy
$.fn.blogPrivacy = function(userOptions){
    //$.extend(options, userOptions);
    var options = $.extend(null, userOptions);
    return $(this).each(function(){
        var self = $(this);
        var post_id = self.attr('post_id');
        var value_id = self.attr('value_id');
        self.parent().find('i').iconLoad('icon-down-dir');
        self.parent().find('button.dropdown-toggle').addClass('disabled');
        $.ajax({
            type: "POST",
            url: URL + "/trang-ca-nhan/trang-thai.html",
            data: {
                'post_id': post_id,
                'value_id': value_id,
                'type_edit': 'request_privacy',
                'blog_id': $('.person-header-username').attr('id_u_blo')
            },
            success: function (respon) {
                options.callback.call(null,respon);
            },
            complete: function(){
                self.parent().find('i').iconUnload('icon-down-dir');
                self.parent().find('button.dropdown-toggle').removeClass('disabled');
            }
        });
    })
}
// END luuhoabk - blog privacy

// luuhoabk - like
$.fn.like = function(userOptions){
        var options = $.extend(null, userOptions);
        return $(this).each(function(){
            var self = $(this);
            var data_user_id = self.attr('data-user-id');
            var data_post_id = self.attr('data-post-id');
            var data_action = self.attr('data-action');
            $.ajax({
                type: "POST",
                url: URL + "/thanh-vien/like-post",
                data: {
                    'post_id': data_post_id,
                    'user_id': data_user_id,
                    'data_action': data_action
                },
                success: function (respon) {
                    options.callback.call(null,respon);
                }
            });
        })

    }
// END luuhoabk - like

/* imtoantran social action start */
$.fn.social = function(options){
    $(this).on("click",".social-btn",function(e){
        e.preventDefault();
        var _this = this;_this.disabled = true;
        controller = $(this).data("controller");
        if(options) {
            if (options.controller) {
                controller = options.controller + "/" + $(this).data("id")+"/";
            }
        }
        $.ajax({
            url:controller,
            type:"post",
            data:$(this).data(),
            dataType:"json",
            success:function(data){
                if(data.success){
                    if(data.value){
                        $(_this).addClass("true");
                    }else{
                        $(_this).removeClass("true");
                    }
                    if($(_this).data("action")=="like"){
                        //if(data.totalLikes)
                            $(_this).find(".total-liked").text(data.totalLikes);
                    }
                    _this.disabled = false;
                }
            },complete:function(){
                _this.disabled = false;
            }
        });
        return false;
    });
};
/* imtoantran social action stop */
/* comment start */
$.fn.comments = function(options) {
    var _this = this;
    var controller = $(this).attr("href");
    if(options) {
        if (options.controller) {
            controller = options.controller + "/" + $(this).data("id");
        }
    }
    $(this).on("keyup", function (e) {
        if (e.which == 13) {
            $.ajax({
                type:"post",
                url:controller,
                data:{content:this.value},
                success:function(data){
                    this.value = "";
                    if(data){
                        if(data.success){

                        }
                    }
                }
            })
        }
    });
};
/* comment stop */
