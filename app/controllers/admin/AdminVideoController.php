<?php

/**
 * Created by PhpStorm.
 * User: imtoantran
 * Date: 3/18/2015
 * Time: 11:16 AM
 */
class AdminVideoController extends \AdminController
{
    public function getIndex()
    {
        return View::make("admin.video.index");
    }


    public function getVideos()
    {
        $videos = Post::orderBy('updated_at','DESC')->select(array('id','title', 'parent_id', 'user_id', 'created_at' , 'guid'))->wherePost_type('video');
//        $videos = Location::select(array('locations.id', 'name', 'locations.user_id', 'created_at', 'province_id', 'status_id', 'slug'))->where("user_id", "!=", '');

        return Datatables::of($videos)
            ->add_column('Lượt xem', function($row){
                $view_count = number_format(json_decode(file_get_contents('http://gdata.youtube.com/feeds/api/videos/'.$row['guid'].'?v=2&alt=json'))->entry->{'yt$statistics'}->viewCount);
               $view = '<span class="badge badge-primary pull-right">'.$view_count.'</span>';
                return $view;
            })
            ->add_column('user', function($row){
                $user = User::whereId($row['user_id'])->first();
//                PostMeta::where(["meta_key"=>"review_price","post_id"=>$row['id']])->first()["meta_value"];
                return empty($user['fullname'])?$user['username']:$user['fullname'];
            })
            ->add_column('location', function($row){
                $location = Location::whereId($row['parent_id'])->first();
//                PostMeta::where(["meta_key"=>"review_price","post_id"=>$row['id']])->first()["meta_value"];
                return $location['name'];
            })
            ->add_column('create', function($row){
                return date("H:i d-m-Y", strtotime($row['created_at']));
            })
            ->add_column('actions', function($row){
                $actions = '<a class="pull-right btn btn-xs btn-danger btn-video-delete" data-action="delete" data-post-id="'.$row['id'].'"><i class="icon-trash"></i> Xóa</a>';
                $actions .= '<a href="https://www.youtube.com/embed/'.$row['guid'].'?html5=1" class="pull-right btn btn-xs btn-warning btn-review-detail" data-post-id="'.$row['id'].'"><i class="icon-eye"></i> <span>Chi tiết</span></a>';
                return $actions;
            })
            ->remove_column('id')
            ->remove_column('created_at')
            ->remove_column('user_id')
            ->remove_column('parent_id')
            ->remove_column('guid')
            ->make();
    }

    public function deleteVideo()
    {
        $data = Input::all();
        echo Post::whereId($data['post_id'])->delete();

    }
//
//    public function postEdit()
//    {
//
//    }
//
//    public function getReviews()
//    {
//
//    }
//
//    public function postVerify($location)
//    {
//        if (Auth::guest()) return Response::json(["success" => false, "message" => "Need permission"]);
//        $option = Option::firstOrNew(["name" => "location_status", "value" => "verified", "description" => "Đã xác thực"]);
//        $location->status_id = $option->id;
//        if ($location->save()) return Response::json(["success" => true, "message" => $option->description,"content"=>'<i class="icon icon-ok" data-placement="left" data-toggle="tooltip" title="Đã xác thực"></i>']);
//
//    }
//
//    public function postDelete($location)
//    {
//        if (Auth::guest()) return Response::json(["success" => false, "message" => "Need permission"]);
//        if ($location->delete()) return Response::json(["success" => true]);
//
//    }
//////
//    public function getDetailFaq($post_id){
//        $post_question = Post::find($post_id);
//        $post_question['user'] =  User::find($post_question['user_id']);
//        $post_question['user_url'] = $post_question['user']->url();
//        $post_question['latest_date'] =  $post_question->date();
//
//        $arr_answer = Post::orderBy('updated_at', 'DESC')->wherePost_type('faq-answer')->whereParent_id($post_id);
//        $post_question['total_answer'] =  $arr_answer->count();
//
//        $arr_answer = $arr_answer->paginate(10);;
//        foreach($arr_answer as $key=>$val){
//            $arr_answer[$key]['user'] = User::whereId($val->user_id)->first();
//            $arr_answer[$key]['user_url'] = $arr_answer[$key]['user']->url();
//            $arr_answer[$key]['latest_date'] = $val->date();
//        }
//        return View::make("admin.faq.detail", compact('post_question','arr_answer'));
//    }
//
//    public function getData()
//    {
//        $faq = Post::select(array('posts.id','posts.status','posts.title', 'posts.user_id', 'posts.updated_at'))->wherePost_type('faq-question');
//
//        return Datatables::of($faq)
//            ->edit_column('title', '<span class="text-style">{{{$title}}}</span> <span class="badge badge-default">{{Post::whereParent_id($id)->count()}} phản hồi</span>')
//            ->edit_column('user_id', '@if($user_id) <a href="{{User::find($user_id)->url()}}">{{User::find($user_id)->display_name()}}</a> @endif')
//            ->add_column('actions',
//                '<a href="#" class="btn btn-danger btn-xs btn-faq-delete pull-right" data-post-id="{{$id}}">Xóa</a>
//                <a href="#" class="btn btn-warning btn-xs btn-faq-close pull-right" data-type="@if($status){{"open"}}@else{{"close"}}@endif" data-post-id="{{$id}}">@if($status){{"Mở"}}@else{{"Đóng"}}@endif</a>
//                '
//            )
//            ->remove_column('id')
//            ->remove_column('status')
//            ->make();
//    }

}