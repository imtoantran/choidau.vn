<?php

use Illuminate\Support\Facades\URL;

class Answer extends Post {
	protected $table = "posts";
	protected $attributes = array(
		'post_type' => 'answer'
	);


	/**
	 * @param bool $excludeDeleted
	 * @return mixed
     */
	public function newQuery($excludeDeleted = true)
	{
		return parent::newQuery()->wherePost_type("answer");
	}
}