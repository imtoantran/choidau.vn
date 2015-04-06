<?php
//luuhoabk
class VideoController extends BaseController {

	public function __construct()
	{
		parent::__construct();
	}

	public function getIndex(){
		$videos = Post::orderBy('updated_at','DESC')->wherePost_type('video')->whereStatus(1)->get();
		foreach($videos as $key=>$val){
			$user = User::find($val['user_id']);
			$videos[$key]['title_limit'] = Str::words($val['title'],12);
			$videos[$key]['user_name'] = empty($user['fullname'])?$user['username'] : $user['fullname'];
			$videos[$key]['user_url'] = $user->url();
			$videos[$key]['date'] = $val->date();
			$viewcount = json_decode(file_get_contents('http://gdata.youtube.com/feeds/api/videos/'.$val['guid'].'?v=2&alt=json'))->entry->{'yt$statistics'}->viewCount;
			$videos[$key]['viewcount'] = number_format($viewcount);
		}
		return View::make('site/video/index', compact('videos'));
	}
	public function createVideo(){
		$location = Location::orderBy('created_at')->get();
		return View::make('site/video/create',compact('location'));
	}
	public function loadDetail($video_id){
		$video = Post::find($video_id);
		$video['date'] = $video->date();
		$video['view_count'] = number_format(json_decode(file_get_contents('http://gdata.youtube.com/feeds/api/videos/'.$video['guid'].'?v=2&alt=json'))->entry->{'yt$statistics'}->viewCount);
		$video['comment_count'] = Post::whereParent_id($video['id'])->wherePost_type('comment')->count();
		$location = Location::whereId($video['parent_id'])->first();
		$video['location'] = $location['name'];
		$video['location_url'] = $location->url();
		$user = User::find($video['user_id']);
		$video['user_name'] = $user->display_name();
		$video['user_url'] = $user->url();

		$comment = Post::orderBy('updated_at', 'DESC')->wherePost_type('comment')->whereParent_id($video_id)->paginate(10);

		foreach($comment as $key=>$val){

			$user = User::find($val['user_id']);
			$comment[$key]['user_url'] = $user->url();
			$comment[$key]['user_name'] = 'dasd';
			$comment[$key]['user_avatar'] = $user['avatar'];
			$comment[$key]['latest_date'] = $val->date();
		}

		return View::make('site/video/detail', compact('video','user', 'comment'));
	}

	public function confimVideo(){
		$data = Input::all();
		echo json_encode($this->get_youtube_id($data['video_url']));
//		echo $data['video_url'];
	}
	private static function get_youtube_id($url) {
		$link = parse_url($url,PHP_URL_QUERY);

		/**split the query string into an array**/
		if($link == null) $arr['v'] = $url;
		else  parse_str($link, $arr);
		/** end split the query string into an array**/
		if(! isset($arr['v'])) return false; //fast fail for links with no v attrib - youtube only

		$checklink = YOUTUBE_CHECK . $arr['v'];

		//** curl the check link ***//
		$ch = curl_init();
		curl_setopt($ch, CURLOPT_URL,$checklink);
		curl_setopt($ch, CURLOPT_RETURNTRANSFER,1);
		curl_setopt($ch, CURLOPT_TIMEOUT, 5);
		$result = curl_exec($ch);
		curl_close($ch);

		$return = $arr['v'];
		if(trim($result)=="Invalid id") $return = false; //you tube response

		return $return; //the stream is a valid youtube id.
	}
}
