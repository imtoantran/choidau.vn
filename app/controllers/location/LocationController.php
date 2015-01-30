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
        $style_plugin=$this->Style(array(
            'assets/global/plugins/jquery-file-upload/blueimp-gallery/blueimp-gallery.min.css',
            'assets/global/plugins/jquery-file-upload/css/jquery.fileupload.css',
            'assets/global/plugins/jquery-file-upload/css/jquery.fileupload-ui.css',

            'assets/global/plugins/uniform/css/uniform.default.css',
            'assets/global/plugins/jquery-file-upload/css/image-manager.min.css'
        ));
        $style_page=$this->Style(array(
            'assets/frontend/pages/css/location.css',
            'assets/global/css/plugins.css',
            'assets/global/plugins/bootstrap-timepicker/css/bootstrap-timepicker.min.css'

        ));

        /*thêm javascript*/
        $js_global = $this->JScript(array(
            'http://maps.googleapis.com/maps/api/js?sensor=true&libraries=places',
            'assets/admin/pages/scripts/maps-google.js',
        ));
        $js_plugin = $this->JScript(array(
            'assets/global/plugins/bootbox/bootbox.min.js',
            'assets/global/plugins/gmaps/gmaps.min.js',
            'assets/global/plugins/image-manager/js/image-manager.js',
            'assets/global/plugins/image-manager/spaCMS_settings.js',
            'assets/global/plugins/jquery-file-upload/js/vendor/jquery.ui.widget.js',
            'assets/global/plugins/jquery-file-upload/js/vendor/tmpl.min.js',
            'assets/global/plugins/jquery-file-upload/js/vendor/load-image.min.js',
            'assets/global/plugins/jquery-file-upload/js/vendor/canvas-to-blob.min.js',
            'assets/global/plugins/jquery-file-upload/blueimp-gallery/jquery.blueimp-gallery.min.js',
            'assets/global/plugins/jquery-file-upload/js/jquery.iframe-transport.js',
            'assets/global/plugins/jquery-file-upload/js/jquery.fileupload.js',
            'assets/global/plugins/jquery-file-upload/js/jquery.fileupload-process.js',
            'assets/global/plugins/jquery-file-upload/js/jquery.fileupload-image.js',
            'assets/global/plugins/jquery-file-upload/js/jquery.fileupload-audio.js',
            'assets/global/plugins/jquery-file-upload/js/jquery.fileupload-video.js',
            'assets/global/plugins/jquery-file-upload/js/jquery.fileupload-validate.js',
            'assets/global/plugins/jquery-file-upload/js/jquery.fileupload-ui.js',

            'assets/global/plugins/jquery-validation/js/jquery.validate.min.js',
            'assets/global/plugins/jquery-validation/js/localization/messages_vi.min.js',
            'assets/global/plugins/uniform/jquery.uniform.min.js',
            'assets/global/plugins/bootstrap-timepicker/js/bootstrap-timepicker.min.js'
        ));
        $js_page = $this->JScript(array(
            'assets/admin/pages/scripts/form-fileupload.js',
            'assets/admin/pages/scripts/maps-google.js',
            'assets/frontend/pages/scripts/location.js'));
        $js_script=' Layout.init();
                FormFileUpload.init();';

        return View::make('site/location/create', compact('$address','style_plugin','style_page',
            'js_plugin','js_script','js_page','js_global')
        );
    }

    public function loadInitParam(){
        $foodType = Option::orderBy('name','ASC')->where('name','=','food_type')->get();
        $province = Province::orderBy('name','ASC')->get();
        $utility = Utility::orderBy('name','ASC')->get();
        $food = Food::orderBy('name','ASC')->get();
        $initParam = array("food"=>$food, "foodType"=>$foodType, "utility"=>$utility, "province"=>$province);
        return json_encode($initParam);
    }

    public function saveLocation(){
        $province_id = Input::all();


//        $province_id = Input::get('dataForm');
//        $a = array($province_id['location_timeAction']);
//        print_r($a); exit;
//        return json_encode($province_id['dataform'][14]['location_timeAction'][0]['bd']);
        return json_encode($province_id);
    }
    /* imtoantran save location start */
    public function getView($provinceSlug,$locationSlug){
        $location = Location::whereSlug($locationSlug)->first();
        return View::make("site/location/view",compact("location"));
    }
    function like(){
        $id = Input::get("id");
        $location = Location::find($id);
        $user = Auth::user();
        $count = $location->userAction()->whereUser_id($user->id)->whereAction_type('like')->count();
        $response=[];
        if($count){
            $location->userAction()->detach($user,['action_type'=>'like']);
            $response['canLike'] = true;
        }
        else{
            $location->userAction()->attach($user,['action_type'=>'like']);
            $response['canLike'] = false;
        }
        $response['totalFavourites'] = $location->userAction()->whereAction_type("like")->count();
        $response['success']=true;
        return json_encode($response);
    }
    function checkin(){
        $id = Input::get("id");
        $location = Location::find($id);
        $user = Auth::user();
        $count = $location->userAction()->whereUser_id($user->id)->whereAction_type('checkin')->count();
        $response=[];
        if($count){
            $response['success']=false;
            $response['message']="Bạn đã đến đây";
        }
        else{
            $location->userAction()->attach($user,['action_type'=>'checkin']);
            $response['success']=true;
        }
        $response['totalCheckedIn'] = $location->userAction()->whereAction_type("checkin")->count();

        return json_encode($response);
    }
    private function userAction(){

    }
    public function loadReviews(){
        $id = Input::get("id");
        return json_encode(Location::find($id)->reviews());
    }
    /* imtoantran save location end */
}
