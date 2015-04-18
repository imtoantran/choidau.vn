<?php
//luuhoabk
class ContactController extends BaseController {

	public function __construct()
	{
		parent::__construct();
	}

	public function getIndex(){
		$map = Social::whereType('website-map')->first()->content;
		$web_map = array(10.823130, 106.629356);
		if(strlen($map)>0){
			if(is_float(explode(',',$map)[0]+0)){
				$web_map = explode(',',$map);
			}
		}
		$web_info = Social::whereType('website-info')->first()->content;
		return View::make('site/contact/index',compact('web_map','web_info'));
	}

	public function saveContact(){
		$data = Input::all();
		$contact = new Contact();
		$contact->username = $data['message_name'];
		$contact->email = $data['message_email'];
		$contact->title = $data['message_title'];
		$contact->content = $data['message_content'];
		$contact->content = $data['message_content'];
		$contact->created_at = date_format(new DateTime(),"Y-m-d H:i:s");
		$contact->updated_at = date_format(new DateTime(),"Y-m-d H:i:s");

		echo json_encode($contact->save());
	}
}
