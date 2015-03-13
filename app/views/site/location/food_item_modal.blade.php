<?php
/**
 * Created by PhpStorm.
 * User: imtoantran
 * Date: 3/12/2015
 * Time: 11:50 AM
 */
?>
<div class="modal fade" id="food-item-modal">
    <div class="modal-dialog modal-sm">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
                <h4 class="modal-title">Món ăn</h4>
            </div>
            <form action="{{URL::to("location/$location->id/food/add")}}" id="food_form" method="POST"
                  class="form-horizontal" role="form">
                <div class="modal-body">
                    <div class="row">

                    <div class="col-xs-12 col-sm-12 col-md-6 col-lg-6">
                        <div class="form-group">
                            <label for="name" class="col-sm-4 control-label">Tên:</label>

                            <div class="col-sm-8">
                                <input type="text" name="name" class="form-control" value="" title="" required="required">
                                <input type="hidden" name="id"/>
                                <input type="hidden" name="_token" value="{{Session::token()}}"/>
                            </div>
                        </div>
                        <div class="form-group">
                            <label for="price" class="col-sm-4 control-label">Giá:</label>

                            <div class="col-sm-8">
                                <input type="text" name="price" class="form-control" value="" title="" required="required">
                            </div>
                        </div>
                        <div class="form-group">
                            <label for="inputID" class="col-sm-4 control-label">Phân loại:</label>
                            <div class="col-sm-8">
                                <select name="type" class="form-control">
                                    <option value="0"> -- Chọn --</option>
                                    @if(Cache::has("food_type"))
                                        @foreach(Cache::get("food_type") as $type)
                                            <option value="{{$type->id}}"> {{$type->description}} </option>
                                        @endforeach
                                    @endif
                                </select>
                            </div>
                        </div>
                    </div>
                    <div class="col-xs-12 col-sm-12 col-md-6 col-lg-6">
                    	<div class="form-group">
                    		<label for="name" class="col-lg-4 col-md-6 col-sm-12 col-xs-12">Hình ảnh:</label>
                    		<div class="col-lg-8 col-md-6 col-sm-12 col-xs-12">
                                <img id="food-thumbail" src="/assets/global/img/no-image.png" class="img-responsive" style="max-height:150px;">
                    			<input type="hidden" name="image">
                    		</div>
                    	</div>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-sm btn-default" data-dismiss="modal">Hủy</button>
                    <button type="submit" class="btn btn-sm btn-primary">Lưu</button>
                </div>
                </div>
            </form>
        </div>
        <!-- /.modal-content -->
    </div>
    <!-- /.modal-dialog -->
</div><!-- /.modal -->
