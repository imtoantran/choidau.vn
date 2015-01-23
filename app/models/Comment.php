<?php

use Illuminate\Support\Facades\URL;

class Comment extends Post {
	protected $table = "posts";
	protected $attributes = array(
		'post_type' => 'comment'
	);

	/**
	 * Returns the video post type
	 * @param bool $excludeDeleted
	 * @return object
	 * @internal param $query
	 * @return object
	 */

	public function newQuery($excludeDeleted = true)
	{
		return parent::newQuery()->wherePost_type("comment");
	}
}
