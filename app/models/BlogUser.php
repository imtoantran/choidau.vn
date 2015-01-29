<?php
/**
 * @author imtoantran
 */
use Illuminate\Support\Facades\URL;

class BlogUser extends Eloquent {
	protected $table = "blogs";



	/**
	 * @param bool $excludeDeleted
	 * @return mixed
     */


    public function user() {
        return $this->hasOne('User');
    }


    public function status(){
        return $this->hasOne('Post');
    }

}