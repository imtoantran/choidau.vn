@extends('admin.layouts.main')
@section("content")
    <div class="row" style="padding: 20px; background-color: #f7f7f7; margin: 0px;">
        <div class="col-md-11 font-14px">
            <label class="grey" style="width: 120px;"><i class="icon-user"></i> Người đăng</label>:  <span class="font-blue font-weight-600">{{$contact->username}}</span>
        </div>
        <div class="col-md-1">
            <a class="pull-right btn btn-xs btn-danger contact-item-delete-1" data-id="{{$contact->id}}" data-action="delete"><i class="icon-trash"></i> Xóa</a>
        </div>
        <div class="col-md-12 font-14px">
            <label class="grey" style="width: 120px;"><i class="icon-email"></i> Email</label>:  <span class="font-red font-weight-600">{{$contact->email}}</span>
        </div>
        <div class="col-md-12 font-14px">
            <label class="grey" style="width: 120px;"><i class="icon-calendar"></i> Đăng lúc</label>: <span class="font-yellow-lemon font-weight-600">{{$contact->created_at}}</span>
        </div>
        <div class="col-md-12 font-14px margin-top-10">
            <span class="font-weight-600" style="color: #8e8e8e;"><i class="icon-bookmark"></i> {{$contact->title}}</span>
        </div>
        <div class="col-md-12 font-14px" style="color: #aaa; padding: 16px; background-color: #fff;  margin-top: 10px;">
            <i class="icon-quote-left"></i>{{$contact->content}}
        </div>

    </div>

@stop

@section("scripts")
    <script type="text/javascript">
        jQuery(document).ready(function () {
            $('.contact-item-delete-1').on('click', function(e){
                e.preventDefault();
                var self = $(this);
                var cf = confirm('Bạn muốn xóa liên hệ này?');
                if(cf){

                    self.find('i').iconLoad('icon-trash');
                    self.attr('disabled', true);
                    $.ajax({
                        url: '{{URL::to('qtri-choidau/setting/contact/delete')}}',
                        type: "post",
                        data: {id: self.attr('data-id')},
                        dataType: "json",
                        success: function (respon) {
                            if(respon){
                                window.location = '{{Url::to('qtri-choidau/setting/contact')}}';
                            }else{
                                self.find('i').iconUnload('icon-trash');
                                self.attr('disabled', false);
                                alert('Xóa thất bại, Xin vui lòng thử lại.');
                            }
                        }
                    });
                }
            });

        });

    </script>
@stop