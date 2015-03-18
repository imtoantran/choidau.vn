<?php

use Illuminate\Support\Facades\URL;

class Image extends Post
{
    protected $table = "posts";
    protected $attributes = array(
        'post_type' => 'image'
    );
    protected $_img_src = '';

    /**
     * Returns the image
     *
     * @param bool $excludeDeleted
     * @return object
     * @internal param $query
     */

    public function newQuery($excludeDeleted = true)
    {
        $this->title;
        return parent::newQuery()->wherePost_type("image");
    }

    public function thumbnail260x180()
    {
        return $this->thumbnail(260, 180);
    }

    public function thumbnail($width=100, $height=100)
    {
        if (File::exists(public_path().$this->guid))
            return URL::to("upload/thumbnail/$width" . "x$height-$this->title");
        return URL::to("assets/global/img/no-image.png");

    }
    /*  public function getUrc(){
          return $this->meta()->whereMeta_key('url')->first()->meta_value;
      }*/

}
