<?php
/**
 * Created by PhpStorm.
 * User: imtoantran
 * Date: 3/18/2015
 * Time: 11:16 AM
 */
class AdminLocationsController extends \AdminController {
    public function getIndex(){
        return View::make("admin.location.index");
    }

    public function getLocations(){
        return Response::json(Location);
    }

    public function getEdit(){

    }

    public function postEdit(){

    }

    public function getReviews(){

    }
    public function getData()
    {
        $offset = Input::get("start");
        $length = Input::get("length");
        //$locations = Location::select(array('locations.id', 'name', 'locations.user_id as owner', 'created_at'))->offset($offset)->take($length)->get();

        //return Response::json(["dsf"=>$locations]);
        $locations = Location::select(array('locations.id', 'name', 'locations.user_id', 'created_at','province_id','slug'))->where("user_id","!=",'');
        return Datatables::of($locations)
            ->edit_column('user_id', '@if($user_id) <a href="{{User::find($user_id)->url()}}">{{User::find($user_id)->display_name()}}</a> @endif')
            ->add_column('actions', '<a href="{{{ URL::to(Province::find($province_id)->slug."/".$slug) }}}" class="btn btn-default btn-xs" >{{{ Lang::get(\'button.edit\') }}}</a>
                <a href="{{{ URL::to(\'qtri-choidau/location/\' . $id . \'/delete\' ) }}}" class="btn btn-xs btn-danger">{{{ Lang::get(\'button.delete\') }}}</a>
            ')
            ->remove_column('id')
            ->remove_column('province_id')
            ->remove_column('slug')
            ->make();
    }

}