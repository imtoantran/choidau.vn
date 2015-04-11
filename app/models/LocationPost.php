<?php
/**
 * @author imtoantran
 */
use Illuminate\Support\Facades\URL;

class LocationPost extends Post {
	protected $table = "posts";
	protected $attributes = array(
		'post_type' => 'location'
	);


	/**
	 * @param bool $excludeDeleted
	 * @return mixed
     */
	public function newQuery($excludeDeleted = true)
	{
		return parent::newQuery()->wherePost_type("location");
	}

	public function category(){
		return $this->belongsToMany('Category');
	}
	public function reviews(){
		return $this->hasMany("Review","parent_id");
	}

	public function getImage(){
//		return $this->hasMany("Post","post_id");
		return $this->belongsToMany('Post','blog_post');
	}

}