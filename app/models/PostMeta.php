<?php

use Illuminate\Support\Facades\URL;

class PostMeta extends Eloquent {
	protected $table = "post_meta";
	public function meta(){
		return $this->belongsTo("Post");
	}
	public function PostMeta($key = null,$value = null){
		$this->meta_key = $key;
		$this->meta_value = $value;
	}
	public function set($value){
		$this->meta_value = $value;
	}
	public function post()
	{
		return $this->belongsTo("Post");
	}
	public function getImage(){
//		return $this->$this->hasOne('Post', 'id');
		return $this->belongsToMany('Post', 'post_meta', 'meta_value', 'id');
	}
}
