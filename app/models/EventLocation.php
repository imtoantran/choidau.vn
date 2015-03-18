<?php
use Illuminate\Support\Facades\URL;

class EventLocation extends Post {
    protected $table = "posts";
    protected $attributes = array(
        'post_type' => 'event'
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
    {
        return parent::newQuery()->wherePost_type("event");
    }

    public function location(){
        return $this->belongsToMany('Location','location_post','post_id','location_id');
    }
}
