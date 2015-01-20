{{--@extends('site.layouts.default')--}}

 {{--Web site Title--}}
{{--@section('title')--}}
{{--{{{ Lang::get('user/user.register') }}} ::--}}
{{--@parent--}}
{{--@stop--}}

 {{--Content--}}
{{--@section('content')--}}
{{--<div class="page-header">--}}
	{{--<h1>Signup</h1>--}}
{{--</div>--}}
{{--{{ Confide::makeSignupForm()->render() }}--}}
{{--@stop--}}
@section("scripts")
	{{HTML::script('assets/frontend/pages/scripts/location.js')}}
@stop

@section('content')
<section id="container">
	<div class="container">
		<div class="bg-primary">
			<div class="page-header padding-top-10 padding-left-20">
				<h2>Thêm địa điểm</h2>
				<span>Thêm địa điểm yêu thích của bạn để chia sẻ với cộng đồng ngay!</span>
			</div>

		</div>
		<form method="POST" name="location_create" id="location_create" class="form-horizontal choidau-form" role="form">
			<input type="hidden" name="_token" id='token-location' value="{{csrf_token()}}"/>

			<!-- THÔNG TIN CƠ BẢN -->
			<div class="row">
				<div class="col-xs-10 col-sm-10 col-md-10 col-lg-10 col-xs-offset-1 col-sm-offset-1 col-md-offset-1 col-lg-offset-1 bg-grey padding-top-20">
					<div class="col-md-10 col-md-offset-1">
						<div class="form-group ">
							<p class="btn btn-primary"><strong>Thông tin cơ bản</strong>
							</p>
						</div>

						<div class="form-group">
							<label for="input" class="col-sm-3 control-label"><strong>Tên địa điểm </strong><span class="require">*</span></label>
							<div class="col-sm-9">
								<input type="text" name="" id="input" class="form-control" value="" required="required" pattern="" title="">
							</div>
						</div>
						<div class="form-group">
							<label for="input" class="col-sm-3 control-label"><strong>Địa chỉ</strong> <span class="require">*</span></label>
							<div class="col-sm-9">
								<input type="text" name="" id="input" class="form-control" value="" required="required" pattern="" title="">
							</div>
						</div>
						<div class="form-group">
							<label for="input" class="col-sm-3 control-label"><strong>Tỉnh thành </strong> <span class="require">*</span></label>
							<div class="col-sm-5">
								<select name="location_province" id="location_province" class="form-control" required="required" title="">
									<option value="">Chọn một tỉnh thành</option>
								</select>
							</div>
							<div class="col-sm-4">
								<select name="location_district" id="location_district" class="form-control" required="required" title="">
									<option value="">Chọn một Quận/Huyện</option>
								</select>
							</div>

						</div>
						<div class="form-group">
							<label for="input" class="col-sm-3 control-label"><strong>Gần khu vực</strong></label>

							<div class="col-sm-9">
								<input type="text" name="" id="input" class="form-control" value="" required="required" pattern="" title="">
							</div>
						</div>
						<div class="form-group">
							<label for="input" class="col-sm-3 control-label"><strong>Địa chỉ đường chi tiết</strong></label>

							<div class="col-sm-9">
								<input type="text" name="" id="input" class="form-control" value="" required="required" pattern="" title="">
							</div>
						</div>
						<div class="form-group">
							<label for="input" class="col-sm-3 control-label"><strong>Điện thoại</strong></label>
							<div class="col-sm-9">
								<input type="text" name="" id="input" class="form-control" value="" required="required" pattern="" title="">
							</div>
						</div>
						<div class="form-group">
							<label for="input" class="col-sm-3 control-label"><strong>Email</strong></label>
							<div class="col-sm-9">
								<input type="text" name="" id="input" class="form-control" value="" required="required" pattern="" title="">
							</div>
						</div>
						<div class="form-group">
							<label for="input" class="col-sm-3 control-label"><strong>Website</strong></label>
							<div class="col-sm-9">
								<input type="text" name="" id="input" class="form-control" value="" required="required" pattern="" title="">
							</div>
						</div>
						<div class="form-group">
							<label for="input" class="col-sm-3 control-label"><strong>Mô tả địa điểm</strong></label>
							<div class="col-sm-9">
								<textarea name="" id="input" class="form-control" value="" required="required" pattern="" title=""></textarea>
							</div>
						</div>
						<div class="form-group">
							<label class="col-sm-3 control-label"><strong>Ảnh đại diện</strong></label>
							<div class="col-sm-4 col-md-3 col-lg-3">
								<button class="form-control bg-yellow">Tải ảnh lên</button>
							</div>
						</div>
						<div class="form-group">
							<label class="col-sm-3 control-label"><strong>Vị trí</strong></label>
							<div class="col-sm-4 col-md-3 col-lg-3">
								<button class="form-control bg-yellow">Cập nhật vị trí</button>
							</div>
						</div>
						<div class="row">

						</div>
					</div>
				</div>
			</div>
			<!-- THÔNG TIN CƠ BẢN END-->
			<!-- THÔNG TIN KHÁC -->
			<div class="row margin-top-15">
				<div class="col-xs-10 col-sm-10 col-md-10 col-lg-10 col-xs-offset-1 col-sm-offset-1 col-md-offset-1 col-lg-offset-1 bg-grey padding-top-20">
					<div class="col-md-10 col-md-offset-1">
						<div class="form-group ">
							<p class="btn btn-primary"><strong>Thông tin khác</strong></p>
						</div>
						<div class="form-group ">
							<label for="input" class="col-sm-3 control-label"><strong>Giờ mở cửa</strong></label>
							<div class="col-sm-9">
								<input type="text" name="" id="input" class="form-control" value="" required="required" title="">
							</div>
						</div>
						<div class="form-group">
							<label for="input" class="col-sm-3 control-label"><strong>Giờ đóng cửa</strong></label>
							<div class="col-sm-9">
								<input type="text" name="" id="input" class="form-control" value="" required="required" pattern="" title="">
							</div>
						</div>

						<div class="form-group">
							<label for="input" class="col-sm-3 control-label"><strong>Gía thấp nhất</strong></label>
							<div class="col-sm-9">
								<input type="text" name="" id="input" class="form-control" value="" required="required" pattern="" title="">
							</div>
						</div>
						<div class="form-group">
							<label for="input" class="col-sm-3 control-label"><strong>Gía cao nhất</strong></label>
							<div class="col-sm-9">
								<input type="text" name="" id="input" class="form-control" value="" required="required" pattern="" title="">
							</div>
						</div>




					</div>
				</div>
			</div>
			<!-- THÔNG TIN KHÁC END-->
			<!-- PHÂN LOẠI DANH MỤC -->
			<div class="row margin-top-15">
				<div class="col-xs-10 col-sm-10 col-md-10 col-lg-10 col-xs-offset-1 col-sm-offset-1 col-md-offset-1 col-lg-offset-1 bg-grey padding-top-20">
					<div class="col-md-10 col-md-offset-1">
						<div class="form-group ">
							<p class="btn btn-primary"><strong>Phân loại danh mục</strong></p>
						</div>
						<div class="form-group ">
							<label for="input" class="col-sm-3 control-label"><strong>Loại hình</strong></label>
							<div class="col-sm-9">
								<select name="" id="input" class="form-control" value="" required="required" title="">
									<option value=""></option>}
									option
								</select>
							</div>
						</div>
						<div class="form-group">
							<label for="input" class="col-sm-3 control-label"><strong>Hoạt động</strong></label>
							<div class="col-sm-9">
								<select name="" id="input" class="form-control" value="" required="required" title="">
									<option value=""></option>}
									option
								</select>
							</div>
						</div>

						<div class="form-group">
							<label for="input" class="col-sm-3 control-label"><strong>Tiện nghi</strong></label>
							<div class="col-sm-8 padding-right-0">
								<select name="" id="input" class="form-control" value="" required="required" title="">
									<option value=""></option>}
									option
								</select>
							</div>
							<div class="col-sm-1">
								<button class="btn btn-icon-only btn-default"><i class="icon-plus"></i></button>
							</div>
						</div>

					</div>
				</div>
			</div>
			<!-- PHÂN LOẠI DANH MUC END-->
			<!-- THUỘC DANH MUC -->
			<div class="row margin-top-15">
				<div class="col-xs-10 col-sm-10 col-md-10 col-lg-10 col-xs-offset-1 col-sm-offset-1 col-md-offset-1 col-lg-offset-1 bg-grey padding-top-20">
					<div class="col-md-10 col-md-offset-1">

						<div class="form-group ">
							<p class="btn btn-primary col-xs-3"><strong>Thuộc danh mục</strong></p>
							<div class="col-sm-9">
								<select name="" id="input" class="form-control" value="" required="required" title="">
									<option></option>
								</select>
							</div>
						</div>

					</div>
				</div>
			</div>
			<!-- THUỘC DANH MUC -->
			<!-- SUBMIT -->
			<div class="row margin-top-15">
				<div class="col-xs-10 col-sm-10 col-md-10 col-lg-10 col-xs-offset-1 col-sm-offset-1 col-md-offset-1 col-lg-offset-1 padding-top-20">
					<div class="col-md-10 col-md-offset-1">
						<div class="form-group">
							<button type="submit" class="btn yellow btn-block"><strong>+ Thêm địa điểm</strong></button>
						</div>
					</div>
				</div>
			</div>
			<!-- SUBMIT -->
		</form>
	</div>
</section>


@stop
