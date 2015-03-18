<?php

use Zizaco\Confide\ConfideUser;
use Zizaco\Confide\ConfideUserInterface;
use Zizaco\Entrust\HasRole;
use Carbon\Carbon;

class User extends Eloquent implements ConfideUserInterface {
    use ConfideUser, HasRole;

    /**
     * Get user by username
     * @param $username
     * @return mixed
     */
    public function getUserByUsername( $username )
    {
        return $this->where('username', '=', $username)->first();
    }


    /**
     * Find the user and check whether they are confirmed
     *
     * @param array $identity an array with identities to check (eg. ['username' => 'test'])
     * @return boolean
     */
    public function isConfirmed($identity) {
        $user = Confide::getUserByEmailOrUsername($identity);
        return ($user && $user->confirmed);
    }

    /**
     * Get the date the user was created.
     *
     * @return string
     */
    public function joined()
    {
        return String::date(Carbon::createFromFormat('Y-n-j G:i:s', $this->created_at));
    }

    /**
     * Save roles inputted from multiselect
     * @param $inputRoles
     */
    public function saveRoles($inputRoles)
    {
        if(! empty($inputRoles)) {
            $this->roles()->sync($inputRoles);
        } else {
            $this->roles()->detach();
        }
    }

    /**
     * Returns user's current role ids only.
     * @return array|bool
     */
    public function currentRoleIds()
    {
        $roles = $this->roles;
        $roleIds = false;
        if( !empty( $roles ) ) {
            $roleIds = array();
            foreach( $roles as $role )
            {
                $roleIds[] = $role->id;
            }
        }
        return $roleIds;
    }

    /**
     * Redirect after auth.
     * If ifValid is set to true it will redirect a logged in user.
     * @param $redirect
     * @param bool $ifValid
     * @return mixed
     */
    public static function checkAuthAndRedirect($redirect, $ifValid=false)
    {
        // Get the user information
        $user = Auth::user();
        $redirectTo = false;

        if(empty($user->id) && ! $ifValid) // Not logged in redirect, set session.
        {
            Session::put('loginRedirect', $redirect);
            $redirectTo = Redirect::to('user/login')
                ->with( 'notice', Lang::get('user/user.login_first') );
        }
        elseif(!empty($user->id) && $ifValid) // Valid user, we want to redirect.
        {
            $redirectTo = Redirect::to($redirect);
        }

        return array($user, $redirectTo);
    }

    public function currentUser()
    {
        return Confide::user();
    }

    /**
     * Get the e-mail address where password reminders are sent.
     *
     * @return string
     */
    public function getReminderEmail()
    {
        return $this->email;
    }

    public function blog() {
        return $this->hasOne('BlogUser');
    }


    public function friends(){
       $friend=Friend::WhereUser_id($this->id)->orWhere('friend_id','=',$this->id);
       return $friend;
    }

    public function friends_(){
        //    $list= $this->belongsToMany('User','friends')->orWherePivot('user_id','=',$this->id)
        //                                      ->orWherePivot('friend_id','=',$this->id)->get();

        $list=Friend::orWhere('user_id','=',$this->id)->orWhere('friend_id','=',$this->id)->get();
        $key=array();
        $value=array();

        foreach($list as $item){
            if($item->user_id!=$this->id){
                $key[]=$item->user_id;
            }
            if($item->friend_id!=$this->id){
                $value[]=$item->friend_id;
            }
        }

        $array_list=array_merge($key,$value);
        $list_friend=array();
        foreach($array_list as $item){
            $user_item=User::where('id','=',$item)->first();
            $list_friend[]=$user_item;
        }
        return $array_list;
    }





    public function friend_common($user_friend){
        $list_friend_auth=$user_friend->friends()->get();
        $list_friend_this=$this->friends()->get();
        $list_friend_common=array();

        foreach($list_friend_this as $item){


                foreach($list_friend_auth as $item1){
                    if($item->id==$item1->id){
                        $list_friend_common=array($item);
                    }
                }


        }

      // return count(array_intersect($list_friend_auth, $list_friend_this));
//
    return $list_friend_common;

    }




    public function postAction() {
        return $this->belongsToMany('Post');
    }

    public function locationAction(){
        return $this->belongsToMany("Location");
    }

    /* imtoantran user link start */
    public function url(){
        return URL::to("trang-ca-nhan/$this->username.html");
    }
    /* imtoantran user link end */


    public  function status(){
        return $this->belongsToMany('Post','post_user')->orWherePivot('post_type','=','review')
                                                       ->orWherePivot('post_type','=','status');
    }


    public function checkin(){
        return $this->belongsToMany("Location")->wherePivot('action_type','=','checkin');
    }

    public function location_like(){
        return $this->belongsToMany("Location")->wherePivot('action_type','=','like');
    }

    public function Images(){
        return $this->hasMany("Image");
    }

    public function getTotalLikeLocation(){
        return $this->location_like()->get()->count();
    }
//
//    public function getFriendsConfirm(){
//        $user = Auth::user();
//        $arryIdFriend = Friend::whereStatus_id(35)->whereFriend_id($user->id)->get();
//        $arr = array();
//        foreach($arryIdFriend as $key=>$val){
//            $arr[$key] =  $val['user_id'];
//        }
//        return json_encode(User::WhereIn('id',$arr)->get());
//    }

//    luuhoabk
    public function referFriendConfirm(){
        return  $this->belongsToMany("User","friends","friend_id","user_id")->withPivot('user_id');
    }

    public function referFriend(){
        return  $this->belongsToMany("User","friends","user_id","friend_id");
    }
    public function referLocation(){
        return  $this->belongsToMany("User","locations","user_id","user_id");
    }

    public function display_name(){
        return empty($this->fullname)?$this->username:$this->fullname;
    }
    
    public function isAction($post_type, $post_id){
        return PostMeta::whereMeta_key($post_type)->whereMeta_value($this->id)->wherePost_id($post_id);
    }
}
