<?php

use Illuminate\Support\Facades\URL;

class PostMeta extends Eloquent {
	protected $table = "post_meta";
	public function meta(){
		return $this->belongsTo("Post");
	}


}
