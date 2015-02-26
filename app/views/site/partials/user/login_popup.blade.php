
<!--
<div class="modal large fade in" id="popup-login" data-backdrop="static" style="display: block;" aria-hidden="false"><div class="modal-backdrop fade in" style="height: 615px;"></div>
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
                <h4 class="modal-title">??ng Nh?p</h4>
            </div>
            <div class="modal-body">
                <form class="login-form" action="index.html" method="post" novalidate="novalidate">
                    <h3 class="form-title">Login to your account</h3>
                    <div class="alert alert-danger display-hide">
                        <button class="close" data-close="alert"></button>
			<span>
			Enter any username and password. </span>
                    </div>
                    <div class="form-group">

                        <label class="control-label visible-ie8 visible-ie9">Username</label>
                        <div class="input-icon">
                            <i class="fa fa-user"></i>
                            <input class="form-control placeholder-no-fix" type="text" autocomplete="off" placeholder="Username" name="username">
                        </div>
                    </div>
                    <div class="form-group">
                        <label class="control-label visible-ie8 visible-ie9">Password</label>
                        <div class="input-icon">
                            <i class="fa fa-lock"></i>
                            <input class="form-control placeholder-no-fix" type="password" autocomplete="off" placeholder="Password" name="password">
                        </div>
                    </div>
                    <div class="form-actions">
                        <label class="checkbox">
                            <div class="checker"><span><input type="checkbox" name="remember" value="1"></span></div> Remember me </label>
                        <button type="submit" class="btn blue pull-right">
                            Login <i class="m-icon-swapright m-icon-white"></i>
                        </button>
                    </div>
                    <div class="login-options">
                        <h4>Or login with</h4>
                        <ul class="social-icons">
                            <li>
                                <a class="facebook" data-original-title="facebook" href="#">
                                </a>
                            </li>
                            <li>
                                <a class="twitter" data-original-title="Twitter" href="#">
                                </a>
                            </li>
                            <li>
                                <a class="googleplus" data-original-title="Goole Plus" href="#">
                                </a>
                            </li>
                            <li>
                                <a class="linkedin" data-original-title="Linkedin" href="#">
                                </a>
                            </li>
                        </ul>
                    </div>
                    <div class="forget-password">
                        <h4>Forgot your password ?</h4>
                        <p>
                            no worries, click <a href="javascript:;" id="forget-password">
                                here </a>
                            to reset your password.
                        </p>
                    </div>
                    <div class="create-account">
                        <p>
                            Don't have an account yet ?&nbsp; <a href="javascript:;" id="register-btn">
                                Create an account </a>
                        </p>
                    </div>
                </form>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-default" data-dismiss="modal">?óng</button>
                <button type="button" class="btn btn-primary" id="review-save">Hoàn t?t</button>
            </div>
        </div>
    </div>
</div>
-->

<div id="popup-login" style="z-index: 1051; display: none;" class="modal fade in" role="dialog" aria-labelledby="myModalLabel" aria-hidden="false" data-backdrop="static" data-max-height="440">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header choidau-bg" style=" padding: 6px 10px;">
                <button type="button" class="close" data-dismiss="modal"><span aria-hidden="true">×</span><span class="sr-only">Close</span></button>
                <h5 class="modal-title" id="myModalLabel" style="font-size:1.3em; margin: 5px 0px; text-align:center; font-weight: 600; color: white;">Đăng Nhập</h5>
            </div>
            <div class="modal-body" style="padding: 30px 20px 0px;">

                <form class="form-horizontal">
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
                                <a href="#">Quên mật khẩu?</a> Hoặc chưa có tài khoản, hãy
                                <a href="thanh-vien/dang-ky.html">đăng ký!</a>
                            </small>
                        </div>
                    </div>
                    <div class="form-group alert-popup-login display-none"></div>

                </form>
            </div>

            <div class="modal-footer" id="footer_login" style="padding: 15px 20px 15px;">
                <!-- imtoantran add login with facebook -->
                <button class="btn login-face-btn" type="button">
                    <i class="fa fa-facebook"></i> |
                    đăng nhập Facebook
                </button>
                <!-- <img class='login-face-btn' src="http://beleza.vn/beleza/public/assets/img/fbloginbtn.png" onclick="loginFB()"/> -->
                <!-- imtoantran add login with facebook -->
                <button type="button" class="btn green btn-login-popup-choidau">đăng nhâp <i class="icon-login-2 white"></i>
                </button> <button type="button" class="btn btn-sm btn-default" data-dismiss="modal">Hủy</button>
            </div>
        </div>
    </div>
</div>