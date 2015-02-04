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

    public function author(){
        return $this->belongsTo("User");
      //  return $user;
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
	public function loadUtility(){
		return $this->hasMany("Location_Utility","location_id");
	}
	/* imtoantran url start */
	public function url(){
		return isset($this->province->name)? URL::to(Str::Slug($this->province->name)."/$this->slug"):"";
	}
	public function rating(){
		$ratings = $this->hasManyThrough("PostMeta","Review","parent_id","post_id")->whereMetaKey("review_rating");
		return $ratings->count()?ceil($ratings->sum("meta_value")/$ratings->count()):0;
	}
	public function isLiked($userId){
		return $this->userAction()->whereUserId($userId)->whereActionType("like")->count();
	}
	public function whoLiked(){
		return $this->userAction()->whereActionType("like");
	}
	public function address(){
		$address = isset($this->address_detail)?$this->address_detail:"";
		$address .= isset($this->province->name )?$this->province->name :"";
		$address .= isset($this->district->type )?$this->district->type :"";
		$address .= isset($this->district->name )?$this->district->name :"";
		return $address;
	}

	/* imtoantran url end */
	public function hasReview(){
		return $this->reviews()->count();
	}

}