@extends('site.layouts.default')

@section('content')

	<section id="container">
		<div class="bg-primary">
			<div class="page-header padding-top-10 padding-left-20">
				<h2>Thêm địa điểm</h2>
				<span>Thêm địa điểm yêu thích của bạn để chia sẻ với cộng đồng ngay!</span>
			</div>

		</div>
		<form method="POST" name="location_create" id="location_create" class="form-horizontal choidau-form" role="form">
			<input type="hidden" name="_token" id="token-location" value="{{csrf_token()}}"/>
			<input type="hidden" name="location-position" id="location-position" value="(10.776111111111112,106.69583333333334)"/>

			<div class="alert alert-danger display-hide">
				<button class="close" data-close="alert"></button>
				You have some form errors. Please check below.
			</div>
			<div class="alert alert-success display-hide">
				<button class="close" data-close="alert"></button>
				Your form validation is successful!
			</div>

			<!-- THÔNG TIN CƠ BẢN -->
			<div class="row">
				<div class="col-xs-10 col-sm-10 col-md-10 col-lg-10 col-xs-offset-1 col-sm-offset-1 col-md-offset-1 col-lg-offset-1 bg-grey-light padding-top-20">
					<div class="col-md-10 col-md-offset-1">
						<div class="form-group ">
							<p class="btn btn-primary"><strong>Thông tin cơ bản</strong>
							</p>
						</div>

						<div class="form-group">
							<label for="location_title" class="col-sm-3 control-label"><strong>Tên địa điểm </strong><span class="required">*</span></label>
							<div class="col-sm-9">
								<input type="text" name="location_title" id="location_title" class="form-control" value="" required data-required="1" title="">
							</div>
						</div>

						<div class="form-group">
							<label for="location_address" class="col-sm-3 control-label"><strong>Địa chỉ</strong> <span class="required">*</span></label>
							<div class="col-sm-9">
								<input type="text" name="location_address" id="location_address" class="form-control" value=""   title="">
							</div>
						</div>

						<div class="form-group">
							<label for="location_province" class="col-sm-3 control-label"><strong>Tỉnh thành </strong> <span class="required">*</span></label>
							<div class="col-sm-5">
								<select name="location_province" id="location_province" class="form-control"  title="">
									<option value="">-- Chọn Tỉnh/ Thành phố --</option>
								</select>
							</div>
							<div class="col-sm-4">
								<select name="location_district" id="location_district" class="form-control"  title="">
									<option value="" data-lat="" data-lng="" selected>-- Chọn Quận/ Huyện --</option>
								</select>
							</div>
						</div>

						<div class="form-group">
							<label for="location_area" class="col-sm-3 control-label"><strong>Gần khu vực</strong></label>

							<div class="col-sm-9">
								<input type="text" name="location_area" id="location_area" class="form-control" value=""   title="">
							</div>
						</div>

						<div class="form-group">
							<label for="location_detail-address" class="col-sm-3 control-label"><strong>Địa chỉ chi tiết</strong></label>

							<div class="col-sm-9">
								<input type="text" name="location_detail-address" id="location_detail-address" class="form-control" value=""   title="">
							</div>
						</div>

						<div class="form-group">
							<label for="location_phone" class="col-sm-3 control-label"><strong>Điện thoại</strong></label>
							<div class="col-sm-9">
								<input type="text" name="location_phone" id="location_phone" class="form-control" value=""   title="">
							</div>
						</div>

						<div class="form-group">
							<label for="location_email" class="col-sm-3 control-label"><strong>Email</strong></label>
							<div class="col-sm-9">
								<input type="text" name="location_email" id="location_email" class="form-control" value=""   title="">
							</div>
						</div>

						<div class="form-group">
							<label for="location_website" class="col-sm-3 control-label"><strong>Website</strong></label>
							<div class="col-sm-9">
								<input type="text" name="location_website" id="location_website" class="form-control" value=""   title="">
							</div>
						</div>

						<div class="form-group">
							<label for="location_describe" class="col-sm-3 control-label"><strong>Mô tả địa điểm</strong></label>
							<div class="col-sm-9">
								<textarea name="location_describe" id="location_describe" class="form-control" value=""   title=""></textarea>
							</div>
						</div>

						<div class="form-group">
							<label class="col-sm-3 control-label"><strong>Ảnh đại diện</strong></label>
							<div class="col-sm-4 col-md-3 col-lg-3">
								<button id="btn-upgrade-imgs" type="button" class="form-control yellow btn btn-warning">Tải ảnh lên</button>
							</div>
						</div>

						<div class="form-group">
							<label class="col-sm-3 control-label"><strong>Vị trí</strong></label>
							<div class="col-sm-4 col-md-3 col-lg-3">
								<button id="btn-update-position" type="button" class="form-control yellow btn btn-warning">Cập nhật vị trí</button>
							</div>
						</div>
					</div>
				</div>
			</div>
			<!-- THÔNG TIN CƠ BẢN END-->

			{{--<!-- THÔNG TIN KHÁC -->--}}
			<div class="row margin-top-15">
				<div class="col-xs-10 col-sm-10 col-md-10 col-lg-10 col-xs-offset-1 col-sm-offset-1 col-md-offset-1 col-lg-offset-1 bg-grey-light padding-top-20">
					<div class="col-md-10 col-md-offset-1">
						<div class="form-group ">
							<p class="btn btn-primary"><strong>Thông tin khác</strong></p>
						</div>
						<div class="form-group ">
							<label for="input" class="col-sm-3 control-label"><strong>Giờ mở cửa</strong></label>
							<div class="col-sm-9">
								<input type="text" name="" id="input" class="form-control" value=""  title="">
							</div>
						</div>
						<div class="form-group">
							<label for="input" class="col-sm-3 control-label"><strong>Giờ đóng cửa</strong></label>
							<div class="col-sm-9">
								<input type="text" name="" id="input" class="form-control" value=""   title="">
							</div>
						</div>

						<div class="form-group">
							<label for="input" class="col-sm-3 control-label"><strong>Gía thấp nhất</strong></label>
							<div class="col-sm-9">
								<input type="text" name="" id="input" class="form-control" value=""   title="">
							</div>
						</div>
						<div class="form-group">
							<label for="input" class="col-sm-3 control-label"><strong>Gía cao nhất</strong></label>
							<div class="col-sm-9">
								<input type="text" name="" id="input" class="form-control" value=""   title="">
							</div>
						</div>

						{{--danh muc mon an--}}
						<div class="form-group">
							<label for="input" class="col-sm-3 control-label"><strong>Danh mục món ăn</strong></label>
							<div class="col-sm-9 padding-right-0">
								<div class="portlet box green">
									<div class="portlet-title">
										<div class="caption">Thực đơn bao gồm</div>
										<div class="tools">
											<button id="location-food-add" type="button" class="btn btn-default btn-xs"><i class="icon-plus"></i></button>
										</div>
									</div>
									<div class="portlet-body">
										<div class="table-responsive" style="max-height: 202px;">
											<table id="location-mn-food" class="table table-bordered table-striped table-condensed flip-content">
												<thead>
												<tr>
													<th>Tên món</th>
													<th>Loại món</th>
												</tr>
												</thead>
												<tbody>
													<tr>
														<td class="location-food-empty" colspan="2"><i class="icon-check-empty"> </i> Danh mục đang rỗng.</td>
													</tr>
												</tbody>
											</table>
										</div>
									</div>
								</div>
							</div>
						</div>
						{{--end danh muc mon an--}}

						{{--danh mục tien ich--}}
						<div class="form-group">
							<label for="input" class="col-sm-3 control-label"><strong>Danh mục tiện ích</strong></label>
							<div class="col-sm-9 padding-right-0">
								<div class="portlet box green">
									<div class="portlet-title">
										<div class="caption">Danh mục bao gồm</div>
										<div class="tools">
											<button id="location-food-utility-add" type="button" class="btn btn-default btn-xs"><i class="icon-plus"></i></button>
										</div>
									</div>
									<div class="portlet-body">
										<div class="table-responsive" style="max-height: 202px;">
											<table id="location-mn-utility" class="table table-bordered table-striped table-condensed flip-content">
												<thead>
												<tr>
													<th>Tên tiện ích</th>
												</tr>
												</thead>
												<tbody>
													<tr>
														<td class="location-utility-empty"><i class="icon-check-empty"> </i>Danh mục đang rỗng.</td>
													</tr>
												</tbody>
											</table>

										</div>
									</div>
								</div>
							</div>
						</div>
						{{--end danh muc tien ich--}}
					</div>
				</div>
			</div>
			{{--<!-- THÔNG TIN KHÁC END-->--}}

			{{--<!-- THUỘC DANH MUC -->--}}
			<div class="row margin-top-15">
				<div class="col-xs-10 col-sm-10 col-md-10 col-lg-10 col-xs-offset-1 col-sm-offset-1 col-md-offset-1 col-lg-offset-1 bg-grey-light padding-top-20">
					<div class="col-md-10 col-md-offset-1">

						<div class="form-group ">
							<p class="btn btn-primary col-xs-3"><strong>Thuộc danh mục</strong></p>
							<div class="col-sm-9">
								<select name="" id="input" class="form-control" value="" title="">
									<option></option>
								</select>
							</div>
						</div>

					</div>
				</div>
			</div>
			{{--<!-- THUỘC DANH MUC -->--}}

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





		{{--<!-- BEGIN FORM-->--}}
		{{--<form action="#" id="form_sample_3" class="form-horizontal">--}}
			{{--<div class="form-body">--}}
				{{--<h3 class="form-section">Advance validation. <small>Custom radio buttons, checkboxes and Select2 dropdowns</small></h3>--}}
				{{--<div class="alert alert-danger display-hide">--}}
					{{--<button class="close" data-close="alert"></button>--}}
					{{--You have some form errors. Please check below.--}}
				{{--</div>--}}
				{{--<div class="alert alert-success display-hide">--}}
					{{--<button class="close" data-close="alert"></button>--}}
					{{--Your form validation is successful!--}}
				{{--</div>--}}

				{{--<div class="form-group">--}}
					{{--<label class="control-label col-md-3">Name <span class="required">--}}
										{{--* </span>--}}
					{{--</label>--}}
					{{--<div class="col-md-4">--}}
						{{--<input type="text" name="name" data-required="1" class="form-control"/>--}}
					{{--</div>--}}
				{{--</div>--}}
				{{--<div class="form-group">--}}
					{{--<label class="col-md-3 control-label">Email Address <span class="required">--}}
										{{--* </span>--}}
					{{--</label>--}}
					{{--<div class="col-md-4">--}}
						{{--<div class="input-group">--}}
												{{--<span class="input-group-addon">--}}
												{{--<i class="fa fa-envelope"></i>--}}
												{{--</span>--}}
							{{--<input type="email" name="email" class="form-control" placeholder="Email Address">--}}
						{{--</div>--}}
					{{--</div>--}}
				{{--</div>--}}
				{{--<div class="form-group">--}}
					{{--<label class="control-label col-md-3">Occupation&nbsp;&nbsp;</label>--}}
					{{--<div class="col-md-4">--}}
						{{--<input name="occupation" type="text" class="form-control"/>--}}
					{{--</div>--}}
				{{--</div>--}}
				{{--<div class="form-group">--}}
					{{--<label class="control-label col-md-3">Select2 Dropdown <span class="required">--}}
										{{--* </span>--}}
					{{--</label>--}}
					{{--<div class="col-md-4">--}}
						{{--<select class="form-control select2me" name="options2">--}}
							{{--<option value="">Select...</option>--}}
							{{--<option value="Option 1">Option 1</option>--}}
							{{--<option value="Option 2">Option 2</option>--}}
							{{--<option value="Option 3">Option 3</option>--}}
							{{--<option value="Option 4">Option 4</option>--}}
						{{--</select>--}}
					{{--</div>--}}
				{{--</div>--}}
				{{--<div class="form-group">--}}
					{{--<label class="control-label col-md-3">Select2 Tags <span class="required">--}}
										{{--* </span>--}}
					{{--</label>--}}
					{{--<div class="col-md-4">--}}
						{{--<input type="hidden" class="form-control" id="select2_tags" value="" name="select2tags">--}}
											{{--<span class="help-block">--}}
											{{--select tags </span>--}}
					{{--</div>--}}
				{{--</div>--}}
				{{--<div class="form-group">--}}
					{{--<label class="control-label col-md-3">Datepicker</label>--}}
					{{--<div class="col-md-4">--}}
						{{--<div class="input-group date date-picker" data-date-format="dd-mm-yyyy">--}}
							{{--<input type="text" class="form-control" readonly name="datepicker">--}}
												{{--<span class="input-group-btn">--}}
												{{--<button class="btn default" type="button"><i class="fa fa-calendar"></i></button>--}}
												{{--</span>--}}
						{{--</div>--}}
						{{--<!-- /input-group -->--}}
											{{--<span class="help-block">--}}
											{{--select a date </span>--}}
					{{--</div>--}}
				{{--</div>--}}
				{{--<div class="form-group">--}}
					{{--<label class="control-label col-md-3">Membership <span class="required">--}}
										{{--* </span>--}}
					{{--</label>--}}
					{{--<div class="col-md-4">--}}
						{{--<div class="radio-list" data-error-container="#form_2_membership_error">--}}
							{{--<label>--}}
								{{--<input type="radio" name="membership" value="1"/>--}}
								{{--Fee </label>--}}
							{{--<label>--}}
								{{--<input type="radio" name="membership" value="2"/>--}}
								{{--Professional </label>--}}
						{{--</div>--}}
						{{--<div id="form_2_membership_error">--}}
						{{--</div>--}}
					{{--</div>--}}
				{{--</div>--}}
				{{--<div class="form-group">--}}
					{{--<label class="control-label col-md-3">Services <span class="required">--}}
										{{--* </span>--}}
					{{--</label>--}}
					{{--<div class="col-md-4">--}}
						{{--<div class="checkbox-list" data-error-container="#form_2_services_error">--}}
							{{--<label>--}}
								{{--<input type="checkbox" value="1" name="service"/> Service 1 </label>--}}
							{{--<label>--}}
								{{--<input type="checkbox" value="2" name="service"/> Service 2 </label>--}}
							{{--<label>--}}
								{{--<input type="checkbox" value="3" name="service"/> Service 3 </label>--}}
						{{--</div>--}}
											{{--<span class="help-block">--}}
											{{--(select at least two) </span>--}}
						{{--<div id="form_2_services_error">--}}
						{{--</div>--}}
					{{--</div>--}}
				{{--</div>--}}
				{{--<div class="form-group">--}}
					{{--<label class="control-label col-md-3">Markdown</label>--}}
					{{--<div class="col-md-9">--}}
						{{--<textarea name="markdown" data-provide="markdown" rows="10" data-error-container="#editor_error"></textarea>--}}
						{{--<div id="editor_error">--}}
						{{--</div>--}}
					{{--</div>--}}
				{{--</div>--}}
				{{--<div class="form-group">--}}
					{{--<label class="control-label col-md-3">WYSIHTML5 Editor <span class="required">--}}
										{{--* </span>--}}
					{{--</label>--}}
					{{--<div class="col-md-9">--}}
						{{--<textarea class="wysihtml5 form-control" rows="6" name="editor1" data-error-container="#editor1_error"></textarea>--}}
						{{--<div id="editor1_error">--}}
						{{--</div>--}}
					{{--</div>--}}
				{{--</div>--}}
				{{--<div class="form-group last">--}}
					{{--<label class="control-label col-md-3">CKEditor <span class="required">--}}
										{{--* </span>--}}
					{{--</label>--}}
					{{--<div class="col-md-9">--}}
						{{--<textarea class="ckeditor form-control" name="editor2" rows="6" data-error-container="#editor2_error"></textarea>--}}
						{{--<div id="editor2_error">--}}
						{{--</div>--}}
					{{--</div>--}}
				{{--</div>--}}
			{{--</div>--}}
			{{--<div class="form-actions">--}}
				{{--<div class="row">--}}
					{{--<div class="col-md-offset-3 col-md-9">--}}
						{{--<button type="submit" class="btn green">Submit</button>--}}
						{{--<button type="button" class="btn default">Cancel</button>--}}
					{{--</div>--}}
				{{--</div>--}}
			{{--</div>--}}
		{{--</form>--}}
		{{--<!-- END FORM-->--}}
</section>
@stop

