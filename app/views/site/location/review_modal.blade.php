<div class="modal fade" id="reviewModal" data-backdrop="static">
    <div class="modal-dialog">
        <div class="modal-content">
            <form id="review-form" action="" method="POST" class="form-horizontal" role="form">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
                    <h4 class="modal-title">Viết đánh giá</h4>
                </div>
                <div class="modal-body">
                    <input name="_token" value="{{Session::getToken()}}" type="hidden"/>
                    <input name="id" value="{{$location->id}}" type="hidden"/>

                    <div class="row">
                        <div class="col-xs-9 col-sm-9 col-md-9 col-lg-9">
                            <div class="col-sm-12">
                                <div class="form-group">
                                    <input name="title"
                                           placeholder="Nhập tiêu đề, ví dụ 'Món ăn thật tuyệt'"
                                           minlength="10" type="text" data-required="1"
                                           class="form-control input-sm" value="" title="" required/>
                                </div>
                            </div>
                            <div class="col-sm-12">
                                <div class="form-group">
                            <textarea name="content" placeholder="Nhập nội dung review"
                                      minlength="10" data-required="1" rows="1" class="form-control"
                                      title="Nội dung review" required> </textarea>
                                </div>
                            </div>
                        </div>
                        <div class="col-xs-3 col-sm-3 col-md-3 col-lg-3">
                            <p>Đánh giá</p>

                            <div class="form-group">
                                <div class="col-sm-12">
                                    <input type="range" value="4" name="review_rating" step="0.25" id="backing4">

                                    <div class="rateit" data-rateit-backingfld="#backing4" data-rateit-resetable="false"
                                         data-rateit-ispreset="true"
                                         data-rateit-min="0" data-rateit-max="5">
                                    </div>
                                </div>
                            </div>
                            <div class="form-group">
                                <div class="col-sm-12">
                                    <select name="review_visitors" class="form-control input-sm">
                                        <option value=""> -- Đã đến --</option>
                                        <option value="2"> 2 người +</option>
                                        <option value="4"> 4 người +</option>
                                        <option value="6"> 6 người +</option>
                                    </select>
                                </div>
                            </div>
                            <div class="form-group">
                                <div class="col-sm-12">
                                    <select name="review_price" class="form-control input-sm">
                                        <option value=""> -- Giá cả --</option>
                                        <option value="50000"> 50,000 đ+</option>
                                        <option value="100000"> 100,000 đ+</option>
                                        <option value="200000"> 200,000 đ+</option>
                                    </select>
                                </div>
                            </div>
                            <div class="form-group">
                                <div class="col-sm-12">
                                    <select name="review_visit_again" class="form-control input-sm">
                                        <option value=""> -- Quay lại --</option>
                                        <option value="sure"> Chắc chắn</option>
                                        <option value="never"> Không bao giờ</option>
                                        <option value="maybe"> Có thể</option>
                                    </select>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-xs-12 col-sm-12 col-md-12 col-lg-12">
                            <div class="review-image-container">
                            </div>
                        </div>
                    </div>
                </div>
                <div class="modal-footer">
                    <button id="add-review-image" type="button" class="btn-xs btn text-primary review-upload-image">
                        <i class="icon-camera"></i>
                        Đăng hình
                    </button>
                    <button type="button" class="btn btn-info btn-xs" data-dismiss="modal">Đóng</button>
                    <input type="submit" class="btn btn-primary btn-xs" id="review-save" value="Hoàn tất"/>
                </div>
            </form>
        </div>
        <!-- /.modal-content -->
    </div>
    <!-- /.modal-dialog -->
</div><!-- /.modal -->


