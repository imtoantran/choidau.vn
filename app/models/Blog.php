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
	public function totalComment()
	{
		return $this->comments()->count();
	}
	public function totalLike(){
		return $this->whoLiked()->count();
	}
	public function isLiked($userId){
		return $this->whoLiked()->whereMetaValue($userId)->count();
	}
	public function whoLiked(){
		return $this->meta()->whereMetaKey("blog_like");
	}
}