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
}
