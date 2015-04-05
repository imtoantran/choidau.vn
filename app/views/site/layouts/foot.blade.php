<!-- JavaScript required for CMS-->
@if (isset($js_variable))
    {{$js_variable}}
@endif


<script type="text/javascript">
    URL = '{{URL::to('/')}}';


</script>


<!-- END fast view of a product -->

<!-- Load javascripts at bottom, this will reduce page load time -->
<!-- BEGIN CORE PLUGINS (REQUIRED FOR ALL PAGES) -->
<!--[if lt IE 9]>
<script src="../../assets/global/plugins/respond.min.js"></script>

<![endif]-->


<!-- START CORE GLOBAL -->

@if (isset($js_global))
    {{$js_global}}
@endif

@section('js_global')
    @show

            <!-- END CORE GLOBAL -->




    <!-- START CORE PLUGINS -->
    <script src="{{asset("assets/global/plugins/tinymce/tinymce.min.js")}}" type="text/javascript"></script>
    <script src="{{asset('assets/global/plugins/jquery-migrate.min.js')}}" type="text/javascript"></script>
    <script src="{{asset('assets/global/plugins/jquery-ui/jquery-ui-1.10.3.custom.min.js')}}"
            type="text/javascript"></script>
    <script src="{{asset('assets/global/plugins/bootstrap-datetimepicker/js/moment.js')}}"
            type="text/javascript"></script>
    <script src="{{asset('assets/global/plugins/bootstrap-datetimepicker/js/locales/vi.js')}}"
            type="text/javascript"></script>
    <script src="{{asset('assets/global/plugins/bootstrap/js/bootstrap.min.js')}}" type="text/javascript"></script>
    <script src="{{asset('assets/global/plugins/bootstrap-modal/js/bootstrap-modalmanager.js')}}"
            type="text/javascript"></script>
    <script src="{{asset('assets/global/plugins/bootstrap-modal/js/bootstrap-modal.js')}}"
            type="text/javascript"></script>
    <script src="{{asset('assets/global/plugins/rateit/jquery.rateit.min.js')}}" type="text/javascript"></script>
    <script src="{{asset('assets/global/plugins/bootstrap-datepicker/js/bootstrap-datepicker.js')}}"
            type="text/javascript"></script>
    <script src="{{asset('assets/global/plugins/bootstrap-datetimepicker/js/bootstrap-datetimepicker.min.js')}}"
            type="text/javascript"></script>
    <script src="{{asset('assets/global/plugins/bootbox/bootbox.min.js')}}"></script>
    {{--<script src="{{asset('assets/global/plugins/datatables/bootstrap-select.min.js')}}" type="text/javascript"></script>--}}
    <script src="{{asset('assets/global/plugins/jquery-alerts/jquery.alerts.min.js')}}" type="text/javascript"></script>
    <script src="{{asset('assets/global/plugins/jquery-inputmask/jquery.inputmask.bundle.min.js')}}"
            type="text/javascript"></script>
    <script src="{{asset('assets/global/plugins/jquery.blockui.min.js')}}" type="text/javascript"></script>
    <script src="{{asset('assets/global/plugins/dropzone/dropzone.js')}}" type="text/javascript"></script>
    <script src="{{asset('assets/global/plugins/fancybox-v3beta/jquery.fancybox.js')}}" type="text/javascript"></script>
    <script src="{{asset('assets/global/plugins/fancybox-v3beta/jquery.fancybox-thumbs.js')}}"
            type="text/javascript"></script>
    <script src="{{asset('assets/frontend/pages/scripts/media-manager.js')}}" type="text/javascript"></script>
    <script src="{{asset('assets/frontend/pages/scripts/jquery.ag.js')}}"></script>
    <script src="{{asset('assets/global/plugins/firebase.js')}}"></script>

    @if (isset($js_plugin))
        {{$js_plugin}}
    @endif
=======
<!-- START CORE PLUGINS -->
<script src="{{asset("assets/global/plugins/tinymce/tinymce.min.js")}}" type="text/javascript"></script>
<script src="{{asset('assets/global/plugins/jquery-migrate.min.js')}}" type="text/javascript"></script>
<script src="{{asset('assets/global/plugins/jquery-ui/jquery-ui-1.10.3.custom.min.js')}}" type="text/javascript"></script>
<script src="{{asset('assets/global/plugins/bootstrap-datetimepicker/js/moment.js')}}" type="text/javascript" ></script>
<script src="{{asset('assets/global/plugins/bootstrap-datetimepicker/js/locales/vi.js')}}" type="text/javascript" ></script>
<script src="{{asset('assets/global/plugins/bootstrap/js/bootstrap.min.js')}}" type="text/javascript"></script>
<script src="{{asset('assets/global/plugins/bootstrap-modal/js/bootstrap-modalmanager.js')}}" type="text/javascript"></script>
<script src="{{asset('assets/global/plugins/bootstrap-modal/js/bootstrap-modal.js')}}" type="text/javascript"></script>
<script src="{{asset('assets/global/plugins/rateit/jquery.rateit.min.js')}}" type="text/javascript"></script>
<script src="{{asset('assets/global/plugins/bootstrap-datepicker/js/bootstrap-datepicker.js')}}" type="text/javascript"></script>
<script src="{{asset('assets/global/plugins/bootstrap-datetimepicker/js/bootstrap-datetimepicker.min.js')}}" type="text/javascript"></script>
<script src="{{asset('assets/global/plugins/bootbox/bootbox.min.js')}}"></script>
{{--<script src="{{asset('assets/global/plugins/datatables/bootstrap-select.min.js')}}" type="text/javascript"></script>--}}
<script src="{{asset('assets/global/plugins/jquery-alerts/jquery.alerts.min.js')}}" type="text/javascript"></script>
<script src="{{asset('assets/global/plugins/jquery-inputmask/jquery.inputmask.bundle.min.js')}}" type="text/javascript"></script>
<script src="{{asset('assets/global/plugins/jquery.blockui.min.js')}}" type="text/javascript"></script>
<script src="{{asset('assets/global/plugins/dropzone/dropzone.js')}}" type="text/javascript"></script>
<script src="{{asset('assets/global/plugins/fancybox-v3beta/jquery.fancybox.js')}}" type="text/javascript"></script>
<script src="{{asset('assets/global/plugins/fancybox-v3beta/jquery.fancybox-thumbs.js')}}" type="text/javascript"></script>
<script src="{{asset('assets/frontend/pages/scripts/media-manager.js')}}" type="text/javascript"></script>
<script src="{{asset('assets/frontend/pages/scripts/jquery.ag.js')}}"></script>
<script src="{{asset('assets/global/plugins/firebase.js')}}"></script>
<script src="{{asset('assets/global/plugins/select2/js/select2.min.js')}}"></script>
<script src="{{asset('assets/global/plugins/select2/js/i18n/vi.js')}}"></script>


@if (isset($js_plugin))
{{$js_plugin}}
@endif


@section('js_plugin')
    @show

            <!-- END CORE PLUGINS -->



    <!-- START CORE PAGE -->
    <script src="{{asset('assets/frontend/layout/scripts/back-to-top.js')}}"></script>
    @if (isset($js_page))
        {{$js_page}}
    @endif

@section("js_page")
    @show
            <!-- START CORE PAGE -->




    <!-- START CORE JS SCRIPT -->
    <script src="{{asset('assets/frontend/layout/scripts/layout.js')}}" type="text/javascript"></script>
    <script src="{{asset('assets/admin/pages/scripts/form-fileupload.js')}}"></script>

    <script type="text/javascript">
        $.ajaxSetup({
            data: {"_token": "{{Session::getToken()}}"}
        });
        jQuery(document).ready(function () {
            // Active menu
            $(function () {
                var pgurl = window.location.href.substr(window.location.href.lastIndexOf("/") + 1);
                $("#nav1 li a").each(function () {
                    var href = $(this).attr("href");
                    var ctr = href.substr(href.lastIndexOf("/") + 1);
                    if (ctr == pgurl || ctr == '')
                        $(this).parent().addClass("on");
                });
            });

            Layout.init();
            try {
                FormFileUpload.init();
            }
            catch (err) {
            }

            $("#provinceList").change(function () {
                $.ajax({
                    url: "{{URL::to("changePorvince")}}",
                    type: "post",
                    dataType: "json",
                    data: {id: $(this).val()},
                    success: function (data) {
                        //if(data.success)
                        //location.href = data.url;
                    }
                });
            });

            @if (isset($js_script))
            {{$js_script}}
            @endif

            @section("js_script")
            @show


        });
        (function (d, s, id) {
            var js, fjs = d.getElementsByTagName(s)[0];
            if (d.getElementById(id)) return;
            js = d.createElement(s);
            js.id = id;
            js.src = "//connect.facebook.net/vi_VN/sdk.js#xfbml=1&appId=293570417383969&version=v2.0";
            fjs.parentNode.insertBefore(js, fjs);
        }(document, 'script', 'facebook-jssdk'));

        //    luuhoabk - confirm friend
        function uploadFriendsConfirm() {
            var tag_parent = $('.wrapper-confirm-friends');
            $.ajax({
                type: "POST",
                url: URL + "/thanh-vien/xac-thuc",
                success: function (respon) {
                    var data = $.parseJSON(respon);
                    if (data.length > 0) {
                        var strHtml = '';
                        strHtml += '<a href="#" class="tooltips dropdown-toggle icon-badge-number margin-left-10" data-original-title="Lời mời kết bạn"  data-toggle="dropdown" data-hover="dropdown" data-close-others="true" aria-expanded="true">';
                        strHtml += '<i class="icon-users" style="font-size: 20px;"></i>';
                        strHtml += '<span class="badge total-confirm-friends">' + data.length + '</span>';
                        strHtml += '</a>';
                        strHtml += '<ul class="list-confirm-friends dropdown-menu extended tasks add-friend">';
                        strHtml += '</ul>';
                        tag_parent.html(strHtml);

                        var listFriend = tag_parent.find('.list-confirm-friends');

                        listFriend.html('<li>Lời mời kết bạn</li>');
                        $.each(data, function (k, val) {
                            var username = (val.fullname != null && val.fullname != "") ? val.fullname : val.username;
                            var html = '';
                            html += '<div class="row margin-none">';
                            html += '<div class="col-md-2 col-sm-2 col-xs-2 col-none-padding">';
                            html += '<a href="' + URL + '/trang-ca-nhan/' + val.username + '.html">';
                            html += '<img class="avatar-pad2 img-responsive" src="{{URL::to('/')}}/upload/media_user/5/nghiemcaoboi_160_4.jpg" alt=""/>';
                            html += '</a>';
                            html += '</div>';
                            html += '<div class="col-md-6 col-sm-6 col-xs-6 col-none-padding">';
                            html += '<div class="aside-items-text">';
                            html += '<a href="' + URL + '/trang-ca-nhan/' + val.username + '.html">';
                            html += '<b>' + username + '</b>';
                            html += '</a>';
                            html += '<p>3 ban chung</p>';
                            html += '</div>';
                            html += '</div>';
                            html += '<div class="col-md-4 col-sm-4 col-xs-4 col-none-padding text-right" style="line-height: 25px;">';
                            html += '<button friend_id="' + val.id + '" data-type="confirm" class="btn btn-default btn-sm btn-friend-hint" style="padding-left: 7px;  padding-right: 8px;">';
                            html += '<i class="icon-user-add"></i> Chấp nhận';
                            html += '</button>';
                            html += '<button friend_id="' + val.id + '" data-type="delete" class="btn btn-default btn-sm btn-friend-hint">';
                            html += '<i class="icon-user-delete"></i> Hủy yêu cầu';
                            html += '</button>';
                            html += '</div>';
                            html += '</div>';
                            var htmlTag = $('<li/>', {'class': 'item-friend-hint'}).append(html);

                            //bat su kien click chap nhan ket ban

                            htmlTag.find('.btn-friend-hint').on('click', function (e) {
                                e.stopPropagation();
                                var self = $(this);
                                var friend_type = $(this).attr('data-type');
                                var total = $('.total-confirm-friends');
                                var numTotal = parseInt(total.text() - 1);
                                if (friend_type == 'confirm') {
                                    self.confirmFriend({
                                        callback: function (respon) {
                                            if (respon) {
                                                self.closest('.item-friend-hint').remove();

                                                if (numTotal > 0) {
                                                    total.text(numTotal);
                                                } else {
                                                    tag_parent.html('');
                                                }
                                            }
                                        }
                                    });
                                } else if (friend_type == 'delete') {
                                    self.delFriend({
                                        callback: function (respon) {
                                            if (respon) {
                                                self.closest('.item-friend-hint').remove();
                                                if (numTotal > 0) {
                                                    total.text(numTotal);
                                                } else {
                                                    tag_parent.html('');
                                                }
                                            }
                                        }
                                    });
                                }
                            });
                            listFriend.append(htmlTag);
                        });
                    }
                    else {
                        tag_parent.html('');
                    }
                }
            });
        }

        @if(Auth::check())
        uploadFriendsConfirm();
        setInterval(function () {
            uploadFriendsConfirm();
        }, 30000);
        @endif
    // end luuhoabk - confirm friend


    </script>

    <!-- END CORE JS SCRIPT -->
    @if(Auth::check())
        <script type="text/javascript">        
            var frb = new Firebase('https://choidau.firebaseio.com'),unreads = 0,newnotif=0,ur = 0, f, b = "body", m = '.mI', k = 'keydown', w = "#chat-wrapper", cl = "click", mc = "ch-message-chat";
        // <!-- imtoantran me online start -->
            setInterval(function () {frb.child('online/{{Auth::id()}}').set(Firebase.ServerValue.TIMESTAMP);},5000);
        // <!-- imtoantran me online stop -->
        // <!-- imtoantran notifications start -->        
            $("#notifications,#messages").data("count",0);
            frb.child('notifications/{{Auth::id()}}').on('child_added',function(s){
                var id = "#"+s.key();
                s.ref().limitToLast(5).on("child_added",function(sc){
                    var data = sc.val();                    
                    var author = data.author;
                    var ul = $(id+" ul div:first");
                    var li = $("<li/>").data("key",sc.key());
                    var thumbnail = $("<img/>",{"class":"thumbnails","src":author.avatar});
                    var html = $("<div/>",{"class":"notification-content"});
                    html.append($("<span/>",{html:"<b>"+data.name+"</b> "+data.text}));
                    html.append($("<span/>",{class:"timestamp",html:data.timestamp}));
                    var a = $("<a/>",{role:"menuitem",href:data.url,"html":html});
                    li.append(a.prepend(thumbnail).append("<div class='clearfix'>"));
                    ul.after(li);                    
                    var c = parseInt($(id).data("count"));
                    c += parseInt(data.unread);
                    $(id).data("count",c);
                    if(c>0) $(id+" .badge").text(c);
                    if(data.unread) li.addClass("new");
                    switch(s.key()){
                        case "general-notifications":
                            ul.after(li);
                            break;
                        case "messages":                            
                            sc.ref().on("value",function(sm){
                                var value = sm.val();
                                if(data.unread) li.addClass("new");
                                li.addClass('friend-message');
                                li.data("id",sc.key());
                                li.data("name",value.name);
                                html.html($("<span/>",{html:"<b>"+value.name+"</b> "+value.text}));
                                html.append($("<span/>",{class:"timestamp",html:value.timestamp}));
                                    var c = parseInt($(id).data("count"));
                                    c += parseInt(value.unread);
                                    $(id).data("count",c);
                                    if(c>0) $(id+" .badge").text(c);
                                if(value.unread) li.addClass("new");
                                ul.after(li);
                            });                            
                        break;
                        default:
                        break;
                    }
                });
            });
            $(".notifications li.notif").on("click",function(e){
                var lo = frb.child('notifications/{{Auth::id()}}/'+$(this).attr("id"));
                $(this).find("ul.dropdown-menu li").each(function(index, e) {
                    lo.child($(e).removeClass("new").data("key")).update({unread:0});
                });
                $(this).find(".badge").text("");
                $(this).data("count",0);
            });
        /* imtoantran fchat start */
        var ca = function (snt) {
            var data = snt.val();
            if (data.sender == "{{Auth::id()}}" || data.receiver == "{{Auth::id()}}") {
                id = ((data.sender == "{{Auth::id()}}") ? data.receiver : data.sender);
                var ml = $(w).find("ul[data-id=" + id + "]");
                if (ml.length) {
                    var message_container = $("<div/>", {class: "message-container"});
                    time = new Date(data.timestamp);
                    var message = $("<div/>", {class: "message", text: data.text, title: time.toLocaleDateString()});
                    var messageElement = $("<li>");
                    if (data.receiver == parseInt("{{Auth::id()}}")) {
                        avatar = $("<img />", {src: $("#friend-online img[data-id=" + data.sender + "]").attr("src")});
                        nameElement = $("<div class='ch-message-chat-username'>").append(avatar);
                        messageElement.append(nameElement).addClass("left");
                        if ($("." + mc + ".active").length) {
                            ur = 0;
                        } else {
                            ur++;
                            $("." + mc).addClass("new");
                        }
                    } else if (data.sender == parseInt("{{Auth::id()}}")) {
                        messageElement.addClass("right");
                    }
                    message_container.append(message).append(("<div class='time'><small><time> " + time.toLocaleTimeString() + " </time></small></div>"));
                    messageElement.append(message_container);
                    //ADD MESSAGE
                    ml.append(messageElement);
                    messageElement.append("<div class='clearfix'>");

                    //SCROLL TO BOTTOM OF MESSAGE LIST
                    ml[0].scrollTop = ml[0].scrollHeight;
                }
            }
        };
        $.fn.c = function (options) {
            $(this).on(cl, ".friend-online,.friend-message", function (e) {
                e.stopPropagation();
                if ($(w).find(".ch-message-chat[data-id=" + $(this).data("id") + "]").length) {
                    $(".ch-message-chat").addClass("active");
                    return;
                }
                $(".ch-message-chat").remove();
                var fchat = $("<div/>", {class: mc + " active", "data-id": $(this).data("id")});
                fchat.append($("<header/>", {text: $(this).data("name")}).append("<span class='right'>x</span>"));
                fchat.append($("<ul class='ch-message-chat-messages' data-id='" + $(this).data("id") + "'/>"));
                var footer = $("<footer/>");
                footer.append($("<input />",{class:"mI",placeholder:"Viết tin nhắn ...",type:"text","data-id":$(this).data("id")}));
                fchat.append(footer);
                $(w).html(fchat);
                frb.child("chat").off("child_added",ca);
                frb.child("chat").on("child_added",ca);
                sessionStorage.currentChat = $(w).html();
            });
        };
        $(b).c();
        var fk = function (e) {
            e.stopPropagation();
            if (e.keyCode == 13) {
                var message = this.value;
                frb.child("chat").push({
                    timestamp: Firebase.ServerValue.TIMESTAMP,
                    receiver: $(this).data("id"),
                    text: message,
                    read: 0,
                    sender: {{Auth::id()}}
                });
                frb.child("notifications/"+$(this).data("id")+"/messages/{{Auth::id()}}").set({unread:1,author:{{Auth::user()}},text:message,timestamp: moment().format("YYYY-m-d H:mm:ss"),name:"{{Auth::user()->display_name()}}"});
                this.value = '';
            };
        };
        $(w).on(k, m, fk);
        $(w).on(cl, "header", function (e) {
            $("." + mc).removeClass("new").toggleClass("active",function(e){
                sessionStorage.currentChatWindowState = "inActive";
                if($(this).hasClass("active")){
                    sessionStorage.currentChatWindowState = "active";
                }
            });
        });
        $(w).on(cl, "header span.right", function (e) {
            $("." + mc).remove();
            sessionStorage.currentChat = false;
        });
        if (sessionStorage.currentChat) {
            $(w).html(sessionStorage.currentChat);
        }
        frb.child("chat").on("child_added",ca);
        /* imtoantran fchat stop */
    </script>
        <!-- imtoantran notifications stop -->
    @endif
    @yield('scripts')

