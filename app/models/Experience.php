<?php

use Illuminate\Support\Facades\URL;

class Experience extends Post {
	protected $table = "posts";
	protected $attributes = array(
		'post_type' => 'experience'
	);


	/**
	 * @param bool $excludeDeleted
	 * @return mixed
     */
	public function newQuery($excludeDeleted = true)
	{
		return parent::newQuery()->wherePost_type("experience");
	}
}