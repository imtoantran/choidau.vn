<?php

class LocationController extends BaseController {

    /**
     * Location Model
     * @var Location
     */
    protected $location;

    public function __construct(Location $location) {
        parent::__construct();
        $this->location = $location;
    }

    public function getCreate() {
        if(!Auth::user()){
            return Redirect::to('/');
        }
            $style_plugin=$this->Style(array(
                'assets/global/plugins/jquery-file-upload/blueimp-gallery/blueimp-gallery.min.css',
                'assets/global/plugins/jquery-file-upload/css/jquery.fileupload.css',
                'assets/global/plugins/jquery-file-upload/css/jquery.fileupload-ui.css',
                'assets/global/plugins/jquery-file-upload/css/image-manager.min.css',
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
            $js_script='FormFileUpload.init();';

            return View::make('site/location/create', compact('$address','style_plugin','style_page',
                    'js_plugin','js_script','js_page','js_global')
            );

    }

    public function loadInitParam(){
        $foodType = Option::orderBy('name','ASC')->where('name','=','food_type')->get();
        $province = Province::orderBy('name','ASC')->get();
        $utility = Utility::orderBy('name','ASC')->get();
        $food = Food::orderBy('name','ASC')->get();

        // Lay danh muc dia diem
        $catLocation = Category::whereSlug("danh-muc-dia-diem")->first()->children()->get();

        $initParam = array("food"=>$food, "foodType"=>$foodType, "utility"=>$utility, "province"=>$province, 'catLocation'=>$catLocation);
        return json_encode($initParam);
    }

    public function saveLocation(){
        $result = [];
        $user = Auth::user();
        $location = $this->location;
        $locationCreate = Input::all();
        $isAlbum = Input::has('location_album');
        $isFood= Input::has('location_food');
        $isUtilityMenu= Input::has('location_utility');

        $location->name = $locationCreate['location_name'];
        $location->address_detail = $locationCreate['location_address_detail'];
        $location->province_id = $locationCreate['location_province'];
        $location->district_id = $locationCreate['location_district'];
        $location->address_nearly = $locationCreate['location_address_nearly'];
        $location->address_detail = $locationCreate['location_address_detail'];
        $location->phone = $locationCreate['location_phone'];
        $location->email = $locationCreate['location_email'];
        $location->website = $locationCreate['location_website'];
        $location->description = $locationCreate['location_description'];
        $location->avatar = $locationCreate['location_avatar'];
        $location->position = $locationCreate['location_position'];
        $location->price_max = $locationCreate['location_price_max'];
        $location->price_min = $locationCreate['location_price_min'];
        $location->category_id = $locationCreate['location_category'];
        $location->slug = Str::slug($locationCreate['location_name']);
        $location->action_time = json_encode($locationCreate['location_timeAction']);

        // luu dia diem
        $isSaveLocation=$location->save();

        // kiem tra neu luu thanh cong
        if($isSaveLocation){
            // kiem tra va insert table location_post 'them album'
            if($isAlbum){
                foreach($locationCreate['location_album'] as $key=>$value){
                    $location->album()->attach($value['post_id']);
                }
            }

            // kiem tra va insert table location_food 'them mon an'
            if($isFood){
                foreach($locationCreate['location_food'] as $key=>$value){
                    $value['user_id'] = $user->id;
                    $isSaveL_F = $location->food()->attach($value['food_id'],$value);
                }
            }

            // kiem tra va insert table location_utility 'them tien ich'
            if($isUtilityMenu){
                foreach($locationCreate['location_utility'] as $key=>$value){
                    $isSaveL_U= $location->utility()->attach($value['utility_id'],$value);
                }
            }

            $province_name = Province::find($location->province_id)->name;

            $result['location_id'] =$location->id;
            $result['location_name'] = $location->name ;
            $result['username'] = $user->username ;
            $result['slug_province'] = Str::slug($province_name) ;
            $result['slug_location_name'] = Str::slug($location->name) ;
            $result['result'] = true ;

        }else{
            $result['result'] = false ;
        }

        return $result;
    }

//        $province_id = Input::get('dataForm');
//        $a = array($province_id['location_timeAction']);
//        print_r($a); exit;
//        return json_encode($province_id['dataform'][14]['location_timeAction'][0]['bd']);
    
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
