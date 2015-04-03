<?php

class VideoController extends BaseController {

	public function __construct()
	{
		parent::__construct();
	}

	public function getIndex(){
		$videos = Post::orderBy('updated_at','DESC')->wherePost_type('video')->get();
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
//
//	public function loadQuestionDetail($postId)
//	{
//		$post_question = Post::find($postId);
//		$post_question['user'] =  User::find($post_question['user_id']);
//		$post_question['user_url'] = $post_question['user']->url();
//		$post_question['latest_date'] =  $post_question->date();
//		$arr_answer = Post::orderBy('updated_at', 'DESC')->wherePost_type('faq-answer')->whereParent_id($postId)->paginate(10);
//		foreach($arr_answer as $key=>$val){
//			$arr_answer[$key]['user'] = User::whereId($val->user_id)->first();
//			$arr_answer[$key]['user_url'] = $arr_answer[$key]['user']->url();
//			$arr_answer[$key]['latest_date'] = $val->date();
//		}
//
//		$arr_question_no_feedback = $this->getQuestionNoFeedBack();
//		$arr_question_latest_feedback = $this->getQuestionLatestFeedBack();
//		$arr_question_hot_feedback = $this->getQuestionHotFeedBack();
//		return View::make('site/faq/question-detail', compact('post_question', 'arr_answer', 'arr_question_no_feedback', 'arr_question_latest_feedback', 'arr_question_hot_feedback'));
//	}
//
//	public function addSubject(){
//		$user = Auth::user();
//		$data = Input::all();
//		$post = new Post();
//		$post->user_id = $user->id;
//		$post->title = $data['subject'];
//		$post->content = $data['content'];
//		$post->created_at = date_format(new DateTime(),"Y-m-d H:i:s");
//		$post->updated_at = date_format(new DateTime(),"Y-m-d H:i:s");
//		$post->post_type = 'faq-question';
//		$post->status = 0;
//		if($post->save()){
//			echo 1;
//		}else{
//			echo 0;
//		}
//	}
//
//	// tra loi moi nhat
//	public function getQuestionLatestFeedBack(){
//		$arr_post = Post::orderBy('updated_at', 'DESC')->wherePost_type('faq-answer')->get();
//		$arr_post_temp = array();
//		$arr_post_temp_id = array();
//
//		foreach($arr_post as $key=>$val){
//			$arr_post_temp_id[] = $val->parent_id;
//		}
//		if(count($arr_post_temp_id)>0){
//			$arr_post_temp = Post::orderBy('updated_at', 'DESC')->whereIn('id', array_unique($arr_post_temp_id))->take(5)->get();
//			if(count($arr_post_temp)>0){
//				foreach($arr_post_temp as $key=>$val){
//					$arr_post_temp[$key]['user'] =  User::find($val['user_id']);
//					$arr_post_temp[$key]['user_url'] =  $arr_post_temp[$key]['user']->url();
//					$post = Post::orderBy('updated_at', 'DESC')->wherePost_type('faq-answer')->whereParent_id($val->id)->first();
//					$arr_post_temp[$key]['latest_date'] = $post->date();
//					$arr_post_temp[$key]['latest_short_date'] = $post->updated_at;
//					$arr_post_temp[$key]['total_feedback'] = Post::whereParent_id($val->id)->wherePost_type('faq-answer')->count();
//					$arr_post_temp[$key]['content'] = Str::words($val->content, 6);
//				}
//			}
//		}
//
//		$this->objectRSort($arr_post_temp, 'latest_short_date');
//		return $arr_post_temp;
//	}
//
//	// chua co tra loi
//	public function getQuestionNoFeedBack(){
//		$arr_post = Post::orderBy('updated_at', 'DESC')->wherePost_type('faq-question')->get();
//		$arr_post_temp = array();
//		foreach($arr_post as $key=>$val){
//			$num = Post::whereParent_id($val->id)->wherePost_type('faq-answer')->count();
//			if($num>0){break;}
//			else{
//				$arr_post_temp[] = $arr_post[$key];
//				if(count($arr_post_temp)>4){ break;}
//			}
//		}
//
//		if(count($arr_post_temp) > 0){
//			foreach($arr_post_temp as $key=>$val){
//				$arr_post_temp[$key]['user'] = User::find($val['user_id']);
//				$arr_post_temp[$key]['user_url'] =  $arr_post_temp[$key]['user']->url();
//				$arr_post_temp[$key]['content'] = Str::words($val->content, 6);
//				$arr_post_temp[$key]['latest_date'] = $val->date();
//			}
//		}
//		return $arr_post_temp;
//	}
//
//	// chua co tra loi
//	public function getQuestionHotFeedBack(){
//		$arr_post = Post::orderBy('updated_at', 'DESC')->wherePost_type('faq-question')->get();
//		$arr_post_temp = array();
//
//		foreach($arr_post as $key=>$val){
//			$arr_post[$key]['total_answer'] = Post::whereParent_id($val->id)->wherePost_type('faq-answer')->count();
//		}
//
//		if(count($arr_post)>0) {
//			$this->objectRSort($arr_post, 'total_answer');
//			foreach ($arr_post as $key => $val) {
//				$arr_post_temp[$key]['id'] = $val['id'];
//				$arr_post_temp[$key]['title'] = $val['title'];
//				$arr_post_temp[$key]['user'] = User::find($val['user_id']);
//				$arr_post_temp[$key]['user_url'] =  $arr_post_temp[$key]['user']->url();
//				$arr_post_temp[$key]['latest_date'] = $val->date();
//				$arr_post_temp[$key]['content'] = Str::words($val->content, 6);
//				$arr_post_temp[$key]['total_feedback'] = Post::whereParent_id($val->id)->wherePost_type('faq-answer')->count();
//				if (count($arr_post_temp) > 4) {
//					break;
//				}
//			}
//		}
//		return $arr_post_temp;
//	}
//
//
//	function objectRSort(&$object, $key){
//		for ($i = count($object) - 1; $i >= 0; $i--) {
//			for ($j = 0; $j < $i; $j++) {
//				if ($object[$j]->$key < $object[$j + 1]->$key) {
//					$tmp = $object[$j];
//					$object[$j] = $object[$j + 1];
//					$object[$j + 1] = $tmp;
//				}
//			}
//		}
//		return $object;
//	}

}
