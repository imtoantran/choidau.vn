<?php

class Location extends Eloquent
{
    public function ward()
    {
        return $this->belongsTo('Ward');
    }

    public function province()
    {
        return $this->belongsTo('Province');
    }

    public function district()
    {
        return $this->belongsTo('District');
    }

    public function reviews()
    {
        return $this->hasMany('Review', 'parent_id');
    }

    public function owner()
    {
        return $this->belongsTo("User", "user_id");
        //  return $user;
    }

    public function userAction()
    {
        return $this->belongsToMany("User");
    }

    public function category()
    {
        return $this->belongsTo("Category");
    }

//	luuhoabk
    public function getValuePostType($textColum)
    {
        return Option::whereName('location_post_type')->whereValue($textColum)->first()->id;
    }

    public function relationPost()
    {
        return $this->belongsToMany("Post");
    }

    public function saveAlbum($post_id)
    {
        if ($this->relationPost()->wherePivot("post_id", "=", $post_id)->count()) {
            return 0;
        }
        $this->belongsToMany("Post")->attach($post_id, ["location_post_type_id" => $this->getValuePostType('image')]);
        return 1;
    }

    public function deleteImageAlbum($post_id)
    {
        if ($this->relationPost()->wherePivot("post_id", "=", $post_id)->count()) {
            $this->belongsToMany("Post")->detach($post_id);
            return 1;
        }
        return 0;
    }
//	public function album(){
//		return $this->belongsToMany("Post")->whereLocationPostTypeId($this->getValuePostType('image'));
//	}
    public function food()
    {
        return $this->belongsToMany("Food", "location_food", 'location_id', 'food_id')->withPivot("food_name");
        // location_food: chi dinh lien ket khong theo thu tu a->z
    }

    /* imtoantran load location's food start */
    public function foods()
    {
        return $this->hasMany("LocationFood");
    }

    /* imtoantran load location's food stop */

    public function utility()
    {
        return $this->belongsToMany("Utility");
    }

    public function loadUtility()
    {
        return $this->hasMany("Location_Utility", "location_id");
    }

    /* imtoantran start */
    public function url()
    {
        return isset($this->province->name) ? URL::to($this->province->slug . "/$this->slug") : "";
    }

    public function rating()
    {
        $ratings = $this->hasManyThrough("PostMeta", "Review", "parent_id", "post_id")->whereMetaKey("review_rating");
        return $ratings->count() ? ceil($ratings->sum("meta_value") / $ratings->count()) : 0;
    }

    public function address()
    {
        $address = isset($this->address_detail) ? $this->address_detail : "";
        $address .= isset($this->province->name) ? $this->province->name : "";
        $address .= isset($this->district->type) ? $this->district->type : "";
        $address .= isset($this->district->name) ? $this->district->name : "";
        return $address;
    }

    public function whoLiked()
    {
        return $this->userAction()->whereActionType("like")->orderBy("location_user.created_at", "desc");
    }

    public function totalLike()
    {
        return $this->whoLiked()->count() ? $this->whoLiked()->count() : 0;
    }

    /* imtoantran end */
    public function hasReview()
    {
        return $this->reviews()->count();
    }

    public function members()
    {
        return $this->belongsToMany('User', 'location_user')->wherePivot('action_type', '=', 'checkin');
    }

    public function events()
    {
        return $this->belongsToMany('EventLocation', 'location_post', 'location_id', 'post_id');
    }

    public function images()
    {
        return $this->belongsToMany('Image', 'location_post', 'location_id', 'post_id');
    }

    /* imtoantran images from reviews start */
    public function reviewsImages()
    {
        $reviewsImages = [];
        $reviews = $this->reviews();
        if ($reviews->count()) {
            foreach ($reviews->get() as $key => $review) {
                foreach ($review->images() as $image) {
                    $reviewsImages[] = $image;
                }
            }
        }
        return $reviewsImages;
    }

    /* imtoantran images from reviews stop */

    public function totalCheckIn()
    {
        return $this->userAction()->whereAction_type("checkin")->count();
    }

    /* imtoantran event */
    public function event()
    {
        return $this->hasOne("EventLocation", "parent_id");
    }
    /* imtoantran event */
    /* imtoantran l status */
    public function isVerified(){
        if(!empty($this->status_id)){
            $status = Option::findOrFail($this->status_id);
            if($status)
                return $status->value == "verified";
        }
        return false;
    }
    /* imtoantran l status end*/

    public function itemSave($user, $action_type){
        return $this->userAction()->attach($user, ['action_type' => $action_type, 'created_at' => date_format(new DateTime(), "Y-m-d H:i:s")]);
    }
    public function itemDelete($userId,$type){
        return $this->userAction()->withPivot("action_type")->wherePivot('action_type' , '=', $type)->detach($userId);
    }
    public function isLiked($userId)
    {
        return $this->userAction()->whereUserId($userId)->whereActionType("like")->count();
    }
    public function isCheckin($userId)
    {
        return $this->userAction()->whereUserId($userId)->whereActionType("checkin")->count();
    }
}