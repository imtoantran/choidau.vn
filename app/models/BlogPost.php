<?php
/**
 * @author imtoantran
 */
use Illuminate\Support\Facades\URL;

class BlogPost extends Eloquent {
	protected $table = "blog_post";



	/**
	 * @param bool $excludeDeleted
	 * @return mixed
     */


    public function user() {
        return $this->hasMany('User');
    }





}