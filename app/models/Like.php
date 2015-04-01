<?php
class Like extends Post{
	protected $table = "posts";
	protected $attributes = array(
		'post_type' => 'like_location'
	);

	/**
	 * @param bool $excludeDeleted
	 * @return mixed
     */
	public function newQuery($excludeDeleted = true)
	{
		return parent::newQuery()->wherePost_type("like_location");
	}

    public function location(){

        return $this->belongsTo('Location','parent_id');
    }

}