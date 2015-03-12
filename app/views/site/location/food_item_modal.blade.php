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
            <form action="{{URL::to("location/$location->id/food/add")}}" id="food_form" method="POST" class="form-horizontal" role="form">
			<div class="modal-body">
                    <div class="form-group">
                    	<label for="name" class="col-sm-2 control-label">Tên:</label>
                    	<div class="col-sm-10">
                    		<input type="text" name="name" class="form-control" value="" title="" required="required" >
                    		<input type="hidden" name="id"/>
                    		<input type="hidden" name="_token" value="{{Session::token()}}"/>
                    	</div>
                    </div>
                    <div class="form-group">
                    	<label for="name" class="col-sm-2 control-label">Giá:</label>
                    	<div class="col-sm-4">
                    		<input type="text" name="price"  class="form-control" value="" title="" required="required" >
                    	</div>
                        <label for="inputID" class="col-sm-2 control-label">Phân loại:</label>
                        <div class="col-sm-4">
                            <select name="type"  class="form-control">
                                <option value="0"> -- Chọn -- </option>
                                @if(Cache::has("food_type"))
                                    @foreach(Cache::get("food_type") as $type)
                                        <option value="{{$type->id}}"> {{$type->description}} </option>
                                    @endforeach
                                @endif
                            </select>
                        </div>
                    </div>
                    <div class="form-group">
                    </div>
			</div>
			<div class="modal-footer">
				<button type="button" class="btn btn-sm btn-default" data-dismiss="modal">Hủy</button>
				<button type="submit" class="btn btn-sm btn-primary">Lưu</button>
			</div>
            </form>
		</div><!-- /.modal-content -->
	</div><!-- /.modal-dialog -->
</div><!-- /.modal -->
