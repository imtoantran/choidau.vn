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


        );
        $arrayStyle = array(



        );




        $style_global=$this->Style(array('assets/global/plugins/jquery-1.8.3.min.js'
        ));

        $style_plugin=$this->Style(array(

            'assets/global/plugins/jquery-file-upload/blueimp-gallery/blueimp-gallery.min.css',
            'assets/global/plugins/jquery-file-upload/css/jquery.fileupload.css',
            'assets/global/plugins/jquery-file-upload/css/jquery.fileupload-ui.css'

        ));
        $js_page = $this->JScript($arrayJS);
            'assets/frontend/pages/css/location.css',
            'assets/global/css/plugins.css',
            'assets/global/plugins/image-manager/css/image-manager.min.css'));



        /*--------end*/

        /*thêm css---start */
        $style_script=' .a{color:red;font-size:30px} b.{background:green;} ';
        /*-----------end*/

        /*thêm javascript*/
        $js_global=$this->JScript(array(

            'http://maps.googleapis.com/maps/api/js?sensor=true&libraries=places',
            'assets/admin/pages/scripts/maps-google.js',
        ));
        // $js_global.=$this->JScript(array('abc.js','nbkk.js'));
        $js_plugin=$this->JScript(array(
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
            'assets/global/plugins/jquery-file-upload/js/jquery.fileupload-ui.js'
        ));
        $style_page = $this->Style($arrayStyle);
            'assets/admin/pages/scripts/form-fileupload.js',
            'assets/frontend/pages/scripts/location.js'));
        $js_script=' Layout.init();
                FormFileUpload.init();
        ';



     //   $js_page = $this->JScript($arrayJS);
     //   $style_page = $this->Style($arrayStyle);
        return View::make('site/location/create', compact('js_page','style_page','$address'));
            'js_plugin','js_script','js_page'));
    }

    public function loadInitParam(){
        $foodType = Option::orderBy('name','ASC')->where('name','=','food_type')->get();
        $province = Province::orderBy('name','ASC')->get();
        $utility = Utility::orderBy('name','ASC')->get();
        $food = Food::orderBy('name','ASC')->get();
        $initParam = array("food"=>$food, "foodType"=>$foodType, "utility"=>$utility, "province"=>$province);
//        $initParam = array( "province"=>$province);

        return json_encode($initParam);
    }

}
