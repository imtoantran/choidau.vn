<?php
/**
 * @author imtoantran
 */
use Illuminate\Support\Facades\URL;

class Blog extends Post {
	protected $table = "posts";
	protected $attributes = array(
		'post_type' => 'blog'
	);


	/**
	 * @param bool $excludeDeleted
	 * @return mixed
     */
	public function newQuery($excludeDeleted = true)
	{
		return parent::newQuery()->wherePost_type("blog");
	}

	public function url(){
		return Url::to("blog/".$this->slug.".html");
	}

	public function category(){
		return $this->belongsTo('Category');
	}
}