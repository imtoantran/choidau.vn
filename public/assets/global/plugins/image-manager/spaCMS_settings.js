// le viet
$("#venue_name, #venue_type, #venue_location_1, #venue_location_2, #venue_address, #loc_map, #phone, #email, #website, #face, #google, #description").tooltip({
    placement : 'right',
    html : true,
    container : 'body'
});

$(document).ready(function(){
    
});

function get_day_vi(day_en) {
    switch(day_en) {
        case '2': return "Thứ 2";
        case '3': return "Thứ 3";
        case '4': return "Thứ 4";
        case '5': return "Thứ 5";
        case '6': return "Thứ 6";
        case '7': return "Thứ 7";
        case '8': return "Chủ nhật";
        default: return false;
    }
}



var ImageManager = function () {
    return {
        init: function() {
            $('#iM_user_logo').click(function(){
                $('#imageManager_saveChange').attr('cover_id','user_logo');
            });

            $('#iM_user_slide').click(function(){
                $('#imageManager_saveChange').attr('cover_id','user_slide');
            });

            // <!-- Save Change -->
            $('#imageManager_saveChange').on('click', function(evt) {
                evt.preventDefault();
                // Define position insert to image
                var cover_id = $(this).attr('cover_id');
                // Define selected image 
                var radio_checked = $("input:radio[name='iM-radio']:checked"); // Radio checked
                // image and thumbnail_image
                var image = radio_checked.val();
                var thumbnail = radio_checked.attr('data-image');

                // Truong hop dac biet
                if(cover_id == 'user_slide') {
                    var out = null;
                    var list_image = $('div.list_user_slide');
                    var html = '<li class="single-picture">';
                        html += '<div class="single-picture-wrapper">';
                        html += '<img id="user_slide_thumbnail" src=":img_thumbnail">';
                        html += '<input type="hidden" name="user_slide[]" value=":user_slide_val">';
                        html += '</div>';
                        html += '<div class="del_image icons-delete2"></div>';
                        html += '</li>';

                    out = html.replace(':img_thumbnail', thumbnail);
                    out = out.replace(':user_slide_val', image);

                    list_image.append(out);

                    // del image 
                    $('.del_image').on("click", function(){
                        var self = $(this).parent();
                        self.attr("disabled","disabled");
                        self.fadeOut();
                    });
                } else {
                    $('#' + cover_id + '_thumbnail').attr('src', thumbnail);
                    $('input[name=' + cover_id + ']').val(image);
                }

                // Hide Modal
                $("#imageManager_modal").modal('hide');
            });
        }
    }
}();

//hoabk
var UserDetail = function (){
    // var xhrGet_type_business = function() {
    //     var url = URL + 'spaCMS/settings/xhrGet_type_business';
    //     var options_type_business = '';
    //     // user_type_business_id
    //     var xhr = $.get(url, function(data){
    //         $.each(data, function(index, value){
    //             options_type_business += '<option value="' + value['type_business_id'] + '">' + value['type_business_name'] + '</option>';
    //         });
    //         //
    //         $('#user_type_business').html(options_type_business);
    //     }, 'json');
    //     return xhr;
    // }

    var xhrGet_district = function() {
        var url = URL + 'spaCMS/settings/xhrGet_district';
        var options_district = '';
        var xhr = $.get(url, function(data){
            $.each(data, function(index, value){
                options_district += '<option value="' + value['district_id'] + '">' + value['district_name'] + '</option>';
            });
            //
            $('#user_district_id').append(options_district);
        }, 'json');
        return xhr;
    }

    ////////////// hoabk
    var xhrGet_user_detail = function() {
        var url = URL + 'spaCMS/settings/xhrGet_user_detail';
        $.get(url, function(data){
            // get image thumbnail
            if(data[0]['user_logo'] != ""){
                var url_thumbnail = get_thumbnail(data[0]['user_logo'], user_id);
            }

            $('#user_logo_thumbnail').attr('src', url_thumbnail);
            $('input[name=user_logo]').val(data[0]['user_logo']);
            $('input[name=user_business_name]').val(data[0]['user_business_name']);
            $('textarea[name=user_address]').val(data[0]['user_address']);
            $('input[name=user_phone]').val(data[0]['user_phone']);
            $('input[name=user_facebook]').val(data[0]['user_facebook']);
            $('input[name=user_website]').val(data[0]['user_website']);
            $('input[name=user_googleplus]').val(data[0]['user_googleplus']);
            $('input[name=user_email]').val(data[0]['user_email']);
            $('textarea[name=user_description]').val(data[0]['user_description']);
            $('input[name=user_type_business]').val(data[0]['user_type_business']);
            // hoabk config select tyle business -> input
            // $('select[name=user_country_id]').val(data[0]['user_country_id']);
            xhrGet_district().done(function(){
                $('select[name=user_district_id]').find('option[value="'+data[0]['user_district_id']+'"]').prop("selected", true);
            });
            // xhrGet_type_business().done(function() {
            //     // $('select[name=user_type_business_id]').find('option[value="'+data[0]['user_type_business']+'"]').prop("selected",true);
            // });
            
        }, 'json');
    }

    // hoabk
    var xhrUpdate_user_detail = function() {
        $('#user_detail_form').on('submit', function(){
            var data = $(this).serialize();
            
            var isSuccess = false;
            var loading = $(this).find('.loading');
            var done = $(this).find('.done');
            loading.fadeIn();
            done.hide();
            var url = URL + 'spaCMS/settings/xhrUpdate_user_detail';

            $.post(url, data, function(result) {
                if(result["success"] == true) {
                    isSuccess = true;
                }
            }, 'json')
            .done(function() {
                loading.hide();
                done.show();

                if(isSuccess) {
                    alert("Cập nhật thành công!");
                } else {
                    alert("Update user detail error!");
                }
            });
            return false;
        });
    }

    var xhrGet_user_is_use_voucher = function () {
        var url = URL + 'spaCMS/settings/xhrGet_user_is_use_voucher';
        $.get(url, function(data){
            if(data){
                $('input[name=user_is_use_voucher]').attr('checked', true);
            } else {
                $('input[name=user_is_use_voucher]').attr('checked', false);
            }
            
        }, 'json');
    }

    var xhrUpdate_user_is_use_voucher = function () {
        $('#user_is_use_voucher_form').on('submit', function(){
            var data = $(this).serialize();
            var loading = $(this).find('.loading');
            var done = $(this).find('.done');
            loading.fadeIn();
            done.hide();
            var url = URL + 'spaCMS/settings/xhrUpdate_user_is_use_voucher';
            $.post(url, data, function(result) {
                loading.fadeOut();
                done.fadeIn();
            }, 'json');
            return false;
        });
    }

    var xhrGet_user_slide = function () {
        var url = URL + 'spaCMS/settings/xhrGet_user_slide';
        
        var html = '<li class="single-picture">';
            html += '<div class="single-picture-wrapper">';
            html += '<img id="user_slide_thumbnail" src=":img_thumbnail">';
            html += '<input type="hidden" name="user_slide[]" value=":user_slide_val">';
            html += '</div>';
            html += '<div class="del_image icons-delete2"></div>';
            html += '</li>';

        var images = null;
        var out = null;
        var list_image = $('div.list_user_slide');
        
        $.get(url, function(data){
            if(typeof data !== 'undefined'){
                images = data[0]['user_slide'].split(",");
                // console.log(images[0]);
                for(var i=0; i<images.length; i++) {
                    var url_thumbnail = get_thumbnail(images[i], user_id);
                    out = html.replace(':img_thumbnail', url_thumbnail);
                    out = out.replace(':user_slide_val', images[i]);
                    list_image.append(out);
                }
            }

            // del image 
            $('.del_image').on("click", function(){
                var self = $(this).parent();
                self.fadeOut();
                self.html('');
            });
        }, 'json');
    }

    //////// USER MAP //////////////
    var loc_map = $("#loc_map");
    var xhrGet_user_map = function() {
        var input_ulat = $('input[name=user_lat]', loc_map);
        var input_ulong = $('input[name=user_long]', loc_map);
        var staticmap_img = $("#staticmap_img");

        var url = URL + "spaCMS/settings/xhrGet_user_map";
        var staticmap_src = "https://maps.googleapis.com/maps/api/staticmap?sensor=false&zoom=15&size=397x208&maptype=roadmap&markers=icon:"+URL+"public/assets/img/map-marker.png%7C:user_lat%2C:user_long";
        $.get(url, function(data) {
            staticmap_src = staticmap_src.replace(":user_lat", data["user_lat"]);
            staticmap_src = staticmap_src.replace(":user_long", data["user_long"]);
            staticmap_img.attr("src", staticmap_src);

            input_ulat.val(data["user_lat"]);
            input_ulong.val(data["user_long"]);
        }, "json");
    }

    var vdm_modal = $("#venueDetailsMap_modal");
    var xhrGetOM_edit_user_map = function() {
        // Get du lieu truoc khi Open Modal
        var btnOM_eum = $("#btnOM_editUserMap");
        //
        var input_ulat = $('input[name=user_lat]', vdm_modal);
        var input_ulong = $('input[name=user_long]', vdm_modal);

        ///////// MAP GOOGLE /////
        google.maps.event.addDomListener(window, 'load', function() {
            btnOM_eum.on("click", function(){
                vdm_modal.modal("show");

                var LAT = $('input[name=user_lat]', loc_map).val();
                var LNG = $('input[name=user_long]', loc_map).val();
                input_ulat.val(LAT);
                input_ulong.val(LNG);

                var user_position = new google.maps.LatLng(LAT, LNG);

                var marker;
                var map;

                var mapOptions = {
                    zoom: 15,
                    center: user_position
                };

                map = new google.maps.Map(document.getElementById('venue-details-map-container'), mapOptions);

                marker = new google.maps.Marker({
                    map: map,
                    draggable: true,
                    animation: google.maps.Animation.DROP,
                    position: user_position,
                    icon: URL + "public/assets/img/map-marker.png"
                });

                google.maps.event.addListener(marker, 'dragend', function (event) {
                    input_ulat.val( this.getPosition().lat() );
                    input_ulong.val( this.getPosition().lng() );
                });
            
                return false;
            });

        });

    }

    var xhrUpdate_user_map = function() {
        eUM_form = $("#editUserMap_form");
        eUM_form.on("submit", function(){
            var self = $(this);
            var data = self.serialize();

            var isSuccess = false;
            var done = self.find('.done');
            var loading = self.find('.loading');

            done.hide();
            loading.fadeIn();

            var url = URL + "spaCMS/settings/xhrUpdate_user_map";
            $.post(url, data, function(result){
                if(result == 'success') {
                    xhrGet_user_map();
                    isSuccess = true;
                }
            })
            .done(function(){
                done.show();
                loading.hide();

                if(isSuccess) {
                    vdm_modal.modal("hide");
                } else {
                    alert("Update location error! ");
                }
            });

            return false;
        }); 
    }

    return {
        init: function(){
            xhrGet_user_detail();
            xhrUpdate_user_detail();
            xhrGet_user_is_use_voucher();
            xhrUpdate_user_is_use_voucher();
            xhrGet_user_slide();
            xhrGet_user_map();
            xhrGetOM_edit_user_map();
            xhrUpdate_user_map();
        }
    }
}();

var UserOpenHour = function (){
    var xhrGet_user_open_hour = function() {
        var url = URL + 'spaCMS/settings/xhrGet_user_open_hour';
        $.get(url, function(data){
            var status = null;
            var checked = null;
            var disabled = null;
            var selected = null;
            var open_hour = null;
            var close_hour = null;
            var option_open_hour = '';
            var option_close_hour = '';
            // $('input[name=user_open_hour_old').val(data);

            var out_html = '<li class=":status">';
                out_html += '<div>';
                out_html += '<input class="user_open_hour_checked" type="checkbox" :checked id=":day">';
                out_html += '<label for=":day">:vi_day</label>';
                out_html += '<select :disabled name="user_open_hour_from[:day]">';
                out_html += ':option_open_hour';
                out_html += '</select> - ';
                out_html += '<select :disabled name="user_open_hour_to[:day]">';
                out_html += ':option_close_hour';
                out_html += '</select>';
                out_html += '</div>';
                out_html += '</li>';

            var weekly = $('#opening-hours ul.week');
            $.each(data, function(day, hour){
                var vi_day = get_day_vi(day);
                var open_hour = hour[1];
                var close_hour = hour[2];
                option_open_hour = '';
                option_close_hour = '';

                if(hour[0] == 0) {
                    status  = 'off';
                    checked = '';
                    disabled = 'disabled="disabled"';
                } else {
                    status  = 'on';
                    checked = 'checked="checked"';
                    disabled = '';
                }

                var out = out_html.replace(':status', status);
                    out = out.replace(/:checked/g, checked);
                    out = out.replace(/:disabled/g, disabled);
                    out = out.replace(/:day/g, day);
                    out = out.replace(/:vi_day/g, vi_day);

                    for (var i = 0; i < 24; i++) {
                        if(i == open_hour) {
                            selected = 'selected="selected"';
                        } else {
                            selected = null;
                        }

                        if(i<10) {
                            option_open_hour += '<option '+selected+' value="'+i+'">0'+i+':00</option>';
                        }
                        if(i>10) {
                            option_open_hour += '<option '+selected+' value="'+i+'">'+i+':00</option>';
                        }
                    }

                    for (var i = 0; i < 24; i++) {
                        if(i == close_hour) {
                            selected = 'selected="selected"';
                        } else {
                            selected = null;
                        }

                        if(i<10) {
                            option_close_hour += '<option '+selected+' value="'+i+'">0'+i+':00</option>';
                        }
                        if(i>10) {
                            option_close_hour += '<option '+selected+' value="'+i+'">'+i+':00</option>';
                        }
                    }
                    out = out.replace(':option_open_hour', option_open_hour);
                    out = out.replace(':option_close_hour', option_close_hour);

                weekly.append(out);
            });

            $('.user_open_hour_checked').change(function() {
                if ($(this).is(':checked')) {
                    var li = $(this).parent().parent();
                    li.removeClass('off');
                    li.addClass('on');
                    li.find('select').removeAttr('disabled');
                }
                else {
                    var li = $(this).parent().parent();
                    li.removeClass('on');
                    li.addClass('off');
                    li.find('select').attr('disabled','disabled');
                }
            });
        }, 'json');
    }

    var xhrUpdate_user_open_hour = function() {
       $('#user_open_hour_form').on('submit', function(){
            var data = $(this).serialize();
            var loading = $(this).find('.loading');
            var done = $(this).find('.done');
            loading.fadeIn();
            done.hide();
            var url = URL + 'spaCMS/settings/xhrUpdate_user_open_hour';

            $.post(url, data, function(result) {
                // console.log(result);
                loading.fadeOut();
                done.fadeIn();
            }, 'json');
            return false;
        });
    }

    return {
        init: function(){
            xhrGet_user_open_hour();
            xhrUpdate_user_open_hour();
        }
    }
}();

var UserFinance = function (){
    var xhrGet_country = function() {
        var url = URL + 'spaCMS/settings/xhrGet_country';
        var options_country = '';
        var xhr = $.get(url, function(data){
            $.each(data, function(index, value){
                options_country += '<option value="' + value['country_id'] + '">' + value['country_name'] + '</option>';
            });
            //
            $('#user_country_id').html(options_country);
            $('#user_company_country_id').html(options_country);
        }, 'json');
        return xhr;
    }

    var xhrGet_user_company = function () {
        var url = URL + 'spaCMS/settings/xhrGet_user_company';
        $.get(url, function(data){
            if(data.length > 0) {
                $('input[name=user_company_name]').val(data[0]['user_company_name']);
                $('input[name=user_company_delegate]').val(data[0]['user_company_delegate']);
                $('textarea[name=user_company_address]').val(data[0]['user_company_address']);
                $('input[name=user_company_tax_code]').val(data[0]['user_company_tax_code']);
                xhrGet_country().done(function(){
                    $('select[name=user_company_country_id]').find('option[value="'+data[0]['user_company_country_id']+'"]').prop("selected", true);
                });
                $('input[name=user_contact_name]').val(data[0]['user_contact_name']);
                $('input[name=user_contact_email]').val(data[0]['user_contact_email']);
                $('input[name=user_contact_phone]').val(data[0]['user_contact_phone']);
                $('input[name=user_contact_role]').val(data[0]['user_contact_role']);
            }
        }, 'json');
    }

    var xhrUpdate_user_company = function () {
        $('#user_company_form').on('submit', function(){
            var data = $(this).serialize();
            var isSuccess = false;
            var loading = $(this).find('.loading');
            var done = $(this).find('.done');
            loading.fadeIn();
            done.hide();
            // console.log(data);
            var url = URL + 'spaCMS/settings/xhrUpdate_user_company';
            $.get(url, data, function(result) {
                if(result == 'success') {
                    isSuccess = true;
                }
                
            })
            .done(function() {
                loading.hide();
                done.show();
                if(isSuccess) {
                    alert('Cập nhật thành công!');
                } else {
                    alert('Update finance error!');
                }
            });
            return false;
        });
    }

    var xhrGet_user_bank_acc = function () {
        var url = URL + 'spaCMS/settings/xhrGet_user_bank_acc';
        $.get(url, function(data){
            $('input[name=user_bank_acc_owner]').val(data[0]['user_bank_acc_owner']);
            $('input[name=user_bank_acc]').val(data[0]['user_bank_acc']);
            $('textarea[name=user_bank_address]').val(data[0]['user_bank_address']);
            $('input[name=user_bank_branch]').val(data[0]['user_bank_branch']);
            $('input[name=user_bank_name]').val(data[0]['user_bank_name']);
        }, 'json');
    }

    var xhrUpdate_user_bank_acc = function () {
        $('#user_bank_acc_form').on('submit', function(){
            var data = $(this).serialize();
            var loading = $(this).find('.loading');
            var done = $(this).find('.done');
            loading.fadeIn();
            done.hide();
            // console.log(data);
            var url = URL + 'spaCMS/settings/xhrUpdate_user_bank_acc';
            $.get(url, data, function(result) {
                loading.fadeOut();
                done.fadeIn();
            }, 'json');
            return false;
        });
    }

    return {
        init: function(){
            xhrGet_user_company();
            xhrUpdate_user_company();
            xhrGet_user_bank_acc();
            xhrUpdate_user_bank_acc();
        }
    }
}();

var UserNotification = function() {
    var un_form = $('#user_notification_form');
    var input_une = $('input[name=user_notification_email]', un_form);

    var xhrGet_user_notification_email = function() {
        var url = URL + "spaCMS/settings/xhrGet_user_notification_email";
        $.get(url, function(data){
            input_une.val(data[0]['user_notification_email']);
        }, 'json')
        .done(function(){
            // input_une.fadeIn();
        });
    }

    var xhrUpdate_user_notification = function() {
        un_form.on('submit', function(e){
            e.preventDefault();
            var self = $(this);
            var data = input_une.val();
            // var data = $(this).serialize();
            var isSuccess = false;
            var loading = self.find('.loading');
            var done = self.find('.done');
            loading.fadeIn();
            done.hide();

            // console.log(data);
            var url = URL + 'spaCMS/settings/xhrUpdate_user_notification';
            $.post(url, {'user_notification_email':data}, function(result) {
                if(result == 'success') {
                    isSuccess = true;
                }
            })
            .done(function(){
                loading.hide();
                done.show();
                if(isSuccess) {
                    alert("Cập nhật thành công!");
                } else {
                    alert("Update Email notification error!");
                }
            });

        });
    }

    return {
        init: function() {
            xhrGet_user_notification_email();
            // Update email
            xhrUpdate_user_notification();
        }
    }
}();

var OnlineBooking = function() {
    var editOBs_form = $('#editOBs_form');
    var xhrUpdate_online_booking = function() {
        editOBs_form.on("submit", function(e) {
            e.preventDefault();
            var self = $(this);
            var data = self.serialize();

            var isSuccess = false;
            var loading = self.find('.loading');
            var done = self.find('.done');
            loading.fadeIn();
            done.hide();

            var url = URL + 'spaCMS/settings/xhrUpdate_online_booking';
            $.post(url, data, function(result) {
                if(result == 'success') {
                    isSuccess = true;
                }
            })
            .done(function(){
                loading.hide();
                done.show();
                if(isSuccess) {
                    alert("Cập nhật thành công!");
                } else {
                    alert("Update Online Booking error!");
                }
            });

            return false;
        });
    }

    var xhrGet_user_is_use_gvoucher = function() {
        var ckbox_uiugv = $('input[name=user_is_use_gvoucher]', editOBs_form);
        
        var url = URL + 'spaCMS/settings/xhrGet_user_is_use_gvoucher';
        $.get(url, function(data){
            if(data['user_is_use_gvoucher'] == 1) {
                ckbox_uiugv.prop( "checked", true );
            } else {
                ckbox_uiugv.prop( "checked", false );
            }
        }, 'json');
    }

    var xhrGet_user_is_use_evoucher = function() {
        var ckbox_uiuev = $('input[name=user_is_use_evoucher]', editOBs_form);
        
        var url = URL + 'spaCMS/settings/xhrGet_user_is_use_evoucher';
        $.get(url, function(data){
            if(data['user_is_use_evoucher'] == 1) {
                ckbox_uiuev.prop( "checked", true );
            } else {
                ckbox_uiuev.prop( "checked", false );
            }
        }, 'json');
    }

    var xhrGet_user_is_use_appointment = function() {
        var ckbox_uiua = $('input[name=user_is_use_appointment]', editOBs_form);
        
        var url = URL + 'spaCMS/settings/xhrGet_user_is_use_appointment';
        $.get(url, function(data){
            if(data['user_is_use_appointment'] == 1) {
                ckbox_uiua.prop( "checked", true );
            } else {
                ckbox_uiua.prop( "checked", false );
            }
        }, 'json');
    }

    var xhrGet_user_limit_before_booking = function() {
        var input_ulbb = $('input[name=user_limit_before_booking]', editOBs_form);
        var select_ulbs = $('select[name=user_limit_before_service]', editOBs_form);
        
        var url = URL + 'spaCMS/settings/xhrGet_user_limit_before_booking';
        $.get(url, function(data){
            input_ulbb.val(data['user_limit_before_booking']);
            select_ulbs.find('option[value="'+data['user_limit_before_service']+'"]').prop("selected",true);
        }, 'json');
    }

    return {
        init: function(){
            xhrGet_user_is_use_gvoucher();
            xhrGet_user_is_use_evoucher();
            xhrGet_user_is_use_appointment();
            xhrGet_user_limit_before_booking();

            xhrUpdate_online_booking();
        }
    }
}();

var Sercurity = function (){
    var sp_form = $("#security_password_form");
    var xhrUpdate_user_password = function() {
        sp_form.on("submit", function(e){
            e.preventDefault();
            var self = $(this);
            var input_up = $('input[name=user_password]').val();
            var input_up_new = $('input[name=user_password_new]').val();
            var input_up_newc = $('input[name=user_password_new_confirm]').val();

            var isNotMatch = false;
            var isSuccess = false;
            var loading = self.find('.loading');
            var done = self.find('.done');
            var warning_notmatch = $('.warning_notmatch');
            var warning_error = $('.warning_error');

            warning_notmatch.hide();
            warning_error.hide();
            loading.fadeIn();
            done.hide();

            if(input_up_new == input_up_newc) {
                var url = URL + 'spaCMS/settings/xhrUpdate_user_password';
                $.post(url, {'user_password':input_up, 'user_password_new':input_up_new}, function(result){
                    if(result == 'password_error') {
                        isNotMatch = true;
                        return false;
                    }

                    if(result == 'success') {
                        isSuccess = true;
                    }
                })
                .done(function(){
                    if(isSuccess) {
                        sp_form[0].reset();
                        alert("Cập nhật thành công!");
                    } 
                    else if(isNotMatch) {
                        warning_error.fadeIn();
                    }
                    else {
                        alert("Update Password error!");
                    }
                });
            } else {
                warning_notmatch.fadeIn();
            }

            loading.hide();
            done.show();
        });
        
        
    }

    return {
        init: function(){
            xhrUpdate_user_password();
        }
    }
}();

//UserDetail.init();
//UserOpenHour.init();
//UserFinance.init();
//UserNotification.init();
//OnlineBooking.init();
//Sercurity.init();

ImageManager.init();