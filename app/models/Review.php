<?php

use Illuminate\Support\Facades\URL;

class Review extends Post {
	protected $table = "posts";
	protected $attributes = array(
		'post_type' => 'review'
	);


	/**
	 * @param bool $excludeDeleted
	 * @return mixed
     */
	public function newQuery($excludeDeleted = true)
	{
		return parent::newQuery()->wherePost_type("review");
	}
	public function location(){
		return $this->belongsTo("Location","parent_id");
	}
}