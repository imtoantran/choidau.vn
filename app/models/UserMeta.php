<?php

use Illuminate\Support\Facades\URL;

class UserMeta extends Eloquent {
	protected $table = "user_meta";
	public function meta(){
		return $this->belongsTo("User");
	}
	public function PostMeta($key = null,$value = null){
		$this->meta_key = $key;
		$this->meta_value = $value;
	}
	public function set($value){
		$this->meta_value = $value;
	}
}
