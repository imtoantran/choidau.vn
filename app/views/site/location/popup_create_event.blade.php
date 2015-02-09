
<div class="modal fade in" id="popup-create-event" style="display: none;" aria-hidden="false"><div class="modal-backdrop fade in" style="height: 337px;"></div>
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
                <h4 class="modal-title margin-bottom-0"><i class="icon-picture"></i> sự kiện địa điểm</h4>
            </div>
            <div class="modal-body">


                <form id="review-form" action="" method="POST" class="form-horizontal" role="form">
                    <input name="_token" value="" type="hidden">
                    <input name="id" value="127" type="hidden">
                    <div class="row">
                        <div class="col-xs-12 col-sm-12 col-md-12 col-lg-12">
                            <div class="form-group">

                                <div class="col-sm-12">
                                    <label>Tiêu đề sự kiện</label>
                                    <input type="text" name="title" placeholder="Nhập tiêu đề, ví dụ '  sự kiện khuyến mãi mùa tết'" id="inputID" class="form-control" value="" title="" required="required">
                                </div>
                            </div>

                            <div class="form-group">

                                <div class="col-sm-12">
                                    <label>Nội dung sự kiện</label>
                                    <textarea type="text" name="content" id="inputID" class="form-control" value="" title="" required="required" placeholder="Nhập nội dung sự kiện"></textarea>

                                </div>
                            </div>


                            <div class="form-group">

                                <div class="col-md-12">
                                    <div class="col-md-6">
                                        <label class="control-label col-md-12 pull-left">Ngày bắt đầu</label>
                                        <div class="input-group date date-picker datepicker-start">
                                            <input type="text" class="form-control" data-date-format="dd-mm-yyyy" readonly />
                                            <span class="input-group-addon"><i class="fa fa-calendar"></i></span>
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <label class="control-label col-md-12 pull-left">Ngày kết thúc</label>
                                        <div class="input-group date date-picker datepicker-end">
                                            <input type="text" class="form-control" data-date-format="dd-mm-yyyy" readonly />
                                            <span class="input-group-addon"><i class="fa fa-calendar"></i></span>
                                        </div>
                                    </div>
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

                    <input type="hidden" id="list-album" name="list-album">

                </form>


            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-default" data-dismiss="modal">Đóng</button>
                <div id="iM_user_slide1" type_insert="location_insert_album" class="col-md-4 insertMedia single-picture-wrapper imageManager_openModal1 abc" style="position: relative;" data-toggle="modal" data-target="#imageManager_modal">
                    <div class="add-picture vertically-centered" style="">
                        <button id="btn-upgrade-imgs" type="button" class="form-control yellow btn btn-warning text-left"> <i class="icon-file-image" style="font-size: 1.3em;"></i> Thêm ảnh</button>
                    </div>
                </div>
            </div>
        </div><!-- /.modal-content -->
    </div><!-- /.modal-dialog -->
</div>