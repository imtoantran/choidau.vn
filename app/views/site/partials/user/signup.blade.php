

<form   method="POST" action="{{{ URL::to('user') }}}" accept-charset="UTF-8" class="col-md-8 col-xs-offset-1 col-sm-offset-2 col-md-offset-2 col-lg-offset-2 form-horizontal form-blog"  role="form">
<input type="hidden" name="_token" value="{{{ Session::getToken() }}}">
<fieldset>
<legend>Thông tin đăng ký thành viên</legend>


<div class="form-group">



    <label for="firstname" class="col-lg-3 control-label"for="username">{{{ Lang::get('user/user.username') }}} <span class="require"></span></label>
    <div class="col-xs-12 col-sm-12 col-md-9 col-lg-9">
        <div class="col-xs-10 col-sm-8 col-md-8 col-lg-8 margin-bottom-10">
            <input class="form-control" placeholder="{{{ Lang::get('user/user.username') }}}" type="text" name="username" id="username" value="{{{ Input::old('username') }}}">

        </div>
    </div>
</div>
<div class="form-group">


    <label for="lastname" class="col-lg-3 control-label" for="email">{{{ Lang::get('user/user.e_mail') }}}<small>{{ Lang::get('user/user.signup.confirmation_required') }}</small> <span class="require"></span></label>
    <div class="col-xs-12 col-sm-12 col-md-9 col-lg-9">
        <div class="col-xs-10 col-sm-8 col-md-8 col-lg-8 margin-bottom-10">
            <input class="form-control" placeholder="{{{ Lang::get('user/user.e_mail') }}}" type="text" name="email" id="email" value="{{{ Input::old('email') }}}">

        </div>
    </div>
</div>



<div class="form-group">


    <label for="lastname" class="col-lg-3 control-label" for="password">{{{ Lang::get('user/user.password') }}} <span class="require"></span></label>
    <div class="col-xs-12 col-sm-12 col-md-9 col-lg-9">
        <div class="col-xs-10 col-sm-8 col-md-8 col-lg-8 margin-bottom-10">
            <input class="form-control" placeholder="{{{ Lang::get('user/user.password') }}}" type="password" name="password" id="password">

        </div>
    </div>
</div>



<div class="form-group">


    <label for="lastname" class="col-lg-3 control-label" for="password_confirmation">{{{ Lang::get('user/user.password_confirmation') }}} <span class="require"></span></label>
    <div class="col-xs-12 col-sm-12 col-md-9 col-lg-9">
        <div class="col-xs-10 col-sm-8 col-md-8 col-lg-8 margin-bottom-10">
            <input class="form-control" placeholder="{{{ Lang::get('user/user.password_confirmation') }}}" type="password" name="password_confirmation" id="password_confirmation">

        </div>
    </div>
</div>






<div class="form-group">
    <label for="email" class="col-lg-3 control-label">Tỉnh/Thành Phố <span class="require"></span></label>
    <div class="col-xs-12 col-sm-12 col-md-9 col-lg-9">
        <div class="col-xs-10 col-sm-8 col-md-8 col-lg-8 margin-bottom-10 margin-bottom-10">
            <input type="text" class="form-control" id="email">
        </div>
    </div>
</div>


<div class="form-group">
    <label class="col-lg-3  control-label">Tình Trạng Hôn Nhân
    </label>
    <div class="col-xs-11 col-sm-12 col-md-9 col-lg-9">

        <div class="col-xs-10 col-sm-8 col-md-8 col-lg-8 margin-bottom-10">
            <div class="section-icon-right">
                <select class="form-control" name="select">
                    <option value="">Select...</option>
                    <option value="Category 1">Category 1</option>
                    <option value="Category 2">Category 2</option>
                    <option value="Category 3">Category 5</option>
                    <option value="Category 4">Category 4</option>
                </select>
                <i class="icon-down-dir"></i></button>
            </div>
        </div>
        <div class="col-xs-10 col-sm-4 col-md-4 col-lg-4 margin-bottom-10">
            <div class=" btn-group select-button">
                <button type="button" class="btn btn-default">Default</button>
                <button type="button" class="btn btn-default dropdown-toggle select-bullet" data-toggle="dropdown">
                    <i class="icon-down-dir"></i></button>
                <ul class="dropdown-menu" role="menu">
                    <li>
                        <a href="#">
                            Action </a>
                    </li>
                    <li>
                        <a href="#">
                            Another action </a>
                    </li>
                    <li>
                        <a href="#">
                            Something else here </a>
                    </li>
                    <li class="divider">
                    </li>
                    <li>
                        <a href="#">
                            Separated link </a>
                    </li>
                </ul>
            </div>

        </div>



    </div>

</div>

<div class="form-group">
    <label class="col-lg-3  control-label">Ngày Sinh <span class="required" aria-required="true">
													 </span>
    </label>
    <div class="col-xs-12 col-sm-12 col-md-9 col-lg-9">


        <div class="col-xs-12 col-sm-12 col-md-8 col-lg-8">
            <div class="col-md-4 col-xs-6 col-sm-6 col-none-padding">
                <div class="section-icon-right margin-bottom-10">
                    <select class="form-control" name="select">
                       
						@for ($i = 1; $i <= 31; $i++)
						 <option value="Category 1">{{ $i }}</option>
						@endfor
                     
                    </select>
                    <i class="icon-down-dir"></i></button>
                </div>
            </div>

            <div class="col-md-4 col-xs-6 col-sm-6 margin-bottom-10" style="padding:0px 2px;">
                <div class="section-icon-right">
                    <select class="form-control" name="select">
                        @for ($i = 1; $i <=12; $i++)
						 <option value="Category 1">{{ $i }}</option>
						@endfor
                    </select>
                    <i class="icon-down-dir"></i></button>
                </div>
            </div>
            <div class="col-md-4 col-xs-6 col-sm-6 margin-bottom-10 col-none-padding">
                <div class="section-icon-right">
                    <select class="form-control" name="select">
                       @for ($i = 1980; $i < 2018; $i++)
						 <option value="Category 1">{{ $i }}</option>
						@endfor
                    </select>
                    <i class="icon-down-dir"></i></button>
                </div>
            </div>





        </div>
        <div class="col-xs-12 col-sm-12 col-md-4 col-lg-4">

            <div class="btn-group select-button">
                <button type="button" class="btn btn-default">Default</button>
                <button type="button" class="btn btn-default dropdown-toggle select-bullet" data-toggle="dropdown">
                    <i class="icon-down-dir"></i></button>
                <ul class="dropdown-menu" role="menu">
                    <li>
                        <a href="#">
                            Action </a>
                    </li>
                    <li>
                        <a href="#">
                            Another action </a>
                    </li>
                    <li>
                        <a href="#">
                            Something else here </a>
                    </li>
                    <li class="divider">
                    </li>
                    <li>
                        <a href="#">
                            Separated link </a>
                    </li>
                </ul>
            </div>
        </div>


    </div>


</div>

<div class="form-group">
    <label class="col-lg-3  control-label">Giới Tính<span class="required" aria-required="true">
													 </span>
    </label>

    <div class="col-xs-12 col-sm-12 col-md-9 col-lg-9">
        <div class="col-xs-12 col-sm-8 col-md-8 col-lg-8">

            <div class="radio-list radio-button">


                <label class="radio-inline">
                    <input type="radio" name="optionsRadios" id="optionsRadios4" value="option1" checked>
                    <i> </i><span>Nam</span>
                </label>
                <label class="radio-inline">
                    <input type="radio" name="optionsRadios" id="optionsRadios5" value="option2">
                    <i> </i><span>Nữ</span>
                </label>


            </div>


        </div>
        <div class=" col-md-4">

            <div class="btn-group select-button">
                <button type="button" class="btn btn-default">Default</button>
                <button type="button" class="btn btn-default dropdown-toggle select-bullet" data-toggle="dropdown">
                    <i class="icon-down-dir"></i></button>
                <ul class="dropdown-menu" role="menu">
                    <li>
                        <a href="#">
                            Action </a>
                    </li>
                    <li>
                        <a href="#">
                            Another action </a>
                    </li>
                    <li>
                        <a href="#">
                            Something else here </a>
                    </li>
                    <li class="divider">
                    </li>
                    <li>
                        <a href="#">
                            Separated link </a>
                    </li>
                </ul>
            </div>
        </div>


    </div>

</div>

<div class="form-group">
    <label class="col-lg-3  control-label">Giới thiệu bản thân <span class="required" aria-required="true">
													 </span>
    </label>
    <div class="col-xs-12 col-sm-12 col-md-9 col-lg-9 ">

        <div class="col-xs-12 col-sm-8 col-md-8 col-lg-8 margin-bottom-10">
            <textarea class="form-control" rows="3"></textarea>
        </div>
        <div class=" col-xs-12 col-sm-4 col-md-4 col-lg-4">
            <div class=" btn-group select-button">
                <button type="button" class="btn btn-default">Default</button>
                <button type="button" class="btn btn-default dropdown-toggle select-bullet" data-toggle="dropdown">
                    <i class="icon-down-dir"></i></button>
                <ul class="dropdown-menu" role="menu">
                    <li>
                        <a href="#">
                            Action </a>
                    </li>
                    <li>
                        <a href="#">
                            Another action </a>
                    </li>
                    <li>
                        <a href="#">
                            Something else here </a>
                    </li>
                    <li class="divider">
                    </li>
                    <li>
                        <a href="#">
                            Separated link </a>
                    </li>
                </ul>
            </div>

        </div>


    </div>




</div>

<div class="form-group">
    <label class="col-lg-3 control-label">Chia sẽ lên facebook
													<span class="required" aria-required="true">
													 </span>
    </label>
    <div class="col-xs-12 col-sm-12 col-md-9 col-lg-9 ">
        <div class="col-xs-12 col-sm-5 col-md-5 col-lg-5"">

        <div class="radio-list radio-button">


            <label class="radio-inline">
                <input type="radio" name="radioshareface" id="optionsRadios4" value="option1" checked>
                <i> </i><span></span>
            </label>
            <label class="radio-inline">
                <input type="radio" name="radioshareface" id="optionsRadios5" value="option2">
                <i> </i><span></span>
            </label>


        </div>




    </div>
    <div class=" col-xs-12 col-sm-7 col-md-7 col-lg-7"">
    <button type="submit" class="btn btn-primary">{{{ Lang::get('confide::confide.signup.submit') }}}</button>


    <button type="button" class="btn btn-default">Huỷ</button>
</div>
</div>
@if (Session::get('error'))
<div class="alert alert-error alert-danger">
    @if (is_array(Session::get('error')))
    {{ head(Session::get('error')) }}
    @endif
</div>
@endif

@if (Session::get('notice'))
<div class="alert">{{ Session::get('notice') }}</div>
@endif


</fieldset>
</form>