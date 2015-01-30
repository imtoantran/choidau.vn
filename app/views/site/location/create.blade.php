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
			<input type="hidden" name="location_position" id="location_position" value="(10.776111111111112,106.69583333333334)"/>

			<div class="alert alert-danger display-hide">
				<button class="close location-alert-close" data-close="alert"></button>
				You have some form errors. Please check below.
			</div>
			<div class="alert alert-success display-hide">
				<button class="close location-alert-close" data-close="alert"></button>
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
							<label for="location_name" class="col-sm-3 control-label"><strong>Tên địa điểm </strong><span class="required">*</span></label>
							<div class="col-sm-9">
								<input type="text" name="location_name" id="location_name" class="form-control" value=""  title="">
							</div>
						</div>

						<div class="form-group">
							<label for="location_address_detail" class="col-sm-3 control-label"><strong>Địa chỉ</strong> <span class="required">*</span></label>
							<div class="col-sm-9">
								<input type="text" name="location_address_detail" id="location_address_detail" class="form-control" value=""   title="">
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
							<label for="location_address_nearly" class="col-sm-3 control-label"><strong>Gần khu vực</strong></label>

							<div class="col-sm-9">
								<input type="text" name="location_address_nearly" id="location_address_nearly" class="form-control" value=""   title="">
							</div>
						</div>

						<div class="form-group">
							<label for="location_detail_address" class="col-sm-3 control-label"><strong>Địa chỉ chi tiết</strong></label>

							<div class="col-sm-9">
								<input type="text" name="location_detail_address" id="location_detail_address" class="form-control" value=""   title="">
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
							<label for="location_description" class="col-sm-3 control-label"><strong>Mô tả địa điểm</strong></label>
							<div class="col-sm-9">
								<textarea name="location_description" id="location_description" class="form-control" value=""   title=""></textarea>
							</div>
						</div>


						{{--anh dai dien--}}
						<div class="form-group">
							<label class="col-sm-3 control-label"><strong>Ảnh đại diện</strong></label>
							<div class="col-sm-4 col-md-3 col-lg-3 location-wrapper-img">
								<button type="button" id="location-img-btn-close" class="no-padding hidden location-img-btn-close-item" title="Thôi chọn hình"><i class="icon-cancel-circled"></i></button>
								<div id="iM_user_slide1" type_insert="location_load_avatar" class="insertMedia single-picture-wrapper imageManager_openModal1" style="position: relative;" data-toggle="modal" data-target="#imageManager_modal">
									<div class="add-picture vertically-centered" style="">
										<button id="btn-upgrade-imgs" type="button" class="form-control yellow btn btn-warning text-left"> <i class="icon-picture" style="font-size: 1.3em;"></i> Chọn ảnh</button>
									</div>
									<img id="location-img-url" class="hidden" data-url="assets/global/img/no-image.png" src="{{asset('assets/global/img/no-image.png')}}" width="166px" alt=""/>
								</div>

							</div>
						</div>

						{{--album anh--}}
						<div class="form-group">
							<label class="col-sm-3 control-label"><strong>Album ảnh</strong></label>
							<div class="col-sm-9 col-md-9 col-lg-9 location-wrapper-img">
								<div class="row">
									<div id="iM_user_slide1" type_insert="location_load_album" class=" col-md-4 insertMedia single-picture-wrapper imageManager_openModal1" style="position: relative;" data-toggle="modal" data-target="#imageManager_modal">
										<div class="add-picture vertically-centered" style="">
											<button id="btn-upgrade-imgs" type="button" class="form-control yellow btn btn-warning text-left"> <i class="icon-file-image" style="font-size: 1.3em;"></i> Thêm ảnh</button>
										</div>
									</div>
								</div>
								<div class="row location-album-wrapper">
								</div>
							</div>
						</div>


						{{--cap nhat vi tri--}}
						<div class="form-group">
							<label class="col-sm-3 control-label"><strong>Vị trí</strong></label>
							<div class="col-sm-4 col-md-3 col-lg-3">
								<button id="btn-update-position" type="button" class="form-control yellow btn btn-warning"> <i class="icon-location pull-left" style="font-size: 1.3em;"></i> Cập nhật vị trí</button>
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

						<div class="form-group">
							<label for="location_price_min" class="col-sm-3 control-label"><strong>Giá thấp nhất</strong></label>
							<div class="col-sm-9">
								<input type="text" name="location_price_min" id="location_price_min" class="form-control" value=""   title="">
							</div>
						</div>
						<div class="form-group">
							<label for="location_price_max" class="col-sm-3 control-label"><strong>Giá cao nhất</strong></label>
							<div class="col-sm-9">
								<input type="text" name="location_price_max" id="location_price_max" class="form-control" value=""   title="">
							</div>
						</div>

						<div class="form-group ">

							<label for="input" class="col-sm-3 control-label"><strong>Giờ hoạt động</strong></label>
							<div class="col-sm-9 location-time-action">
								<table id="" class="table table-bordered table-striped table-condensed flip-content">
									<thead>
										<tr>
											<th class="text-center">Thứ</th><th>Giờ bắt đầu</th><th>Giờ kết thúc</th>
										</tr>
									</thead>
									<tbody>
										<tr>
											<td>
												<label class="location-time-check-lbl">
													<div class="checker"><span>
														<input data-thu="2" class="location-time-check" type="checkbox" id="location-time-check-t2" checked></span></div>
													Hai
												</label>
											</td>
											<td>
												<div class="input-group">
													<input id="location-time-start-t2" type="text" class="form-control timepicker  timepicker-no-seconds location-time-2" value="6:00 AM">
													<span class="input-group-btn">
													<button class="btn default" type="button"><i class="icon-clock"></i></button>
													</span>
												</div>
											</td>
											<td>
												<div class="input-group">
													<input id="location-time-end-t2" type="text" class="form-control timepicker timepicker-no-seconds location-time-2" value="11:00 PM">
													<span class="input-group-btn">
													<button class="btn default" type="button"><i class="icon-clock"></i></button>
													</span>
												</div>
											</td>
										</tr>

										<tr>
											<td>
												<label class="location-time-check-lbl">
													<div class="checker"><span>
														<input data-thu="3" class="location-time-check" type="checkbox" id="location-time-check-t3" checked></span></div>
													Ba
												</label>
											</td>
											<td>
												<div class="input-group">
													<input id="location-time-start-t3" type="text" class="form-control timepicker  timepicker-no-seconds location-time-3" value="6:00 AM">
													<span class="input-group-btn">
													<button class="btn default" type="button"><i class="icon-clock"></i></button>
													</span>
												</div>
											</td>
											<td>
												<div class="input-group">
													<input id="location-time-end-t3" type="text" class="form-control timepicker timepicker-no-seconds location-time-3" value="11:00 PM">
													<span class="input-group-btn">
													<button class="btn default" type="button"><i class="icon-clock"></i></button>
													</span>
												</div>
											</td>
										</tr>

										<tr>
											<td>
												<label class="location-time-check-lbl">
													<div class="checker"><span>
														<input data-thu="4" class="location-time-check" type="checkbox" id="location-time-check-t4" checked></span></div>
													Tư
												</label>
											</td>
											<td>
												<div class="input-group">
													<input id="location-time-start-t4" type="text" class="form-control timepicker  timepicker-no-seconds location-time-4" value="6:00 AM">
													<span class="input-group-btn">
													<button class="btn default" type="button"><i class="icon-clock"></i></button>
													</span>
												</div>
											</td>
											<td>
												<div class="input-group">
													<input id="location-time-end-t4" type="text" class="form-control timepicker timepicker-no-seconds location-time-4" value="11:00 PM">
													<span class="input-group-btn">
													<button class="btn default" type="button"><i class="icon-clock"></i></button>
													</span>
												</div>
											</td>
										</tr>

										<tr>
											<td>
												<label class="location-time-check-lbl">
													<div class="checker"><span>
														<input data-thu="5" class="location-time-check" type="checkbox" id="location-time-check-t3" checked></span></div>
													Năm
												</label>
											</td>
											<td>
												<div class="input-group">
													<input id="location-time-start-t5" type="text" class="form-control timepicker  timepicker-no-seconds location-time-5" value="6:00 AM">
													<span class="input-group-btn">
													<button class="btn default" type="button"><i class="icon-clock"></i></button>
													</span>
												</div>
											</td>
											<td>
												<div class="input-group">
													<input id="location-time-end-t5" type="text" class="form-control timepicker timepicker-no-seconds location-time-5" value="11:00 PM">
													<span class="input-group-btn">
													<button class="btn default" type="button"><i class="icon-clock"></i></button>
													</span>
												</div>
											</td>
										</tr>

										<tr>
											<td>
												<label class="location-time-check-lbl">
													<div class="checker"><span>
														<input data-thu="6" class="location-time-check" type="checkbox" id="location-time-check-t6" checked></span></div>
													Sáu
												</label>
											</td>
											<td>
												<div class="input-group">
													<input id="location-time-start-t6" type="text" class="form-control timepicker  timepicker-no-seconds location-time-6" value="6:00 AM">
													<span class="input-group-btn">
													<button class="btn default" type="button"><i class="icon-clock"></i></button>
													</span>
												</div>
											</td>
											<td>
												<div class="input-group">
													<input id="location-time-end-t6" type="text" class="form-control timepicker timepicker-no-seconds location-time-6" value="11:00 PM">
													<span class="input-group-btn">
													<button class="btn default" type="button"><i class="icon-clock"></i></button>
													</span>
												</div>
											</td>
										</tr>

										<tr>
											<td>
												<label class="location-time-check-lbl">
													<div class="checker"><span>
														<input data-thu="7" class="location-time-check" type="checkbox" id="location-time-check-t7" checked></span></div>
													Bảy
												</label>
											</td>
											<td>
												<div class="input-group">
													<input id="location-time-start-t7" type="text" class="form-control timepicker  timepicker-no-seconds location-time-7" value="6:00 AM">
													<span class="input-group-btn">
													<button class="btn default" type="button"><i class="icon-clock"></i></button>
													</span>
												</div>
											</td>
											<td>
												<div class="input-group">
													<input id="location-time-end-t7" type="text" class="form-control timepicker timepicker-no-seconds location-time-7" value="11:00 PM">
													<span class="input-group-btn">
													<button class="btn default" type="button"><i class="icon-clock"></i></button>
													</span>
												</div>
											</td>
										</tr>
										<tr>
											<td>
												<label class="location-time-check-lbl">
													<div class="checker"><span>
														<input data-thu="8" class="location-time-check" type="checkbox" id="location-time-check-t8" checked></span></div>
													Chủ nhật
												</label>
											</td>
											<td>
												<div class="input-group">
													<input id="location-time-start-t8" type="text" class="form-control timepicker  timepicker-no-seconds location-time-8" value="6:00 AM">
													<span class="input-group-btn">
													<button class="btn default" type="button"><i class="icon-clock"></i></button>
													</span>
												</div>
											</td>
											<td>
												<div class="input-group">
													<input id="location-time-end-t8" type="text" class="form-control timepicker timepicker-no-seconds location-time-8" value="11:00 PM">
													<span class="input-group-btn">
													<button class="btn default" type="button"><i class="icon-clock"></i></button>
													</span>
												</div>
											</td>
										</tr>
									</tbody>
								</table>
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
													<th>Giá</th>
													<th>Loại món</th>
												</tr>
												</thead>
												<tbody>
													<tr>
														<td class="location-food-empty" colspan="3"><i class="icon-check-empty"> </i> Danh mục đang rỗng.</td>
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
			<!-- THUỘC DANH MUC -->
			<div class="row margin-top-15">
				<div class="col-xs-10 col-sm-10 col-md-10 col-lg-10 col-xs-offset-1 col-sm-offset-1 col-md-offset-1 col-lg-offset-1 bg-grey-light padding-top-20">
					<div class="col-md-10 col-md-offset-1">
						<div class="form-group ">
							<p class="btn btn-primary col-xs-3"><strong>Thuộc danh mục</strong></p>
							<div class="col-sm-9">
								<select name="location_category" id="location_category" class="form-control" value="" title="">
									<option></option>
								</select>
							</div>
						</div>

					</div>
				</div>
			</div>


			<!-- THUỘC DANH MUC -->
			{{--<!-- THÔNG TIN KHÁC END-->--}}

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

