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
	public function category(){
		return $this->belongsTo("Category");
	}
//	luuhoabk
	public function album(){
		return $this->belongsToMany("Post");
	}
	public function food(){
		return $this->belongsToMany("Food","location_food");
		// location_food: chi dinh lien ket khong theo thu tu a->z
	}
	public function utility(){
		return $this->belongsToMany("Utility");
	}
}