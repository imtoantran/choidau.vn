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
						@foreach($location->album()->get() as $image)
							<div class="col-xs-3 item-img">
								<button type="button" class="no-padding location-img-btn-close-item" title="Xóa hình">
									<i class="icon-cancel-circled"></i>
								</button>
								<img width="100%" height="100%" class="img-responsive" src="{{$image->getMetaKey("url")}}" alt=""/>
							</div>
						@endforeach
					</div>
				</session>
			</div>
			<div class="modal-footer">
				<button type="button" class="btn btn-default" data-dismiss="modal">Đóng</button>
				<div class="btn btn-primary">Thêm hình</div>
			</div>
		</div><!-- /.modal-content -->
	</div><!-- /.modal-dialog -->
</div><!-- /.modal -->