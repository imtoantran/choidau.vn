<?php

/**
 * Class BlogController
 * @author imtoantran
 * blog page of admin
 */
class BlogController extends BaseController {

    /**
     * Post Model
     * @var Post
     */
    protected $post;

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
	public function __construct(User $user,Blog $post,Category $cat)
    {
        parent::__construct();
		$this->user = $user;
		$this->post = $post;
		$this->cat = $cat;
    }

	/**
	 * Returns all the blog posts.
	 *
	 * @param string $catSlug
	 * @return View
	 */
	public function getIndex($catSlug = 'an-uong-choi')
	{
		$blogs = Category::whereSlug("danh-muc-bai-viet")->first()->allBlogs()->take(4)->get();
		$cat = $this->cat->whereSlug($catSlug)->first();
		// Get all the blog posts
		$posts = $this->post->whereCategory_id($cat->id)->orderBy('created_at', 'DESC')->paginate(10);

		// Show the page
		return View::make('site/blog/index', compact('posts','blogs','cat'));
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
		$post = Blog::where('slug', '=', $slug)->first();
		$blogs = Category::whereSlug("danh-muc-bai-viet")->first()->allBlogs()->take(4)->get();

		// Check if the blog post exists
		if (is_null($post))
		{
			// If we ended up in here, it means that
			// a page or a blog post didn't exist.
			// So, this means that it is time for
			// 404 error page.
			return App::abort(404);
		}
		$post -> updateTotalView();
		// Get this post comments
		$comments = $post->comments()->orderBy('created_at', 'DESC')->get()->reverse();

        // Get current user and check permission
        $user = $this->user->currentUser();
        $canComment = false;
        if(!empty($user)) {
            $canComment = $user->can('post_comment');
        }
		// who like this post
		$likeMeta = $post->whoLiked()->orderBy("created_at","desc")->take(3)->get();

		$userIds = [];
		if(is_array($likeMeta)) {
			foreach ($likeMeta as $meta) {
				$userIds[] = $meta->meta_value;
			}
			$likes = User::whereIn("id",$userIds)->get();
		}

		//$post->whoLiked()->get();
		// Show the page
		return View::make('site/blog/view_post', compact('post', 'comments', 'canComment','blogs'));
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
	/* imtoantran save comment start */
	public function postComment(){
		$data = Input::all();
		$user = Auth::user();
		$post = Blog::find($data['id']);
		$comment = new Comment();
		$comment->content = $data['content'];
		$comment->user_id = $user->id;
		$comment->created_at = date_format(new DateTime(),"Y-m-d H:i:s");
		if($post->comments()->save($comment)){
			return json_encode([
				"success"=>true,
				"avatar"=>asset($user->avatar),
				"username"=>$user->username,
				"content"=>$comment->content,
				"date"=>$comment->date(),
			]);
		}
		return json_encode(["success"=>false]);
	}
	public function postLike(){
		$blog = Blog::find(Input::get("id"));
		if(is_null($blog)||Auth::guest()){
			return json_encode(["success"=>false]);
		}
		$meta = new PostMeta("blog_like",Auth::user()->id);
		$blog->meta()->save($meta);
		return json_encode(["success"=>true]);
	}
	public function postUnlike(){
		$blog = Blog::find(Input::get("id"));
		if(is_null($blog)||Auth::guest()){
			return json_encode(["success"=>false]);
		}
		PostMeta::whereMetaKey("blog_like")->whereMetaValue($this->user->currentUser()->id)->delete();
		return json_encode(["success"=>true]);
	}
	/* imtoantran save comment end*/
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
				return Response::json(["totalComments"=>$post->comments()->count(),"success"=>true,"content"=>View::make("site.blog.comment_item",compact("comment"))->render()]);
			};
		}
		return Response::json(["success"=>false,"message"=>"Not saved"]);
	}
}
