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

}
