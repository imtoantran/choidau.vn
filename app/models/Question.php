<?php

use Illuminate\Support\Facades\URL;

class Question extends Post {
	protected $table = "posts";
	protected $attributes = array(
		'post_type' => 'question'
	);


	/**
	 * @param bool $excludeDeleted
	 * @return mixed
     */
	public function newQuery($excludeDeleted = true)
	{
		return parent::newQuery()->wherePost_type("question");
	}
}