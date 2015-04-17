<?php

class PostController extends BaseController {

	/**
	 * Post Model
	 * @var Post
	 */
	protected $post;

	/**
	 * Inject the models.
	 * @param Post $post
	 */
	public function __construct(Post $post)
	{
		parent::__construct();
		$this->post = $post;
	}
	/**
	 * Show a list of all the blog posts.
	 *
	 * @return View
	 */
	public function getIndex()
	{
		// Grab all the blog posts
		$posts = $this->post->get();

		// Show the page
		return View::make('post/index',compact('posts'));
	}

	/**
	 * Show the form for creating a new resource.
	 *
	 * @return Response
	 */
	public function getCreate()
	{
		// Title
		//$title = Lang::get('admin/blogs/title.create_a_new_blog');
		$title = "Đăng bài viết";

		// Show the page
		return View::make('post/create_edit', compact('title'));
	}

	/**
	 * Store a newly created resource in storage.
	 *
	 * @return Response
	 */
	public function postCreate()
	{
		// Declare the rules for the form validation
		$rules = array(
			'title'   => 'required|min:3',
			'content' => 'required|min:3'
		);

		// Validate the inputs
		$validator = Validator::make(Input::all(), $rules);

		// Check if the form validates with success
		if ($validator->passes())
		{
			// Create a new blog post
			$user = Auth::user();

			// Update the blog post data
			$this->post->title            = Input::get('title');
			$this->post->slug             = Str::slug(Input::get('title'));
			$this->post->content          = Input::get('content');
			$this->post->meta_title       = Input::get('meta-title');
			$this->post->meta_description = Input::get('meta-description');
			$this->post->meta_keywords    = Input::get('meta-keywords');
			$this->post->user_id          = $user->id;

			// Was the blog post created?
			if($this->post->save())
			{
				// Redirect to the new blog post page
				//return Redirect::to('admin/blogs/' . $this->post->id . '/edit')->with('success', Lang::get('admin/blogs/messages.create.success'));
			}

			// Redirect to the blog post create page
			//return Redirect::to('admin/blogs/create')->with('error', Lang::get('admin/blogs/messages.create.error'));
		}

		// Form validation failed
		return Redirect::to('post/image/create')->withInput()->withErrors($validator);
	}

	/**
	 * Display the specified resource.
	 *
	 * @param $post
	 * @return Response
	 */
	public function getShow($post)
	{
		// redirect to the frontend
	}

	/**
	 * Show the form for editing the specified resource.
	 *
	 * @param $post
	 * @return Response
	 */
	public function getEdit($post)
	{
		// Title
		$title = Lang::get('admin/blogs/title.blog_update');
		// Show the page
		return View::make('admin/blogs/create_edit', compact('post', 'title'));
	}

	/**
	 * Update the specified resource in storage.
	 *
	 * @param $post
	 * @return Response
	 */
	public function postEdit($post)
	{

		// Declare the rules for the form validation
		$rules = array(
			'title'   => 'required|min:3',
			'content' => 'required|min:3'
		);

		// Validate the inputs
		$validator = Validator::make(Input::all(), $rules);

		// Check if the form validates with success
		if ($validator->passes())
		{
			// Update the blog post data
			$post->title            = Input::get('title');
			$post->slug             = Str::slug(Input::get('title'));
			$post->content          = Input::get('content');
			$post->meta_title       = Input::get('meta-title');
			$post->meta_description = Input::get('meta-description');
			$post->meta_keywords    = Input::get('meta-keywords');

			// Was the blog post updated?
			if($post->save())
			{
				// Redirect to the new blog post page
				return Redirect::to('admin/blogs/' . $post->id . '/edit')->with('success', Lang::get('admin/blogs/messages.update.success'));
			}

			// Redirect to the blogs post management page
			return Redirect::to('admin/blogs/' . $post->id . '/edit')->with('error', Lang::get('admin/blogs/messages.update.error'));
		}

		// Form validation failed
		return Redirect::to('admin/blogs/' . $post->id . '/edit')->withInput()->withErrors($validator);
	}


	/**
	 * Remove the specified resource from storage.
	 *
	 * @param $post
	 * @return Response
	 */
	public function getDelete($post)
	{
		// Title
		$title = Lang::get('admin/blogs/title.blog_delete');

		// Show the page
		return View::make('admin/blogs/delete', compact('post', 'title'));
	}

	/**
	 * Remove the specified resource from storage.
	 *
	 * @param $post
	 * @return Response
	 */
	public function postDelete($post)
	{
		// Declare the rules for the form validation
		$rules = array(
			'id' => 'required|integer'
		);

		// Validate the inputs
		$validator = Validator::make(Input::all(), $rules);

		// Check if the form validates with success
		if ($validator->passes())
		{
			$id = $post->id;
			$post->delete();

			// Was the blog post deleted?
			$post = Post::find($id);
			if(empty($post))
			{
				// Redirect to the blog posts management page
				return Redirect::to('admin/blogs')->with('success', Lang::get('admin/blogs/messages.delete.success'));
			}
		}
		// There was a problem deleting the blog post
		return Redirect::to('admin/blogs')->with('error', Lang::get('admin/blogs/messages.delete.error'));
	}

	/**
	 * Show a list of all the blog posts formatted for Datatables.
	 *
	 * @return Datatables JSON
	 */
	public function getData()
	{
		$posts = Post::select(array('posts.id', 'posts.title', 'posts.id as comments', 'posts.created_at'));

		return Datatables::of($posts)

			->edit_column('comments', '{{ DB::table(\'comments\')->where(\'post_id\', \'=\', $id)->count() }}')

			->add_column('actions', '<a href="{{{ URL::to(\'admin/blogs/\' . $id . \'/edit\' ) }}}" class="btn btn-default btn-xs iframe" >{{{ Lang::get(\'button.edit\') }}}</a>
                <a href="{{{ URL::to(\'admin/blogs/\' . $id . \'/delete\' ) }}}" class="btn btn-xs btn-danger iframe">{{{ Lang::get(\'button.delete\') }}}</a>
            ')

			->remove_column('id')

			->make();
	}

    public function getView(){
    // echo Image::find(20)->meta()->whereMeta_key('url')->first()->meta_value;
        $img=Image::find(20);
        echo $img->content;
      //  echo $img->getUrc();
      //  echo $img->_img_src;
        echo $img->getMetaKey('url');
    }

    /**
     *
     * chức năng like dislike spam**/
    public function userActionClickPost(){
        $data=Input::all();
        $user=Auth::user();
        $date=date_create("now");
        $date=  date_format($date,"Y-m-d H:i:s");
        $type_action=$data['type_action'];
        $post_like=Post::where('id','=',$data['id_post'])->first();
        $count = $post_like->userAction()->whereUser_id($user->id)->wherePost_user_type_id($type_action)->count();


        $isLike=0;
        if($count){
            $post_like->userAction()->detach($user,['post_user_type_id'=>$type_action]);

        }else{
            $isLike=1;
            $post_like->userAction()->attach($user,['post_user_type_id'=>$type_action,'created_at'=>$date]);
        }

        $number_like=$post_like->userAction()->wherePost_user_type_id($type_action)->count();
        echo json_encode(array('is_like'=>$isLike,'number_like'=>$number_like));

    }

	/* imtoantran social action start */
	public function social($post){
		if(Auth::guest())
			return Response::json(["success"=>false,"message"=>"Need login"]);
		$user = Auth::user();
		$params = Input::all();
		if(!in_array($params['action'],['like','spam'])){
			return Response::json(["success"=>false]);
		}
		$meta = $post->meta()->whereMetaKey($params['action'])->whereMetaValue($user->id);
		if($meta->count()){
			if($meta->delete()){
				return Response::json(["success"=>true,"value"=>false,"totalLikes"=>$post->totalLikes()]);
			}
		}else{
			$meta = new PostMeta($params['action'],$user->id);
			$post->meta()->save($meta);
			return Response::json(["success"=>true,"value"=>true,"totalLikes"=>$post->totalLikes()]);
		}
		return Response::json(["success"=>false]);
	}
	/* imtoantran social action stop */
	/* imtoantran save comment start */
	public function postComments($post){
		if(Auth::guest()){
			return Response::json(["success"=>false,"message"=>"Need login"]);
		}
		if(Input::has("content")){
			$user = Auth::user();
			$comment = new Comment();
			$comment -> user_id = $user->id;
			$comment -> parent_id = $post->id;
			$comment -> content = Input::get("content");
			if($comment -> save()){
				return Response::json(["totalComments"=>$post->comments()->count(),"success"=>true,"content"=>View::make("post.comment_item",compact("comment"))->render()]);
			};
		}
		return Response::json(["success"=>false,"message"=>"Not saved"]);
	}
	/* imtoantran save comment stop */
	/* imtoantran load comment start */
	public function getComments($post){
		/* imtoantran comments start*/
		$t = $post->post_type;
		$$t = $post;
		return Response::json(["success"=>true,"content"=>View::make("post.comment",compact($t))->render()]);
	}
	/* imtoantran load comment stop */

}