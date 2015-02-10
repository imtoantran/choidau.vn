<?php
use Illuminate\Support\Facades\URL;

class MenuLocation extends Post {
    protected $table = "posts";
    protected $attributes = array(
        'post_type' => 'menu_location'
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
        return parent::newQuery()->wherePost_type("menu_location");
    }

    public function location(){
        return $this->belongsToMany('Location','location_post','post_id','location_id');
    }

    /*  public function getUrc(){
          return $this->meta()->whereMeta_key('url')->first()->meta_value;
      }*/

}
