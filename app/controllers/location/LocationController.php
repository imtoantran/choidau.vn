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
        $style_plugin = $this->Style(array(
            'assets/global/plugins/jquery-file-upload/blueimp-gallery/blueimp-gallery.min.css',
            'assets/global/plugins/jquery-file-upload/css/jquery.fileupload.css',
            'assets/global/plugins/jquery-file-upload/css/jquery.fileupload-ui.css',
            'assets/global/plugins/jquery-file-upload/css/image-manager.min.css',
            'assets/global/plugins/uniform/css/uniform.default.css',
            'assets/global/plugins/jquery-file-upload/css/image-manager.min.css'
        ));
        $style_page = $this->Style(array(
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
            'assets/admin/pages/scripts/maps-google.js',
            'assets/frontend/pages/scripts/location.js'));
        $js_script='';

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

    //luuhoabk - save location
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
        $location->user_id=$user->id;

        // luu dia diem
        $isSaveLocation=$location->save();

        // kiem tra neu luu thanh cong
        if($isSaveLocation){
            // kiem tra va insert table location_post 'them album'
            if($isAlbum){
                foreach($locationCreate['location_album'] as $key=>$value){
                    $location->saveAlbum($value['post_id']);
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

    //luuhoabk - get image album of location
    public function loadAlbum(){
        $location_id = Input::get('location_id');
        return json_encode(Location::find($location_id)->album()->get());
    }

    public function saveImageAlbum(){
        $location_id = Input::get('location_id');
        $post_id = Input::get('post_id');
        return Location::find($location_id)->saveAlbum($post_id);
    }

    public function deleteImageAlbum(){
        $location_id = Input::get('location_id');
        $post_id = Input::get('post_id');
        return Location::find($location_id)->deleteImageAlbum($post_id);
    }

//        $province_id = Input::get('dataForm');
//        $a = array($province_id['location_timeAction']);
//        print_r($a); exit;
//        return json_encode($province_id['dataform'][14]['location_timeAction'][0]['bd']);
    
    /* imtoantran save location start */
    public function getView($provinceSlug,$slug){
        // kiem tra thanh pho ton tai hay khng
        if(Province::whereSlug($provinceSlug)->count()){
            $province = Province::whereSlug($provinceSlug)->first();
            // kiem tra danh muc co ton tai hay khong va hien thi danh sach dia diem theo danh muc nay neu co
            if(Category::whereSlug($slug)->count()) {
                if (Category::whereSlug($slug)->first()->parent->slug == "danh-muc-dia-diem") {
                    $category = Category::whereSlug($slug)->first();
                    $categoryTitle = $category->description;
                    // kiem tra co dia diem trong danh muc hay khong
                    if(Location::whereCategoryId($category->id)->count()){
                        $locations = Location::whereCategoryId($category->id)->whereProvinceId($province->id)->paginate(9);
                        return View::make("site.location.index", compact("locations","categoryTitle"));
                    }
                }
            }
            // neu khong co danh muc thi hien thi dia diem
            if(Location::whereSlug($slug)->count()){
                $location = Location::whereSlug($slug)->first();
                $location_nearly = $this->getClosePosition($location);
                $reviews = $location->reviews()->orderBy("created_at","DESC")->paginate(2);
                $options = json_decode(Option::whereName("review_visit_again")->first()->value,true);
                $blogs = Category::whereSlug("danh-muc-bai-viet")->first()->allBlogs()->take(4)->get();;
                return View::make("site/location/view",compact("location","location_nearly","reviews","options","blogs"));
            }

        }
        return View::make("site.location.404");
    }

    //luuhoabk  tra ve mang diem diem gan nhat trong cung 1 thanh pho (province)
    public function getClosePosition($location_one){
        $arrPosition = explode(',',$location_one->position);
        $location_province = Location::whereProvince_id($location_one->province_id)->where('id','<>',$location_one->id)->get();

        foreach($location_province as $k=>$v){
            $arrPosition_v = explode(',',$v->position);
            $location_province[$k]['distance'] = pow(($arrPosition[0] - $arrPosition_v[0]),2) + pow(($arrPosition[1] - $arrPosition_v[1]),2);
        }
        return $this->objectRSort($location_province,"distance");
    }

    //luuhoabk sap xep mang doi tuong tam thoi
    function objectRSort(&$object, $key)
    {
        for ($i = count($object) - 1; $i >= 0; $i--)
        {
            $swapped = false;
            for ($j = 0; $j < $i; $j++)
            {
                if ($object[$j]->$key > $object[$j + 1]->$key)
                {
                    $tmp = $object[$j];
                    $object[$j] = $object[$j + 1];
                    $object[$j + 1] = $tmp;
                    $swapped = true;
                }
            }
        }
        return $object;
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
            $location->userAction()->attach($user,['action_type'=>'like','created_at'=>date_format(new DateTime(),"Y-m-d H:i:s")]);
            $response['canLike'] = false;
        }
        $response['totalFavourites'] = $location->totalLike();
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
            $response['success'] = true;
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
    public function getReview(){
        return View::make("site.location.review");
    }
    public function postReview(){
        $user = Auth::user();
        $data = Input::all();


        $review = new Review();
        $review->title = $data['title'];
        $review->content = $data['content'];
        $review->user_id = $user->id;
        $review->parent_id = $data['id']; // review for this location
        $review->save();

        /* review meta star */
        $meta[] = new PostMeta("review_rating",$data["review_rating"]);
        $meta[] = new PostMeta("review_visitors",$data["review_visitors"]);
        $meta[] = new PostMeta("review_price",$data["review_price"]);
        $meta[] = new PostMeta("review_visit_again",$data["review_visit_again"]);
        $list_album=explode(",",$data['list-album']);

        for($i=0 ;$i<count($list_album)-1;$i++){
            $meta[] =new PostMeta("review_image",$list_album[$i]);
        }

        $review->meta()->saveMany($meta);

        /* review meta end */

    }
    /* imtoantran save location end */


    /*-------load  member*/
    public function loadMember(){
        $html='';
        $data=Input::all();
        $location_id=$data['location_id'];
        $user=Auth::user();
       // $list= $user->friends_();
      //  echo'<pre>';
      //  print_r($list);
      //  echo'</pre>';

        $listMember=Location::find($location_id)->members()->get();

        foreach($listMember as $member){
         //   $item_friend=$user->friend_common($member);
            $ban_chung=2;// count($item_friend);
            $html.=' <article class="person-friends-item col-md-4 col-sm-6 col-xs-12"> <div class="media"> <a href="#" class="pull-left">';
            $html.='<img src="'.$member->avatar.'" alt="" class="media-object"> </a>';
            $html.='<div class="media-body"><header>';
            $html.='<a class="media-heading text-1em2">'.$member->username.'</a></header><p>'. $ban_chung.' bạn chung</p></div></div></article>';

        }
        echo $html;
    }
    /*------------end*/

    /*-------load  member*/
    public function loadEvent(){
        $html='';
        $data=Input::all();
        $location_id=$data['location_id'];
        $user=Auth::user();
        $location=Location::find($location_id);
        $listEvent=$location->events()->get();

        foreach($listEvent as $event){
         $html.=$this->loadEventItem($event);
        }
        echo $html;
    }
    public function loadEventItem($event){
            $user_author=$event->author;
            return View::make('site.location.item_event',compact('event','user_author'));
    }

    /*------------end*/


    /*---------load photo*/
    public function loadPhoto1(){
        $html='';
        $data=Input::all();
        $location_id=$data['location_id'];
        $user=Auth::user();
        $location=Location::find($location_id);
        $listPhoto=$location->photos()->get();

        foreach($listPhoto as $photo){
            $html.=$this->loadEventItem($photo);
        }
        echo $html;
    }

    public function  loadPhoto(){

        $data=Input::all();
        $location=Location::find($data['location_id']);
        $list_photo=$location->photos()->get();
        $html_photo='';

        foreach($list_photo as $item){
            $category='';
            $url='';
            $url=$item->loadAlbum('url');

            $category='category_'.$item->getMetaKey('type_use');
            $html_photo.='<div class="col-md-4 col-sm-6 mix '.$category.' mix_all" id_pho="'.$item->id.'"  style="display: block; opacity: 1;"><div class="mix-inner">';

            $html_photo.='<img alt="" src="'.$url.'" class="img-responsive blog-item-photo">';
            $html_photo.='<div class="mix-details choidau-bg-light-a9">';
            $html_photo.='<h4 class="choidau-font-fff"></h4>';
            $html_photo.='<p></p>';
            $html_photo.='<a class="mix-link choidau-bg"><i class="icon-link"></i></a>';
            $html_photo.='<a data-rel="fancybox-button" title="Project Name" href="'.$url.'" class="mix-preview choidau-bg fancybox-button"><i class="icon-search"></i></a>';
            $html_photo.=' </div> </div></div>';

            $a=4;
        }

      //  $arrReturn['html']=$html_photo;
        // $arrReturn['total']=count($list_id_friend);

        echo $html_photo;// json_encode($arrReturn);

    }



    /*---------end load photo*/

}
