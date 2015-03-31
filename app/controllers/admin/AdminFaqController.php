<?php

/**
 * Created by PhpStorm.
 * User: imtoantran
 * Date: 3/18/2015
 * Time: 11:16 AM
 */
class AdminFaqController extends \AdminController
{
    public function getIndex()
    {
        return View::make("admin.faq.index");
    }

//
//    public function getLocations()
//    {
//        return Response::json(Location);
//    }
//
//    public function getEdit()
//    {
//
//    }
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
//
//    public function getData()
//    {
//        $offset = Input::get("start");
//        $length = Input::get("length");
//        //$locations = Location::select(array('locations.id', 'name', 'locations.user_id as owner', 'created_at'))->offset($offset)->take($length)->get();
//
//        //return Response::json(["dsf"=>$locations]);
//        $locations = Location::select(array('locations.id', 'name', 'locations.user_id', 'created_at', 'province_id', 'status_id', 'slug'))->where("user_id", "!=", '');
//        return Datatables::of($locations)
//            ->edit_column('user_id', '@if($user_id) <a href="{{User::find($user_id)->url()}}">{{User::find($user_id)->display_name()}}</a> @endif')
//            ->add_column('actions',
//                '<a href="{{{ URL::to(Province::find($province_id)->slug."/".$slug) }}}" class="btn btn-default btn-xs" >{{{ Lang::get(\'button.edit\') }}}</a>
//                <a data-controller="{{{ URL::to(\'location/\' . $id . \'/delete\' ) }}}" class="btn btn-xs btn-danger" data-action="delete">{{{ Lang::get(\'button.delete\') }}}</a>
//                @if(Option::find($status_id))
//                    @if(Option::find($status_id)->value == "verified")
//                        <i class="icon icon-ok" data-placement="left" data-toggle="tooltip" title="Đã xác thực"></i>
//                    @endif
//                @else
//                    <a class="btn btn-xs btn-success" data-controller="{{{ URL::to(\'location/\' . $id . \'/verify\' ) }}}" data-action="verify">Xác thực</a>
//                @endif
//            ')
//            ->remove_column('id')
//            ->remove_column('province_id')
//            ->remove_column('slug')
//            ->remove_column('status_id')
//            ->make();
//    }

}