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

		return String::date($date);
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

	//imtoantran
}
