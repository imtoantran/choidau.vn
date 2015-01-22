<?php

use Illuminate\Support\Facades\URL;

class Food extends Post {
	protected $table = "posts";
	protected $attributes = array(
		'post_type' => 'blog'
	);


	/**
	 * @param bool $excludeDeleted
	 * @return mixed
     */
	public function newQuery($excludeDeleted = true)
	{
		return parent::newQuery()->wherePost_type("blog");
	}
}