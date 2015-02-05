var Location = function () {
	var location_create_frm = $('#location_create');
	var province_tag = location_create_frm.find('#location_province');
	var district_tag = location_create_frm.find('#location_district');
	var input_map = location_create_frm.find('#location_position');
	var token_tag = location_create_frm.find('#token-location');
	var foodMenu_tag = $('#location-mn-food');
	var utilityMenu_tag = $('#location-mn-utility');

	var global_food_item =''; // danh dach goi y mon an
	var global_food_type =''; // loai mon an
	var global_utility_item ='';
	var catLocation ='';
	var dataProvince ='';
	var markerLocation;
	var self;
	var map;

    return {
        //main function to initiate the module
        init: function () {
			self = this;
			jQuery(document).ready(function(){
				self.loadInitParam();
				self.loadActionTime();

				$('#location-food-add').on('click', function(){
					self.addFoodTemp();
				})

				$('#location-food-utility-add').on('click', function(){
					self.addUtilityTemp();
				})

				$('#btn-update-position').on('click', function(){
					self.loadDialogMap();
					setTimeout(function(){	self.loadGmap(); },300);
				});
				self.submitForm();
			});


        },
		submitForm: function() {
			var locationError = $('.alert-danger', location_create_frm);
			var locationSuccess = $('.alert-success', location_create_frm);
			$('.location-alert-close').click(function(){
				$(this).closest('.alert').fadeOut();
			});
			location_create_frm.validate({
				errorElement: 'span', //default input error message container
				errorClass: 'help-block help-block-error', // default input error message class
				focusInvalid: true, // do not focus the last invalid input
				ignore: "", // validate all fields including form hidden input
				rules: {
					location_name: {minlength: 4,required: true},
					location_address_detail: {minlength: 4,required: true},
					location_province: {required: true},
					location_email: {email:true},
					location_category: {required:true},
					location_price_min: {number:true, minlength: 3},
					location_price_max: {number:true, minlength: 3}
				},

				errorPlacement: function (error, element) { // render error placement for each input type
					if (element.parent(".input-group").size() > 0) {
						error.insertAfter(element.parent(".input-group"));
					} else if (element.attr("data-error-container")) {
						error.appendTo(element.attr("data-error-container"));
					} else if (element.parents('.radio-list').size() > 0) {
						error.appendTo(element.parents('.radio-list').attr("data-error-container"));
					} else if (element.parents('.radio-inline').size() > 0) {
						error.appendTo(element.parents('.radio-inline').attr("data-error-container"));
					} else if (element.parents('.checkbox-list').size() > 0) {
						error.appendTo(element.parents('.checkbox-list').attr("data-error-container"));
					} else if (element.parents('.checkbox-inline').size() > 0) {
						error.appendTo(element.parents('.checkbox-inline').attr("data-error-container"));
					} else {
						error.insertAfter(element); // for other inputs, just perform default behavior
					}
				},
				invalidHandler: function (event, validator) { //display error alert on form submit
					locationSuccess.hide();
					locationError.show();
				},
				highlight: function (element) { // hightlight error inputs
					$(element).closest('.form-group').addClass('has-error'); // set error class to the control group
				},
				unhighlight: function (element) { // revert the change done by hightlight
					$(element).closest('.form-group').removeClass('has-error'); // set error class to the control group
				},
				success: function (label) {
					label.closest('.form-group').removeClass('has-error'); // set success class to the control group
				},
				submitHandler: function (form) {
					locationSuccess.show();
					locationError.hide();
					var dataPost = {
						'location_name'			    :$('#location_name').val(),
						'location_address_detail'   :$('#location_address_detail').val(),
						'location_province'			:$('#location_province').val(),
						'location_district'			:$('#location_district').val(),
						'location_address_nearly'	:$('#location_address_nearly').val(), //gan khu vuc
						'location_detail_address' 	:$('#location_detail_address').val(),
						'location_phone' 			:$('#location_phone').val(),
						'location_email' 			:$('#location_email').val(),
						'location_website' 			:$('#location_website').val(),
						'location_description' 		:$('#location_description').val(),
						'location_position' 		:input_map.val(),
						'location_price_min' 		:$('#location_price_min').val(),
						'location_price_max' 		:$('#location_price_max').val(),
						'location_avatar'			:$('#location-img-url').attr('data-url'),
						'location_category'			:$('#location_category').val(),
						'location_album'			:self.getAlbum(),
						'location_timeAction'		:self.getTimeAction(),
						'location_food'				:self.getFoods(),
						'location_utility'			:self.getUtility()
					};

					// submit them dia diem
					$.ajax({
						url: URL+"/dia-diem/luu-dia-diem",
						type: 'post',
						data: dataPost,
						dataType: 'json',
						success: function(resInsert){
							console.log(resInsert);
							// resInsert:{result: true/false 'them dia diem thanh cong hay khong', location_id: 'id cua dia diem'}
							if(!(resInsert.result)){
								alert('Thêm địa điểm thất bại, xin vui lòng kiểm tra kết nối và thử lại!');
							}else{
								//window.location = URL+'/dia-diem/luu-dia-diem-thanh-cong/'+resInsert.location_id;
								self.loadSuccessInsert(resInsert.username, resInsert.location_id, resInsert.location_name, resInsert.slug_province, resInsert.slug_location_name);
							}
						},
						complete: function(){
						}
					});
				}
			});

		},
		//loadSuccessInsert: function(){
		loadSuccessInsert: function(username,location_id,location_name, slug_province, slug_province_name){
			var htmlBox = "";

			htmlBox += '<div class="container-fluid"><div class="col-md-12">';
				htmlBox += '<div class="portlet light bg-inverse">';
					htmlBox += '<div class="portlet-title">';
						htmlBox += '<div class="caption font-purple-plum">';
							htmlBox += '<i class="icon-place font-purple-plum"></i>';
							htmlBox += '<span class="caption-subject bold font-green"> Choidau thông báo:</span>';

						htmlBox += '</div>';
						htmlBox += '</div>';
						htmlBox += '<div class="portlet-body ">';
							htmlBox += '<p>Xin chào <label class="color-red">'+username+'</label>!</p>';
							htmlBox += '<p>Bạn vừa thêm địa điểm <label class="label label-success label-sm bold">'+location_name+'</label> thành công</p>';
							htmlBox += '<div class="margin-top-20">';
								htmlBox += '<a href="'+URL+'/dia-diem/'+slug_province+'/'+location_id+'-'+slug_province_name+'" class="btn btn-danger btn-sm">';
								htmlBox += '<i class="icon-eye color-white"></i> Đi đến địa điểm </a> ';
								htmlBox += '<a href="'+URL+'/dia-diem/tao-dia-diem" class="btn btn btn-default btn-sm">';
								htmlBox += '<i class="icon-plus" style="color: #444;"></i> Tạo địa điểm khác </a>';
							htmlBox += '</div>';
						htmlBox += '</div>';
				htmlBox += '</div>';
			htmlBox += '</div>';

			bootbox.dialog({
				message: htmlBox,
				closeButton: true
			});
			$('.bootbox button.close').hide();
			$('.modal-dialog').css({'width':'50%','margin-top':'100px'});
			$('.modal-content').css('background-color','#f7f7f0');
		},

		// duoc goi tu layout url:" public/assets/frontend/layout/script/layout.js
		loadAvatar: function(){
			var urlImg=$('#url-edit-media').attr('data-img-url');
			if(urlImg == '' || urlImg == 'undefined'){
				alert('Xin chọn hình.');
				return false;
			}
			$('#location-img-url').attr({'src':URL+'/'+urlImg,'data-url':urlImg}).removeClass('hidden').fadeIn();
			$(this).removeClass('hidden').fadeIn('fast');

			$('#location-img-btn-close').removeClass('hidden').fadeIn('fast');
			// bat su kien close cho nut bo chon avatar
			$('#location-img-btn-close').click(function(){
				$(this).addClass('hidden').fadeOut('fast');
				$('#location-img-url').fadeOut('fast').attr({'src':URL+'/assets/global/img/no-image.png','data-url':'assets/global/img/no-image.png'});
			});
		},

		// duoc goi tu layout url:" public/assets/frontend/layout/script/layout.js
		loadAlbum: function(){
			var urlImg=$('#url-edit-media').attr('data-img-url');
			var urlPostId=$('#url-edit-media').attr('data-post-img-id');

			var tag = $('.location-album-wrapper').find('button');
			var isExist = true;
			tag.each(function(){
				var post_id= $(this).attr('data-post-id');
				//var url_img= $(this).attr('data-img');
				if(post_id == urlPostId){
					alert('Hình này đã được chọn.');
					isExist = false;
				}
			});
			if(!isExist){ return false;}

			if(urlImg == '' || urlImg == 'undefined'){
				alert('Xin chọn hình.');
				return false;
			}
			var strHTML = '';
				strHTML +='<button data-post-id="'+urlPostId+'" data-img="'+urlImg+'" type="button" class="no-padding location-img-btn-close-item" title="Thôi chọn hình"><i class="icon-cancel-circled"></i></button>';
				strHTML +='<img class="img-responsive" src="'+URL+urlImg+'" alt=""/>';

			var htmlTag  = $('<div/>',{class:'col-md-3'}).append(strHTML);
				htmlTag.find('button').on('click',function(){
					$(this).closest('.col-md-3').fadeOut('slow').remove();
				});
			var tagAlbum = $('.location-album-wrapper');
				tagAlbum.append(htmlTag);
		},

		getAlbum: function(){
			var arrayAlbum=[];
			var tag = $('.location-album-wrapper').find('button');
			tag.each(function(){
				var post_id= $(this).attr('data-post-id');
				//var url_img= $(this).attr('data-img');
				arrayAlbum.push({'post_id':post_id});
			});
			return arrayAlbum;
		},

		loadActionTime: function(){
			$("input.location-time-check").uniform();
			$('.timepicker').timepicker();
			$('.location-time-check').on('click', function(){
				var thu = $(this).attr('data-thu');
				if(this.checked){//nghi
					$('.location-time-'+thu).addClass('timepicker').prop('readonly', false).prop('disabled', false);
					$('#location-time-start-t'+thu).val('6:00 AM');
					$('#location-time-end-t'+thu).val('11:00 PM');
				}else{
					$('.location-time-'+thu).removeClass('timepicker').prop('readonly', true).prop('disabled', true).val('Nghỉ');
				}
			});

		},

		getTimeAction: function(){
			var arrayTime=[];
			var thu = 2;
			$('.location-time-check').each(function(){
				var thu = $(this).attr('data-thu');
				var timeStart = $('#location-time-start-t'+thu).val();
				var timeEnd = $('#location-time-end-t'+thu).val();
				if(this.checked){
					// thoi gian bat dau | thoi gian ket thuc
					//arrayTime.push([timeStart+'|'+timeEnd]);
					arrayTime.push({'thu':thu,'time':timeStart+' - '+timeEnd});
				}else{
					arrayTime.push({'thu':thu,'time':''});
				}
				thu++;
			});
;			return arrayTime;
		},

		//load thuc don
		loadInitParam: function(){
			$.ajax({
				url: URL+"/dia-diem/loadInitParam",
				type: 'get',
				dataType: 'json',
				success: function(dbParam){
					var html='';
					global_food_item = dbParam.food;
					global_food_type = dbParam.foodType;
					global_utility_item = dbParam.utility;
					dataProvince = dbParam.province;
					catLocation = dbParam.catLocation;

					//load province
					html += '<option value="" selected >-- Chọn Tỉnh/ Thành phố --</option>';
					$.each(dataProvince, function(key,value){
						if(value.id == 79 || value.id == 01){
							html += '<option value="'+value.id+'" style="color:red!important;">'+value.name+'</option>';
						}else{
							html += '<option value="'+value.id+'">'+value.name+'</option>';
						}
					});
//					province_tag.html(html);

					// load category
					var htmlcat='';
					htmlcat += '<option value="" selected >-- Chọn danh mục --</option>';
					$.each(catLocation, function(key,value){
						htmlcat += '<option value="'+value.id+'">'+value.name+'</option>';
					});
					$('#location_category').html(htmlcat);

				},
				complete: function(){
					//if province changed is set district value
					province_tag.on('change', function(){
						self.loadDistrict();
					});
				}
			});
		},

		//load quan, huyen
		loadDistrict: function() {
			var province_id = province_tag.val();
			var token = token_tag.val();
			var html ='';
			if(province_id !=""){
				$.ajax({
					url: URL+"/dia-diem/loadDistrict",
					type: 'post',
					data: {'province_id':province_id,'_token':token},
					dataType: 'json',
					success: function(dbDistrict){
						$.each(dbDistrict, function(key,value){
							var location = value.location;
							var lat = '10.776111' ;
							var lng = '106.695833';
							if(location.length>0 && location!='undefined'){
								location = location.split(", ");
								lat = self.convertDegree(location[0]);
								lng = self.convertDegree(location[1]);
								input_map.attr('data-lat',lat);
								input_map.attr('data-lng',lng);
								input_map.val(lat+','+lng);
							}
							html += '<option data-lat="'+lat+'" data-lng ="'+lng+'" value="'+value.id+'">'+value.type+' '+value.name+'</option>';
						});
						district_tag.html(html);
					}
				});
			}else{
				district_tag.html('<option value="" data-lat="" data-lng="" selected>-- Chọn Quận/ Huyện --</option>');
			}
		},

		//load hop hoi thoai
		loadDialogMap: function(){
			var html ='<div class="input-group loacation-search-wrapper">';
				html +='<span class="input-group-btn bg-grey"><i class="icon-search"></i></span>';
				html +='<input id="location-search" type="text" placeholder=" Tìm địa điểm..." class="form-control">';
				html +='</div>';
				html +='<div id="location-gmap"></div>';
			bootbox.dialog({
				message: html,
				title: "Vị trí địa điểm",
				buttons: {
					default: {
						label: "Đóng",
						className: "btn-default"
					},
					main: {
						label: "Hoàn tất",
						className: "btn-primary",
						callback: function() {
							var position = markerLocation.getPosition();
							input_map.attr('data-lat',position.k);
							input_map.attr('data-lng',position.D);
							input_map.val(position.k+','+position.D);
						}
					}
				}
			});
		},

		//load ban do
		loadGmap: function(){
			var selected_tag = district_tag.find('option:selected');
			var val_map = input_map.val();
			var lat = "";
			var lng = "";
			if(val_map == "") {
				lat = (selected_tag.attr('data-lat') == "") ? '10.822894625766558' : lat;
				lng = (selected_tag.attr('data-lng') == "") ? '106.62956714630127' : lng;
			}else{
				lat = input_map.attr('data-lat');
				lng = input_map.attr('data-lng');
			}
			var searchBox = new google.maps.places.SearchBox(document.getElementById('location-search'));

			map = new GMaps({
				div: '#location-gmap',
				lat: lat,
				lng: lng,
				zoom: 13
			});
			markerLocation = map.createMarker({
				lat: lat,
				lng: lng,
				title: 'Chọn vị trí cho địa điểm',
				draggable: true,
				animation: google.maps.Animation.DROP
			});

			map.addMarker(markerLocation);

			google.maps.event.addListener(searchBox, 'places_changed', function(){
				var places = searchBox.getPlaces();
				var bounds = new google.maps.LatLngBounds();
					if (places == null || places.length <= 0 || typeof (places[0]) == 'undefined') {
						alert("Không tìm thấy vị trí này!");
					} else{
						var place = places[0];
						var positionPlace = place.geometry.location;
						map.removeMarkers();
						markerLocation = map.createMarker({
							lat: positionPlace.k,
							lng: positionPlace.D,
							animation: google.maps.Animation.DROP,
							title: '',
							draggable: true
						});
						map.addMarker(markerLocation);
						bounds.extend(place.geometry.location);
						map.fitBounds(bounds);
						map.setZoom(18);
					}
			});

			//handle event bounds_changed of myMap
			google.maps.event.addListener(map, 'bounds_changed', function () {
				var bounds = map.getBounds();
				searchBox.setBounds(bounds);
			});

		},

		//load box add utility
		addUtilityTemp: function(){
				var	html ='<div class="form-group clearfix">';
					html +='<label for="location-utility-name" class="col-sm-2 control-label"><strong>Tên tiện ích:</strong></label>';
					html +='<div class="col-sm-10">';
						html +='<input data-utility-suggest-id="" list="utility-datalist" name="location-utility-name" id="location-utility-name">';
						html +='<datalist name="utility-datalist" id="utility-datalist">';
						//ten goi y tien ich
							$.each(global_utility_item, function(key,val){
								html += '<option data-id="'+val.id+'" value="'+val.name+'">';
							});
						//end ten goi y mon an
						html +='</datalist>';
					html +='</div>';
				html +='</div>';
				var htmlBox  = $('<div/>',{class:'container-fluid'},{id:'location-utility-item-add'}).append(html);

				//set id suggest food cho input food name
				htmlBox.find('#location-utility-name').on('change',function(){
					var txtUtilityName = $(this);
					$.each(global_utility_item, function(key,val){
						if((txtUtilityName.val().toLowerCase().match(val.name.toLowerCase()) != null)){
							txtUtilityName.attr('data-utility-suggest-id',val.id);
						}
					});
				});
			bootbox.dialog({
				message: htmlBox,
				title: "Thêm tiện ích",
				buttons: {
					default: {
						label: "Đóng",
						className: "btn-default"
					},
					main: {
						label: "Hoàn tất",
						className: "btn-primary",
						callback: function(){
							var utilityName = $('#location-utility-name');
							var utilitySuggest = utilityName.attr('data-utility-suggest-id');
							var html = '<td> <i class="icon-right-dir"> </i>';
									html += utilityName.val();
									html += '<button data-suggest="'+utilitySuggest+'" data-utility-name="'+utilityName.val()+'" type="button" class="btn btn-default pull-right btn-xs location-utility-delete">';
									html += '<i class="icon-trash"></i>';
									html += '</button>';
								html += '</td>';
							var htmlItemUtility  = $('<tr/>',{class:'utility-item'}).append(html);

							// kiem tra neu ten tien ich ko hop le
							if(utilityName.val().length <=2){
								alert('Tên tiện ích phải dài hơn 2 kí tự');
								utilityName.focus();
								return false;
							}

							var tag = utilityMenu_tag.find('.utility-item button');
							var isCheck = true;
							tag.each(function(){
								var utilityNameItem= $(this).attr('data-utility-name');
								if($.trim(utilityName.val().toLowerCase()) == $.trim(utilityNameItem.toLowerCase())){
									alert('Tên tiện ích đã được chọn');
									utilityName.focus();
									isCheck = false;
								}
							})
							if(!isCheck){return false;}

							$('.location-utility-empty').fadeOut('fast');
							// them thẻ tien ich
							utilityMenu_tag.find('tbody').append(htmlItemUtility);
							htmlItemUtility.find('button').on('click', function(){

								$(this).closest('tr').hide('fast',function(){$(this).remove()});
								var numChild = utilityMenu_tag.find('tbody').children('tr.utility-item').length;
								if(numChild <= 1){
									$('.location-utility-empty').fadeIn('fast');
								}
							});
						}
					}
				}
			});
		},

		//load box add food
		addFoodTemp: function(){
			var	html ='<div class="form-group clearfix">';
			html +='<label for="location-food-name" class="col-sm-2 control-label"><strong>Tên món:</strong></label>';
			html +='<div class="col-sm-10">';
			html +='<input data-food-suggest-id="" list="food-datalist" name="location-food-name" id="location-food-name">';
			html +='<datalist name="food-datalist" id="food-datalist">';
			//ten goi y mon an
			$.each(global_food_item, function(key,val){
				html += '<option data-id="'+val.id+'" value="'+val.name+'">';
			});
			//end ten goi y mon an
			html +='</datalist>';
			html +='</div>';
			html +='</div>';

			html +='<div class="form-group clearfix">';
				html +='<label for="location-food-price" class="col-sm-2 control-label"><strong>Giá:</strong></label>';
				html +='<div class="col-sm-5">';
					html +='<input name="location-food-price" id="location-food-price" class="form-control">';
				html +='</div>';
				html +='<div class="col-sm-5">';
					html +='VNĐ';
				html +='</div>';
			html +='</div>';

			html +='<div class="form-group clearfix">';
			html +='<label for="location-food-typ" class="col-sm-2 control-label"><strong>Loại món:</strong></label>';
			html +='<div class="col-sm-10">';
				html +='<select name="location-food-typ" id="location-food-type" class="form-control" value="" required="required" title="">';
				//load type food
				$.each(global_food_type, function(key,val){
					html += '<option value="'+val.id+'">'+val.value+'</option>';
				});
				//end load type food
				html +='</select>';
			html +='</div>';
			html +='</div>';

				html +='<div class="form-group clearfix">';
				html +='<label for="input" class="col-sm-2 control-label"><strong>Mô tả:</strong></label>';
				html +='<div class="col-sm-10">';
				html +='<textarea name="location-food-description" id="location-food-description" rows="4" style="width: 100%!important;"></textarea>';
				html +='</div>';
			html +='</div>';

			var htmlBox  = $('<div/>',{class:'container-fluid'},{id:'location-food-item-add'}).append(html);

			//set id suggest food cho input food name
			htmlBox.find('#location-food-name').on('change',function(){
				var txtFoodName = $(this);
				$.each(global_food_item, function(key,val){
					if((txtFoodName.val().toLowerCase().match(val.name.toLowerCase()) != null)){
						txtFoodName.attr('data-food-suggest-id',val.id);
					}
				});
			});

			bootbox.dialog({
				message: htmlBox,
				title: "Thêm món ăn",
				buttons: {
					default: {
						label: "Đóng",
						className: "btn-default"
					},
					main: {
						label: "Hoàn tất",
						className: "btn-primary",
						callback: function(){
							var foodName = $('#location-food-name');
							var foodType = $('#location-food-type').find('option:selected');
							var foodSuggest = foodName.attr('data-food-suggest-id');
							var tagFoodPrice = $('#location-food-price');
							var foodPrice = tagFoodPrice.val();
							var foodDescribe = $('#location-food-description');

							// kiem tra neu ten mon an ko hop le
							if(foodName.val().length <=2){
								alert('Tên món ăn phải dài hơn 2 kí tự');
								foodName.focus();
								return false;
							}

							var tag = foodMenu_tag.find('.food-item button');
							var isCheck = true;
							tag.each(function(){
								var foodNameItem= $(this).attr('data-food-name');
								if($.trim(foodName.val().toLowerCase()) == $.trim(foodNameItem.toLowerCase())){
									alert('Tên món ăn đã có trong thực đơn');
									foodName.focus();
									isCheck = false;
								}
							})
							if(!isCheck){return false;}

							var regexSpace = /^([0-9]+)$/;
							if(foodPrice !="" && !(regexSpace.test(foodPrice))){
								alert('Giá món ăn chỉ nhập số');
								tagFoodPrice.focus();
								return false;
							}

							if(foodPrice !="" && foodPrice.length <=2){
								alert('Giá món ăn phải lớn hơn 2 số');
								tagFoodPrice.focus();
								return false;
							}
							var textFoodPrice =self.converMoney(foodPrice)+' vnđ';

							if(foodPrice ==""){
								foodPrice =0;
								textFoodPrice = "Cập nhật";
							}
							var html = '<td> <i class="icon-right-dir"> </i>'+foodName.val()+'</td>';
								html += '<td class="text-right">'+textFoodPrice+'</td>';
								html += '<td>';
									html += foodType.text();
									html += '<button data-food-suggest="'+foodSuggest+'" data-food-name="'+foodName.val()+'" data-food-price="'+foodPrice+'" data-food-type="'+foodType.val()+'" data-food-descript="'+foodDescribe.val()+'"  type="button" class="btn btn-default pull-right btn-xs location-food-delete">';
									html += '<i class="icon-trash"></i>';
									html += '</button>';
								html += '</td>';

							var htmlItemFood  = $('<tr/>',{class:'food-item'}).append(html);

							// them thong tin mon an vao mảng toan cuc
							$('.location-food-empty').fadeOut('fast');
							// them thẻ mon an
							foodMenu_tag.find('tbody').append(htmlItemFood);
							htmlItemFood.find('button').on('click', function(){
								$(this).closest('tr').hide('slow',function(){$(this).remove()});
								var numChild = foodMenu_tag.find('tbody').children('tr.food-item').length;
								if(numChild <= 1){
									$('.location-food-empty').fadeIn('fast');
								}
							});
						}
					}
				}
			});
		},

		getFoods: function(){
			var arrayFood=[];
			var tag = foodMenu_tag.find('.food-item button');
			tag.each(function(){
				var foodName= $(this).attr('data-food-name');
				var foodPrice= $(this).attr('data-food-price');
				var foodType= $(this).attr('data-food-type');
				var foodSuggest= $(this).attr('data-food-suggest');
				var foodDescript= $(this).attr('data-food-descript');
				arrayFood.push({'food_name':foodName, 'price':foodPrice, 'type_id':foodType, 'food_id':foodSuggest, 'description':foodDescript});
			});
			return arrayFood;
		},

		getUtility: function(){
			var arrayUtility=[];
			var tag = utilityMenu_tag.find('.utility-item button');
			tag.each(function(){
				var utilityName= $(this).attr('data-utility-name');
				var utilitySuggest= $(this).attr('data-suggest');
				arrayUtility.push({'utility_id':utilitySuggest,'utility_name':utilityName});
			});
			return arrayUtility;
		},

		converMoney: function(str) {
			if (str.length > 3) {
				str = str.split('');
				for (var i = str.length - 3; i > 0; i -= 3) str.splice(i, 0, ",");
				return str.join('');
			}
			return str;
		},

		//convert between degrees, minutes, seconds to Decimal coordinates
		convertDegree: function(strDegree, name){
			var arr = strDegree.split(' ');
			var degrees =parseFloat(arr[0]);
			var minutes = parseFloat(arr[1]);
			var seconds = arr[2];
				seconds = parseFloat(seconds.substr(0,seconds.length-1));
			var decimal = ((minutes * 60)+seconds)/(60*60);
			return degrees+decimal;
		}
    };
}();



