<?php
/**
 * @author imtoantran
 *
 * Bài viết thuộc loại location
 */
use Illuminate\Support\Facades\URL;

class Place extends Post {
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

	public function url(){
		return Url::to($this->slug.".html");
	}

}