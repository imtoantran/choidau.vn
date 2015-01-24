<?php

class ImageController extends PostController {
	/**
	 * Inject the models.
	 * @param Image|ImagePost|Post $post
	 */
	public function __construct(Image $post)
	{
		parent::__construct($post);
	}

	/**
	 * @param $post
	 * @return Response|void
	 */
	public function getEdit($post)
	{
		{
			// Title
			$title = Lang::get('admin/blogs/title.blog_update');

			// Show the page
			return View::make('post/images/create_edit', compact('post', 'title'));
		}
	}
	public function getIndex(){
		$title = 'sdf';
		return View::make('post/images/index',compact('title'));
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
		$title = 'Create new image';

		// Show the page
		return View::make('post/images/create_edit', compact('title'));
	}
    public  function postCreate(){

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
            //$user = Auth::user();

            $user = User::find(3)->first();
            $data = Input::all();
            $this->post->title            =$data['title'];
            $this->post->slug             =Str::slug( $data['title']);
            $this->post->content          =  $data['content'];
            $this->post->user_id          =  $user->id;
            // Was the blog post created?
            if($this->post->save())
            {
                // Redirect to the new blog post page
                //return Redirect::to('admin/blogs/' . $this->post->id . '/edit')->with('success', Lang::get('admin/blogs/messages.create.success'));
            }

            // Redirect to the blog post create page
            //return Redirect::to('admin/blogs/create')->with('error', Lang::get('admin/blogs/messages.create.error'));
        }

        $postMeta=new PostMeta();
        $postMeta->meta_key='url';
        $postMeta->meta_value=$data['url'];
        $this->post->meta()->save($postMeta);


        // Form validation failed
        return Redirect::to('post/image/create')->withInput()->withErrors($validator);



    }

}
