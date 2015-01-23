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

			<!-- THÔNG TIN CƠ BẢN -->
			<div class="row">
				<div class="col-xs-10 col-sm-10 col-md-10 col-lg-10 col-xs-offset-1 col-sm-offset-1 col-md-offset-1 col-lg-offset-1 bg-grey-light padding-top-20">
					<div class="col-md-10 col-md-offset-1">
						<div class="form-group ">
							<p class="btn btn-primary"><strong>Thông tin cơ bản</strong>
							</p>
						</div>

						<div class="form-group">
							<label for="input" class="col-sm-3 control-label"><strong>Tên địa điểm </strong><span class="require">*</span></label>
							<div class="col-sm-9">
								<input type="text" name="" id="input" class="form-control" value=""  title="">
							</div>
						</div>
						<div class="form-group">
							<label for="input" class="col-sm-3 control-label"><strong>Địa chỉ</strong> <span class="require">*</span></label>
							<div class="col-sm-9">
								<input type="text" name="" id="input" class="form-control" value=""   title="">
							</div>
						</div>
						<div class="form-group">
							<label for="input" class="col-sm-3 control-label"><strong>Tỉnh thành </strong> <span class="require">*</span></label>
							<div class="col-sm-5">
								<select name="location_province" id="location_province" class="form-control"  title="">
									<option value="">Chọn một tỉnh thành</option>
								</select>
							</div>
							<div class="col-sm-4">
								<select name="location_district" id="location_district" class="form-control"  title="">
									<option value="">Chọn một Quận/Huyện</option>
								</select>
							</div>

						</div>
						<div class="form-group">
							<label for="input" class="col-sm-3 control-label"><strong>Gần khu vực</strong></label>

							<div class="col-sm-9">
								<input type="text" name="" id="input" class="form-control" value=""   title="">
							</div>
						</div>
						<div class="form-group">
							<label for="input" class="col-sm-3 control-label"><strong>Địa chỉ đường chi tiết</strong></label>

							<div class="col-sm-9">
								<input type="text" name="" id="input" class="form-control" value=""   title="">
							</div>
						</div>
						<div class="form-group">
							<label for="input" class="col-sm-3 control-label"><strong>Điện thoại</strong></label>
							<div class="col-sm-9">
								<input type="text" name="" id="input" class="form-control" value=""   title="">
							</div>
						</div>
						<div class="form-group">
							<label for="input" class="col-sm-3 control-label"><strong>Email</strong></label>
							<div class="col-sm-9">
								<input type="text" name="" id="input" class="form-control" value=""   title="">
							</div>
						</div>
						<div class="form-group">
							<label for="input" class="col-sm-3 control-label"><strong>Website</strong></label>
							<div class="col-sm-9">
								<input type="text" name="" id="input" class="form-control" value=""   title="">
							</div>
						</div>
						<div class="form-group">
							<label for="input" class="col-sm-3 control-label"><strong>Mô tả địa điểm</strong></label>
							<div class="col-sm-9">
								<textarea name="" id="input" class="form-control" value=""   title=""></textarea>
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
			<!-- THÔNG TIN KHÁC -->
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
												<tbody></tbody>
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
			<!-- THÔNG TIN KHÁC END-->
			{{--<!-- DANH MỤC MÓN ĂN -->--}}
			{{--<div class="row margin-top-15">--}}
				{{--<div class="col-xs-10 col-sm-10 col-md-10 col-lg-10 col-xs-offset-1 col-sm-offset-1 col-md-offset-1 col-lg-offset-1 bg-grey-light padding-top-20">--}}
					{{--<div class="col-md-10 col-md-offset-1">--}}
						{{--<div class="form-group ">--}}
							{{--<p class="btn btn-primary"><strong>Danh mục món ăn</strong></p>--}}
						{{--</div>--}}

						{{--<div class="form-group">--}}
							{{--<label for="input" class="col-sm-3 control-label"></label>--}}
							{{--<div class="col-sm-9 padding-right-0">--}}
								{{--<div class="portlet box green">--}}
									{{--<div class="portlet-title">--}}
										{{--<div class="caption">Danh mục bao gồm</div>--}}
										{{--<div class="tools">--}}
											{{--<button id="location-food-add" type="button" class="btn btn-default btn-xs"><i class="icon-plus"></i></button>--}}
										{{--</div>--}}
									{{--</div>--}}
									{{--<div class="portlet-body">--}}
										{{--<div class="table-responsive" style="max-height: 202px;">--}}
											{{--<table id="location-mn-food" class="table table-bordered table-striped table-condensed flip-content">--}}
												{{--<thead>--}}
													{{--<tr>--}}
														{{--<th>Tên món</th>--}}
														{{--<th>Loại món</th>--}}
													{{--</tr>--}}
												{{--</thead>--}}
												{{--<tbody>--}}

												{{--</tbody>--}}
											{{--</table>--}}

										{{--</div>--}}
									{{--</div>--}}
								{{--</div>--}}
								{{--</div>--}}


						{{--</div>--}}
					{{--</div>--}}
				{{--</div>--}}
			{{--</div>--}}
			{{--<!-- DANH MỤC MÓN ĂN END-->--}}

			<!-- THUỘC DANH MUC -->
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
</section>
@stop

