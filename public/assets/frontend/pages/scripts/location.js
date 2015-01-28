var Location = function () {
	var createLocation_frm = $('#location_create');
	var province_tag = $('#location_province');
	var district_tag = $('#location_district');
	var token_tag = createLocation_frm.find('#token-location');
	var global_food_item ='';
	var global_food_type ='';
	var global_utility_item ='';
	var global_arrayFood =[];//name,description,type_id  global_arrayFood.push({"id":"1",'ten':'hoa'});
	var global_arrayUtility =[];//name,description,type_id  global_arrayFood.push({"id":"1",'ten':'hoa'});
	var global_arrayAlbum =[1,2,3,4];
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
				self.loadAvatar();

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

				//submit add location;
				createLocation_frm.submit(function(e){
					e.preventDefault();
					self.submitForm();
				})
				self.submitForm();
			});


        },

		submitForm: function() {
			var locationError = $('.alert-danger', createLocation_frm);
			var locationSuccess = $('.alert-success', createLocation_frm);
			createLocation_frm.validate({
				errorElement: 'span', //default input error message container
				errorClass: 'help-block help-block-error', // default input error message class
				focusInvalid: true, // do not focus the last invalid input
				ignore: "", // validate all fields including form hidden input
				rules: {
					//location_title: {minlength: 4,required: true},
					//location_address: {minlength: 4,required: true},
					//location_province: {required: true},
					//location_email: {email:true}
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
					//Metronic.scrollTo(locationError, -200);
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
					//var dataForm = [];
					//var locationTitle = $('#location_title').val();
					//var locationAddress = $('#location_address').val();
					//var locationProvince = province_tag.val();
					//var locationDistrict = district_tag.val();
					//var locationArea = $('#location_area').val();
					//var locationDetailAddress = $('#location_detail-address').val();
					//var locationPhone = $('#location_phone').val();
					//var locationEmail = $('#location_email').val();
					//var locationWebsite = $('#location_website').val();
                    //
					//var locationAlbum = global_arrayAlbum;
					//var locationPosition = $('#location-position').val();
					//var locationPriceMin = $('#location-price-min').val();
					//var locationPriceMax = $('#location-price-max').val();
                    //
					//var locationTimeAction = self.getTimeAction();
					//var locationFoodArray = global_arrayFood;
					//var locationUtilityArray = global_arrayUtility;

					var locationAvatar = $('#location-img-url').attr('data-url');

					var dataForm = createLocation_frm.serialize();
					dataForm += '&location_avatar='+locationAvatar;
					dataForm += '&location_album='+global_arrayAlbum;
					dataForm += '&location_timeAction='+self.getTimeAction();
					dataForm += '&location_food='+global_arrayFood;
					dataForm += '&location_utility='+global_arrayUtility;
					console.log(dataForm);

					$.ajax({
						url: URL+"/location/luu-dia-diem",
						type: 'post',
						data: dataForm,
						dataType: 'json',
						success: function(resInsert){
							alert(resInsert);
						},
						complete: function(){

						}
					});
				}
			});

		},
		loadAvatar: function(){

			$('#location-upload-img-save').click(function(){
				var urlImg=$('#url-edit-media').attr('data-img-url');

				if(urlImg == "" || urlImg == 'undefined'){
					alert('Xin vui lòng chọn hình.');
					return false;
				}else{
					$('#location-img-url').attr({'src':URL+'/'+urlImg,'data-url':urlImg}).removeClass('hidden').fadeIn();
					$(this).removeClass('hidden').fadeIn('fast');
					$('#location-img-btn-close').removeClass('hidden').fadeIn('fast');
				}
			});

			$('#location-img-btn-close').click(function(){

				$(this).addClass('hidden').fadeOut('fast');
				$('#location-img-url').fadeOut('fast').attr({'src':URL+'/assets/global/img/no-image.png','data-url':'assets/global/img/no-image.png'});
			});

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
			$('.location-time-check').each(function(){
				var thu = $(this).attr('data-thu');
				var timeStart = $('#location-time-start-t'+thu).val();
				var timeEnd = $('#location-time-end-t'+thu).val();
				if(this.checked){
					// thoi gian bat dau | thoi gian ket thuc
					arrayTime.push([timeStart+'|'+timeEnd]);
				}else{
					arrayTime.push(['']);
				}
			});
;			return arrayTime;
		},
		//load thuc don
		loadInitParam: function(){
			$.ajax({
				url: URL+"/location/loadInitParam",
				type: 'get',
				dataType: 'json',
				success: function(dbParam){
					var html='';
					global_food_item = dbParam.food;
					global_food_type = dbParam.foodType;
					global_utility_item = dbParam.utility;
					dataProvince = dbParam.province;

					//load province
					html += '<option value="" selected >-- Chọn Tỉnh/ Thành phố --</option>';
					$.each(dataProvince, function(key,value){
						if(value.id == 79 || value.id == 01){
							html += '<option value="'+value.id+'" style="color:red!important;">'+value.name+'</option>';
						}else{
							html += '<option value="'+value.id+'">'+value.name+'</option>';
						}
					});
					province_tag.html(html);
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
					url: URL+"/location/loadDistrict",
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
							createLocation_frm.find('#location-position').val(markerLocation.getPosition());
						}
					}
				}
			});
		},

		//load ban do
		loadGmap: function(){
			var selected_tag = district_tag.find('option:selected');
			var lat = selected_tag.attr('data-lat');
				lat = (lat == "")? '10.822894625766558': lat;
			var lng = selected_tag.attr('data-lng');
				lng = (lng == "")? '106.62956714630127': lng;

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
						if((txtUtilityName.val().match(val.name) != null)){
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
							var utilityMenu = $('#location-mn-utility');
							var html = '<td> <i class="icon-right-dir"> </i>';
									html += utilityName.val();
									html += '<button data-utilityName="'+utilityName.val()+'" type="button" class="btn btn-default pull-right btn-xs location-utility-delete">';
									html += '<i class="icon-trash"></i>';
									html += '</button>';
								html += '</td>';
							var htmlItemUtility  = $('<tr/>').append(html);

							// kiem tra neu ten tien ich ko hop le
							if(utilityName.val().length <=2){
								alert('Tên tiện ích phải dài hơn 2 kí tự');
								utilityName.focus();
								return false;
							}

							// them thong tin mon an vao mảng toan cuc
							global_arrayUtility.push({'utilityName':utilityName.val(),'utilitySuggestId':utilityName.attr('data-utility-suggest-id')});
							$('.location-utility-empty').fadeOut('fast');
							// them thẻ tien ich
							utilityMenu.find('tbody').append(htmlItemUtility);
							htmlItemUtility.find('button').on('click', function(){
								var utilityName = $(this).attr('data-utilityName');
								self.deleteUtility(utilityName);
								$(this).closest('tr').hide('slow',function(){$(this).remove()});
								if(global_arrayUtility.length<=0){	$('.location-utility-empty').fadeIn('fast');}

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
			html +='<label for="input" class="col-sm-2 control-label"><strong>Loại món:</strong></label>';
			html +='<div class="col-sm-10">';
			html +='<select name="" id="location-food-type" class="form-control" value="" required="required" title="">';
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
					if((txtFoodName.val().match(val.name) != null)){
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
							var foodDescribe = $('#location-food-description');
							var foodMenu = $('#location-mn-food');
							var html = '<td> <i class="icon-right-dir"> </i>'+foodName.val()+'</td>';
								html += '<td>';
									html += foodType.text();
									html += '<button data-foodName="'+foodName.val()+'" type="button" class="btn btn-default pull-right btn-xs location-food-delete">';
									html += '<i class="icon-trash"></i>';
									html += '</button>';
								html += '</td>';

							var htmlItemFood  = $('<tr/>').append(html);


							// kiem tra neu ten mon an ko hop le
							if(foodName.val().length <=2){
								alert('Tên món ăn phải dài hơn 2 kí tự');
								foodName.focus();
								return false;
							}

							// them thong tin mon an vao mảng toan cuc
							global_arrayFood.push({'foodName':foodName.val(), 'foodType':foodType.val(), 'foodDescribe':foodDescribe.val(), 'foodSuggestId':foodName.attr('data-food-suggest-id')});
							$('.location-food-empty').fadeOut('fast');
							// them thẻ mon an
							foodMenu.find('tbody').append(htmlItemFood);
							htmlItemFood.find('button').on('click', function(){
								var foodName = $(this).attr('data-foodName');
								self.deleteFood(foodName);
								$(this).closest('tr').hide('slow',function(){$(this).remove()});
								if(global_arrayFood.length<=0){	$('.location-food-empty').fadeIn('fast');}
							});
						}
					}
				}
			});
		},

		deleteFood: function(foodName){
			global_arrayFood.forEach(function(object,id){
				if(object.foodName == foodName){
					global_arrayFood.splice(id,1);
				}
			});
		},

		deleteUtility: function(utilityName){
			global_arrayUtility.forEach(function(object,id){
				if(object.utilityName == utilityName){
					global_arrayUtility.splice(id,1);
				}
			});
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

jQuery(document).ready(function(){
	Location.init();
});


