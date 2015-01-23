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
			});

        },

		submitForm: function(){

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
					$.each(dataProvince, function(key,value){
						var selected = (value.id == 79) ? 'selected' : '';  //if selected
						html += '<option value="'+value.id+'" '+selected+'>'+value.name+'</option>';
					});
					province_tag.html(html);
				},
				complete: function(){
					self.loadDistrict();
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
						var selected = (value.id == 79) ? 'selected' : '';
						html += '<option data-lat="'+lat+'" data-lng ="'+lng+'" value="'+value.id+'" '+selected+'>'+value.type+' '+value.name+'</option>';
					});
					district_tag.html(html);
				}
			});
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
			var lng = selected_tag.attr('data-lng');
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
							var html = '<td>';
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

							// them thẻ tien ich
							utilityMenu.find('tbody').append(htmlItemUtility);
							htmlItemUtility.find('button').on('click', function(){
								var utilityName = $(this).attr('data-utilityName');
								self.deleteUtility(utilityName);
								$(this).closest('tr').hide('slow',function(){$(this).remove()});
								console.log(global_arrayUtility);
							});
							console.log(global_arrayUtility);
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
							//var foodSuggest = $('#loction-food-suggest');
							var html = '<td>'+foodName.val()+'</td>';
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

							// them thẻ mon an
							foodMenu.find('tbody').append(htmlItemFood);
							htmlItemFood.find('button').on('click', function(){
								var foodName = $(this).attr('data-foodName');
								self.deleteFood(foodName);
								$(this).closest('tr').hide('slow',function(){$(this).remove()});
								console.log(global_arrayFood);
							});
							console.log(global_arrayFood);
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
