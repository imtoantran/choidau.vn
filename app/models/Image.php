<?php

use Illuminate\Support\Facades\URL;

class Image extends Post {
	protected $table = "posts";
	protected $attributes = array(
		'post_type' => 'image'
	);
    protected   $_img_src='';
	/**
	 * Returns the image
	 *
	 * @param bool $excludeDeleted
	 * @return object
	 * @internal param $query
	 */

	public function newQuery($excludeDeleted = true)
	{ $this->title;
		return parent::newQuery()->wherePost_type("image");
	}

  /*  public function getUrc(){
        return $this->meta()->whereMeta_key('url')->first()->meta_value;
    }*/

}
