<?php

/**
 * Created by PhpStorm.
 * User: imtoantran
 * Date: 3/18/2015
 * Time: 11:16 AM
 */
class AdminLocationsController extends \AdminController
{
    public function getIndex()
    {
        return View::make("admin.location.index");
    }

    public function getLocations()
    {
        return Response::json(Location);
    }

    public function getEdit()
    {

    }

    public function postEdit()
    {

    }

    public function getReview(){
        return View::make("admin.location.review");
    }

    public function postVerify($location)
    {
        if (Auth::guest()) return Response::json(["success" => false, "message" => "Need permission"]);
        $option = Option::firstOrNew(["name" => "location_status", "value" => "verified", "description" => "Đã xác thực"]);
        $location->status_id = $option->id;
        if ($location->save()) return Response::json(["success" => true, "message" => $option->description,"content"=>'<i class="icon icon-ok" data-placement="left" data-toggle="tooltip" title="Đã xác thực"></i>']);

    }

    public function postDelete($location)
    {
        if (Auth::guest()) return Response::json(["success" => false, "message" => "Need permission"]);
        if ($location->delete()) return Response::json(["success" => true]);

    }

    public function getData()
    {
        $offset = Input::get("start");
        $length = Input::get("length");
        //$locations = Location::select(array('locations.id', 'name', 'locations.user_id as owner', 'created_at'))->offset($offset)->take($length)->get();

        //return Response::json(["dsf"=>$locations]);
        $locations = Location::select(array('locations.id', 'name', 'locations.user_id', 'created_at', 'province_id', 'status_id', 'slug'))->where("user_id", "!=", '');
        return Datatables::of($locations)
            ->edit_column('user_id', '@if($user_id) <a href="{{User::find($user_id)->url()}}">{{User::find($user_id)->display_name()}}</a> @endif')
            ->add_column('actions',
                '<a href="{{{ URL::to(Province::find($province_id)->slug."/".$slug) }}}" class="btn btn-default btn-xs" >{{{ Lang::get(\'button.edit\') }}}</a>
                <a data-controller="{{{ URL::to(\'location/\' . $id . \'/delete\' ) }}}" class="btn btn-xs btn-danger" data-action="delete">{{{ Lang::get(\'button.delete\') }}}</a>
                @if(Option::find($status_id))
                    @if(Option::find($status_id)->value == "verified")
                        <i class="icon icon-ok" data-placement="left" data-toggle="tooltip" title="Đã xác thực"></i>
                    @endif
                @else
                    <a class="btn btn-xs btn-success" data-controller="{{{ URL::to(\'location/\' . $id . \'/verify\' ) }}}" data-action="verify">Xác thực</a>
                @endif
            ')
            ->remove_column('id')
            ->remove_column('province_id')
            ->remove_column('slug')
            ->remove_column('status_id')
            ->make();

    }
    public function loadReview()
    {
        $review = Post::orderBy('updated_at','DESC')->select(array('id','title', 'status'))->wherePost_type('review');
        return Datatables::of($review)
            ->add_column('rating', '{{str_repeat("<i class=icon-star-filled></i>",PostMeta::where(["meta_key"=>"review_rating","post_id"=>$id])->get(["meta_value"])->first()["meta_value"])}}')
            ->add_column('price', function($row){
                $price = PostMeta::where(["meta_key"=>"review_price","post_id"=>$row['id']])->first()["meta_value"];
                if(!empty($price)){
                    $price = '<span class="pull-right">'.number_format($price).' vnđ</span>';
                }else{
                    $price = '<span class="pull-right">...</span>';
                }
                return $price;
            })
            ->add_column('visitors', function($row){
                $price = PostMeta::where(["meta_key"=>"review_visitors","post_id"=>$row['id']])->first()["meta_value"];
                if(!empty($price)){
                    $price = '<span class="pull-right">'.number_format($price).'</span>';
                }else{
                    $price = '<span class="pull-right">...</span>';
                }
                return $price;
            })
            ->add_column('visit_again', function($row){
                $test = PostMeta::where(["meta_key"=>"review_visit_again","post_id"=>$row['id']])->first()["meta_value"];
                return json_decode(json_decode(Option::whereName("review_visit_again")->get(["value"])->first())->value,true)[$test];
            })
            ->add_column('action_status', function($row){
                $opStatus = Option::whereName('status_review')->get();
                $str  = '<select name="review-change-status" class="review-change-status" aria-controls="review" data-post-id="'.$row['id'].'">';
                foreach($opStatus as $key=>$val){
                    if($val['value'] == $row['status']){
                        $str .= '<option value="'.$val['value'].'" selected>'.$val['description'].'</option>';
                    }else{
                        $str .= '<option value="'.$val['value'].'">'.$val['description'].'</option>';
                    }
                }
                $str .= '</select>';
                return $str;
            })
            ->add_column('actions', function($row){
                $actions = '<a class="pull-right btn btn-xs btn-danger btn-review-delete" data-action="delete" data-post-id="'.$row['id'].'"><i class="icon-trash"></i> Xóa</a>';
                $actions .= '<a href="'.URL::to('qtri-choidau/location/review-item-'.$row['id']).'" class="pull-right btn btn-xs btn-warning btn-review-detail" data-post-id="'.$row['id'].'"><i class="icon-eye"></i> <span>Chi tiết</span></a>';
                return $actions;
            })
            ->remove_column('id')
            ->remove_column('status')
            ->make();
    }

    public function actionReview(){
        $data = Input::all();
        switch($data['data_action']){
            case 'delete':
                Post::whereParent_id($data['post_id'])->delete();
                PostMeta::wherePost_id($data['post_id'])->delete();
                echo Post::find($data['post_id'])->delete();
                break;

            case 'update_status':
                echo Post::whereId($data['post_id'])->update(['status'=> $data['status']]);
                break;

            default: break;
        }
    }

    public function loadDetailReview($post_id){
        $review = Review::find($post_id);
        return View::make("admin.location.review_detail", compact('review'));
    }

}