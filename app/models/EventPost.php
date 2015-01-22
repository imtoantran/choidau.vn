<?php

use Illuminate\Support\Facades\URL;

class EventPost extends Post {
	protected $table = "posts";
	protected $attributes = array(
		'post_type' => 'event'
	);


	/**
	 * @param bool $excludeDeleted
	 * @return mixed
     */
	public function newQuery($excludeDeleted = true)
	{
		return parent::newQuery()->wherePost_type("event");
	}
}