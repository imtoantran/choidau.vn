<?php

use Illuminate\Support\Facades\URL;

/**
 * @property mixed title
 * @property string slug
 * @property mixed content
 * @property mixed meta_title
 * @property mixed meta_description
 * @property mixed meta_keywords
 * @property mixed user_id
 * @property mixed id
 * @property mixed author
 * @property mixed thumbnail
 */
class Post extends Eloquent
{

	/**
	 * Deletes a blog post and all
	 * the associated comments.
	 *
	 * @return bool
	 */
	public function delete()
	{
		// Delete the comments
		$this->comments()->delete();

		// Delete the blog post
		return parent::delete();
	}

	/**
	 * Returns a formatted post content entry,
	 * this ensures that line breaks are returned.
	 *
	 * @return string
	 */
	public function content()
	{
		return nl2br($this->content);
	}

	/**
	 * Get the post's author.
	 *
	 * @return User
	 */
	public function author()
	{
		return $this->belongsTo('User', 'user_id');
	}

	/**
	 * Get the post's meta_description.
	 *
	 * @return string
	 */
	public function meta_description()
	{
		return $this->meta_description;
	}

	/**
	 * Get the post's meta_keywords.
	 *
	 * @return string
	 */
	public function meta_keywords()
	{
		return $this->meta_keywords;
	}


	/**
	 * Get the date the post was created.
	 *
	 * @param \Carbon|null $date
	 * @return string
	 */
	public function date($date = null)
	{
		if (is_null($date)) {
			$date = $this->created_at;
		}

		return String::showTimeAgo($date);
	}

	/**
	 * Get the URL to the post.
	 *
	 * @return string
	 */
	public function url()
	{
		return Url::to($this->slug);
	}

	/**
	 * Returns the date of the blog post creation,
	 * on a good and more readable format :)
	 *
	 * @return string
	 */
	public function created_at()
	{
		return $this->date($this->created_at);
	}

	/**
	 * Returns the date of the blog post last update,
	 * on a good and more readable format :)
	 *
	 * @return string
	 */
	public function updated_at()
	{
		return $this->date($this->updated_at);
	}
	//imtoantran
	/**
	 * Get the post's comments.
	 *
	 * @return array
	 */
	public function comments()
	{
		return $this->hasMany('Comment', 'parent_id');
	}

	/**
	 * Get the post's meta.
	 *
	 * @return array
	 */
	public function meta()
	{
		return $this->hasMany("PostMeta", "post_id");
	}

	/**
	 * @return \Illuminate\Database\Eloquent\Relations\HasOne
     */
	public function status(){
		return $this->hasOne("Option","status");
	}

    public function getMetaKey($meta_key){
		if($this->meta()->whereMeta_key($meta_key)->count())
        	return $this->meta()->whereMeta_key($meta_key)->first()->meta_value;
		return null;
    }

	public function category(){
		return $this->belongsTo('Category');
	}

    public  function userAction(){
		return $this->belongsToMany("User",'post_user','post_id','user_id');
    }

	/**
	 * @return string
     */
	public function thumbnail($width=100,$height=100){
		if(File::exists(public_path().$this->thumbnail))
			return $this->thumbnail;
		return "/assets/global/img/no-image.png";
	}

	public function totalView(){
		if($this->meta()->whereMetaKey("blog_view")->count())
			return $this->meta()->whereMetaKey("blog_view")->first()->meta_value;
		return 0;
	}

	public function updateTotalView(){
		if($totalView = $this->totalView()){
			$view = $this->meta()->whereMetaKey("blog_view")->first();
			$view -> meta_value = $totalView + 1;
			return $view->save();
		}
		return $this->meta()->save(new PostMeta("blog_view",1));
	}
	//imtoantran

    public function countLike(){
        return $this->belongsToMany('User','post_user','post_id','user_id')->where('post_user_type_id','=','31')->count();
    }

    public function countDisLike(){
        return $this->belongsToMany('User','post_user','post_id','user_id')->where('post_user_type_id','=','32')->count();
    }

	/**
	 * @param $key
	 * @return mixed
     */
	public function getMeta($key){
		return $this->meta()->whereMetaKey($key);
	}

	/**
	 * @return mixed
     */
	public function getFeaturedImage(){
		$temp = $this->getMeta("featured_image");
		if($temp->count()){
			return Image::find($temp->first()->meta_value);
		}
		return false;
	}

	/* imtoantran check if user like this post start */
	public function isLiked(){
		if(Auth::guest()){
			return false;
		}
		$user = Auth::user();
		return($this->meta()->where(["meta_key"=>"like","meta_value"=>$user->id])->count());
	}
	/* imtoantran check if user like this post stop */
	/* imtoantran check if user like this post start */
	public function isReportedSpam(){
		if(Auth::guest()){
			return false;
		}
		$user = Auth::user();
		return($this->meta()->where(["meta_key"=>"spam","meta_value"=>$user->id])->count());
	}
	/* imtoantran check if user like this post stop */
	/* imtoantran get total like start */
	public function totalLikes(){
		return $this->meta()->where(["meta_key"=>"like"])->count();
	}
	/* imtoantran get total like stop */
	/* imtoantran post excerpt start */
	public function excerpt(){
		return Purifier::clean($this->content,'excerpt');
	}
	/* imtoantran post excerpt stop */
}
