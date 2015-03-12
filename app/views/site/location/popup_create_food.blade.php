
<div class="modal fade in" id="popup-create-food" style="display: none;" aria-hidden="false"><div class="modal-backdrop fade in" style="height: 337px;"></div>
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
                <h4 class="modal-title margin-bottom-0"><i class="icon-picture"></i> Món ăn địa điểm</h4>
            </div>
            <div class="modal-body">


                <div class="container-fluid">
                    <form id="from-add-food-location">


                    <div class="form-group clearfix">
                        <label for="location-food-name" class="col-sm-2 control-label">
                            <strong>Tên món:</strong></label>
                            <div class="col-sm-10">
                                <input data-food-suggest-id="" list="food-datalist-add-food" class="form-control" name="location-food-name" id="txt-location-food-name">
                                <datalist name="food-datalist" id="food-datalist-add-food">

                                    <?php if(Cache::has('list_food')){
                                    $food=Cache::get('list_food');
                                    }else{
                                    $food = Food::orderBy('name','ASC')->get();
                                    }?>
                                    @foreach($food as $item)
                                    <option data-id="{{$item->id}}" value="{{$item->name}}"></option>
                                    @endforeach



                                </datalist>
                            </div>
                    </div>
                    <div class="form-group clearfix">
                        <label for="location-food-price" class="col-sm-2 control-label"><strong>Giá:</strong></label>
                        <div class="col-sm-5">
                            <input name="location-food-price" id="txt-location-food-price" class="form-control"></div>
                        <div class="col-sm-5">VNĐ</div>
                    </div>
                    <div class="form-group clearfix"><label for="location-food-typ" class="col-sm-2 control-label"><strong>Loại món:</strong></label>
                        <div class="col-sm-10">
                            <select name="location-food-typ" id="slc-location-food-type" class="form-control" value="" required="required" title="">
                                <option value="2">Thức ăn</option>
                                <option value="25">Nước uống</option></select>
                        </div>
                    </div>
                    <div class="form-group clearfix">
                        <label for="input" class="col-sm-2 control-label"><strong>Mô tả:</strong></label>
                        <div class="col-sm-10">
                            <textarea name="location-food-description" id="are-location-food-description" rows="4" style="width: 100%!important;"></textarea>
                        </div>
                    </div>
                </div>


            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-default" data-dismiss="modal">Đóng</button>
                <button type="button" class="yellow btn btn-warning btn-add-food-location" >Đăng Món ăn <i class="fa fa-calendar"></i></button>

            </div>
            </form>
        </div><!-- /.modal-content -->
    </div><!-- /.modal-dialog -->
</div>