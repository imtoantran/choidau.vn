<div class="modal fade" id="uploadImageModal" data-backdrop="static" data-focus-on="input:first" tabindex="-1">
	<div class="modal-dialog">
		<div class="modal-content">
			<div class="modal-header">
				<button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
				<h4 class="modal-title margin-bottom-0"><i class="icon-picture"></i> hình địa điểm</h4>
			</div>
			<div class="modal-body">
				<section>
					<div class="row wrapper-img">
						@if($location->images()->count())
							@foreach($location->images()->get() as $image)
								<div class="col-xs-2 item-img"  data-image-id="{{$image->id}}">
									<button type="button" data-image-id="{{$image->id}}" class="no-padding location-img-btn-close-item tooltips margin-none" data-original-title="Xóa">
										<i class="icon-cancel-circled"></i>
									</button>
									<img style="width: 100%; " class="padding-3 img-border-grey" src="{{$image->thumbnail;}}" alt=""/>
								</div>
							@endforeach
						@else
							<div class="album-empty padding-left-20" style="font-style: italic; color: #ccc;">
								<i class="icon-folder-empty"></i>
								Thư mục rỗng.
							</div>
						@endif
					</div>
				</section>
			</div>
			<div class="modal-footer">
				<button type="button" class="btn btn-default" data-dismiss="modal">Đóng</button>
				<div class="col-md-4" style="position: relative;">
					<div class="add-picture vertically-centered" style="">
						<button id="btn-upgrade-imgs" type="button" class="form-control yellow btn btn-warning text-left" style="color: #fff!important;"> <i class="icon-file-image" style="font-size: 1.3em;"></i> Thêm ảnh</button>
					</div>
				</div>
			</div>
		</div><!-- /.modal-content -->
	</div><!-- /.modal-dialog -->
</div><!-- /.modal -->