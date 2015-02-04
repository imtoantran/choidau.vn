<?php
use Illuminate\Support\Facades\URL;

class EventLocation extends Post {
	protected $table = "posts";
	protected $attributes = array(
		'post_type' => 'event_location'
	);
    protected $id_location;
	/**
	 * Returns the image
	 *
	 * @param bool $excludeDeleted
	 * @return object
	 * @internal param $query
	 */

	public function newQuery($excludeDeleted = true)
	{ $this->title;
		return parent::newQuery()->wherePost_type("event_location");
	}

    public function location(){
        return $this->belongsToMany('Post','location_post','location_id','post_id')->wherePivot('');
    }

  /*  public function getUrc(){
        return $this->meta()->whereMeta_key('url')->first()->meta_value;
    }*/

}
