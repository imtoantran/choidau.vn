<?php

use Illuminate\Support\Facades\URL;

class Share extends Post {
	protected $table = "posts";
	protected $attributes = array(
		'post_type' => 'share'
	);


	/**
	 * @param bool $excludeDeleted
	 * @return mixed
     */
	public function newQuery($excludeDeleted = true)
	{
		return parent::newQuery()->wherePost_type("share");
	}
}