<?php
/**
 * @author imtoantran
 *
 */


class Location extends Eloquent {
	public function ward(){
		return $this->belongsTo('Ward');
	}
	public function province(){
		return $this->belongsTo('Province');
	}
	public function district(){
		return $this->belongsTo('District');
	}
	public function reviews(){
		return $this->hasMany('Review','parent_id');
	}
	public function userAction(){
		return $this->belongsToMany("User");
	}
	public function album(){
		return $this->belongsToMany("Image","location_post","location_id","post_id");
	}
	public function category(){
		return $this->belongsTo("Category");
	}
	public function utility(){
		return $this->belongsToMany("Utility");
	}
}