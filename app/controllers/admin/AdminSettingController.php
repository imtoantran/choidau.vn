<?php

/**
 * Created by PhpStorm.
 * User: luuhoabk
 * Date: 3/18/2015
 * Time: 11:16 AM
 */
class AdminSettingController extends \AdminController
{
    public function getIndex()
    {
//        return View::make("admin.video.index");
    }
    //contact
    public function getUserLevel()
    {
        $page_name = 'Quản lý cấp bậc';
        $detail_name_page = 'Danh sách cấp bậc';
        $page_icon = 'icon-list-numbered';
        $url_page='user-level';
        $name_page='Setting - user-level';
        $user_level = Option::orderBy('value','ASC')->whereName('level_user')->get();

        return View::make("admin.setting.user_level.index", compact('page_name','detail_name_page','page_icon','url_page', 'name_page', 'user_level'));
    }


    public function userLevelUpdate(){
        $data = input::all();
        $userLevel_update = Option::whereId($data['id'])->whereName('level_user')->update(['value'=>$data['value'],'description'=>$data['description']]);
        echo $userLevel_update;
    }

    public function userLevelDelete(){
        $data = input::all();
        $userLevel_delete = Option::whereId($data['id'])->delete();
        echo $userLevel_delete;
    }
    public function userLevelCreate(){
        $data = input::all();
        $user_level = new option();
        $user_level->name ='level_user';
        $user_level->description = $data['description'];
        $user_level->value = $data['value'];
        if($user_level->save()){
            echo $user_level->id;
        }else{
            echo -1;
        }
    }

    //contact
    public function getContact()
    {
        $page_name = 'Quản lý liên hệ';
        $detail_name_page = 'Danh sách liên hệ';
        $page_icon = 'icon-vcard';
        $url_page='contact';
        $name_page='Setting - contact';
        return View::make("admin.setting.contact.index", compact('page_name','detail_name_page','page_icon','url_page', 'name_page'));
    }

    public function getContactList(){
        $contact = Contact::select(array('id','username', 'email', 'title', 'content','updated_at'));
        return Datatables::of($contact)
            ->edit_column('title', function($row){
                $actions  = Str::limit($row['title'],50);
                return $actions;
            })
            ->edit_column('content', function($row){
                $actions  = Str::limit($row['content'],50);
                return $actions;
            })
            ->add_column('actions', function($row){
                $actions  = '<div>';
                $actions .= '<a class="pull-right btn btn-xs btn-danger contact-item-delete" data-id="'.$row['id'].'" data-action="delete"><i class="icon-trash"></i> Xóa</a>';
                $actions .= '<a class="pull-right btn btn-default btn-xs" href="/qtri-choidau/setting/contact/'.$row['id'].'"><i class="icon-eye"></i> <span>Xem</span></a>';
                $actions .= '</div>';
                return $actions;
            })
            ->make();
    }

    public function contactDelete(){
        $data = Input::all();
        echo Contact::whereId($data['id'])->delete();
    }

    public function contactDetail($contact_id){
        $page_name = 'Quản lý liên hệ';
        $detail_name_page = 'Chi tiết liên hệ';
        $page_icon = 'icon-vcard';
        $url_page=$contact_id;
        $name_page='Setting - contact - detail';
        $contact = Contact::find($contact_id);
        return View::make("admin.setting.contact.detail", compact('page_name','detail_name_page','page_icon','url_page', 'name_page','contact'));
    }
    // contact - map
    public function contactMap(){
        $page_name = 'Quản lý liên hệ';
        $detail_name_page = 'Cập nhật vị trí bản đồ';
        $page_icon = 'icon-map';
        $url_page= '';
        $name_page='Setting - contact - map';

        $map = Social::whereType('website-map')->first()->content;
        $web_map = array(10.823130, 106.629356);
        if(strlen($map)>0){
            if(is_float(explode(',',$map)[0]+0)){
                $web_map = explode(',',$map);
            }
        }
        return View::make("admin.setting.contact.map", compact('page_name','detail_name_page','page_icon','url_page', 'name_page', 'web_map'));
    }

    public function contactMapUpdate(){
        $data = input::all();
        $map_update = Social::whereType('website-map')->update(['content'=>$data['map_position']]);
        echo $map_update;
    }


    // contact - web info
    public function contactWebinfo(){
        $page_name = 'Quản lý liên hệ';
        $detail_name_page = 'Cập nhật thông tin liên hệ của website';
        $page_icon = 'icon-info';
        $url_page= '';
        $name_page='Setting - contact - webinfo';
        $web_info = Social::whereType('website-info')->first()->content;
        return View::make("admin.setting.contact.webinfo", compact('page_name','detail_name_page','page_icon','url_page', 'name_page' , 'web_info'));
    }

    public function contactWebinfoUpdate(){
        $data = input::all();
        $webinfo_update = Social::whereType('website-info')->update(['content'=>$data['content']]);
        echo $webinfo_update;
    }

    //page
    public function getPage()
    {
        $page_name = 'Quản lý trang tỉnh';
        $detail_name_page = 'Link nhanh';
        $page_icon = 'icon-doc-alt';
        $url_page='page';
        $name_page='Setting - page';
        return View::make("admin.setting.page.index", compact('page_name','detail_name_page','page_icon','url_page', 'name_page'));
    }

    public function getPageList(){
            $pages = Page::select(array('id','title', 'alias', 'updated_at'));
            return Datatables::of($pages)
                ->add_column('actions', function($row){
                    $actions  = '<div>';
                    $actions .= '<a class="pull-right btn btn-xs btn-danger page-item-delete" data-id="'.$row['id'].'" data-action="delete"><i class="icon-trash"></i> Xóa</a>';
                    $actions .= '<a class="pull-right btn btn-default btn-xs" href="/qtri-choidau/setting/page-'.$row['id'].'/edit"><i class="icon-edit"></i> <span>Sửa</span></a>';
                    $actions .= '</div>';
                    return $actions;
                })
                ->make();
    }

    public function getPageEdit($page_id){
        $page = Page::find($page_id);

        $page_name = 'Chỉnh sửa trang';
        $detail_name_page = 'Trang '.$page->title;
        $page_icon = 'icon-edit';
        $url_page='edit';
        $name_page='Setting - page - edit';
        return View::make("admin.setting.page.edit", compact('page_name','detail_name_page','page_icon','url_page', 'name_page','page'));
    }

    public function pageSave(){
        $data = Input::all();
        if($data['action'] == 'create'){
            $page = new Page();
            $page->title = $data['title'];
            $page->alias = $data['alias'];
            $page->content = $data['content'];
            $page->created_at = date_format(new DateTime(),"Y-m-d H:i:s");
            $page->updated_at = date_format(new DateTime(),"Y-m-d H:i:s");
            if($page->save()){
                echo $page->id;
            }else{ echo -1;}

        }else{
            $update = Page::whereId($data['id'])->update(['title'=>$data['title'], 'alias'=>$data['alias'], 'content'=>$data['content']]);
            echo $update;
        }

    }

    public function getCreate(){
        $page_name = 'Tạo Page';
        $detail_name_page = 'Trang dd';
        $page_icon = 'icon-edit';
        $url_page='edit';
        $name_page='Setting - page - edit';
        return View::make("admin.setting.page.create", compact('page_name','detail_name_page','page_icon','url_page', 'name_page','page'));
    }


    public function pageDelete(){
        $data = Input::all();
        echo Page::whereId($data['id'])->delete();
    }

    //social
    public function getSocial()
    {
        $page_name = 'Trang liên kết';
        $detail_name_page = 'Chèn liên kết';
        $page_icon = 'icon-dribbble';
        $url_page='social';
        $name_page='Setting - Social';
        $social = Social::orderBy('id','ASC')->whereType('social')->get();
        $mobile_app = Social::orderBy('id','ASC')->whereType('mobile-app')->get();
        $hotline = Social::orderBy('id','ASC')->whereType('hotline')->first();
        $email = Social::orderBy('id','ASC')->whereType('email')->first();
        $page = Social::orderBy('id','ASC')->where('type','like','page-%')->get();
        $page_option = Page::get();
        $facebook_like_box = Social::whereType('facebook-like-box')->first();
        return View::make("admin.setting.social.index", compact('page_name','detail_name_page','page_icon','url_page', 'name_page','social','mobile_app','hotline','email','page','page_option','facebook_like_box'));
    }

    public function socialUpdate(){
        $data = input::all();
        $social_update = Social::whereId($data['social_id'])->update(['content'=>$data['social_link'],'status'=>$data['social_status']]);
        echo $social_update;
    }



    //script
    public function getScript()
    {
        $page_name = 'Trang cài đặt';
        $detail_name_page = 'Chèn Script';
        $page_icon = 'cog-alt';
        $url_page='script';
        $name_page='Setting - Script';
        $script_head = Script::orderBy('created_at', 'DESC')->whereType('p1')->get();
        $script_after_open_body = Script::orderBy('created_at', 'DESC')->whereType('p2')->get();
        $script_before_close_body = Script::orderBy('created_at', 'DESC')->whereType('p3')->get();
        return View::make("admin.setting.script.index", compact('page_name','detail_name_page','page_icon','url_page', 'name_page', 'script_head', 'script_after_open_body', 'script_before_close_body'));
    }

    public function scriptDelete(){
        $data = input::all();
            $del_script = Script::whereId($data['script_id'])->delete();
        echo $del_script;
    }

    public function scriptUpdate(){
        $data = input::all();
            $del_script = Script::whereId($data['script_id'])->update(['content'=>$data['script_content']]);
        echo $del_script;
    }
    public function scriptInsert(){
        $data = input::all();
        parse_str($data['insert_script'], $scriptArray);
        $script = new Script();
        $script->title = $scriptArray['script-title'];
        $script->type = $scriptArray['script-type'];
        $script->content = $scriptArray['script-content'];
        $script->created_at = date_format(new DateTime(),"Y-m-d H:i:s");
        $script->updated_at = date_format(new DateTime(),"Y-m-d H:i:s");
        echo json_encode($script->save());
    }
}