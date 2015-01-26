<?php

class LocationController extends BaseController {

    /**
     * Location Model
     * @var Location
     */
    protected $location;

    public function __construct()
    {
        parent::__construct();
//        $this->location = $user;
    }


    /**
     * Displays the form for user creation
     *
     */
    public function getCreate()
    {

        $arrayJS = array(
            'assets/frontend/pages/scripts/location.js',
            'assets/global/plugins/bootbox/bootbox.min.js',
            'http://maps.googleapis.com/maps/api/js?sensor=true&libraries=places',
            'assets/global/plugins/gmaps/gmaps.min.js',
            'assets/global/plugins/select2/select2.min.js',
            'assets/admin/pages/scripts/maps-google.js',
        );
        $arrayStyle = array(
            'assets/global/plugins/select2/select2.css',
            'assets/frontend/pages/css/location.css'
        );
        $js_page = $this->JScript($arrayJS);
        $style_page = $this->Style($arrayStyle);
        return View::make('site/location/create', compact('js_page','style_page','$address'));
    }

    public function loadInitParam(){
        $foodType = Options::orderBy('name','ASC')->where('name','=','food_type')->get();
        $province = Provinces::orderBy('name','ASC')->get();
        $utility = Utilities::orderBy('name','ASC')->get();
        $food = Foods::orderBy('name','ASC')->get();
        $initParam = array("food"=>$food, "foodType"=>$foodType, "utility"=>$utility, "province"=>$province);

        return json_encode($initParam);
    }

}
