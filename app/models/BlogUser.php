<?php
/**
 * @author imtoantran
 */
use Illuminate\Support\Facades\URL;

class BlogUser extends Eloquent {
	protected $table = "blogs";



	/**
	 * @param bool $excludeDeleted
	 * @return mixed
     */

    /***
     * @return \Illuminate\Database\Eloquent\Relations\HasOne
     *
     *
     */
    public function user() {
        return $this->hasOne('User');
    }



    /***
     * @return \Illuminate\Database\Eloquent\Relations\BelongsToMany
     *
     * Tương tác với bảng blog_post : thêm xoá sửa các status của người dùng: checkin location, thích location, review
     * đăng status
     */
    public function status(){
        return $this->belongsToMany('User','blog_post','post_id','user_id');
    }




   /***
    * @param $id_blog
    *
    * Load các status của người dùng
    */
    public function getContentAction(){
        return  BlogPost::orderBy('updated_at','DESC')->where('blog_id','=',$this->id)->get();
    }
    /*---end  getContentAction*/





}