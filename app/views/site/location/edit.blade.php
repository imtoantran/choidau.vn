{{--<a class="btn btn-primary" data-toggle="modal" href="uploadImageModal">Trigger modal</a>--}}
<div class="modal fade" id="uploadImageModal">
	<div class="modal-dialog">
		<div class="modal-content">
			<div class="modal-header">
				<button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
				<h4 class="modal-title margin-bottom-0"><i class="icon-picture"></i> hình địa điểm</h4>
			</div>
			<div class="modal-body">
				<session>
					<div class="row wrapper-img">
						@if($location->album()->count())
							@foreach($location->album()->get() as $image)
								<div class="col-xs-3 item-img"  data-img-id="{{$image->id}}">
									<button type="button" data-img-album="{{$image->id}}" class="no-padding location-img-btn-close-item tooltips" data-original-title="Xóa">
										<i class="icon-cancel-circled"></i>
									</button>
									<img style="width: 117px; height: 87px;" class="padding-3 img-border-grey img-responsive" src="{{$image->getMetaKey("url")}}" alt=""/>
								</div>
							@endforeach
						@else
							<div class="album-empty padding-left-20" style="font-style: italic; color: #ccc;">
								<i class="icon-folder-empty"></i>
								Thư mục rỗng.
							</div>
						@endif
					</div>
				</session>
			</div>
			<div class="modal-footer">
				<button type="button" class="btn btn-default" data-dismiss="modal">Đóng</button>
				<div id="iM_user_slide1" type_insert="location_insert_album" class=" col-md-4 insertMedia single-picture-wrapper imageManager_openModal1" style="position: relative;" data-toggle="modal" data-target="#imageManager_modal">
					<div class="add-picture vertically-centered" style="">
						<button id="btn-upgrade-imgs" type="button" class="form-control yellow btn btn-warning text-left"> <i class="icon-file-image" style="font-size: 1.3em;"></i> Thêm ảnh</button>
					</div>
				</div>
			</div>
		</div><!-- /.modal-content -->
	</div><!-- /.modal-dialog -->
</div><!-- /.modal -->