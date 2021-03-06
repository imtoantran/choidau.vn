<?php

class AdminBlogsController extends AdminController
{
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
    public function __construct(Blog $post, PostMeta $post_meta)
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
        return $this->blogCategory("all");
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
        $page_name = "Quản lý blog bài viết";
        $categories = Category::whereSlug("danh-muc-bai-viet")->first()->children()->get();
        if($slug == 'all'){
            $catId = 'all';
            // Title
            $title = "Tất cả danh mục";
        }else{
            $category = Category::whereSlug($slug)->first();
            $catId = $category->id;
            // Title
            $title = "Danh mục: " . $category->name;
        }



        // Show the page
        return View::make('admin/blogs/index', compact('title', 'page_name', 'slug', 'categories', 'catId'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return Response
     */
    public function getCreate($catId)
    {
        $page_name = 'Quản lý bài viêt';
        $detail_name_page = 'Tạo bài viết';
        $page_icon = 'icon-pen';
        $url_page= $catId;
        $name_page='Setting - blog';

        // Show the page
        return View::make('admin/blogs/create', compact('page_name', 'detail_name_page', 'page_icon', 'url_page', 'name_page','catId'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @return Response
     */
    public function postCreate()
    {
        $user = Auth::user();

        // Update the blog post data
        $this->post->title = Input::get('title');
        $this->post->slug = Str::slug(Input::get('title'));
        $this->post->content = Input::get('content_tiny');
        $this->post->meta_title = Input::get('meta-title');
        $this->post->meta_description = Input::get('meta-description');
        $this->post->meta_keywords = Input::get('meta-keywords');
        $this->post->user_id = $user->id;
        $this->post->category_id = Input::get("catId");

        // Was the blog post created?
        if ($this->post->save()) {
            if (Input::has("featured_post")) {
                $meta = new PostMeta("featured_post", Input::get("featured_post"));
                $this->post->meta()->save($meta);
            } else {
                $meta = new PostMeta("featured_post", false);
                $this->post->meta()->save($meta);
            }
            $post_meta = new PostMeta("featured_image", Input::get("featured_image"));
            $this->post->meta()->save($post_meta);

            echo $this->post->id;
        }else{
            echo -1;
        }
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
        /* featured post start */
        $featured_post = false;
        $temp_value = $post->meta()->whereMetaKey("featured_post");
        if ($temp_value->count()) {
            $featured_post = $temp_value->first()->meta_value;
        }

        $featured_image = $post->getFeaturedImage();
        return View::make('admin/blogs/edit', compact('post', 'title', 'featured_image', 'featured_post'));
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
//
        $data = Input::all();
//        // Validate the inputs
        parse_str($data['form'],$form);
//        echo json_encode($form); exit;
            // Update the blog post data
            $post->title =$form['title'];
            $post->slug = Str::slug($form['title']);
            $post->content = $data['content_tiny'];
            $post->meta_title = $form['meta-title'];
            $post->meta_description = $form['meta-description'];
            $post->meta_keywords = $form['meta-keywords'];

            // Was the blog post updated?
            if ($post->save()) {
                /* featured post start */
                $meta = $post->meta()->whereMetaKey("featured_post")->first();
                $is_featured_post = isset($form['featured_post'])? 1 : 0;
                if (isset($meta)) {
                    $meta->meta_value = $is_featured_post;
                    $meta->save();
                } else {
                    $meta = new PostMeta("featured_post", $is_featured_post);
                    $post->meta()->save($meta);
                }
                /* featured post stop */
                /* featured image start */
                $meta = $post->meta()->whereMetaKey("featured_image")->first();
                if (!empty($form['featured_image'])) {
                    if (isset($meta)) {
                        $meta->meta_value = $form['featured_image'];
                        $meta->save();
                    } else {
                        $meta = new PostMeta("featured_image", $form['featured_image']);
                        $post->meta()->save($meta);
                    }
                }
                /* featured image stop */
                // Redirect to the new blog post
                echo 1;
//                return Redirect::to('qtri-choidau/blog/' . $post->id . '/edit')->with('success', Lang::get('admin/blogs/messages.update.success'));
            }else{
                echo 0;
            }

//            // Redirect to the blogs post management page
//            return Redirect::to('qtri-choidau/blog/' . $post->id . '/edit')->with('error', Lang::get('admin/blogs/messages.update.error'));
//        }
//
////         Form validation failed

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
        if ($validator->passes()) {
            $id = $post->id;
            $post->delete();

            // Was the blog post deleted?
            $post = Post::find($id);
            if (empty($post)) {
                // Redirect to the blog posts management page
                return Response::json(["success" => true, "message" => Lang::get('admin/blogs/messages.delete.success')]);
                return Redirect::to('qtri-choidau/blog')->with('success', Lang::get('admin/blogs/messages.delete.success'));
            }
        }
        // There was a problem deleting the blog post
        return Response::json(["success" => false, "message" => Lang::get('admin/blogs/messages.delete.error')]);
        return Redirect::to('qtri-choidau/blog')->with('error', Lang::get('admin/blogs/messages.delete.error'));
    }

    /**
     * Show a list of all the blog posts formatted for Datatables.
     *
     * @return Datatables JSON
     */
    public function getData($slug = "an-uong-choi")
    {
        if($slug == 'all'){
            $catId = array();
            $catId[] = Category::whereSlug('su-kien')->first()->id;
            $catId[] = Category::whereSlug('an-uong-choi')->first()->id;
            $catId[] = Category::whereSlug('kinh-nghiem')->first()->id;
            $posts = Blog::select(array('posts.id', 'posts.title', 'posts.id as comments', 'posts.created_at'))->whereIn('category_id',$catId);
        }else{
            $catId = Category::whereSlug($slug)->first()->id;
            $posts = Blog::select(array('posts.id', 'posts.title', 'posts.id as comments', 'posts.created_at'))
                ->whereCategory_id($catId);
        }



        return Datatables::of($posts)
            ->edit_column('comments', '{{ DB::table(\'posts\')->where(\'parent_id\', \'=\', $id)->count() }}')
            ->add_column('actions', '<a href="{{{ URL::to(\'qtri-choidau/blog/\' . $id . \'/edit\' ) }}}" class="btn btn-default btn-xs" >{{{ Lang::get(\'button.edit\') }}}</a>
                <a data-controller="{{{ URL::to(\'qtri-choidau/blog/\' . $id . \'/delete\' ) }}}" class="btn btn-xs btn-danger" data-id="{{$id}}" data-action="delete">{{{ Lang::get(\'button.delete\') }}}</a>
            ')
            ->remove_column('id')
            ->make();
    }

}