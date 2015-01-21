<?php

class VideoController extends PostController {

	/**
	 * @param Video $post
     */
	public function __construct(Video $post)
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
		return 'sdfs';
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
		$title = 'Create new video';

		// Show the page
		return View::make('post/videos/create_edit', compact('title'));
	}

}
