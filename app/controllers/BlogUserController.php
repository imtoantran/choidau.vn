<?php

/**
 * Class BlogController
 * @author imtoantran
 * blog page of admin
 */
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
		$this->user = $user;
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
        $user = Auth::user();
        $blogUser=$user->blog()->first();

        $blogList=array(
            'name'=>$blogUser->name,
            'background'=>$blogUser->background,
            'avatar'=>$user->avatar
        );
        if(empty($user->id)){
            return Redirect::to('user');
        }


        $style_plugin=$this->Style(array(
            'assets/global/plugins/jquery-file-upload/blueimp-gallery/blueimp-gallery.min.css',
            'assets/global/plugins/jquery-file-upload/css/jquery.fileupload.css',
            'assets/global/plugins/jquery-file-upload/css/jquery.fileupload-ui.css',
            'assets/global/plugins/jquery-file-upload/css/image-manager.min.css'

        ));
        $style_page=$this->Style(array('assets/global/css/plugins.css','assets/global/plugins/image-manager/css/image-manager.min.css'));


        $js_plugin=$this->JScript(array(
            'assets/global/plugins/image-manager/js/image-manager1.js',
            'assets/global/plugins/image-manager/spaCMS_settings1.js',
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
        $js_page=$this->JScript(array('assets/admin/pages/scripts/form-fileupload.js'));
        $js_script='
                FormFileUpload.init();
        ';




        if($user->username!=$user_slug){

        }
        $listStatusPost=Option::orderBy('name','ASC')->where('name','=','post_privacy')->get();
       return View::make('site.user.blog.index',compact('user','listStatusPost','blogList','style_plugin','style_page','js_plugin','js_page','js_script'));



		//$user_ = $this->user->whereSlug($user_slug)->first();
		// Get all the blog posts
	//	$posts = $this->post->whereCategory_id($cat->id)->orderBy('created_at', 'DESC')->paginate(10);

		// Show the page
	//	return View::make('site/blog/index', compact('posts'));
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
        $user = Auth::user();
        $this->blogUser=$user->blog()->first();

        $data=Input::all();
      //  $type_edit=$data['type_edit'];
        if(Request::ajax())
        {
            $post =new Post();
            $post->title="status";
            $post->content=$data['content'];
            $post->privacy =$data['privacy'];
            $post->post_type='status';
            $post->user_id=$user->id;
            $post->save();


        }


    }

    public function getEditBlogUser(){
      //  $data=Input::all();

      //  $this->blogUser->background=$data['background'];
    //    $this->blogUser->save();
echo'ádasdasd';

    }

    public  function loadItemStatus($id_status_slug){

        $post= Post::find($id_status_slug);

      //  echo '<pre>';
      //  print_r($post);
      //  echo '</pre>';

        // $user=User::find($post->user_id);

        $listStatusPost=Option::orderBy('name','ASC')->where('name','=','post_privacy')->get();

         $user=$post->author;
         $userIn['username']=$user->username;
         $userIn['avatar']=$user->avatar;
       //  $userIn['level']=Option::find($user->level_id)->description;
         $userIn['level']=$post->status;

          $postIn['content']=$post->content;
          $postIn['privacy']=$post->privacy;
          $postIn['number_like']='';




        echo View::make('site.partials.itemStatus',compact('userIn','listStatusPost','postIn'));

    }



}
