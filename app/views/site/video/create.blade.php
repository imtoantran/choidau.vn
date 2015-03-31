<div id="popup-video-create" style="z-index: 1052;" class="modal fade in" role="dialog" aria-labelledby="myModalLabel" aria-hidden="false" data-backdrop="static" data-max-height="440">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header choidau-bg" style=" padding: 6px 10px; background: #f7ca18 !important;">
                <button type="button" class="close" data-dismiss="modal"><span aria-hidden="true">×</span><span class="sr-only">Close</span></button>
                <h5 class="modal-title" id="myModalLabel" style="font-size:1.3em; margin: 5px 0px; text-align:center; font-weight: 600; color: white;">Tạo chủ đề</h5>
            </div>
            <div class="modal-body" style="padding: 30px 20px 0px;">

                <form class="form-horizontal" id="frm-create-faq" action="#" method="post">
                    <input type="hidden" name="_token" id="_token" value="{{ csrf_token() }}">
                    <div class="form-group">
                        <label class="control-label col-sm-3" >Chủ đề</label>
                        <div class="col-sm-8">
                            <input class="form-control" type="text" id="subject" name="subject" placeholder="Nhập chủ đề cần hỏi." required pattern=".{6,}" title="Chủ đề phải từ 6 kí tự.">
                        </div>
                    </div>
                    <div class="form-group">
                        <label class="control-label col-sm-3">Nội dung</label>
                        <div class="col-sm-8">
                            <textarea class="form-control"  name="content" id="content" cols="20" rows="5"  placeholder="Nhập nội dung cần hỏi." required pattern=".{6,}" title="Nội dung phải từ 6 kí tự."></textarea>
                        </div>
                    </div>

                    <div class="form-group">
                        <label class="control-label col-sm-3"></label>
                        <div class="col-sm-8">
                            <button type="submit" class="btn btn-sm green btn-add-faq">Thêm <i class="icon-plus white"></i></button>
                            <button type="reset" class="btn btn-sm btn-default btn-reset-faq">Hủy <i class="icon-cancel-circle white"></i></button>
                            <button type="button" class="btn btn-sm btn-danger" data-dismiss="modal">Thoát <i class="icon-exit white"></i></button>
                        </div>
                    </div>
                    <div class="form-group alert-popup-login display-none"></div>
                </form>
            </div>

        </div><!-- /.modal-content -->
    </div><!-- /.modal-dialog -->
</div>
