
<!-- Image Manager Modal -->
<div id="product-pop-up">


<div class=" modal" id="imageManager_modal" class="modal" tabindex="-1" role="dialog" aria-labelledby="" aria-hidden="true">
<div class="col-md-11 col-md-offset-1 container modal-dialog">
		<div class="col-md-12 col-none-padding  modal-content">
			<div class=" col-md-12 col-none-padding modal-header">
				<button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
				<h4 class="modal-title" id="imageManager_modalLabel">Manager Media</h4>
			</div>
			<div class="col-md-12 col-none-padding modal-body">
		<div class="row margin-none">
					<div class="col-md-2 col-sm-2 col-xs-2 col-none-padding">
						<ul class="nav nav-tabs tabs-left">
							<li class="active">
								<a href="#tab_thu_vien" data-toggle="tab">
									Thư Viện  </a>
							</li>
							<li class="">
								<a href="#tab_insert_media" data-toggle="tab">
									Thêm ảnh từ internet </a>
							</li>
							<li class="">
								<a href="#tab_6_1" data-toggle="tab">
									Thư Viện </a>
							</li>
							<li class="">
								<a href="#tab_6_2" data-toggle="tab">
									Thêm  </a>
							</li>


						</ul>
					</div>
		<div class="col-md-10 col-sm-10 col-xs-10 col-none-padding">
		<div class="tab-content" style="padding: 0px;background-color: white;">
						<div class="tab-pane " id="tab_6_1">
							<div class="row">
								<div class="col-md-10 col-none-padding">
									<div id="imageManager_allImage">
									</div>
								</div>
								<div class="col-md-2 col-none-padding">
									<div id="imageManager_descriptionImage">
										<div id="imageManager_descriptionImage-content">
											<strong>Image title:</strong> </br>
											<span class="cover_title"></span>
											<div>
												<h6>Image name: </h6><h6 class="cover_image_name"> </h6>
												<h6>Image size: </h6><h6 class="cover_image_size"> </h6>
												<h6>Thumbnail: </h6><h6 class="cover_thumbnail_name"> </h6>
											</div>
										</div>
										<button type="button" id="imageManager_removeImage" class="btn btn-sm btn-danger pull-left" disabled="disabled"><i class="fa fa-trash-o"></i> Remove</button>
									</div>
								</div>
							</div>
						</div>
						
						<div class="tab-pane" id="tab_6_2">
						<div class="col-md-12">

						<div class="media-tab-content col-md-12">
							<ul class=" list-unstyled">
								<li class="col-md-2" >
									{{--<img class="img-responsive" src="/upload/2/thumbnails/2/j-4_165x95.jpg" />--}}
									<span><i class="icon-ok-circled2"></i></span>
									<div class="media-tool">
										<a href="#" class="icon-btn-cd btn-delete-img">


											<button class="icon-cancel-circle-2 delete" data-type="{%=file.deleteType%}" data-url="{%=file.deleteUrl%}"{% if (file.deleteWithCredentials) { %} data-xhr-fields='{"withCredentials":true}'{% } %}>

											</button>



										</a>
										<a href="#" class="icon-btn-cd btn-check-img">
											<i class="icon-ok-circle-1">
												<input type="checkbox" name="delete" value="1" class="toggle">
											</i>

										</a>
									</div>
								</li>
								<li class="col-md-2" >
									<img class="img-responsive" src="/upload/2/thumbnails/2/j-4_165x95.jpg" />
									<span><i class="icon-ok-circled2"></i></span>
									<div class="media-tool">
										<a href="#" class="icon-btn-cd btn-delete-img">


											<button class="icon-cancel-circle-2 delete" data-type="{%=file.deleteType%}" data-url="{%=file.deleteUrl%}"{% if (file.deleteWithCredentials) { %} data-xhr-fields='{"withCredentials":true}'{% } %}>

											</button>



										</a>
										<a href="#" class="icon-btn-cd btn-check-img">
											<i class="icon-ok-circle-1">
												<input type="checkbox" name="delete" value="1" class="toggle">
											</i>

										</a>
									</div>
								</li>
								<li class="col-md-2" >
									<img class="img-responsive" src="/upload/2/thumbnails/2/j-4_165x95.jpg" />
									<span><i class="icon-ok-circled2"></i></span>
									<div class="media-tool">
										<a href="#" class="icon-btn-cd btn-delete-img">
											<i class="icon-cancel-circle-2"></i>

										</a>
										<a href="#" class="icon-btn-cd btn-check-img">
											<i class="icon-ok-circle-1">
												<input type="checkbox" name="delete" value="1" class="toggle">
											</i>

										</a>
									</div>
								</li>
								<li class="col-md-2" >
									<img class="img-responsive" src="/upload/2/thumbnails/2/j-4_165x95.jpg" />
									<span><i class="icon-ok-circled2"></i></span>
									<div class="media-tool">
										<a href="#" class="icon-btn-cd btn-delete-img">
											<i class="icon-cancel-circle-2"></i>

										</a>
										<a href="#" class="icon-btn-cd btn-check-img">
											<i class="icon-ok-circle-1">
												<input type="checkbox" name="delete" value="1" class="toggle">
											</i>

										</a>
									</div>
								</li>
								<li class="col-md-2" >
									<img class="img-responsive" src="/upload/2/thumbnails/2/j-4_165x95.jpg" />
									<span><i class="icon-ok-circled2"></i></span>
									<div class="media-tool">
										<a href="#" class="icon-btn-cd btn-delete-img">
											<i class="icon-cancel-circle-2"></i>

										</a>
										<a href="#" class="icon-btn-cd btn-check-img">
											<i class="icon-ok-circle-1">
												<input type="checkbox" name="delete" value="1" class="toggle">
											</i>

										</a>
									</div>
								</li>
								<li class="col-md-2" >
									<img class="img-responsive" src="/upload/2/thumbnails/2/j-4_165x95.jpg" />
									<span><i class="icon-ok-circled2"></i></span>
									<div class="media-tool">
										<a href="#" class="icon-btn-cd btn-delete-img">
											<i class="icon-cancel-circle-2"></i>

										</a>
										<a href="#" class="icon-btn-cd btn-check-img">
											<i class="icon-ok-circle-1">
												<input type="checkbox" name="delete" value="1" class="toggle">
											</i>

										</a>
									</div>
								</li>
								<li class="col-md-2" >
									<img class="img-responsive" src="/upload/2/thumbnails/2/j-4_165x95.jpg" />
									<span><i class="icon-ok-circled2"></i></span>
									<div class="media-tool">
										<a href="#" class="icon-btn-cd btn-delete-img">
											<i class="icon-cancel-circle-2"></i>

										</a>
										<a href="#" class="icon-btn-cd btn-check-img">
											<i class="icon-ok-circle-1">
												<input type="checkbox" name="delete" value="1" class="toggle">
											</i>

										</a>
									</div>
								</li>
								<li class="col-md-2" >
									<img class="img-responsive" src="/upload/2/thumbnails/2/j-4_165x95.jpg" />
									<span><i class="icon-ok-circled2"></i></span>
									<div class="media-tool">
										<a href="#" class="icon-btn-cd btn-delete-img">
											<i class="icon-cancel-circle-2"></i>

										</a>
										<a href="#" class="icon-btn-cd btn-check-img">
											<i class="icon-ok-circle-1">
												<input type="checkbox" name="delete" value="1" class="toggle">
											</i>

										</a>
									</div>
								</li>
								<li class="col-md-2" >
									<img class="img-responsive" src="/upload/2/thumbnails/2/j-4_165x95.jpg" />
									<span><i class="icon-ok-circled2"></i></span>
									<div class="media-tool">
										<a href="#" class="icon-btn-cd btn-delete-img">
											<i class="icon-cancel-circle-2"></i>

										</a>
										<a href="#" class="icon-btn-cd btn-check-img">
											<i class="icon-ok-circle-1">
												<input type="checkbox" name="delete" value="1" class="toggle">
											</i>

										</a>
									</div>
								</li>
								<li class="col-md-2" >
									<img class="img-responsive" src="/upload/2/thumbnails/2/j-4_165x95.jpg" />
									<span><i class="icon-ok-circled2"></i></span>
									<div class="media-tool">
										<a href="#" class="icon-btn-cd btn-delete-img">
											<i class="icon-cancel-circle-2"></i>

										</a>
										<a href="#" class="icon-btn-cd btn-check-img">
											<i class="icon-ok-circle-1">
												<input type="checkbox" name="delete" value="1" class="toggle">
											</i>

										</a>
									</div>
								</li>
								<li class="col-md-2" >
									<img class="img-responsive" src="/upload/2/thumbnails/2/j-4_165x95.jpg" />
									<span><i class="icon-ok-circled2"></i></span>
									<div class="media-tool">
										<a href="#" class="icon-btn-cd btn-delete-img">
											<i class="icon-cancel-circle-2"></i>

										</a>
										<a href="#" class="icon-btn-cd btn-check-img">
											<i class="icon-ok-circle-1">
												<input type="checkbox" name="delete" value="1" class="toggle">
											</i>

										</a>
									</div>
								</li>
								<li class="col-md-2" >
									<img class="img-responsive" src="/upload/2/thumbnails/2/j-4_165x95.jpg" />
									<span><i class="icon-ok-circled2"></i></span>
									<div class="media-tool">

										<a href="#" class="icon-btn-cd btn-delete-img">
											<i class="icon-cancel-circle-2"></i>

										</a>
										<a href="#" class="icon-btn-cd btn-check-img">
											<i class="icon-ok-circle-1">
												<input type="checkbox" name="delete" value="1" class="toggle">
											</i>

										</a>
									</div>
								</li>
							</ul>
						</div>

						</div>

						</div>

						<div class="tab-pane fade active in " id="tab_thu_vien">
							<div class="col-md-9 col-none-padding" style=" background: aliceblue;">
								<form id="fileupload" action="{{URL::to('media-data')}}" method="POST" enctype="multipart/form-data">
									<!-- The fileupload-buttonbar contains buttons to add/delete files and start/cancel the upload -->
									<input type="hidden" name="_token" value="{{{ Session::getToken() }}}">
									<div class="row fileupload-buttonbar" style=" margin-left: 2px;">
										<div class="col-lg-12">
											<!-- The fileinput-button span is used to style the file input field as button -->
																	<span class="btn green fileinput-button">
																	<i class="fa fa-plus"></i>
																	<span>
																	Thêm files... </span>
																	<input type="file" name="files[]" multiple="">
																	</span>
											<button type="submit" class="btn blue start">
												<i class="fa fa-upload"></i>
																	<span>
																	Upload Tất cả </span>
											</button>
											<button type="reset" class="btn warning cancel">
												<i class="fa fa-ban-circle"></i>
																	<span>
																	Huỷ upload </span>
											</button>
											<button type="button" class="btn red delete">
												<i class="fa fa-trash"></i>
																	<span>
																	Xoá </span>
											</button>
											<input type="checkbox" class="toggle">
											<!-- The global file processing state -->
																	<span class="fileupload-process">
																	</span>
										</div>
										<!-- The global progress information -->
										<div class="col-lg-12 fileupload-progress fade">
											<!-- The global progress bar -->
											<div class="progress progress-striped active" role="progressbar" style="margin:0px" aria-valuemin="0" aria-valuemax="100">
												<div class="progress-bar progress-bar-success" style="width:0%;">
												</div>
											</div>
											<!-- The extended global progress information -->
											<div class="progress-extended">
												&nbsp;
											</div>
										</div>
									</div>

									<div role="presentation" style=" overflow-y: scroll;height:400px" class="col-md-12 media-list-content">
										<ul class="files list-unstyled">
										</ul>
									</div>
								</form>

								<!-- The template to display files available for upload -->
								<script id="template-upload" type="text/x-tmpl">
																	{% for (var i=0, file; file=o.files[i]; i++) { %}
																		<li class=" col-md-2 media-item template-upload fade">
																			<div>
																				<span class="preview"></span>
																			</div>
																			<div style="display:none">
																				<p class="name">{%=file.name%}</p>
																				<strong class="error text-danger"></strong>
																			</div>
																			<div style="position: absolute;top: 23px;width: 100%;">
																				<div style="height: 10px;" class="progress progress-striped active" role="progressbar" aria-valuemin="0" aria-valuemax="100" aria-valuenow="0">
																				   <div class="progress-bar progress-bar-success" style="width:0%;">
																				</div>
																				</div>
																			</div>
																			<div class="media-tool">
																				{% if (!i && !o.options.autoUpload) { %}
																					<button class="btn btn-primary start" disabled>
																						<i class="glyphicon glyphicon-upload"></i>

																					</button>
																				{% } %}
																				{% if (!i) { %}
																					<button class="btn btn-warning cancel">
																						<i class="glyphicon glyphicon-ban-circle"></i>

																					</button>
																				{% } %}
																			</div>
																		</li>
																	{% } %}
																	</script>

								<!-- The template to display files available for download -->
														<script id="template-download" type="text/x-tmpl">
															  {% for (var i=0, file; file=o.files[i]; i++) { %}
																		<li class="col-md-2 media-item template-download fade" >
																		
																			<div>
																				<span class="preview">
																					{% if (file.thumbnailUrl) { %}
																					   
																						<img class="img-responsive" name_image="{%=file.name%}" date_post="{%=file.date_post%}" size_img="{%=o.formatFileSize(file.size)%}" title="{%=file.title_post%}" content_post="{%=file.content_post%}" alt="{%=file.alt_post%}"  url_img="{%=file.url_img%}"  id_post="{%=file.id_post%}"  src="{%=file.thumbnail_img%}">
																					{% } %}
																				</span>
																			</div>
																		
																			<div class="media-tool"  >
																				{% if (file.deleteUrl) { %}
																					<button class="btn btn-danger delete" data-type="{%=file.deleteType%}" data-url="{%=file.deleteUrl%}"{% if (file.deleteWithCredentials) { %} data-xhr-fields='{"withCredentials":true}'{% } %}>
																						<i class="glyphicon glyphicon-trash"></i>
																					   
																					</button>
																					<input type="checkbox" name="delete" value="1" class="toggle">
																							
																					
																					
																					
																				{% } else { %}
																					<button class="btn btn-warning cancel">
																						<i class="glyphicon glyphicon-ban-circle"></i>
																						<span>Huỷ</span>
																					</button>
																				{% } %}
																			</div>
																	   </li>
																	{% } %}
																	</script>
													<div class="clearfix"></div>

										</div>
										<div class="col-md-3 col-none-padding">

											<div class="col-md-12 media-edit"  >
												<div class="media-detail-infor">
													<img class="media-thumbnail" id="media-thumbnail-img" src={{asset('asset')}}"/upload/files/thumbnail/2%20%281%29.jpg" />
													<p>Tên Hình : <span id="name_ihinh">hjhjhj</span> </p>
													<p>kích thước :  <span id="size_ihinh">hjhjhj</span></p>
													<p>Ngày đăng :  <span id="date_ihinh">hjhjhj</span></p>

												</div>

												<form id="form-edit-media" method="post"  action="" class="form-edit-media" role="form" autocomplete="off">
													<input type="hidden" name="_token" value="">
													<input  type="hidden" id="id-edit-media" value=""/>
													<div class="form-body">
														<div class="form-group">
															<label>Tiêu đề</label>
															<div class="input-group">

																<input class="form-control" placeholder="Hãy nhập tiêu đề..." type="text" name="title-edit" id="title-edit-media" value="">


															</div>
														</div>
														<div class="form-group">
															<label>URL</label>
															<div class="input-group">
																<input class="form-control" placeholder="" data-img-url="" readonly type="text" name="url-edit" id="url-edit-media" value="">
															</div>
														</div>
														<div class="form-group">
															<label>ALT</label>
															<div class="input-group">
																<input class="form-control" placeholder="" type="text" name="alt-edit" id="alt-edit-media" value="">
															</div>
														</div>
														<div class="form-group">
															<label>Giới thiệu</label>
															<textarea class="form-control full-width wysihtml5" placeholder="hãy nhập đoạn giới thiệu ...." name="content-edit" id="content-edit-media" value="content" rows="3"></textarea>



														</div>
													</div>
													<div class="form-actions">
														<button type="submit" class="btn blue">Cập Nhật </button>
														<button type="button" class="btn default">Cancel</button>
													</div>
												</form>

											</div>

										</div>
							<div class="clearfix"></div>

						</div>
							<div class="tab-pane fade" id="tab_insert_media">
								<div class="col-md-12">
									<div class="form-group">
										<label>Thêm Url hình ảnh</label>
										<div class="input-group input-icon right">
																		<span class="input-group-addon">
																		<i class="icon-attach-outline"></i>
																		</span>
											<i class="fa fa-exclamation tooltips" data-original-title="Invalid email." data-container="body"></i>
											<input id="email" id="input-url-img" class="input-error input-url-img form-control" type="text" value="">
										</div>

									</div>

									<div class="form-group">
										<label>Thêm Url Youtube</label>
										<div class="input-group input-icon right">
																		<span class="input-group-addon">
																		<i class="icon-attach-outline"></i>
																		</span>
											<i class="fa fa-exclamation tooltips" data-original-title="Invalid email." data-container="body"></i>
											<input  id="email" id="input-url-video" class="input-error input-url-video form-control" type="text" value="">
											<input type="hidden" name="type-media" value=""/>
										</div>

									</div>
									<div class="frame-media-internet">
									</div>

									<form id="form-add-media" method="post" action="{{ URL::to('post/image/create') }}" class="infor-media" role="form" autocomplete="off">
										<input type="hidden" name="_token" value="{{{ csrf_token() }}}" />
										<input type="hidden" name="url" id="url-media" value=""/>
										<div class="form-body">
											<div class="form-group">
												<label>Tiêu đề</label>
												<div class="input-group">
																				<span class="input-group-addon">
																				<i class="fa fa-envelope"></i>
																				</span>
													<input class="form-control" placeholder="Hãy nhập tiêu đề..." type="text" name="title" id="title" value="{{{ Input::old('title', isset($post) ? $post->title : null) }}}" />
													{{ $errors->first('title', '<span class="help-block">:message</span>') }}

												</div>
											</div>

											<div class="form-group">
												<label>Giới thiệu</label>
												<textarea class="form-control full-width wysihtml5" placeholder="hãy nhập đoạn giới thiệu ...." name="content" id="content" value="content" rows="3">{{{ Input::old('content', isset($post) ? $post->content : null) }}}</textarea>
												{{ $errors->first('content', '<span class="help-block">:message</span>') }}


											</div>
										</div>
										<div class="form-actions">
											<button type="submit" class="btn blue" >Chèn </button>
											<button type="button" class="btn default">Cancel</button>
										</div>
									</form>
								</div>



								<div></div>
							</div>
		<div class="tab-pane fade" id="tab_6_5">
			<p>
				Trust fund seitan letterpress, keytar raw denim keffiyeh etsy art party before they sold out master cleanse gluten-free squid scenester freegan cosby sweater. Fanny pack portland seitan DIY, art party locavore wolf cliche high life echo park Austin. Cred vinyl keffiyeh DIY salvia PBR, banh mi before they sold out farm-to-table VHS viral locavore cosby sweater. Lomo wolf viral, mustache readymade thundercats keffiyeh craft beer marfa ethical. Wolf salvia freegan, sartorial keffiyeh echo park vegan.
			</p>
		</div>
		</div>
		</div>
		</div>


		<div class="clearfix"></div>
		</div>
			<div class=" col-md-12 col-none-padding modal-footer" style="margin-top: 0px;padding-top: 10px;padding: 5px;">
				<div class="col-md-9" style="border-right: 1px solid #CCC; margin-bottom: 10px;"></div>
				<div class="col-md-3">
					<button type="button" id="insert-media-browser" class="btn btn-sm btn-primary" data-dismiss="modal" >Chèn Hình</button>
					<button type="button" class="btn btn-sm btn-default" data-dismiss="modal">Đóng</button>
				</div>
			</div>
		</div>
</div>
</div><!--// END Image Manager Modal -->
</div>