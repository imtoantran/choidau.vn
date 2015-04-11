
<div class="modal fade in" id="popup-create-event" style="display: none;" aria-hidden="false"><div class="modal-backdrop fade in" style="height: 337px;"></div>
    <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
        <h4 class="modal-title margin-bottom-0"><i class="icon-picture"></i> sự kiện địa điểm</h4>
    </div>
    <div class="modal-body">
        <form id="form-ada-event-location" action="" method="POST" class="form-horizontal" role="form">
            <input name="_token" value="" type="hidden">
            <input name="id" value="127" type="hidden">
            <div class="row">
                <div class="col-xs-12 col-sm-12 col-md-12 col-lg-12">
                    <div class="form-group">
                        <div class="col-sm-12">
                            <label>Tiêu đề sự kiện</label>
                            <input type="text" name="title" placeholder="Nhập tiêu đề, ví dụ '  sự kiện khuyến mãi mùa tết'" id="title-event-location" class="form-control" value="" title="" required="required">
                        </div>
                    </div>

                    <div class="form-group">
                        <div class="col-sm-12">
                            <label>Nội dung sự kiện</label>
                            <textarea type="text" name="content" id="content-event-location" rows="10" class="form-control" value="" title="" required="required" placeholder="Nhập nội dung sự kiện"></textarea>
                        </div>
                    </div>

                    <div class="form-group">
                        <div class="col-md-12">
                            <div class="col-md-6 no-padding">
                                <label class= col-md-12 pull-left">Ngày bắt đầu</label>
                                <div class="input-group date date-picker " >

                                    <input type='text' class="form-control" id='date-start-event-location' />
                                    <span class="input-group-addon"><span class="glyphicon glyphicon-calendar"></span>
                                    </span>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <label class=" col-md-12 pull-left">Ngày kết thúc</label>
                                <div class="input-group date date-picker " >
                                    <input type='text' class="form-control" id='date-end-event-location' />
                                    <span class="input-group-addon"><span class="glyphicon glyphicon-calendar"></span>
                                    </span>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </form>
    </div>
    <div class="modal-footer">
        <button type="button" class="btn btn-default" data-dismiss="modal">Đóng</button>
        <button type="button" class="yellow btn btn-warning btn-add-event-location" >Đăng sự kiện <i class="fa fa-calendar"></i></button>
    </div>
</div>