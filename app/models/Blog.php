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

	public function totalLiked(){
		return $this->whoLiked()->count();
	}

	public function isLiked($id = null){
		if($id == null) {
			if (Auth::check()) {
				return $this->whoLiked()->whereMetaValue(Auth::id())->count();
			}
		}
		return $this->whoLiked()->whereMetaValue(Auth::id())->count();
	}

	public function whoLiked(){
		return $this->meta()->whereMetaKey("blog_like");
	}

	public function recentLiked(){
		if(Auth::check()){
			return User::whereIn("id",$this->whoLiked()->lists("meta_value"));
		}else{
			return User::whereIn("id",$this->whoLiked()->list("meta_value"));
		}
	}
}