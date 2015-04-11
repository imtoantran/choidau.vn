<?php

/**
 * Created by PhpStorm.
 * User: imtoantran
 * Date: 3/18/2015
 * Time: 11:16 AM
 */
class AdminImageController extends \AdminController
{
    public function getIndex()
    {
        $name_page='Image user location';
        $detail_name_page='Danh sách các hình ảnh của người dùng đăng địa điểm';
        $url_page='user-location';
        $type_image = 'location';
        $images_location = Post::orderBy('posts.updated_at', 'DESC')
            ->join('location_post','posts.id', '=', 'location_post.post_id')
            ->where('location_post.location_post_type_id', '=', 39)
            ->where('posts.user_id', '<>', 1)
            ->paginate(18);
        foreach($images_location as $key=>$val){
            $images_location[$key]['parent_id'] = $val->location_id;
        }
        $images_events = $images_location;

        $location = Location::orderBy('created_at')->get();
        return View::make("admin.image.index-user", compact('name_page','detail_name_page','url_page','images_events', 'location','type_image'));
    }

    public function getImageUserReview(){
        $name_page='Image user review';
        $detail_name_page='Danh sách các hình ảnh của người dùng đánh giá địa điểm';
        $url_page='user-review';
        $type_image = 'review';
        $images_review = Post::orderBy('posts.updated_at', 'DESC')
            ->join('post_meta','posts.id', '=', 'post_meta.meta_Value')
            ->where('post_meta.meta_key', '=', 'review_image')
            ->where('posts.user_id', '<>', 1)
            ->paginate(18);
        foreach($images_review as $key=>$val){
            $images_review[$key]['parent_id'] = $val->meta_value;
        }
        $images_events = $images_review;
        return View::make("admin.image.index-user", compact('name_page','detail_name_page','url_page','images_events','type_image'));
    }

    public function filterImageUserLocation($location_id){
        $name_page='Image user location';
        $detail_name_page='Danh sách các hình ảnh của người dùng đăng địa điểm';
        $url_page='user-location';
        $type_image = 'location';
        $images_location = Post::orderBy('posts.updated_at', 'DESC')
            ->join('location_post','posts.id', '=', 'location_post.post_id')
            ->where('location_post.location_id', '=', $location_id)
            ->paginate(18);
        foreach($images_location as $key=>$val){
            $images_location[$key]['parent_id'] = $val->location_id;
        }
        $images_events = $images_location;

        $location = Location::orderBy('created_at')->get();
        $goto_location = Location::find($location_id)->url();
        $location_id = $location_id;
        return View::make("admin.image.index-user", compact('name_page','detail_name_page','url_page','images_events', 'location','goto_location','location_id','type_image'));
    }

    public function LoadEditImage($image_type, $image_id, $parent_id){
        $name_page='Detail image '.$image_type;
        $detail_name_page='Thông tin chi tiết hình ảnh';
        $url_page='edit';

        $image = '';

        if($image_type == 'location'){
            $image = DB::table('location_post')
                ->join('posts','location_post.post_id','=','posts.id')
                ->where('location_post.location_id','=',$parent_id)
                ->where('location_post.post_id','=',$image_id)
                ->where('location_post.location_post_type_id','=',39)->get();

        }else{
            $image = Post::join('post_meta','posts.id', '=', 'post_meta.meta_Value')
                ->where('post_meta.id', '=', $image_id)
                ->where('post_meta.meta_value', '=', $parent_id)
                ->where('post_meta.meta_key', '=', 'review_image')->get();
            $image = json_decode($image);
        }
        return View::make("admin.image.detail",  compact('name_page','detail_name_page','url_page','image', 'image_type', 'image_id', 'parent_id'));
    }

    public function DeleteImage(){
        $data = Input::all();
//        $result ='';
        if($data['data_type'] == "location"){
            $result = DB::table('location_post')
                ->where('location_id','=',$data['parent_id'])
                ->where('post_id','=',$data['image_id'])
                ->where('location_post.location_post_type_id','=',39)->delete();
        }else{
            $result = PostMeta::find($data['image_id'])->delete();
        }

        echo $result;
    }

    public function EditImage(){
        $data = Input::all();
        parse_str($data['frm_image'], $arr_img);
        $result = 0;
        if(isset($arr_img['image_type'])){
            if($arr_img['image_type'] == 'location'){
                $result = DB::table('location_post')
                    ->where('location_id','=',$arr_img['parent_id'])
                    ->where('post_id','=',$arr_img['image_id'])
                    ->where('location_post.location_post_type_id','=',39)
                    ->update(['alternative_text'=> $arr_img['alternative_text'], 'caption'=> $arr_img['caption'], 'descrip'=> $arr_img['description']]);
            }else{
                $result = PostMeta::whereId($arr_img['image_id'])
                    ->update(array('alternative_text' => $arr_img['alternative_text'], 'caption'=> $arr_img['caption'], 'descrip'=> $arr_img['description']));
            }
        }
        echo json_encode($result);
    }


   // admin
    public function getImageLocationAdmin()
    {
        $name_page='Image Admin location';
        $detail_name_page='Danh sách các hình ảnh của admin đăng địa điểm';
        $url_page='admin-location';
        $type_image = 'location';
        $images_location = Post::orderBy('posts.updated_at', 'DESC')
            ->join('location_post','posts.id', '=', 'location_post.post_id')
            ->where('location_post.location_post_type_id', '=', 39)
            ->where('posts.user_id', '=', 1)
            ->paginate(18);
        foreach($images_location as $key=>$val){
            $images_location[$key]['parent_id'] = $val->location_id;
        }
        $images_events = $images_location;

        $location = Location::orderBy('created_at')->get();
        return View::make("admin.image.index-user", compact('name_page','detail_name_page','url_page','images_events', 'location','type_image'));
    }

    public function GetImageReviewAdmin(){
        $name_page='Image user review';
        $detail_name_page='Danh sách các hình ảnh của người dùng đánh giá địa điểm';
        $url_page='user-review';
        $type_image = 'review';
        $images_review = Post::orderBy('posts.updated_at', 'DESC')
            ->join('post_meta','posts.id', '=', 'post_meta.meta_Value')
            ->where('post_meta.meta_key', '=', 'review_image')
            ->where('posts.user_id', '=', 1)
            ->paginate(18);

        foreach($images_review as $key=>$val){
            $images_review[$key]['type_image'] = 'review';
            $images_review[$key]['parent_id'] = $val->meta_value;
        }
        $images_events = $images_review;
        return View::make("admin.image.index-user", compact('name_page','detail_name_page','url_page','images_events','type_image'));
    }

    public function filterImageAdminLocation($location_id){
        $name_page='Image user location';
        $detail_name_page='Danh sách các hình ảnh của người dùng đăng địa điểm';
        $url_page='user-location';
        $type_image = 'location';
        $images_location = Post::orderBy('posts.updated_at', 'DESC')
            ->join('location_post','posts.id', '=', 'location_post.post_id')
            ->where('location_post.location_id', '=', $location_id)
            ->where('posts.user_id', '=', 1)
            ->paginate(18);
        foreach($images_location as $key=>$val){
            $images_location[$key]['parent_id'] = $val->location_id;
        }
        $images_events = $images_location;

        $location = Location::orderBy('created_at')->get();
        $goto_location = Location::find($location_id)->url();
        $location_id = $location_id;
        return View::make("admin.image.index-user", compact('name_page','detail_name_page','url_page','images_events', 'location','goto_location','location_id','type_image'));
    }
}