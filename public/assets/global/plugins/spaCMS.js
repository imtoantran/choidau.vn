$(document).ready(function(){
	xhrGet_notification();

	setInterval(function(){
		xhrGet_notification();
		notification_badge.fadeOut();
		notification_badge.fadeIn();
	}, 10000);
});

var notification = $("#nav-notifications");
var notification_badge = notification.find(".notification-badge");
var no_b_confirm = notification.find(".notification-booking-confirm");
var no_a_confirm = notification.find(".notification-appointment-confirm");
var no_e_new = notification.find(".notification-evoucher-new");

var no_tt_count = notification.find(".notification-count");
var no_b_count = no_b_confirm.find(".b-count");
var no_a_count = no_a_confirm.find(".a-count");
var no_e_count = no_e_new.find(".e-count");

function xhrGet_notification() {
	var exist_no = false;
	var url = URL + "spaCMS/home/xhrGet_notification";
	$.get(url, function(data) {
		if( data["no_tt_count"] > 0 ) {
			no_tt_count.text(data["no_tt_count"]);

			if( data["no_b_count"] > 0 ) {
				no_b_count.text(data["no_b_count"]);
				no_b_confirm.show();
			} else {
				no_b_confirm.hide();
			}

			if( data["no_a_count"] > 0 ) {
				no_a_count.text(data["no_a_count"]);
				no_a_confirm.show();
			} else {
				no_a_confirm.hide();
			}

			if( data["no_e_count"] > 0 ) {
				no_e_count.text(data["no_e_count"]);
				no_e_new.show();
			} else {
				no_e_new.hide();
			}

			exist_no = true;
		}
		
	}, 'json')
	.done(function() {
		if(exist_no) {
			notification.show();
		} else {
			notification.hide();
		}
	});

	
}