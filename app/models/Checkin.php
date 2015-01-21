<?php

use Illuminate\Support\Facades\URL;

class Checkin extends Post {
	protected $table = "posts";
	protected $attributes = array(
		'post_type' => 'checkin'
	);

	/**
	 * @param bool $excludeDeleted
	 * @return mixed
     */
	public function newQuery($excludeDeleted = true)
	{
		return parent::newQuery()->wherePost_type("checkin");
	}
}
