<?php

class AdminBlogsController extends AdminController {


    /**
     * Post Model
     * @var Post
     */
    protected $post;

    protected $post_meta;

    /**
     * Inject the models.
     * @param Blog $post
     */
    public function __construct(Blog $post,PostMeta $post_meta)
    {
        parent::__construct();
        $this->post = $post;
        $this->post_meta = $post_meta;
    }

    /**
     * Show a list of all the blog posts.
     *
     * @return View
     */
    public function getIndex()
    {
        // Title
        $title = Lang::get('admin/blogs/title.blog_management');

        // Grab all the blog posts
        $posts = $this->post;
        return $this->blogCategory("an-uong-choi");
        // Show the page
        //return View::make('admin/blogs/index', compact('posts', 'title'));
    }

    /**
     * Show a list of all the blog posts.
     *
     * @param $categorySlug
     * @return View
     */
    public function blogCategory($slug = "an-uong-choi")
    {
        $category = Category::whereSlug($slug)->first();
        $catId = $category->id;
        // Title
        $title = "Danh mục: ".$category->name;
        //$posts = $category->blogs()->get();
        $categories = Category::whereSlug("danh-muc-bai-viet")->first()->children()->get();
        $page_name = "Quản lý blog bài viết";
        // Show the page
        return View::make('admin/blogs/index', compact('title','page_name','slug','categories','catId'));
    }

	/**
	 * Show the form for creating a new resource.
	 *
	 * @return Response
	 */
	public function getCreate($catId)
	{
        // Title
        $title = Lang::get('admin/blogs/title.create_a_new_blog');

        // Show the page
        return View::make('admin/blogs/create_edit', compact('title','catId'));
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
            $this->post->category_id      = Input::get("catId");

            // Was the blog post created?
            if($this->post->save())
            {
                if(Input::has("featured_post")){
                    $meta = new PostMeta("featured_post",Input::get("featured_post"));
                    $this->post->meta()->save($meta);
                }else{
                    $meta = new PostMeta("featured_post",false);
                    $this->post->meta()->save($meta);
                }
                $post_meta = new PostMeta("featured_image",Input::get("featured_image"));
                $this->post->meta()->save($post_meta);
                // Redirect to the new blog post page
                return Redirect::to('qtri-choidau/blog/' . $this->post->id . '/edit')->with('success', Lang::get('admin/blogs/messages.create.success'));
            }

            // Redirect to the blog post create page
            return Redirect::to('qtri-choidau/blog/create')->with('error', Lang::get('admin/blogs/messages.create.error'));
        }

        // Form validation failed
        return Redirect::to('qtri-choidau/blog/create')->withInput()->withErrors($validator);
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
        $is_featured_post = false;
        if($post->meta()->whereMetaKey("featured_post")->count()){
            $is_featured_post = $post->meta()->whereMetaKey("featured_post")->first()->meta_value;
        }
        $featured_image_id = $post->meta()->whereMetaKey("featured_image")->first();
        $featured_image = [];
        $title = Lang::get('admin/blogs/title.blog_update');
        if($featured_image_id->count()){
            $featured_image["id"] = isset($featured_image_id->meta_value)?$featured_image_id->meta_value:"";
            $featured_image["src"] = isset(Image::find($featured_image_id->meta_value)->guid)?Image::find($featured_image_id->meta_value)->guid:"";
        }
        // Show the page
        return View::make('admin/blogs/create_edit', compact('post', 'title','featured_image','is_featured_post'));
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
                $meta = $post->meta()->whereMetaKey("featured_post")->first();
                    if (isset($meta)) {
                        $meta->meta_value = Input::get("featured_post");
                        $meta->save();
                    }
                    else{
                        $meta = new PostMeta("featured_post",Input::get("featured_post"));
                        $post->meta()->save($meta);
                    }
                $post_meta = $post->meta()->whereMetaKey("featured_image")->first();
                if(isset($post_meta)){
                    $post_meta->meta_value =Input::get("featured_image");
                    $post_meta->save();
                }
                // Redirect to the new blog post page
                return Redirect::to('qtri-choidau/blog/' . $post->id . '/edit')->with('success', Lang::get('admin/blogs/messages.update.success'));
            }

            // Redirect to the blogs post management page
            return Redirect::to('qtri-choidau/blog/' . $post->id . '/edit')->with('error', Lang::get('admin/blogs/messages.update.error'));
        }

        // Form validation failed
        return Redirect::to('qtri-choidau/blog/' . $post->id . '/edit')->withInput()->withErrors($validator);
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
                return Redirect::to('qtri-choidau/blog')->with('success', Lang::get('admin/blogs/messages.delete.success'));
            }
        }
        // There was a problem deleting the blog post
        return Redirect::to('qtri-choidau/blog')->with('error', Lang::get('admin/blogs/messages.delete.error'));
    }

    /**
     * Show a list of all the blog posts formatted for Datatables.
     *
     * @return Datatables JSON
     */
    public function getData($slug = "an-uong-choi")
    {
        $catId = Category::whereSlug($slug)->first()->id;
        $posts = Blog::select(array('posts.id', 'posts.title', 'posts.id as comments', 'posts.created_at'))
        ->whereCategory_id($catId);
        return Datatables::of($posts)

        ->edit_column('comments', '{{ DB::table(\'posts\')->where(\'parent_id\', \'=\', $id)->count() }}')

        ->add_column('actions', '<a href="{{{ URL::to(\'qtri-choidau/blog/\' . $id . \'/edit\' ) }}}" class="btn btn-default btn-xs" >{{{ Lang::get(\'button.edit\') }}}</a>
                <a href="{{{ URL::to(\'qtri-choidau/blog/\' . $id . \'/delete\' ) }}}" class="btn btn-xs btn-danger iframe">{{{ Lang::get(\'button.delete\') }}}</a>
            ')

        ->remove_column('id')

        ->make();
    }

}