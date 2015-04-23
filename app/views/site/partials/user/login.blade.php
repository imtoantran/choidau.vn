<div class="page-login">
    @include('site.partials.user.frm_login')
</div>

{{--<form class="form-horizontal" method="POST" action="{{ URL::to('thanh-vien/dang-nhap.html') }}" accept-charset="UTF-8">--}}
    {{--<input type="hidden" name="_token" value="{{ csrf_token() }}">--}}
    {{--<fieldset>--}}
        {{--<div class="form-group">--}}
            {{--<label class="col-md-2 control-label" for="email">{{{ Lang::get('user/user.username_e_mail') }}}</label>--}}
            {{--<div class="col-md-10">--}}
                {{--<input class="form-control" tabindex="1" placeholder="{{{ Lang::get('user/user.username_e_mail') }}}" type="text" name="email" id="email" value="{{ Input::old('email') }}">--}}
            {{--</div>--}}
        {{--</div>--}}
        {{--<div class="form-group">--}}
            {{--<label class="col-md-2 control-label" for="password">--}}
                {{--{{{ Lang::get('user/user.password') }}}--}}
            {{--</label>--}}
            {{--<div class="col-md-10">--}}
                {{--<input class="form-control" tabindex="2" placeholder=" {{{ Lang::get('user/user.password') }}}" type="password" name="password" id="password">--}}
            {{--</div>--}}
        {{--</div>--}}

        {{--<div class="form-group">--}}
            {{--<div class="col-md-offset-2 col-md-10">--}}
                {{--<div class="checkbox">--}}
                    {{--<label for="remember"> {{{ Lang::get('user/user.login.remember') }}}--}}
                        {{--<input type="hidden" name="remember" value="0">--}}
                        {{--<input tabindex="4" type="checkbox" name="remember" id="remember" value="1">--}}
                    {{--</label>--}}
                {{--</div>--}}
            {{--</div>--}}
        {{--</div>--}}

        {{--@if ( Session::get('error') )--}}
            {{--<div class="alert alert-danger">{{ Session::get('error') }}</div>--}}
        {{--@endif--}}

        {{--@if ( Session::get('notice') )--}}
            {{--<div class="alert">{{ Session::get('notice') }}</div>--}}
        {{--@endif--}}

        {{--<div class="form-group">--}}
            {{--<div class="col-md-offset-2 col-md-10">--}}
                {{--<button tabindex="3" type="submit" class="btn btn-primary">{{ Lang::get('user/user.login.submit') }}</button>--}}
                {{--<a class="btn btn-default" href="forgot">{{ Lang::get('user/user.login.forgot_password') }}</a>--}}
            {{--</div>--}}
        {{--</div>--}}
    {{--</fieldset>--}}
{{--</form>--}}
