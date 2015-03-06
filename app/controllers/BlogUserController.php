<?php

/**
 * Class BlogController
 * @author imtoantran
 * blog page of admin
 */
use Andrew13\Helpers\String;
class BlogUserController extends BaseController {

    /**
     * Post Model
     * @var Post
     */
    protected $blogUser;

    /**
     * User Model
     * @var User
     */
    protected $user;
	protected $cat;

	/**
	 * @param User $user
	 * @param Blog $post
	 * @param Category $cat
	 */
	public function __construct(User $user,BlogUser $blogUser,Category $cat)
    {
        parent::__construct();
		$this->user = Auth::user();
		$this->blogUser = $blogUser;
		$this->cat = $cat;

    }

	/**
	 * Returns all the blog posts.
	 *
	 * @param string $catSlug
	 * @return View
	 */
	public function getIndex($user_slug)
	{
        $user_blog = User::where('username','=',"$user_slug")->first();
//        $blogUser  = $user_blog->blog()->first();


        try{

            $user_auth = Auth::user();

            $this->user = $user_auth;
            $this->blogUser=$user_blog;

            $html_friends = '';

            $list_friend=$user_blog->friends()->get();
            $list_sus_friend=array();

            $list_friend_my=$this->filterFriends_byBlog($list_friend,$user_auth->id);

            foreach($list_friend_my as $item){
                $user_tam=User::whereId($item)->first();
                $list_friend_friend=$user_tam->friends()->get();
                $list_id_friend_friend = $this->filterFriends_byBlog($list_friend_friend,$user_auth->id);
                $i=0;

                foreach($list_id_friend_friend as $item1){
                    if(!in_array($item1,$list_sus_friend)){
                        $user_tam_1=User::whereId($item1)->first();
                        $list_sus_friend[$i]['id']=$item1;
                        $item_friend=$this->filterMutualFriend($this->user,$user_tam_1);
                        $list_sus_friend[$i]['mutual']=count($item_friend['list_id_friend_mutual']);
                        $i++;
                    }
                }
            }

            $list_sus_friend2=array();
            $html_friends.='';

            foreach($list_sus_friend as $item){
                if(!in_array($item['id'], $list_friend_my) && !in_array($item['id'], $list_sus_friend2)){
                    $list_sus_friend2[]=$item['id'];
                    $user_friend = User::whereId($item['id'])->first();
                    $html_friends.='<li class="lab-btn-item-blog-friend"><div class = "row margin-none"><div class="col-md-8 col-sm-8 col-xs-8 col-none-padding article-img-text">';
                        $html_friends.='<a href="'.$user_friend->url().'">';
                            $html_friends.='<img class="avatar-pad2" src="'.$user_friend->avatar.'" alt="">';
                        $html_friends.='</a>';
                            $html_friends.='<div class="aside-items-text">';
                                $html_friends.='<a href="'.$user_friend->url().'">';
                                    $html_friends.='<b>'.(($user_friend->fullname)?$user_friend->fullname:$user_friend->username).'</b>';
                                $html_friends.='</a>';
                                $html_friends.= '<p>'.$item['mutual'].' bạn chung</p></div>';
                            $html_friends.='</div>';
                        $html_friends.='<div class="col-md-4 col-sm-4 col-xs-4 col-none-padding text-center">';

                    $html_friends.='<button i_u="'.$user_friend->id.'" data-url="'.$user_friend->url().'" class="btn btn-default btn-aside-add-friend"> <i class="icon-user-add"> </i> Kết bạn</button>';

//                    $status_id = Friend::whereUser_id($user_auth->id)->whereFriend_id($user_friend->id)->first()['status_id'];
//                    if($status_id == null){
//                            $html_friends.='<button i_u="'.$user_friend->id.'"  class="btn btn-default btn-aside-add-friend"> <i class="icon-user-add"> </i> Kết bạn</button>';
//                    }elseif($status_id == 35){
//                            $html_friends.='<button i_u="'.$user_friend->id.'"  class="btn btn-default btn-aside-delete-friend"> <i class="icon-user-add"> </i> Đang đợi/Hủy</button>';
//                    }else{
//                        $html_friends.='<button i_u="'.$user_friend->id.'"  class="btn btn-default btn-aside-delete-friend"> <i class="icon-user-add"> </i> H</button>';
//                    }

                    $html_friends.='</div></div></li>';

                }
            }

        }catch (Exception $e){}

        $style_plugin=$this->Style(array(
            'assets/global/plugins/jquery-file-upload/blueimp-gallery/blueimp-gallery.min.css',
            'assets/global/plugins/jquery-file-upload/css/jquery.fileupload.css',
            'assets/global/plugins/jquery-file-upload/css/jquery.fileupload-ui.css',
            'assets/global/plugins/jquery-file-upload/css/image-manager.min.css',
            'assets/frontend/pages/css/portfolio.css'

        ));
        $style_page=$this->Style(array('assets/global/css/plugins.css'
           ));


        $js_plugin=$this->JScript(array(

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
             'assets/global/plugins/jquery-mixitup/jquery.mixitup.min.js'
        ));
        $js_page=$this->JScript(array('assets/admin/pages/scripts/form-fileupload.js',
                                      'assets/frontend/pages/scripts/portfolio.js'));
        $js_script='
                var id_blo='.$this->blogUser->id.';
                FormFileUpload.init();
                 Portfolio.init();
        ';

        $user_birthday      = new DateTime($user_blog->birthday);
        $user_birthday      = date_format($user_birthday,'d/m/Y');

        $blog_info =array(
            'username'=>$user_blog->username,
            'name'=>$user_blog->fullname,
            'id'=>$user_blog->id,
            'background'=>$user_blog->background,
            'avatar'=>$user_blog->avatar,
            'level'=> Option::find($user_blog->level_id)->description,
            'birthday'=>$user_birthday,
            'province'=>Province::getName($user_blog->province_id),
            'friend_sus'=>$html_friends,
            'total_like'=>$user_blog->getTotalLikeLocation(),
            'id_auth'=>$user_auth->id,
            'friend_status'=>Friend::whereUser_id($user_auth->id)->whereFriend_id($user_blog->id)->first()['status_id'],
        );

        $listStatus_2 =Post::orderBy('updated_at','DESC')->whereUser_id($user_blog->id)->wherePost_type('status')->get();

//        $listStatus_2 =Post::orderBy('updated_at','DESC')->where('user_id','=',$user_blog->id)->where('post_type','=','status')->skip(0)->take(5)->get();
//         $listStatus_2=$blogUser->getContentAction();

         $html_status='';

        /*---- get html item status*/
        foreach($listStatus_2 as $item){
            $id= $item->post_id;

            switch($item->blog_post_type_id){
                case "43":
                   $html_status.= $this->loadItemStatus2($id);
                    break;
                case "44":
                    $html_status.=$this->loadLikeLocation($id);

                    break;
                case "41":
                    $html_status.=$this->loadCheckIn($id);
                    break;
                case "42":

                  $html_status.=$this->loadReviewLocation($id);
                    break;
                default :

                    break;
            }

        }




       $listStatusPost=Option::orderBy('name','ASC')->where('name','=','post_privacy')->get();
       return View::make('site.user.blog.index',compact('user','listStatusPost','html_status','blog_info','style_plugin','style_page','js_plugin','js_page','js_script'));

	}
	public function getEvent(){
		return $this->getIndex('su-kien');
	}
	public function getExperience(){
		return $this->getIndex('kinh-nghiem');
	}
	/**
	 * View a blog post.
	 *
	 * @param  string  $slug
	 * @return View
	 * @throws NotFoundHttpException
	 */
	public function getView($slug)
	{
		// Get this blog post data
		$post = Post::where('slug', '=', $slug)->first();

		// Check if the blog post exists
		if (is_null($post))
		{
			// If we ended up in here, it means that
			// a page or a blog post didn't exist.
			// So, this means that it is time for
			// 404 error page.
			return App::abort(404);
		}

		// Get this post comments
		$comments = $post->comments()->orderBy('created_at', 'ASC')->get();

        // Get current user and check permission
        $user = $this->user->currentUser();
        $canComment = false;
        if(!empty($user)) {
            $canComment = $user->can('post_comment');
        }

		// Show the page
		return View::make('site/blog/view_post', compact('post', 'comments', 'canComment'));
	}

	/**
	 * View a blog post.
	 *
	 * @param  string  $slug
	 * @return Redirect
	 */
	public function postView($slug)
	{

        $user = $this->user->currentUser();
        $canComment = $user->can('post_comment');
		if ( ! $canComment)
		{
			return Redirect::to($slug . '#comments')->with('error', 'You need to be logged in to post comments!');
		}

		// Get this blog post data
		$post = $this->post->where('slug', '=', $slug)->first();

		// Declare the rules for the form validation
		$rules = array(
			'comment' => 'required|min:3'
		);

		// Validate the inputs
		$validator = Validator::make(Input::all(), $rules);

		// Check if the form validates with success
		if ($validator->passes())
		{
			// Save the comment
			$comment = new Comment;
			$comment->user_id = Auth::user()->id;
			$comment->content = Input::get('comment');

			// Was the comment saved with success?
			if($post->comments()->save($comment))
			{
				// Redirect to this blog post page
				return Redirect::to($slug . '#comments')->with('success', 'Your comment was added with success.');
			}

			// Redirect to this blog post page
			return Redirect::to($slug . '#comments')->with('error', 'There was a problem adding your comment, please try again.');
		}

		// Redirect to this blog post page
		return Redirect::to($slug)->withInput()->withErrors($validator);
	}


    public function postEditBlogUser(){
        $user = Auth::user();
        $this->blogUser=$user->blog()->first();

        $data=Input::all();
        $type_edit=$data['type_edit'];
        if(Request::ajax())
        {

            switch($type_edit){
                case "change_anh_bia":

                    $this->blogUser->background=$data['background'];
                    $this->blogUser->save();

                    break;
                case "change_avatar":
                    $user->avatar=$data['avatar'];
                    $user->save();

                    break;
                case "change_anh_bia_1":

                    break;

            }
        }
    }

    public function postStatusBlogUser(){
        $data=Input::all();
        $user =  Auth::user();
        $this->blogUser=$user->blog()->first();

        $user_blog=User::find($data['id_user_blog']);
        $blog_user=$user_blog->blog()->first();

        $type_edit=$data['type_edit'];
        if(Request::ajax())
        {
            switch($type_edit){
                case "add_status":
                    $post =new Post();
                    $post->title="status";
                    $post->content=$data['content'];
                    $post->privacy =$data['privacy'];
                    $post->post_type='status';
                    $post->user_id=$user->id;
                    $post->save();
                    $date=date_create("now");
                    $date=  date_format($date,"Y-m-d H:i:s");
                    $post->userAction()->attach($user,['post_user_type_id'=>33,'created_at'=>$date]);
                    $blog_user->status()->attach($blog_user->id,['blog_post_type_id'=>43,'user_id'=>$user->id,'obj_id'=>$post->id,'created_at'=>$date,'updated_at'=>$date]);
                    echo $post->id;
                    break;
                case "like_status":
                  //  $user=Auth::user();
                    $date=date_create("now");
                    $date=  date_format($date,"Y-m-d H:i:s");

                    $post_like=Post::where('id','=',$data['post_id'])->first();
                    $type_action_like=$data['type_action_like'];

                    if($type_action_like=="type_action_like"){
                        $post_like->userAction()->attach($user,['post_user_type_id'=>31,'created_at'=>$date]);

                    }else{
                        $post_like->userAction()->detach($user,['post_user_type_id'=>31,'created_at'=>$date]);

                     //  $post_like->userAction()->updateExistingPivot($user,['post_user_type_id'=>31,'created_at'=>$date]);

                    }
                    $number_like=$post_like->userAction()->where('post_user_type_id','=','31')->count();
                    $data_1=array(
                        'type_action_like'=>$type_action_like,
                        'number_like'=>$number_like
                    );

                  //  echo $type_action_like.'-'.$number_like;
                    echo json_encode($data_1);
                    break;
                case "comment_post":
                    $post_id=$data['post_id'];
                    $content_comment=$data['content_comment'];

                    $post= new Post();
                    $post->content=$data['content_comment'];
                    $post->parent_id=$data['post_id'];
                    $post->post_type='comment';
                    $post->user_id=$user->id;
                    $post->save();
                    $post_parent=Post::where('id','=',$post_id)->first();

                    $data_1=array(
                        'avatar_user'=>$user->avatar,
                        'username'=>$user->username,
                        'content'=>$data['content_comment'],
                        'date_at'=>String::showTimeAgo($post->created_at()),
                        'id_user'=>$user->id,
                        'id_comment'=>$post->id,
                        'number_comment'=>$post_parent->comments()->count()
                    );
                    echo json_encode($data_1);
                    break;
                case "comment_delete":

                    $post=Post::where('id','=',$data['id_comment'])->where('post_type','=','comment')->get()->first();
                    $post->delete();
                    $post_parent=Post::where('id','=',$data['id_parent_comment'])->first();
                    echo $inum_comment=$post_parent->comments()->count();
                    break;
                case "status_delete":
                    $post=Post::where('id','=',$data['id_status'])->where('post_type','=','status')->first();
                    $listComment=$post->comments()->delete();
                    $blog_user->status()->detach($blog_user->id,['blog_post_type_id'=>43,'user_id'=>$user->id,'obj_id'=>$post->id]);

                    $post->delete();
                    break;
            }


        }


    }

    public function getCountMutualFriend($arr1, $arr2){
    $arr1_tam[] ='';
    $arr2_tam[] ='';
    foreach($arr1 as $key=>$val){
        $arr1_tam[$key] = $val['id'];
    }
    foreach($arr2 as $key=>$val){
        $arr2_tam[$key] = $val['id'];
    }

    return array_intersect($arr1_tam ,$arr2_tam);
}
    //luuhoabk
    public function  getListFriend(){

        $data           = Input::all();
        $user_blog      = User::whereId($data['userBlog_id'])->first();
        $list_friend    = $user_blog->referFriend()->withPivot("status_id")->wherePivot('status_id' , '=', 34)->get(['id','username','avatar', 'fullname']);
        $arrTemp = $list_friend;
        $user = Auth::user();

        $arr_user_friend  = $user->referFriend()->get(['id']);

        foreach($arrTemp as $key=>$val){
            $user_blog_friend      = User::whereId($val['id'])->first();
            $arr_blog_friend  = $user_blog_friend->referFriend()->get(['id']);
            $list_friend[$key]['mutual_friend_count'] = count($this->getCountMutualFriend($arr_blog_friend, $arr_user_friend));
            $list_friend[$key]['user_login_id'] = $user->id;

            //kiem tra user_login coquan he voi user friend_blog_item khong
            $list_friend[$key]['state_user'] = Friend::whereUser_id($user->id)->whereFriend_id($val['id'])->get(['status_id'])->first();
            $list_friend[$key]['state_friend'] = Friend::whereUser_id($val['id'])->whereFriend_id($user->id)->get(['status_id'])->first();

        }
        echo json_encode($list_friend);
    }

    public function  getListPhoto(){

        $data=Input::all();
        $user_blog=User::where('id','=',$data['id_user_blog'])->first();
        $list_photo=Post::where('user_id','=',$user_blog->id)->where('post_type','=','image')->get();
        $html_photo='';
        foreach($list_photo as $item){
            $category='';
            $url='';

            $url=$item->getMetaKey('url');
           
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
        $arrReturn['html']=$html_photo;
        echo  json_encode($arrReturn);

    }


    /**
     * get list check in location
     *
    */
    public function  getListCheckIn(){

        $data=Input::all();
        $user_blog=User::where('id','=',$data['id_user_blog'])->first();
        $list_location=$user_blog->checkin()->get();
        $html_checkin='';
        foreach($list_location as $item){

            $html_checkin.=$this->loadCheckInByLocation($item->id,$user_blog->id);
        }
        $arrReturn['html']=$html_checkin;
        echo  json_encode($arrReturn);

    }

    /**-- get list check in loation end----*/



    /** get list location  yêu thích*/

    public function  getListLocationLike(){

        $data=Input::all();
        $user_blog=User::where('id','=',$data['id_user_blog'])->first();
        $list_location=$user_blog->location_like()->get();
        $html_location='';
        foreach($list_location as $item){

            $html_location.=$this->loadLocationLike_2($item->id,$user_blog->id);
        }
        $arrReturn['html']=$html_location;
        echo  json_encode($arrReturn);

    }

    /** end---get list location like yêu thích*/
    public function deleteFriend($friend, $user_id, $friend_id){
        return $friend->whereUser_id($user_id)->whereFriend_id($friend_id)->delete();
    }
    public function updateFriend($friend, $user_id, $friend_id, $state){
        return $friend->whereUser_id($user_id)->whereFriend_id($friend_id)->update(['status_id' => $state]);
    }
    public function getFriend($friend, $user_id, $friend_id){
        return $friend->whereUser_id($user_id)->whereFriend_id($friend_id)->get()->first();
    }
    public function addFriend($friend, $user_id, $friend_id, $state){
        $friend->user_id    = $user_id;
        $friend->friend_id  = $friend_id;
        $friend->status_id  = $state;
        $friend->created_at = date_format(date_create("now"),"Y-m-d H:i:s");
        return $friend->save();
    }

    /** luuhoabk action ket ban */
    public function  postFriend(){
        $this->user = Auth::user();
        $data=Input::all();
        if(Request::ajax())
        {
            $friend             = new Friend();
            switch($data['type_edit']){
                case "request_add_friend":
                    echo $this->addFriend($friend, $this->user->id, $data['friend_id'], '35');
                    break;

                case "request_confirm_friend":
                    $this->updateFriend($friend, $data['id_friend'], $this->user->id, '34');
                    $num_friend = $this->getFriend($friend, $this->user->id, $data['id_friend']);
                    if(count($num_friend)>0){
                        echo $this->updateFriend($friend, $this->user->id, $data['id_friend'], '34');
                    }else{
                        echo $this->addFriend($friend, $this->user->id, $data['id_friend'], '34');
                    }
                    break;

                case "request_delete_confirm_friend":
                    echo $this->deleteFriend($friend, $this->user->id, $data['id_friend']);
                    break;

                case "request_delete_friend":
                         $this->deleteFriend($friend, $this->user->id, $data['id_friend']);
                         $this->deleteFriend($friend, $data['id_friend'], $this->user->id);
                         echo 1;
                    break;

                default:
                    break;
            }
        }

    }


    public  function loadItemStatus2($id_status_slug){
        $post= Post::find($id_status_slug);
        $listStatusPost=Option::orderBy('name','ASC')->where('name','=','post_privacy')->get();
        $user_author=$post->author;
        $userAuth=array();
        if(Auth::check()){
            $user_auth = Auth::user();
            $userAuth['id']=$user_auth->id;

            $isLike=$post->userAction()->where('post_user_type_id','=','31')->where('user_id','=',$user_auth->id)->count();

            $userAuth['like_content']='Thích';
            $userAuth['avatar']=$user_auth->avatar;
            $userAuth['type_action_like']='type_action_like';
            if($isLike!=0){
                $userAuth['like_content']='Đã thích';
                $userAuth['type_action_like']='type_action_dislike';
            }

        }

        $userAuthor['username']=$user_author->username;
        $userAuthor['avatar']=$user_author->avatar;
        $userAuthor['level']=Option::find($user_author->level_id)->description;
        $userAuthor['id']=$user_author->id;

        $postIn['id']=$post->id;
        $postIn['content']=$post->content;
        $postIn['privacy']=$post->privacy;
        $postIn['number_like']=$post->userAction()->where('post_user_type_id','=','31')->count();
        $postIn['privacy_description']=Option::find($post->privacy)->description;
        $postIn['privacy_id']=$post->privacy;
        $postIn['comment']=$this->loadComment($post->id);
        $postIn['number_comment']=$post->comments()->count();
        if($post->updated_at!='0000-00-00 00:00:00'){
           // $postIn['post_date']=date_format($post->updated_at,'d-m').' lúc '.date_format($post->updated_at,'H:i');//date_format($post->updated_at,'d-m-Y lúc H:i');
            $postIn['post_date']=String::showTimeAgo($post->updated_at());
            $postIn['post_type_user']='Đã cập nhật trạng thái :';
        }else{
            //$postIn['post_date']=date_format($post->created_at,'d-m').' lúc '.date_format($post->created_at,'H:i');
            $postIn['post_date']=String::showTimeAgo($post->created_at());
            $postIn['post_type_user']='Đã đăng trạng thái  :';
        }
            return View::make('site.user.blog.item_status_blog',compact('userAuthor','userAuth','listStatusPost','postIn'));
    }


    public function loadComment($id_comment_post_slug){
      //  $listCommentPost=Post::where('parent_id','=',$id_comment_post_slug)->where('post_type','=','comment')->get();
        $post=Post::find($id_comment_post_slug);
        $listCommentPost=$post->comments()->get();
        $listCommentPost_ok=array();
        foreach($listCommentPost as $item){
            $user_item=$item->author()->get()->first();
            $item['avatar_user']=$user_item->avatar;
            $item['username']=$user_item->username;
            $date=new DateTime($item->created_at);
            $item['updated_at_2']= String::showTimeAgo($item->created_at());//date_format($date,'H:i d-m-Y');
            $item['id_comment']=$item->id;
            $item['id_user']=$user_item->id;
            $item['content']=$item->content;
            $listCommentPost_ok []= $item;
        }
        return View::make('site.partials.itemComment',compact('listCommentPost_ok'));
    }
    /*
     *load bai review người dùng trả về html của một bài review
     * ***/
    public function loadReviewLocation($id){

        $post= Review::find($id);
        $listStatusPost=Option::orderBy('name','ASC')->where('name','=','post_privacy')->get();
        $user_author=$post->author;

        $userAuth=array();
        if(Auth::check()){
            $user_auth = Auth::user();
            $userAuth['id']=$user_auth->id;

            $isLike=$post->userAction()->where('post_user_type_id','=','31')->where('user_id','=',$user_auth->id)->count();

            $userAuth['like_content']='Thích';
            $userAuth['avatar']=$user_auth->avatar;
            $userAuth['type_action_like']='type_action_like';
            if($isLike!=0){
                $userAuth['like_content']='Đã thích';
                $userAuth['type_action_like']='type_action_dislike';
            }

        }



        $userAuthor['username']=$user_author->username;
        $userAuthor['avatar']=$user_author->avatar;
        $userAuthor['level']=Option::find($user_author->level_id)->description;
        $userAuthor['id']=$user_author->id;

        $postIn['id']=$post->id;
        $postIn['content']=$post->content;
        $postIn['privacy']=$post->privacy;
        $postIn['number_like']=$post->userAction()->where('post_user_type_id','=','31')->count();
        $postIn['privacy_description']='Cộng đồng';//Option::find($post->privacy)->description;
        $postIn['privacy_id']=$post->privacy;
        $postIn['comment']=$this->loadComment($post->id);
        $postIn['number_comment']=$post->comments()->count();
      //  echo $post->id;

        if($post->updated_at!='0000-00-00 00:00:00'){
            // $postIn['post_date']=date_format($post->updated_at,'d-m').' lúc '.date_format($post->updated_at,'H:i');//date_format($post->updated_at,'d-m-Y lúc H:i');
            $postIn['post_date']=String::showTimeAgo($post->updated_at());
            $postIn['post_type_user']='Đã cập nhật trạng thái :';
        }else{
            //$postIn['post_date']=date_format($post->created_at,'d-m').' lúc '.date_format($post->created_at,'H:i');
            $postIn['post_date']=String::showTimeAgo($post->created_at());
            $postIn['post_type_user']='Đã đăng trạng thái  :';
        }
        $review=Review::find($id);
        return View::make('site.user.blog.item_status_review',compact('userAuthor','userAuth','listStatusPost','postIn','review'));
    }

    /**
     * Load checin của người dùng từng trả vè html của bài checkin
     *
    */
    public function loadCheckIn($id_check_in){


       $post_check_in=Checkin::find($id_check_in);
       $location=$post_check_in->location();


        $album_location=$location->album()->get();

        $listStatusPost=Option::orderBy('name','ASC')->where('name','=','post_privacy')->get();
        $user_author=$post_check_in->author;

        $userAuth=array();
        if(Auth::check()){
            $user_auth = Auth::user();
            $userAuth['id']=$user_auth->id;

            $isLike=$post_check_in->userAction()->where('post_user_type_id','=','31')->where('user_id','=',$user_auth->id)->count();

            $userAuth['like_content']='Thích';
            $userAuth['avatar']=$user_auth->avatar;
            $userAuth['type_action_like']='type_action_like';
            if($isLike!=0){
                $userAuth['like_content']='Đã thích';
                $userAuth['type_action_like']='type_action_dislike';
            }

        }



        $userAuthor['username']=$user_author->username;
        $userAuthor['avatar']=$user_author->avatar;
        $userAuthor['level']=Option::find($user_author->level_id)->description;
        $userAuthor['id']=$user_author->id;
        $userAuthor['text_status']='đã đến địa điểm này';


        $postIn['id']=$post_check_in->id;
        $postIn['content']=$post_check_in->content;
        $postIn['privacy']=$post_check_in->privacy;
        $postIn['number_like']=$post_check_in->userAction()->where('post_user_type_id','=','31')->count();
        $postIn['privacy_description']='Cộng đồng';//Option::find($post->privacy)->description;
        $postIn['privacy_id']=$post_check_in->privacy;
        $postIn['comment']=$this->loadComment($post_check_in->id);
        $postIn['number_comment']=$post_check_in->comments()->count();
        //  echo $post->id;

        if($post_check_in->updated_at!='0000-00-00 00:00:00'){
            // $postIn['post_date']=date_format($post->updated_at,'d-m').' lúc '.date_format($post->updated_at,'H:i');//date_format($post->updated_at,'d-m-Y lúc H:i');
            $postIn['post_date']=String::showTimeAgo($post_check_in->updated_at());
            $postIn['post_type_user']='Đã cập nhật trạng thái :';
        }else{
            //$postIn['post_date']=date_format($post->created_at,'d-m').' lúc '.date_format($post->created_at,'H:i');
            $postIn['post_date']=String::showTimeAgo($post_check_in->created_at());
            $postIn['post_type_user']='Đã đăng trạng thái  :';
        }
        $review=$post_check_in;


        return View::make('site.user.blog.item_status_checkin',compact('userAuthor','userAuth','listStatusPost','postIn','review','location','album_location'));

    }
    /*load item check in location by id location id user*/
    public function loadCheckInByLocation($id_check_in,$id_user){


        $location=Location::find($id_check_in);
        $post_check_in=Checkin::where('parent_id','=',$location->id)->where('user_id','=',$id_user)->first();
        if(isset($post_check_in)){

        $album_location=$location->album()->get();
        $listStatusPost=Option::orderBy('name','ASC')->where('name','=','post_privacy')->get();

        $user_author=$post_check_in->author;

        $userAuth=array();
        if(Auth::check()){
            $user_auth = Auth::user();
            $userAuth['id']=$user_auth->id;

            $isLike=$post_check_in->userAction()->where('post_user_type_id','=','31')->where('user_id','=',$user_auth->id)->count();

            $userAuth['like_content']='Thích';
            $userAuth['avatar']=$user_auth->avatar;
            $userAuth['type_action_like']='type_action_like';
            if($isLike!=0){
                $userAuth['like_content']='Đã thích';
                $userAuth['type_action_like']='type_action_dislike';
            }

        }



        $userAuthor['username']=$user_author->username;
        $userAuthor['avatar']=$user_author->avatar;
        $userAuthor['level']=Option::find($user_author->level_id)->description;
        $userAuthor['id']=$user_author->id;
        $userAuthor['text_status']='Đã đến địa điểm này';


        $postIn['id']=$post_check_in->id;
        $postIn['content']=$post_check_in->content;
        $postIn['privacy']=$post_check_in->privacy;
        $postIn['number_like']=$post_check_in->userAction()->where('post_user_type_id','=','31')->count();
        $postIn['privacy_description']='Cộng đồng';//Option::find($post->privacy)->description;
        $postIn['privacy_id']=$post_check_in->privacy;
        $postIn['comment']=$this->loadComment($post_check_in->id);
        $postIn['number_comment']=$post_check_in->comments()->count();
        //  echo $post->id;

        if($post_check_in->updated_at!='0000-00-00 00:00:00'){
            // $postIn['post_date']=date_format($post->updated_at,'d-m').' lúc '.date_format($post->updated_at,'H:i');//date_format($post->updated_at,'d-m-Y lúc H:i');
            $postIn['post_date']=String::showTimeAgo($post_check_in->updated_at());
            $postIn['post_type_user']='Đã cập nhật trạng thái :';
        }else{
            //$postIn['post_date']=date_format($post->created_at,'d-m').' lúc '.date_format($post->created_at,'H:i');
            $postIn['post_date']=String::showTimeAgo($post_check_in->created_at());
            $postIn['post_type_user']='Đã đăng trạng thái  :';
        }
        $review=$post_check_in;


        return View::make('site.user.blog.item_status_checkin',compact('userAuthor','userAuth','listStatusPost','postIn','review','location','album_location'));
        }
    }

    /* load item end*/




    /**
     * Load checin của người dùng từng trả vè html của bài checkin tag hoạt động
     *
     */
    public function loadLikeLocation($id_like_location){


        $post_like_location=Status::find($id_like_location);
        $location=Location::find($post_like_location->parent_id);
        $album_location=$location->album()->get();

        $listStatusPost=Option::orderBy('name','ASC')->where('name','=','post_privacy')->get();
        $user_author=$post_like_location->author;

        $userAuth=array();
        if(Auth::check()){
            $user_auth = Auth::user();
            $userAuth['id']=$user_auth->id;

            $isLike=$post_like_location->userAction()->where('post_user_type_id','=','31')->where('user_id','=',$user_auth->id)->count();

            $userAuth['like_content']='Thích';
            $userAuth['avatar']=$user_auth->avatar;
            $userAuth['type_action_like']='type_action_like';
            if($isLike!=0){
                $userAuth['like_content']='Đã thích';
                $userAuth['type_action_like']='type_action_dislike';
            }

        }



        $userAuthor['username']=$user_author->username;
        $userAuthor['avatar']=$user_author->avatar;
        $userAuthor['level']=Option::find($user_author->level_id)->description;
        $userAuthor['id']=$user_author->id;
        $userAuthor['text_status']='đã thích địa điểm này';

        $postIn['id']=$post_like_location->id;
        $postIn['content']=$post_like_location->content;
        $postIn['privacy']=$post_like_location->privacy;
        $postIn['number_like']=$post_like_location->userAction()->where('post_user_type_id','=','31')->count();
        $postIn['privacy_description']='Cộng đồng';//Option::find($post->privacy)->description;
        $postIn['privacy_id']=$post_like_location->privacy;
        $postIn['comment']=$this->loadComment($post_like_location->id);
        $postIn['number_comment']=$post_like_location->comments()->count();
        //  echo $post->id;

        if($post_like_location->updated_at!='0000-00-00 00:00:00'){
            // $postIn['post_date']=date_format($post->updated_at,'d-m').' lúc '.date_format($post->updated_at,'H:i');//date_format($post->updated_at,'d-m-Y lúc H:i');
            $postIn['post_date']=String::showTimeAgo($post_like_location->updated_at());
            $postIn['post_type_user']='Đã cập nhật trạng thái :';
        }else{
            //$postIn['post_date']=date_format($post->created_at,'d-m').' lúc '.date_format($post->created_at,'H:i');
            $postIn['post_date']=String::showTimeAgo($post_like_location->created_at());
            $postIn['post_type_user']='Đã đăng trạng thái  :';
        }
        $review=$post_like_location;


        return View::make('site.user.blog.item_status_checkin',compact('userAuthor','userAuth','listStatusPost','postIn','review','location','album_location'));

    }


    /**---------end Load checin   */


    /**
     * Load checin của người dùng từng trả vè html của bài checkin tag hoạt động
     *
     */
    public function loadLocationLike_2($id_like_location,$id){



        $location=Location::find($id_like_location);



        return View::make('site.user.blog.item_tab_like_location',compact('location'));

    }


    /**---------end Load checin   */



    public function filterFriends($listFriend){

        $list_id_friend_my=array();
        $list_id_friend_my2=array();

            foreach($listFriend as $item){
             //   echo $item->user_id.'->'.$item->friend_id.'<br>';


                if($item->friend_id==$this->user->id){
                    $list_id_friend_my[]=$item->user_id;

                }else{
                    $list_id_friend_my[]=$item->friend_id;
                }


                if($item->user_id==$this->user->id){
                  //  $list_id_friend_my[]=$item->friend_id;
                }else{
                   $list_id_friend_my[]=$item->user_id;
                }
            }
            foreach($list_id_friend_my as $item){
                if(!in_array($item,$list_id_friend_my2) && $item!=$this->user->id){
                    $list_id_friend_my2[]=$item;
                }
            }

        return $list_id_friend_my2;
        }

    public function filterFriends_byBlog($listFriend,$id){
        $list_id_friend_my=array();
        $list_id_friend_my2=array();

        foreach($listFriend as $item){
            if($item->friend_id == $this->blogUser->id){
                $list_id_friend_my[]=$item->user_id;
            }else{
                $list_id_friend_my[]=$item->friend_id;
            }


            if($item->user_id==$this->blogUser->id){
                //  $list_id_friend_my[]=$item->friend_id;
            }else{
                $list_id_friend_my[]=$item->user_id;
            }
        }

        foreach($list_id_friend_my as $item){
            if((!in_array($item,$list_id_friend_my2) )){

                if($item!=$id){
                    $list_id_friend_my2[]=$item;
                }

            }



        }



        return $list_id_friend_my2;
    }

    public function filterMutualFriend($user_1,$user_2){

            $list_friend_user_1=$user_1->friends()->get();
            $list_id_friend_user_1=$this->filterFriends($list_friend_user_1);
            $list_friend_user_2=$user_2->friends()->get();
            $list_id_friend_user_2=$this->filterFriends($list_friend_user_2);
            $list_id_friend_mutual=array();
            $list_item_friend_mutual=array();
            foreach($list_id_friend_user_1 as $item){
                if(in_array($item,$list_id_friend_user_2)){
                    $user_tam=User::where('id','=',$item)->first();
                    $list_id_friend_mutual[]=$user_tam->id;
                    $list_item_friend_mutual[]=$user_tam;
                }
            }
            $kq['list_id_friend_mutual']=$list_id_friend_mutual;
            $kq['list_item_friend_mutual']=$list_item_friend_mutual;

            return $kq;

        }

    public function ala($id_status_slug){
        echo $id_status_slug;
        $post_like=Post::where('id','=',131);

     //   $post= Post::where('id','=',$id_status_slug)->get()->first();
            echo '<pre>';
          print_r($post_like);
        echo '</pre>';


    }

}
