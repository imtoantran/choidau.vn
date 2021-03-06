<?php

class HomeController extends BaseController
{

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

    /**
     * Inject the models.
     * @param Post $post
     * @param User $user
     */
    public function __construct(Blog $blog, Post $post, User $user)
    {
        parent::__construct();

        $this->post = $post;
        $this->user = $user;
        $this->blog = $blog;
    }

    /**
     * Returns all the blog posts.
     *
     * @return View
     */
    public function getIndex()
    {
        // Show the page
        $page_title = 'Địa điểm ăn uống chơi';
//		$locations = Location::with("category")->get();
        $categories = Category::whereIn("slug", ["an", "uong", "di"])->get();
        /* top review start */
//        if (!Cache::has("topReview")) {
            $topReview = Review::has("location")->orderBy("created_at", "desc")->first();
            $topReview['location'] = Location::whereId($topReview->parent_id)->first();
//            Cache::put("topReview", $topReview, 120);
//        }
//        $topReview = Cache::get("topReview");

        /* top review start */
        /* top location start */
        if (!Cache::has("topLocation")) {
            $topLocation = Location::orderBy("created_at", "desc")->first();
            Cache::put("topLocation", $topLocation, 120);
        }
        $topLocation = Cache::get("topLocation");

        /* top location end */
        /* top post start */
        $topBlog = $this->blog->wherePostType("blog")->orderBy("created_at", "desc")->first();
        /* top post end */
        $blogs = Category::whereSlug("danh-muc-bai-viet")->first()->allBlogs()->take(4)->get();;
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
        $facebook_like_box = Social::whereType('facebook-like-box')->first();
        return View::make('site/home/index', compact('page_title', 'categories', 'topReview', 'topLocation', 'topBlog', 'blogs','facebook_like_box'));
    }

    /**
     * View a blog post.
     *
     * @param  string $slug
     * @return View
     * @throws NotFoundHttpException
     */
    public function getView($slug)
    {
        // Get this blog post data
        $post = $this->post->where('slug', '=', $slug)->first();

        // Check if the blog post exists
        if (is_null($post)) {
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
        if (!empty($user)) {
            $canComment = $user->can('post_comment');
        }

        // Show the page
        return View::make('site/blog/view_post', compact('post', 'comments', 'canComment'));
    }

    /**
     * View a blog post.
     *
     * @param  string $slug
     * @return Redirect
     */
    public function postView($slug)
    {

        $user = $this->user->currentUser();
        $canComment = $user->can('post_comment');
        if (!$canComment) {
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
        if ($validator->passes()) {
            // Save the comment
            $comment = new Comment;
            $comment->user_id = Auth::user()->id;
            $comment->content = Input::get('comment');

            // Was the comment saved with success?
            if ($post->comments()->save($comment)) {
                // Redirect to this blog post page
                return Redirect::to($slug . '#comments')->with('success', 'Your comment was added with success.');
            }

            // Redirect to this blog post page
            return Redirect::to($slug . '#comments')->with('error', 'There was a problem adding your comment, please try again.');
        }

        // Redirect to this blog post page
        return Redirect::to($slug)->withInput()->withErrors($validator);
    }
}
