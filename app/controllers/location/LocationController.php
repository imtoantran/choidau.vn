<?php

class LocationController extends BaseController
{

    /**
     * Location Model
     * @var Location
     */
    protected $location;

    public function __construct(Location $location)
    {
        parent::__construct();
        $this->location = $location;
    }

    public function getCreate()
    {
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
        $js_script = '';

        return View::make('site/location/create', compact('$address', 'style_plugin', 'style_page',
                'js_plugin', 'js_script', 'js_page', 'js_global')
        );

    }

    public function loadInitParam()
    {
        $foodType = Option::orderBy('name', 'ASC')->where('name', '=', 'food_type')->get();
        $province = Province::orderBy('name', 'ASC')->get();
        $utility = Utility::orderBy('name', 'ASC')->get();

        if (Cache::has('list_food')) {
            $food = Cache::get('list_food');
        } else {
            $food = Food::orderBy('name', 'ASC')->get();
        }


        // Lay danh muc dia diem
        $catLocation = Category::whereSlug("danh-muc-dia-diem")->first()->children()->get();

        $initParam = array("food" => $food, "foodType" => $foodType, "utility" => $utility, "province" => $province, 'catLocation' => $catLocation);
        return json_encode($initParam);
    }

    //luuhoabk - save location
    public function saveLocation()
    {
        $result = [];
        $user = Auth::user();
        $location = $this->location;
        $locationCreate = Input::all();
        $isAlbum = Input::has('location_album');
        $isFood = Input::has('location_food');
        $isUtilityMenu = Input::has('location_utility');

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
        $location->user_id = $user->id;

        // luu dia diem
        $isSaveLocation = $location->save();

        // kiem tra neu luu thanh cong
        if ($isSaveLocation) {
            /* imtoantran create unique slug start */
            $location->slug = Str::slug($location->name) . "-" . $location->id;
            $location->save();
            /* imtoantran create unique slug end */
            // kiem tra va insert table location_post 'them album'
            if ($isAlbum) {
                foreach ($locationCreate['location_album'] as $key => $value) {
                    $location->saveAlbum($value['post_id']);
                }
            }

            // kiem tra va insert table location_food 'them mon an'
            if ($isFood) {
                foreach ($locationCreate['location_food'] as $key => $value) {
                    $value['user_id'] = $user->id;
                    $isSaveL_F = $location->food()->attach($value['food_id'], $value);
                }
            }

            // kiem tra va insert table location_utility 'them tien ich'
            if ($isUtilityMenu) {
                foreach ($locationCreate['location_utility'] as $key => $value) {
                    $isSaveL_U = $location->utility()->attach($value['utility_id'], $value);
                }
            }

            $province_name = Province::find($location->province_id)->name;

            $result['location_id'] = $location->id;
            $result['location_name'] = $location->name;
            $result['username'] = (empty($user->fullname) ? $user->username : $user->fullname);
            $result['url'] = $location->url();
            $result['result'] = true;

        } else {
            $result['result'] = false;
        }

        return $result;
    }

    //luuhoabk - get image album of location
    public function loadAlbum()
    {
        $location_id = Input::get('location_id');
        return json_encode(Location::find($location_id)->images()->get());
    }

    public function saveImageAlbum()
    {
        $location_id = Input::get('location_id');
        $post_id = Input::get('post_id');
        return Location::find($location_id)->saveAlbum($post_id);
    }

    public function deleteImageAlbum()
    {
        $location_id = Input::get('location_id');
        $post_id = Input::get('post_id');
        return Location::find($location_id)->deleteImageAlbum($post_id);
    }

    /* imtoantran delete images start */
    public function deleteImages($location)
    {
        if (Auth::check()) {
            if (Input::has("images")) {
                $location->images()->detach(Input::get("images"));
                return json_encode(["succes" => true]);
            }
        }
        return json_encode(["succes" => false, "message" => "Need login to do this action"]);
    }
    /* imtoantran delete images end */

    /* imtoantran load slider start */
    public function getImages($location)
    {
        return View::make("site.location.slider", compact("location"));
    }
    /* imtoantran load slider end */

    /* imtoantran save location start */
    /* imtoantran save location images start */
    public function postImages($location)
    {
        if (Auth::guest())
            return json_encode(["success" => false]);
        if (!Input::has("images"))
            return json_encode(["success" => false]);
        $images = Input::get("images");
        foreach ($images as $image) {
            $location->images()->withPivot("location_post_type_id")->attach([$image=>['location_post_type_id' => 39]]);
        }
        return json_encode(Input::get("images"));
    }

    /* imtoantran save location images end */
    public function getView($provinceSlug, $slug = '')
    {
        // kiem tra thanh pho ton tai hay khong
        if (Province::whereSlug($provinceSlug)->count()) {
            $province = Province::whereSlug($provinceSlug)->first();
            // kiem tra danh muc co ton tai hay khong va hien thi danh sach dia diem theo danh muc nay neu co
            if (Category::whereSlug($slug)->count()) {
                if (Category::whereSlug($slug)->first()->parent->slug == "danh-muc-dia-diem") {
                    $category = Category::whereSlug($slug)->first();
                    $categoryTitle = $category->description;
                    // kiem tra co dia diem trong danh muc hay khong
                    if (Location::whereCategoryId($category->id)->count()) {
                        $locations = Location::orderBy('created_at','DESC')->whereCategoryId($category->id)->whereProvinceId($province->id)->paginate(9);
                        return View::make("site.location.index", compact("locations", "categoryTitle"));
                    }
                }
            }
            // neu khong co danh muc thi hien thi dia diem
            if (Location::whereSlug($slug)->count()) {
                $location = Location::whereSlug($slug)->first();
                $total_like = $location->totalLike();
                $total_checkin = $location->totalCheckIn();
                $isLike = false;
                $isCheckin = false;

                if(Auth::check()){
                    $user = Auth::user();
//                    var_dump($location->isCheckin($user->id)); exit;
                    $isLike = ($location->isLiked($user->id))? true: false;
                    $isCheckin = ($location->isCheckin($user->id))? true: false;
                }
                /* bat session location start*/
                Session::push("location", $location);
                /* bat session location end*/

                $location_nearly = $this->getClosePosition($location);

                $reviews='';
                /* imtoantran load review */
                if(Input::has("notif_t") && Input::has("post")){
                    $reviews = Review::where(["id"=>Input::get("post")])->paginate(5);
                }else{
                    $reviews = $location->reviews()->orderBy("created_at", "DESC")->paginate(5);
                    $reviews->setBaseUrl("/location/$location->id/reviews");
                }
                /* imtoantran load review */
                $options = json_decode(Option::whereName("review_visit_again")->first()->value, true);
                $blogs = Category::whereSlug("danh-muc-bai-viet")->first()->allBlogs()->take(4)->get();
                foreach($blogs as $key=>$val){
                    $blog_item = Post::find($val['id']);
                    if(isset($blog_item->getFeaturedImage()->thumbnail)){
                        $avatar = $blog_item->getFeaturedImage()->thumbnail;
                        $avatar = explode('/',$avatar);
                        $avatar = '/'.$avatar[1].'/'.$avatar[2].'/260x197-'.$avatar[3];
                        $blogs[$key]['avatar'] = $avatar;
                    }else{
                        $blogs[$key]['avatar'] = '';
                    }
                }
                if (!Cache::has("food_type")) {
                    Cache::forever("food_type", Option::where(["name" => "food_type"])->get(), 24 * 60);
                }
                /* load location's images start  */
                $profile_image = $location->avatar;
                $reviewsImages = $location->reviewsImages();
                $ads = Advertisement::wherePosition('ads-1')->first();
                /* load location's images stop  */
                return View::make("site/location/view", compact("location", "total_like", "total_checkin", "isLike", "isCheckin", "location_nearly", "reviews", "options", "blogs", "reviewsImages","ads"));
            }

        }
        return View::make("site.location.404");
    }

    //luuhoabk  tra ve mang diem diem gan nhat trong cung 1 thanh pho (province)
    public function getClosePosition($location_one)
    {
        $arrPosition = explode(',', $location_one->position);
        $location_province = Location::whereProvince_id($location_one->province_id)->where('id', '<>', $location_one->id)->get();

        if(count($location_province)){
            foreach ($location_province as $k => $v) {
                $arrPosition_v = explode(',', $v->position);
                $location_province[$k]['distance'] = pow(($arrPosition[0] - $arrPosition_v[0]), 2) + pow(($arrPosition[1] - $arrPosition_v[1]), 2);
            }
            return $this->objectRSort($location_province, "distance");
        }



    }

    //luuhoabk sap xep mang doi tuong tam thoi
    function objectRSort(&$object, $key)
    {
        for ($i = count($object) - 1; $i >= 0; $i--) {
            $swapped = false;
            for ($j = 0; $j < $i; $j++) {
                if ($object[$j]->$key > $object[$j + 1]->$key) {
                    $tmp = $object[$j];
                    $object[$j] = $object[$j + 1];
                    $object[$j + 1] = $tmp;
                    $swapped = true;
                }
            }
        }
        return $object;
    }
    function action(){
        $user = Auth::user();
        $data = Input::all();
        $location = Location::find($data['location_id']);

        switch($data['action_type']){
            case 'like':
                if($location->isLiked($user->id)){ echo -1; break; }
                $save = $location->itemSave($user, 'like');
                if(empty($save)){
                    echo $location->totalLike();
                    $isPost = Post::whereUser_id($user->id)->wherePost_type('like-location')->whereParent_id($location->id);
                    if(!$isPost->count()){
                        /* imtoantran  changed to use Like object start */
                        $post = new Like();
                        /* imtoantran  changed to use Like object stop */
                        $post->title        = "like-location";
                        $post->parent_id    = $location->id;
                        $post->content      = "like-location";
                        $post->privacy      = 18;
                        $post->user_id      = $user->id;
                        $post->created_at   = date_format(date_create("now"),"Y-m-d H:i:s");
                        $post->updated_at   = date_format(date_create("now"),"Y-m-d H:i:s");
                        $post->save();
                    }
                } else{ echo -1;}
                break;
            case 'unlike':
                if($location->isLiked($user->id)){
                    if($location->itemDelete($user->id, 'like')){  echo $location->totalLike(); } else{ echo -1;}
                }else{echo -1;}
                break;
            case 'checkin':
                if($location->isCheckin($user->id)){ echo -1; break; }
                $save = $location->itemSave($user, 'checkin');
                if(empty($save)){
                    echo $location->totalCheckIn();
                    $isPost = Post::whereUser_id($user->id)->wherePost_type('checkin')->whereParent_id($location->id);
                    if(!$isPost->count()){
                        /* imtoantran  changed to use Checkin object start */
                        $post = new Checkin();
                        /* imtoantran  changed to use Checkin object stop */
                        $post->title        = "checkin";
                        $post->parent_id    = $location->id;
                        $post->content      = "checkin";
                        $post->privacy      = 18;
                        $post->user_id      = $user->id;
                        $post->created_at   = date_format(date_create("now"),"Y-m-d H:i:s");
                        $post->updated_at   = date_format(date_create("now"),"Y-m-d H:i:s");
                        $post->save();
                    }
                } else{ echo -1;}
                break;
            default: break;
        }
    }


    /**
     * imtoantran
     * @param $location
     * @return \Illuminate\View\View
     */
    public function getReviews($location)
    {
        $reviews = $location->reviews()->paginate(2);
        $reviews->setBaseUrl("/location/$location->id/reviews");
        return View::make("site.location.review", compact("reviews"));
    }

    public function getReview()
    {
        return View::make("site.location.review");
    }

    /**
     * author imtoanran
     * save location review and images
     */
    public function postReview($location)
    {
        if (Auth::guest()) return Response::json(["succes" => false, "message" => "Need login"]);

        $user = Auth::user();
        $data = Input::all();
        /* create review content start */
        $review = new Review();
        $review->title = $data['title'];
        $review->content = $data['content'];
        $review->privacy = 18;
        $review->user_id = $user->id;
        /* save location review */
        if (!$location->reviews()->save($review))
            return Response::json(["success" => false, "message" => "Not saved"]);

        /* review meta start */
        $meta[] = new PostMeta("review_rating", $data["review_rating"]);
        $meta[] = new PostMeta("review_visitors", $data["review_visitors"]);
        $meta[] = new PostMeta("review_price", $data["review_price"]);
        $meta[] = new PostMeta("review_visit_again", $data["review_visit_again"]);
        /* review meta stop */
        /* review images start */
        if(Input::has("images")) {
            foreach ($data["images"] as $image) {
                $meta[] = new PostMeta("review_image", $image);
            }
        }
        /* review images start */
        $review->meta()->saveMany($meta);
        /* review images stop */

        /* review meta end */
        return Response::json(["id"=>$review->id,"success"=>true,"content"=>View::make("site.location.review_item",compact("review"))->render()]);
    }
    /* imtoantran save location review end */


    /*-------load  member*/
    public function loadMember()
    {
        $html = '';
        $data = Input::all();
        $location_id = $data['location_id'];
        $user = Auth::user();
        // $list= $user->friends_();
        //  echo'<pre>';
        //  print_r($list);
        //  echo'</pre>';

        $listMember = Location::find($location_id)->members()->get();

        foreach ($listMember as $member) {
            //   $item_friend=$user->friend_common($member);
            $ban_chung = 2;// count($item_friend);
            $html .= ' <article class="person-friends-item col-md-4 col-sm-6 col-xs-12"> <div class="media"> <a href="#" class="pull-left">';
            $html .= '<img src="' . $member->avatar . '" alt="" class="media-object"> </a>';
            $html .= '<div class="media-body"><header>';
            $html .= '<a class="media-heading text-1em2">' . $member->username . '</a></header><p>' . $ban_chung . ' bạn chung</p></div></div></article>';

        }
        echo $html;
    }
    /*------------end*/

    /*-------load  member*/
    public function loadEvent()
    {
        $html = '';
        $data = Input::all();
        $location_id = $data['location_id'];
        $user = Auth::user();
        $location = Location::find($location_id);
        $listEvent = $location->events()->get()->sortByDesc('updated_at');

        foreach ($listEvent as $event) {
            $html .= $this->loadEventItem($event);
        }
        echo $html;
    }

    public function loadEventItem($event)
    {
        $user_author = $event->author;
        return View::make('site.location.item_event', compact('event', 'user_author'));
    }

    /*------------end*/
    public function  loadPhoto()
    {

        $data = Input::all();
        $location = Location::find($data['location_id']);
        $list_photo = $location->images()->get();
        $html_photo = '';

        foreach ($list_photo as $item) {
            $category = '';
            $url = '';
            $url = $item->getMetaKey('url');

            $category = 'category_' . $item->getMetaKey('type_use');
            $html_photo .= '<div class="col-md-4 col-sm-6 mix ' . $category . ' mix_all" id_pho="' . $item->id . '"  style="display: block; opacity: 1;"><div class="mix-inner">';

            $html_photo .= '<img alt="" src="' . $url . '" class="img-responsive blog-item-photo">';
            $html_photo .= '<div class="mix-details choidau-bg-light-a9">';
            $html_photo .= '<h4 class="choidau-font-fff"></h4>';
            $html_photo .= '<p></p>';
            $html_photo .= '<a class="mix-link choidau-bg"><i class="icon-link"></i></a>';
            $html_photo .= '<a data-rel="fancybox-button" title="Project Name" href="' . $url . '" class="mix-preview choidau-bg fancybox-button"><i class="icon-search"></i></a>';
            $html_photo .= ' </div> </div></div>';

            $a = 4;
        }

        echo $html_photo;
    }

    /*---------end load photo*/

    /***
     * @param $id
     * @return \Illuminate\View\View
     * load một review của địa điêm
     */

    public static function loadItemReview($id)
    {
        $review = Review::find($id);
        return View::make('site.location.item_review', compact('review'));
    }
    /***--------    * load một review của địa điêm --end--     */


    /**
     * imtoantran
     * Đăng một sự kiện mới cho location
     */

    public function postEvent($location)
    {
        if (Auth::guest()) {
            return json_encode(["success" => false, "message" => "Need login"]);
        }
        $event = $location->event;
        if (!$event) {
            $event = new EventLocation();
            $event->parent_id = $location->id;
        }
        if (Input::has("content")) {
            $event->content = Input::get("content");
            if ($event->save()) {
                return json_encode(["success" => true]);
            };
            return json_encode(["success" => false]);
        }
        return json_encode(["success" => false]);
    }
    /**-end-------     * Đăng một sự kiện mới cho location     */


    /**
     * Đăng món ăn trong thực đơn locaiton
     */

    /****/
    public function postFood()
    {
        if (Auth::guest()) {
            return Response::json(["success" => false, "message" => "Need login"]);
        }
        $data = Input::all();
        $food = "";
        if (Input::has("food_id")) {
            $food = LocationFood::find($data["food_id"]);
        } else {
            $food = new LocationFood();
            $food->location_id = $data["location_id"];
        }
        $food->food_name = $data['food_name'];
        $food->description = $data['food_description'];
        $food->user_id = Auth::id();
        $food->type_id = $data['food_type'];
        $food->price = $data['food_price'];
        $food->save();
        //return View::make("site.location.foot_item",compact("food"));
    }
    /***      * Đăng món ăn trong thực đơn locaiton--end    */
    /* imtoantran save food start */
    public function addFood($location)
    {
        if (Auth::guest()) {
            return Response::json(["success" => false, "message" => "Need login"]);
        }
        $data = Input::all();

        $action = "edit";
        $food = "";
        if (Input::has("id")) {
            $food = LocationFood::find($data["id"]);
        } else {
            $food = new LocationFood();
            $food->location_id = $location->id;
            $action = "add";
        }
        $food->food_name = $data['name'];
        //$food->description = $data['description'];
        $food->user_id = Auth::id();
        $food->type_id = $data['type'];
        $food->price = $data['price'];
        if(Input::has('thumbnail'))
            $food->thumbnail = $data['thumbnail'];
        if(Input::has('image'))
            $food->image = $data['image'];
        if($action == "add"){
            $key = $location->foods()->count();
        }
        else{
            $key = Input::get("key");
        }
        if ($food->save())
            return Response::json(["id"=>$food->id,"action" => $action, "success" => true, "content" => View::make("site.location.food_item", compact("location", "food", "key"))->render()]);
        return Response::json(["success" => false, "message" => "Not food saved"]);
    }

    public function editFood()
    {
        if (Auth::guest()) {
            return json_encode(["success" => false, "message" => "Need login"]);
        }
        $data = Input::all();
        if (Input::has("id")) {
            if ($food = LocationFood::find($data["id"]))
                $food[$data['field']] = $data['content'];
            if ($food->save())
                return Response::json(["action" => "edit", "success" => true]);
        }
        return json_encode(["success" => falselike, "message" => "Not food saved"]);
    }
    /* imtoantran save food stop */
    /* imtoantran remove food start */
    public function removeFood()
    {
        if (Auth::guest())
            return Response::json(["success" => false, "message" => "Need login"]);
        $id = Input::get("id");
        if ($food = LocationFood::find($id))
            if ($food->delete())
                return Response::json(["success" => true]);
        return Response::json(["success" => false, "message" => "Not deleted"]);
    }

    /* imtoantran remove food stop */


    public function filterLocation()
    {
        $data = Input::all();
        $arr_location = array();
        $arr_location['posted'] = $this->addUrl(Location::whereUser_id($data['userBlog_id'])->get());

        $user_blog = User::whereId($data['userBlog_id'])->get()->first();

        $arr_location['checkin'] = $this->addUrl($user_blog->checkin()->get());
        $arr_location['like'] = $this->addUrl($user_blog->location_like()->get());
        echo json_encode($arr_location);
    }

    public function addUrl($arr)
    {
        foreach ($arr as $key => $val) {
            $location = Location::whereId($val['id'])->get()->first();
            $arr[$key]['url'] = $location->url();
        }
        return $arr;
    }

//    luuhoabk load album for location
    public function filterAlbums()
    {
        $data = Input::all();
        $arr_location = Location::whereUser_id($data['id_user_blog'])->get();
        foreach ($arr_location as $key => $val) {
            $arr_location[$key]['album'] = Location::find($val['id'])->images()->get();
        }
        echo json_encode($arr_location);
    }
//  END  luuhoabk load albm for location

    //luuhoabk create video
    public function createVideo(){
        $data = Input::all();
        $user = Auth::user();
        $result['is_save'] = array();
        $video = new Post();
        $video->title = $data['video_title'];
        $video->user_id = $user->id;
        $video->guid = $data['video_link'];
        $video->parent_id = $data['location_id'];
        $video->description = $data['description'];
        $video->post_type = 'video';
        $video->content = 'video';
        $video->privacy = 18;
        $result['is_save'] = $video->save();
        $result['user_name'] = $user->display_name();
        echo json_encode($result);
    }
    //END luuhoabk create video

    public function getLocation(){
        $data = Input::all();
        Session::put("province", Province::find($data['province_id']));
//        if($data['province_id'] == 'all'){
//            $location = Location::orderBy('created_at')->get();
//        }else{
//            Session::put("province",Province::find($data['province_id']));
//            $location = Location::orderBy('created_at')->whereProvince_id($data['province_id'])->get();
//        }
//        if(count($location)>0){
//            foreach($location as $key=>$val){
//                $location[$key]['url'] = $val->url();
//            }
//        }
//        echo json_encode($location);
        echo 1;
    }
}
