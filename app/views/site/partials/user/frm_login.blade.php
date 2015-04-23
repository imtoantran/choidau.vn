
    <div class="modal-content">
        <div class="modal-header choidau-bg" style=" padding: 6px 10px;">
            <button type="button" class="close" data-dismiss="modal"><span aria-hidden="true">×</span><span class="sr-only">Close</span></button>
            <h5 class="modal-title" id="myModalLabel" style="font-size:1.3em; margin: 5px 0px; text-align:center; font-weight: 600; color: white;">Đăng Nhập</h5>
        </div>
        <div class="modal-body" style="padding: 30px 20px 0px;">
            <form class="form-horizontal" id="frm-login-popup">
                <input type="hidden" name="_token" id="_token" value="{{ csrf_token() }}">
                <div class="form-group">
                    <label class="control-label col-sm-3">Tên đăng nhâp</label>
                    <div class="col-sm-8">
                        <input autocomplete="off" class="form-control" type="text" id="username_popup_login" name="email_login" placeholder="Nhập email...VD:abc@example.com">
                    </div>
                </div>
                <div class="form-group">
                    <label class="control-label col-sm-3">Mật Khẩu</label>
                    <div class="col-sm-8">
                        <input autocomplete="off" class="form-control" type="password" id="password_popup_login" name="pass_login" placeholder="Nhập mật khẩu...">
                    </div>
                </div>
                <div class="form-group">
                    <label class="control-label col-sm-2"></label>
                    <div class="col-sm-10">
                        <div class="checkbox">
                            Ghi nhớ cho lần sau.
                            {{--<input type="hidden" name="remember" value="0">--}}
                            <input class="margin-left-20" tabindex="4" type="checkbox" name="remember" id="remember_popup_login" value="1">
                        </div>
                    </div>
                    <div class="col-md-offset-2 col-md-10" style="padding-top:10px">
                        <small>
                            <a class="font-weight-600 italic" href="{{URL::to('thanh-vien/quen-mat-khau.html')}}">Quên mật khẩu?</a> Hoặc chưa có tài khoản, hãy
                            {{--Chưa có tài khoản, hãy--}}
                            <a class="font-weight-600 italic" href="{{URL::to('thanh-vien/dang-ky.html')}}">đăng ký!</a>
                        </small>
                    </div>
                </div>
                <div class="form-group alert-popup-login display-none"></div>
                <input type="submit" class="hidden"/>
            </form>
        </div>
        <div class="modal-footer" id="footer_login" style="padding: 15px 20px 15px;">
            <!-- luuhoabk add login with facebook -->
            <button class="btn btn-sm btn-danger login-google-btn" type="button" data-url="{{URL::current()}}">
                <i class="icon-googleplus-rect-1 white"></i>
                | Google+
            </button>
            <button class="btn btn-sm login-face-btn" type="button" data-url="{{URL::current()}}">
                <i class="icon-facebook white"></i>
                | Facebook
            </button>
            <!-- <img class='login-face-btn' src="http://beleza.vn/beleza/public/assets/img/fbloginbtn.png" onclick="loginFB()"/> -->
            <!-- imtoantran add login with facebook -->
            <button type="button" class="btn btn-sm green btn-login-popup-choidau">đăng nhâp <i class="icon-login-2 white"></i>
            </button> <button type="button" class="btn btn-sm btn-default btn-cancel" data-dismiss="modal">Hủy</button>
        </div>
    </div><!-- /.modal-content -->
