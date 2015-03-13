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

	public function images(){
		$meta = $this->getMeta("review_image");
		if($meta->count()){
			return Image::whereIn("id",$meta->orderBy("created_at","asc")->lists("meta_value"))->get();
		}
		return [];
	}
	public function recentImage(){
		$meta = $this->getMeta("review_image");
		if($meta->count()){
			return Image::whereIn("id",$meta->orderBy("created_at","asc")->take(6)->lists("meta_value"))->get();
		}
		return false;
	}
}