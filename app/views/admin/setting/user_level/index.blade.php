@extends("admin.layouts.main")
@section("content")
    <div class="alert alert-danger display-hide">
        <button class="close level-alert-close" data-close="alert"></button>
        <span>Xin vui lòng điền đầy đủ thông tin bên dưới.</span>
    </div>
    <div class="alert alert-success display-hide">
        <button class="close level-alert-close" data-close="alert"></button>
        <span>Tạo địa điểm thành công!</span>
    </div>
<div class="row">
    <div class="col-md-12">
        <div class="row">
            <div class="col-md-1"></div>
            <div class="col-md-9 form-group clearfix">
                <button class="btn btn-success margin-bottom btn-create">
                    <i class="icon-plus"></i> Tạo mới
                </button>
            </div>
        </div>
    </div>
</div>

<div class="user-level-wrapper">
    @if(isset($user_level) && count($user_level))
        @foreach($user_level as $key=>$val)
            <div class="row item-row">
                <div class="form-group clearfix" style="line-height: 32px;">
                    <div class="col-md-3">
                        <div class="input-group pull-right">
                            <input id="{{$val->id}}" name="{{$val->id}}" type="text" class="form-control description" data-val="{{$val->description}}" value="{{$val->description}}">
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="input-group">
                            <input id="" name="" type="text" class="form-control value" data-val="{{$val->value}}" value="{{$val->value}}">
                            <span class="input-group-addon">
                               <a href="#" class="tooltips user-level-delete" data-id="{{$val->id}}" data-original-title="Xóa cấp bậc"><i class="icon-cancel-squared"></i></a>
                            </span>
                        </div>
                    </div>
                    <div class="col-md-1 padding-left-20">
                        <button class="btn btn-default btn-xs margin-bottom user-level-update" data-id="{{$val->id}}">
                            <i class="icon-floppy"></i> Lưu
                        </button>
                    </div>
                </div>
            </div>
        @endforeach
    @endif
</div>

    <div class="margin-bottom-20"></div>
@stop

@section("scripts")
    <script type="text/javascript">
        $(document).ready(function () {
            $('.level-alert-close').on('click', function(){
                $(this).closest('.alert').slideUp('slow');
            });

            $('.btn-create').on('click',function(){
                var str = '<div class="form-group clearfix" style="line-height: 32px;">';
                    str += '<div class="col-md-3">';
                    str += '<div class="input-group pull-right">';
                    str += '<input id="" name="" type="text" class="form-control description" data-val="" value="" placeholder="--- Nhập mô tả ---">';
                    str += '</div>';
                    str += '</div>';
                    str += '<div class="col-md-6">';
                    str += '<div class="input-group">';
                    str += '<input id="" name="" type="text" class="form-control value" data-val="" value="" placeholder="--- Nhập điểm ---">';
                    str += '<span class="input-group-addon">';
                    str += '<a href="#" class="tooltips user-level-delete" data-id="" data-original-title="Xóa cấp bậc"><i class="icon-cancel-squared"></i></a>';
                    str += '</span>';
                    str += '</div>';
                    str += '</div>';
                    str += '<div class="col-md-1 padding-left-20">';
                    str += '<button class="btn btn-default btn-xs margin-bottom user-level-create" data-id="">';
                    str += '<i class="icon-floppy"></i> Lưu';
                    str += '</button>';
                    str += '</div>';
                    str += '</div>';

                var user_level_item = $('<div/>',{class:'row item-row'}).append(str);

                user_level_item.find('.user-level-create').on('click',function(){
                    var self = $(this);
                    var description = self.closest('.form-group').find('.description');
                    var value = self.closest('.form-group').find('.value');
                    if(description.val().length<=0){
                        alert('Hãy nhập mô tả.');
                        description.focus();
                        return;
                    }
                    if(value.val().length<=0){
                        alert('Hãy nhập điểm.');
                        value.focus();
                        return;
                    }
                    // tao moi


                    self.find('i').iconLoad('icon-floppy');
                    $.ajax({
                        type: "POST",
                        url: "{{URL::to('qtri-choidau/setting/user-level/create')}}",
                        data: {'description':description.val(), 'value':value.val()},
                        dataType: 'json',
                        success: function (respon) {
                            $('.alert').hide();

                            if(respon != -1){
                                $('.alert-success').find('span').html('<i class="icon-ok"></i> Thêm cấp bậc thành công!').closest('.alert-success').fadeIn();
                                description.attr('data-val',description.val());
                                value.attr('data-val',value.val());
                                self.removeClass('user-level-create').addClass('user-level-update');
                                self.attr('data-id',respon);
                                self.closest('.form-group').find('.user-level-delete').attr('data-id',respon);

                                //delete
                                self.closest('.form-group').find('.user-level-delete').on('click', function(e){
                                    e.preventDefault();
                                    var cf = confirm('Bạn muốn xóa cấp bậc này');
                                    if(cf){
                                        deleteUserLevel($(this));
                                    }
                                });
                            }else{
                                $('.alert-danger').find('span').html('<i class="icon-ok"></i> Thêm thất bại, Xin vui lòng kiểm tra lại!').closest('.alert-danger').fadeIn();
                            }
                        },
                        complete: function(){
                            self.find('i').iconUnload('icon-floppy');
                        }
                    });
                });


                $('.user-level-wrapper').prepend(user_level_item);
            });

            //delete
            $('.user-level-delete').on('click', function(e){
                e.preventDefault();
                var cf = confirm('Bạn muốn xóa cấp bậc này');
                if(cf){
                    deleteUserLevel($(this));
                }

            });

            function deleteUserLevel(self){
                var id = self.attr('data-id');
                self.find('i').iconLoad('icon-cancel-squared');

                $.ajax({
                    type: "POST",
                    url: "{{URL::to('qtri-choidau/setting/user-level/delete')}}",
                    data: {'id':id},
                    dataType: 'json',
                    success: function (respon) {
                        $('.alert').hide();

                        if(respon){
                            $('.alert-success').find('span').html('<i class="icon-ok"></i> Xóa cấp bậc thành công!').closest('.alert-success').fadeIn();
                            self.closest('.item-row').remove();
                        }else{
                            alert('Xóa không thành công, xin vui lòng thử lại');
                            $('.alert-danger').find('span').html('<i class="icon-ok"></i> Xóa thất bại, Xin vui lòng kiểm tra lại!').closest('.alert-danger').fadeIn();

                        }
                    },
                    complete: function(){
                        self.find('i').iconUnload('icon-cancel-squared');
                    }
                });
            }


            // social update
            $('.user-level-update').on('click', function(){
                var self = $(this);
                var description = self.closest('.form-group').find('.description');
                var old_description = description.attr('data-val');
                var value = self.closest('.form-group').find('.value');
                var old_value = value.attr('data-val');
                var id = self.attr('data-id');
                if(description.val() == old_description && value.val() == old_value){
                    alert('Hãy nhập giá trị mới.');
                    return;
                }

                self.find('i').iconLoad('icon-floppy');
                $.ajax({
                    type: "POST",
                    url: "{{URL::to('qtri-choidau/setting/user-level/update')}}",
                    data: {'id':id, 'value': value.val(), 'description':description.val()},
                    dataType: 'json',
                    success: function (respon) {
                        if(respon){
                            $('.alert-success').find('span').html('<i class="icon-ok"></i> Cập nhật thành công!').closest('.alert-success').fadeIn();

                            description.attr('data-val',description.val());
                            value.attr('data-val',value.val());
                        }else{
                            $('.alert-danger').find('span').html('<i class="icon-ok"></i> Cập nhật không thành công, xin vui lòng kiểm tra lại!').closest('.alert-danger').fadeIn();

                        }
                    },
                    complete: function(){
                        self.find('i').iconUnload('icon-floppy');
                    }
                });
            });

        });
    </script>
@stop