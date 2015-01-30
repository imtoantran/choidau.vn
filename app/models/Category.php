<?php

use Illuminate\Support\Facades\URL;

class Category extends Eloquent {
	/**
	 * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
	public function blogs(){
		return $this->hasMany('Blog');
	}
	public function children(){
		return$this->hasMany('Category','parent_id');
	}
	public function parent(){
		return$this->belongsTo('Category','parent_id');
	}
	public function location(){
		return$this->hasMany('Location');
	}
}