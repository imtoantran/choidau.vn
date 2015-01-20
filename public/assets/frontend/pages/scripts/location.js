var Location = function () {
	var createLocation_frm = $('#location_create');
	var province_tag = $('#location_province');
	var district_tag = $('#location_district');
	var token_tag = createLocation_frm.find('#token-location');
	var self;
    return {
        //main function to initiate the module
        init: function () {
			self = this;
			jQuery(document).ready(function(){
				self.loadProvince();

			});
        },
		loadProvince: function() {
			var html ='';
			$.ajax({
				url: URL+"/location/loadProvince",
				type: 'get',
				dataType: 'json',
				success: function(dbProvince){
					$.each(dbProvince, function(key,value){
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
						//console.log(value.id);
						var selected = (value.id == 79) ? 'selected' : '';
						html += '<option value="'+value.id+'" '+selected+'>'+value.type+' '+value.name+'</option>';
					});
					district_tag.html(html);
				}
			});
		}
    };
}();
jQuery(document).ready(function(){
	Location.init();
});
