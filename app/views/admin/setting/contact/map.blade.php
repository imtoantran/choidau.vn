@extends('admin.layouts.main')
@section("content")
    <div class="row" style="padding: 20px; background-color: #f7f7f7; margin: 0px;">
        <div class="col-md-12">
            <div class="row">
                <div class="col-md-8">
                    <div class="input-group">
                        <span class="input-group-addon">
                            <i class="icon-search"></i>
                        </span>
                        <input id="location-search" type="text" placeholder=" Tìm địa điểm..." class="form-control">
                    </div>
                    <div class="clearfix" style="border:1px solid #e6e6e6; padding:2px; margin-top:10px;" >
                        <div data-lat="{{$web_map[0]}}" data-long="{{$web_map[1]}}" id="gmail-contact" class="col-xs-12 col-sm-12 col-md-12 col-lg-12 margin-none"  style="height: 320px;"></div>
                    </div>
                </div>
                <div class="col-md-3">
                    <button id="contact-getmap" class="btn btn-sm btn-success">
                        Cập nhật
                    </button>
                </div>
            </div>
        </div>
    </div>
@stop

@section("scripts")
    <script src="http://maps.googleapis.com/maps/api/js?sensor=true&amp;libraries=places"></script>
    <script src="{{asset('assets/admin/pages/scripts/maps-google.js')}}"></script>
    <script src="{{asset('assets/global/plugins/gmaps/gmaps.min.js')}}"></script>

    <script type="text/javascript">
        jQuery(document).ready(function () {
            var markerContact ='';


            // load map
            var position_lat = $('#gmail-contact').attr('data-lat')
            var position_lng = $('#gmail-contact').attr('data-long')
            var map = new GMaps({
                div: '#gmail-contact',
                lat: position_lat,
                lng: position_lng,
                zoom: 12
            });
            markerContact = map.createMarker({
                lat: position_lat,
                lng: position_lng,
                title: 'Chọn vị trí cho địa điểm',
                draggable: true,
                animation: google.maps.Animation.DROP
            });
            map.addMarker(markerContact);


           // action search box
            var searchBox = new google.maps.places.SearchBox(document.getElementById('location-search'));
            google.maps.event.addListener(searchBox, 'places_changed', function(){
                var places = searchBox.getPlaces();
                var bounds = new google.maps.LatLngBounds();
                if (places == null || places.length <= 0 || typeof (places[0]) == 'undefined') {
                    alert("Không tìm thấy vị trí này!");
                } else{
                    var place = places[0];
                    var positionPlace = place.geometry.location;
                    map.removeMarkers();
                    markerContact = map.createMarker({
                        lat: positionPlace.k,
                        lng: positionPlace.D,
                        animation: google.maps.Animation.DROP,
                        title: '',
                        draggable: true
                    });
                    map.addMarker(markerContact);
                    bounds.extend(place.geometry.location);
                    map.fitBounds(bounds);
                    map.setZoom(12);
                }
            });
            	//handle event bounds_changed of myMap
            google.maps.event.addListener(map, 'bounds_changed', function () {
                var bounds = map.getBounds();
                searchBox.setBounds(bounds);
            });

            $('#contact-getmap').on('click', function(){
                var position = markerContact.getPosition();
//                console.log(position.k+','+position.D);
                var map_position = position.k+','+position.D;
                $.blockUI({message: '<div class="block-ui"><i class="icon-spin2 animate-spin"></i> Đang cập nhật vị trí </div>'});
                $.ajax({
                    url: '{{URL::to('qtri-choidau/setting/contact/map/update')}}',
                    type: "post",
                    data: {map_position: map_position},
                    dataType: "json",
                    success: function (respon) {
                        if(respon){
                        }else{
                            alert('Cập nhật thất bại, Xin vui lòng thử lại.');
                        }
                    }
                    ,complete: function(){
                        $.unblockUI();
                    }
                });
            });
        });
     </script>
@stop