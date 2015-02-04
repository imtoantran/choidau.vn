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

        return     $user=User::find($this->user_id);
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
		//return URL::to("dia-diem/".Str::Slug($this->province->name)."/$this->id-$this->slug");
	}
	public function rating(){
		$ratings = $this->hasManyThrough("PostMeta","Review","parent_id","post_id")->whereMetaKey("review_rating");
		return $ratings->count()?ceil($ratings->sum("meta_value")/$ratings->count()):0;
	}
	public function isLiked($userId){
		return $this->userAction()->whereUserId($userId)->whereActionType("like")->count();
	}
	/* imtoantran url end */
	public function hasReview(){
		return $this->reviews()->count();
	}
    public function members(){
        return $this->belongsToMany('User','location_user')->wherePivot('action_type','=','checkin');
    }
    public function events(){
        return $this->belongsToMany('EventLocation','location_post','location_id','post_id');
    }

    public function photos(){
        return $this->belongsToMany('Image','location_post','location_id','post_id')->wherePivot('location_post_type_id','=','39');
    }




}