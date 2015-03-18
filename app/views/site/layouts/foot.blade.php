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
<script src="{{asset('assets/global/plugins/jquery-ui/jquery-ui-1.10.3.custom.min.js')}}" type="text/javascript"></script>
<script src="{{asset('assets/global/plugins/bootstrap-datetimepicker/js/moment.js')}}" type="text/javascript" ></script>
<script src="{{asset('assets/global/plugins/bootstrap-datetimepicker/js/locales/vi.js')}}" type="text/javascript" ></script>
<script src="{{asset('assets/global/plugins/bootstrap/js/bootstrap.min.js')}}" type="text/javascript"></script>
<script src="{{asset('assets/global/plugins/bootstrap-modal/js/bootstrap-modalmanager.js')}}" type="text/javascript"></script>
<script src="{{asset('assets/global/plugins/bootstrap-modal/js/bootstrap-modal.js')}}" type="text/javascript"></script>
<script src="{{asset('assets/global/plugins/rateit/jquery.rateit.min.js')}}" type="text/javascript"></script>
<script src="{{asset('assets/global/plugins/bootstrap-datetimepicker/js/bootstrap-datetimepicker.min.js')}}" type="text/javascript"></script>
<script src="{{asset('assets/global/plugins/bootbox/bootbox.min.js')}}"></script>
<script src="{{asset('assets/global/plugins/datatables/bootstrap-select.min.js')}}" type="text/javascript"></script>
<script src="{{asset('assets/global/plugins/jquery-alerts/jquery.alerts.min.js')}}" type="text/javascript"></script>
<script src="{{asset('assets/global/plugins/jquery-inputmask/jquery.inputmask.bundle.min.js')}}" type="text/javascript"></script>
<script src="{{asset('assets/global/plugins/jquery.blockui.min.js')}}" type="text/javascript"></script>
<script src="{{asset('assets/global/plugins/dropzone/dropzone.js')}}" type="text/javascript"></script>
<script src="{{asset('assets/global/plugins/fancybox-v3beta/jquery.fancybox.js')}}" type="text/javascript"></script>
<script src="{{asset('assets/global/plugins/fancybox-v3beta/jquery.fancybox-thumbs.js')}}" type="text/javascript"></script>
<script src="{{asset('assets/frontend/pages/scripts/media-manager.js')}}" type="text/javascript"></script>


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
        data:{"_token":"{{Session::getToken()}}"}
    });
    jQuery(document).ready(function() {
        // Active menu
        $(function() {
            var pgurl = window.location.href.substr( window.location.href.lastIndexOf("/") + 1 );
            $("#nav1 li a").each(function(){
                var href = $(this).attr("href");
                var ctr = href.substr( href.lastIndexOf("/") + 1 ) ;
                if(ctr == pgurl || ctr == '' )
                    $(this).parent().addClass("on");
            });
        });

        Layout.init();
        try {
            FormFileUpload.init();
        }
        catch(err) {}

        $("#provinceList").change(function(){
            $.ajax({
                url:"{{URL::to("changePorvince")}}",
                type:"post",
                dataType:"json",
                data:{id:$(this).val()},
                success:function(data){
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
    (function(d, s, id) {
        var js, fjs = d.getElementsByTagName(s)[0];
        if (d.getElementById(id)) return;
        js = d.createElement(s); js.id = id;
        js.src = "//connect.facebook.net/vi_VN/sdk.js#xfbml=1&appId=293570417383969&version=v2.0";
        fjs.parentNode.insertBefore(js, fjs);
    }(document, 'script', 'facebook-jssdk'));

//    luuhoabk - confirm friend
    function uploadFriendsConfirm(){
        var tag_parent = $('.wrapper-confirm-friends');
        $.ajax({
            type: "POST",
            url: URL + "/thanh-vien/xac-thuc",
            success: function (respon) {
                var data = $.parseJSON(respon);
                if(data.length >0){
                    var strHtml ='';
                        strHtml +='<a href="#" class="tooltips dropdown-toggle icon-badge-number margin-left-10" data-original-title="Lời mời kết bạn"  data-toggle="dropdown" data-hover="dropdown" data-close-others="true" aria-expanded="true">';
                            strHtml +='<i class="icon-users" style="font-size: 20px;"></i>';
                            strHtml +='<span class="badge total-confirm-friends">'+data.length+'</span>';
                        strHtml +='</a>';
                        strHtml +='<ul class="list-confirm-friends dropdown-menu extended tasks add-friend">';
                        strHtml +='</ul>';
                    tag_parent.html(strHtml);

                    var listFriend = tag_parent.find('.list-confirm-friends');

                    listFriend.html('<li>Lời mời kết bạn</li>');
                    $.each(data, function(k,val) {
                        var username = (val.fullname != null && val.fullname != "") ? val.fullname: val.username;
                        var html = '';
                        html += '<div class="row margin-none">';
                        html += '<div class="col-md-2 col-sm-2 col-xs-2 col-none-padding">';
                        html += '<a href="'+URL+'/trang-ca-nhan/'+val.username+'.html">';
                        html += '<img class="avatar-pad2 img-responsive" src="http://choidau.net/upload/media_user/5/nghiemcaoboi_160_4.jpg" alt=""/>';
                        html += '</a>';
                        html += '</div>';
                        html += '<div class="col-md-6 col-sm-6 col-xs-6 col-none-padding">';
                        html += '<div class="aside-items-text">';
                        html += '<a href="'+URL+'/trang-ca-nhan/'+val.username+'.html">';
                        html += '<b>'+username+'</b>';
                        html += '</a>';
                        html += '<p>3 ban chung</p>';
                        html += '</div>';
                        html += '</div>';
                        html += '<div class="col-md-4 col-sm-4 col-xs-4 col-none-padding text-right" style="line-height: 25px;">';
                        html += '<button friend_id="'+val.id+'" data-type="confirm" class="btn btn-default btn-sm btn-friend-hint" style="padding-left: 7px;  padding-right: 8px;">';
                        html += '<i class="icon-user-add"></i> Chấp nhận';
                        html += '</button>';
                        html += '<button friend_id="'+val.id+'" data-type="delete" class="btn btn-default btn-sm btn-friend-hint">';
                        html += '<i class="icon-user-delete"></i> Hủy yêu cầu';
                        html += '</button>';
                        html += '</div>';
                        html += '</div>';
                        var htmlTag  = $('<li/>',{'class':'item-friend-hint'}).append(html);

                        //bat su kien click chap nhan ket ban

                        htmlTag.find('.btn-friend-hint').on('click',function(e){
                            e.stopPropagation();
                            var self = $(this);
                            var friend_type = $(this).attr('data-type');
                            var total = $('.total-confirm-friends');
                            var numTotal = parseInt(total.text()-1);
                            if(friend_type == 'confirm'){
                                self.confirmFriend({callback: function(respon){
                                    if(respon){
                                        self.closest('.item-friend-hint').remove();

                                        if(numTotal > 0){
                                            total.text(numTotal);
                                        }else{
                                            tag_parent.html('');
                                        }
                                    }
                                }});
                            }else if(friend_type == 'delete'){
                                self.delFriend({callback: function(respon){
                                    if(respon){
                                        self.closest('.item-friend-hint').remove();
                                        if(numTotal > 0){
                                            total.text(numTotal);
                                        }else{
                                            tag_parent.html('');
                                        }
                                    }
                                }});
                            }
                        });
                        listFriend.append(htmlTag);
                    });
                }
                else{
                    tag_parent.html('');
                }
            }
        });
    }

    @if(Auth::check())
    	uploadFriendsConfirm();
        setInterval(function(){ uploadFriendsConfirm(); }, 30000);
    @endif
// end luuhoabk - confirm friend


</script>

<!-- END CORE JS SCRIPT -->
@yield('scripts')

