<?php

use Illuminate\Support\Facades\URL;

class ImagePost extends Post {
	protected $table = "posts";
	protected $attributes = array(
		'post_type' => 'image'
	);

	/**
	 * Returns the image
	 *
	 * @param bool $excludeDeleted
	 * @return object
	 * @internal param $query
	 */

	public function newQuery($excludeDeleted = true)
	{
		return parent::newQuery()->wherePost_type("image");
	}
}
