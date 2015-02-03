<div class="modal large fade" id="reviewModal" data-backdrop="static">
	<div class="modal-dialog modal-lg">
		<div class="modal-content">
			<div class="modal-header">
				<button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
				<h4 class="modal-title">Viết review</h4>
			</div>
			<div class="modal-body">
                <form id="review-form" action="" method="POST" class="form-horizontal" role="form">
                    <input name="_token" value="{{Session::getToken()}}" type="hidden"/>
                    <input name="id" value="{{$location->id}}" type="hidden"/>
                    <div class="row">
                        <div class="col-xs-9 col-sm-9 col-md-9 col-lg-9">
                            <div class="form-group">
                                <div class="col-sm-12">
                                    <input type="text" name="title" placeholder="Nhập tiêu đề, ví dụ 'Món ăn thật tuyệt'" id="inputID" class="form-control" value="" title="" required="required" >
                                </div>
                            </div>
                            <div class="form-group">
                                <div class="col-sm-12">
                                    <textarea type="text" name="content" placeholder="Nhập nội dung review" id="inputID" class="form-control wysihtml5" value="" title="" required="required" ></textarea>
                                </div>
                            </div>
                        </div>
                        <div class="col-xs-3 col-sm-3 col-md-3 col-lg-3">
                            <p>Đánh giá</p>

                            <div class="form-group">
                            	<div class="col-sm-12">
                                    <input type="radio" name="review_rating" value="1"/>
                                    <input type="radio" name="review_rating" value="2"/>
                                    <input type="radio" name="review_rating" checked value="3"/>
                                    <input type="radio" name="review_rating" value="4"/>
                                    <input type="radio" name="review_rating" value="5"/>
                                </div>
                            </div>
                            <div class="form-group">
                            	<div class="col-sm-12">
                            		<select name="review_visitors" id="inputID" class="form-control">
                                        <option value=""> -- Đã đến -- </option>
                                        <option value="2">  2 người +  </option>
                                        <option value="4">  4 người +  </option>
                                        <option value="6">  6 người +  </option>
                                    </select>
                            	</div>
                            </div>
                            <div class="form-group">
                            	<div class="col-sm-12">
                            		<select name="review_price" id="inputID" class="form-control">
                                        <option value=""> -- Giá cả -- </option>
                                        <option value="50000"> 50,000 đ+ </option>
                                        <option value="100000"> 100,000 đ+ </option>
                                        <option value="200000"> 200,000 đ+ </option>
                                    </select>
                            	</div>
                            </div>
                            <div class="form-group">
                            	<div class="col-sm-12">
                            		<select name="review_visit_again" id="inputID" class="form-control">
                                        <option value=""> -- Quay lại -- </option>
                                        <option value="sure"> Chắc chắn </option>
                                        <option value="never"> Không bao giờ </option>
                                        <option value="maybe"> Có thể </option>
                                    </select>
                            	</div>
                            </div>
                        </div>
                    </div>
                    <div class="form-group">
                        <div class="col-sm-12">

                            <div id="iM_user_slide1" type_insert="location_load_album" class=" col-md-4 insertMedia single-picture-wrapper imageManager_openModal1" style="position: relative;" data-toggle="modal" data-target="#imageManager_modal">
                                <div class="add-picture vertically-centered" style="">
                                    <button id="btn-upgrade-imgs" type="button" class=" btn text-primary review-upload-image"> Đăng hình <i class="icon-camera"></i></button>
                                </div>
                            </div>

                            <div class="row location-album-wrapper">
                            </div>
                        </div>
                    </div>

                    <input type="hidden" id="list-album" name="list-album"/>

                </form>
			</div>
			<div class="modal-footer">
                <button type="button" class="btn btn-default" data-dismiss="modal">Đóng</button>
				<button type="button" class="btn btn-primary" id="review-save">Hoàn tất</button>
			</div>
		</div><!-- /.modal-content -->
	</div><!-- /.modal-dialog -->
</div><!-- /.modal -->