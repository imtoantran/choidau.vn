
{{--form signup--}}
<form id="frm-signup" method="POST" action="#" accept-charset="UTF-8" class="col-md-8 col-xs-offset-1 col-sm-offset-2 col-md-offset-2 col-lg-offset-2 form-horizontal form-blog"  role="form">
    <input type="hidden" name="_token" value="{{{ Session::getToken() }}}">
    <fieldset>
        <legend class="margin-bottom-5">Thông tin đăng ký</legend>
        {{--fullname--}}
        <div class="alert alert-danger alert-error hidden">
            <button class="close alert-close" data-close="alert"></button>
            <i class="icon-attention" style="color:#a94442;"></i>
            <span class="content-alert">...</span>
        </div>
        <div class="alert alert-success hidden">
            <button class="close alert-close" data-close="alert"></button>
            Tạo địa điểm thành công!
        </div>

        <div class="form-group margin-top-10">
            <label class="col-lg-3 col-md-3 col-sm-3 control-label" for="fullname" >Họ tên đầy đủ <span class="required" aria-required="true">*</span></label>
            <div class="col-xs-12 col-sm-12 col-md-9 col-lg-9">
                <div class="col-xs-12 col-sm-12 col-md-9 col-lg-9 margin-bottom-10">
                    <div class="input-group">
                        <span class="input-group-addon"> <i class="icon-vcard"></i></span>
                        <input type="text" id="fullname" name="fullname" class="form-control" placeholder="Nhập họ tên đầy đủ" value="" maxlength="50" required pattern="{6,50}" title="Họ tên phải từ 6 kí tự ">
                    </div>
                </div>
            </div>
        </div>

        {{--username--}}
        <div class="form-group">
            <label class="col-lg-3 col-md-3 col-sm-3 control-label" for="username" >Tên đăng nhập <span class="required" aria-required="true">*</span></label>
            <div class="col-xs-12 col-sm-12 col-md-9 col-lg-9">
                <div class="col-xs-10 col-sm-10 col-md-9 col-lg-9 margin-bottom-10">
                    <div class="input-group">
                        <span class="input-group-addon"> <i class="icon-user"></i></span>
                        <input type="text" id="username" name="username" data-check="0" class="form-control" placeholder="Tên đăng nhập" value="" required pattern="[a-z|A-z|0-9|]{6,20}" title="Tài khoản phải từ 6 kí tự và không có kí tự đặc biệt">
                    </div>
                </div>
                <div class="col-xs-2 col-sm-2 col-md-3 col-lg-3 col-none-padding">
                    <span class="username-success display-none sub-alert" style="line-height: 36px;"><i class="icon-check green" style="font-size: 18px;"></i></span>
                    <span class="username-error display-none sub-alert" style="line-height: 36px;"><i class="icon-error-alt red" style="font-size: 18px;"></i></span>
                </div>
                <div class="col-xs-12 col-sm-12 col-md-9 col-lg-9 username-alert-content font-weight-600 display-none red sub-alert" style="margin-top: -7px;">
                    Tài khoản này đã tồn tại.
                </div>
            </div>

        </div>

        {{--email--}}
        <div class="form-group">
            <label class="col-lg-3 col-md-3 col-sm-3 control-label" for="email" >Email <span class="required" aria-required="true">*</span></label>
            <div class="col-xs-12 col-sm-12 col-md-9 col-lg-9">
                <div class="col-xs-10 col-sm-10 col-md-9 col-lg-9 margin-bottom-10">
                    <div class="input-group">
                        <span class="input-group-addon padding-lr-15 font-weight-600" > @ </span>
                        <input type="email" id="email" name="email" data-check="0" class="form-control" placeholder="Email đăng ký" value="" required>
                    </div>
                </div>
                <div class="col-xs-2 col-sm-2 col-md-3 col-lg-3 col-none-padding">
                    <span class="email-success sub-alert display-none" style="line-height: 36px;"><i class="icon-check green" style="font-size: 18px;"></i></span>
                    <span class="email-error sub-alert display-none" style="line-height: 36px;"><i class="icon-error-alt red" style="font-size: 18px;"></i></span>
                </div>
                <div class="col-xs-12 col-sm-12 col-md-9 col-lg-9 email-alert-content font-weight-600 display-none red sub-alert" style="margin-top: -7px;">
                    Email này đã tồn tại.
                </div>
            </div>
        </div>

        {{--password--}}
        <div class="form-group">
            <label class="col-lg-3 col-md-3 col-sm-3 control-label" for="password" >Mật khẩu <span class="required" aria-required="true">*</span></label>
            <div class="col-xs-12 col-sm-12 col-md-9 col-lg-9">
                <div class="col-xs-12 col-sm-12 col-md-9 col-lg-9 margin-bottom-10">
                    <div class="input-group">
                        <span class="input-group-addon"> <i class="icon-key-inv"></i> </span>
                        <input type="password" id="password" name="password" class="form-control" placeholder="Mật khẩu" value="" required pattern="[a-z|A-z|0-9|\S]{6,40}" title="Mật khẩu phải từ 6 kí tự và không có khoảng trắng">
                    </div>
                </div>
            </div>
        </div>

        {{--password - confirm--}}
        <div class="form-group">
            <label class="col-lg-3 col-md-3 col-sm-3 control-label" for="password-confirm" >Xác nhận mật khẩu <span class="required" aria-required="true">*</span></label>
            <div class="col-xs-12 col-sm-12 col-md-9 col-lg-9">
                <div class="col-xs-12 col-sm-12 col-md-9 col-lg-9 margin-bottom-10">
                    <div class="input-group">
                        <span class="input-group-addon"> <i class="icon-key-outline"></i> </span>
                        <input type="password" id="password-confirm" name="password-confirm" class="form-control" placeholder="Nhập lại mật khẩu" value="" pattern="[a-z|A-z|0-9|\S]{6,40}" title="Mật khẩu phải từ 6 kí tự và không có khoảng trắng" required>
                    </div>
                </div>
            </div>
        </div>

        {{--birthday--}}
        <div class="form-group">
            <label class="col-lg-3 col-md-3 col-sm-3 control-label" for="birthday" >Ngày sinh <span class="required" aria-required="true">*</span></label>
            <div class="col-xs-12 col-sm-12 col-md-9 col-lg-9">
                <div class="col-xs-12 col-sm-12 col-md-9 col-lg-9 margin-bottom-10">
                    <div class="input-group">
                        <span class="input-group-addon"> <i class="icon-birthday"></i> </span>
                        <input type="text" id="birthday" name="birthday" class="form-control" placeholder="VD: dd/mm/yyyy" value="" required>
                    </div>
                </div>
            </div>
        </div>

        {{--gender--}}
        <div class="form-group">
            <label class="col-lg-3 col-md-3 col-sm-3 control-label" for="male" >Giới tính</label>
            <div class="col-xs-12 col-sm-12 col-md-9 col-lg-9">
                <div class="col-xs-12 col-sm-12 col-md-9 col-lg-9 margin-bottom-10">
                    <div class="input-group">
                        <label class="radio-inline">
                            <input type="radio" name="gender" id="male" checked value="1">Nam
                        </label>
                        <label class="radio-inline">
                            <input type="radio" name="gender" id="female" value="0">Nữ
                        </label>
                    </div>
                </div>
            </div>
        </div>

        <div class="form-group">
            <label class="col-lg-3 col-md-3 col-sm-3 control-label"></label>
            <div class="col-xs-12 col-sm-12 col-md-9 col-lg-9">
                <div class="col-xs-12 col-sm-12 col-md-9 col-lg-9 margin-bottom-10">
                    <button type="submit" class="btn green">Đăng ký</button>
                    <button id="reset" type="reset" class="btn default">Hủy</button>
                </div>
            </div>
        </div>

        {{--<div class="form-actions">--}}
            {{--<div class="row">--}}
                {{--<div class="col-sm-offset-3 col-md-8">--}}
                    {{--<button type="submit" class="btn green btn-sm">Đăng ký</button>--}}
                    {{--<button type="reset" class="btn default btn-sm">Hủy</button>--}}
                {{--</div>--}}
            {{--</div>--}}
        {{--</div>--}}
    </fieldset>
</form>

<script type="text/javascript">

    jQuery(document).ready(function(){

        $('#birthday').datepicker({format: 'dd/mm/yyyy'});
        $('.close.alert-close').on('click', function(e){
            e.preventDefault();
            $(this).closest('.alert').fadeOut();
        });



        $('#username').blur(function(){
            var username = $(this).val();
            $.ajax({
                url: "{{URL::to('thanh-vien/user-exist')}}",
                data: {
                    type: 'username',
                    value: username
                },
                type: 'POST',
                success : function(respon){
                    var tag_error = $('.username-error');
                    var tag_success = $('.username-success');
                    var tag_error_content = $('.username-alert-content');

                    if(respon == 1){
                        tag_error_content.fadeIn();
                        tag_success.hide();
                        tag_error.fadeIn();
                        $('#username').attr('data-check','0');
                    }else{
                        tag_error.hide();
                        tag_success.fadeIn();
                        tag_error_content.fadeOut();
                        $('#username').attr('data-check','1');

                    }
                }
            })
        });

        $('#frm-signup').find('#reset').on('click', function(e){
            e.preventDefault();
            $('#frm-signup').find('.sub-alert').hide();
            $('#frm-signup input').val('');
        })

        $('#email').blur(function(){
            var username = $(this).val();
            $.ajax({
                url: "{{URL::to('thanh-vien/user-exist')}}",
                data: {
                    type: 'email',
                    value: username
                },
                type: 'POST',
                success : function(respon){
                    console.log(respon);
                    var tag_error = $('.email-error');
                    var tag_success = $('.email-success');
                    var tag_error_content = $('.email-alert-content');
                    if(respon == 1){
                        tag_error_content.fadeIn();
                        tag_success.hide();
                        tag_error.fadeIn();
                        $('#frm-signup').find('#email').attr('data-check','0');
                    }else{
                        tag_error.hide();
                        tag_success.fadeIn();
                        tag_error_content.fadeOut();
                        $('#frm-signup').find('#email').attr('data-check','1');

                    }
                }
            })
        });


        $('#frm-signup').submit(function(e){
            var self = $(this);
            var pass = $(this).find('#password');
            var pass_confirm = $(this).find('#password-confirm');
            e.preventDefault();
            if(pass.val() != pass_confirm.val()){
                $('.alert-error').removeClass('hidden').fadeIn();
                $('.alert-error').find('.content-alert').text('Mật khẩu xác nhận không đúng.');
                pass.val('').focus();
                pass_confirm.val('');
                return;
            }
            $('#reset').on('click', function(){
//                $('i.icon-error-alt').hide();
//                $('.display-none ').hide();
                console.log('hello');
            });

            if(self.find('#username').attr('data-check') == '0'){
                self.find('#username').focus();
                return;
            }
            if(self.find('#email').attr('data-check') == '0'){
                self.find('#email').focus();
                return;
            }

            $.ajax({
                url: "{{URL::to('thanh-vien/dang-ky.html')}}",
                data: self.serialize(),
                type: 'POST',
                success: function(respon){
                    if(respon != 0){
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
                        htmlBox += '<p class="font-weight-600">Xin chào <label class="color-red">'+ $('#fullname').val()+'</label>!</p>';
                        htmlBox += '<p>Bạn đã tạo tài khoản <label class="label label-success label-sm bold">'+$('#username').val()+'</label> thành công!</p>';
                        htmlBox += '<p>Vui lòng kiểm tra email để xác thực tài khoản</p>';
                        htmlBox += '<div class="margin-top-20">';
                        htmlBox += '<a href="{{URL::to('/')}}" class="btn green btn-sm">';
                        htmlBox += '<i class="icon-home color-white"></i> Đi đến trang chủ</a> ';

                        htmlBox += '</div>';
                        htmlBox += '</div>';
                        htmlBox += '</div>';
                        htmlBox += '</div>';

                        bootbox.dialog({
                            message: htmlBox,
                            closeButton: false
                        });
                        $('.modal-dialog').css({'width':'50%','margin-top':'100px'});
                        $('.modal-content').css('background-color','#f7f7f0');
                    }else{
                        $('.alert-error').removeClass('hidden').fadeIn();
                        $('.alert-error').find('.content-alert').text('Đã có lô.');
                    }

                }

            });
        });
    });
</script>
