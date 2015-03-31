<?php

class FaqController extends BaseController {

	public function __construct()
    {
        parent::__construct();
    }

	public function getIndex()
	{
		$arr_question = Post::orderBy('updated_at', 'DESC')->wherePost_type('faq-question')->paginate(10);
		foreach($arr_question as $key=>$val){
			$arr_question[$key]['user_question'] = User::whereId($val->user_id)->first();
			$arr_question[$key]['total_answer'] = Post::whereParent_id($val->id)->wherePost_type('faq-answer')->count();
			$arr_question[$key]['latest_date'] = $val->date();
			$arr_question[$key]['user_url'] = $arr_question[$key]['user_question']->url();
		}
		$arr_question_no_feedback = $this->getQuestionNoFeedBack();
		$arr_question_latest_feedback = $this->getQuestionLatestFeedBack();
		$arr_question_hot_feedback = $this->getQuestionHotFeedBack();

		if(Auth::check()){$user = Auth::user();}else{$user = null;}

		return View::make('site/faq/index', compact('user','arr_question', 'arr_question_no_feedback', 'arr_question_latest_feedback', 'arr_question_hot_feedback'));
	}

	public function loadQuestionDetail($postId)
	{
		$post_question = Post::find($postId);
		$post_question['user'] =  User::find($post_question['user_id']);
		$post_question['user_url'] = $post_question['user']->url();
		$post_question['latest_date'] =  $post_question->date();
		$arr_answer = Post::orderBy('updated_at', 'DESC')->wherePost_type('faq-answer')->whereParent_id($postId)->paginate(10);
		foreach($arr_answer as $key=>$val){
			$arr_answer[$key]['user'] = User::whereId($val->user_id)->first();
			$arr_answer[$key]['user_url'] = $arr_answer[$key]['user']->url();
			$arr_answer[$key]['latest_date'] = $val->date();
		}

		$arr_question_no_feedback = $this->getQuestionNoFeedBack();
		$arr_question_latest_feedback = $this->getQuestionLatestFeedBack();
		$arr_question_hot_feedback = $this->getQuestionHotFeedBack();
		return View::make('site/faq/question-detail', compact('post_question', 'arr_answer', 'arr_question_no_feedback', 'arr_question_latest_feedback', 'arr_question_hot_feedback'));
	}

	public function addSubject(){
		$user = Auth::user();
		$data = Input::all();
		$post = new Post();
		$post->user_id = $user->id;
		$post->title = $data['subject'];
		$post->content = $data['content'];
		$post->created_at = date_format(new DateTime(),"Y-m-d H:i:s");
		$post->updated_at = date_format(new DateTime(),"Y-m-d H:i:s");
		$post->post_type = 'faq-question';
		$post->status = 0;
		if($post->save()){
			echo 1;
		}else{
			echo 0;
		}
	}

	// tra loi moi nhat
	public function getQuestionLatestFeedBack(){
		$arr_post = Post::orderBy('updated_at', 'DESC')->wherePost_type('faq-answer')->get();
		$arr_post_temp = array();
		$arr_post_temp_id = array();

		foreach($arr_post as $key=>$val){
			$arr_post_temp_id[] = $val->parent_id;
		}
		if(count($arr_post_temp_id)>0){
			$arr_post_temp = Post::orderBy('updated_at', 'DESC')->whereIn('id', array_unique($arr_post_temp_id))->take(5)->get();
			if(count($arr_post_temp)>0){
				foreach($arr_post_temp as $key=>$val){
					$arr_post_temp[$key]['user'] =  User::find($val['user_id']);
					$arr_post_temp[$key]['user_url'] =  $arr_post_temp[$key]['user']->url();
					$post = Post::orderBy('updated_at', 'DESC')->wherePost_type('faq-answer')->whereParent_id($val->id)->first();
					$arr_post_temp[$key]['latest_date'] = $post->date();
					$arr_post_temp[$key]['latest_short_date'] = $post->updated_at;
					$arr_post_temp[$key]['total_feedback'] = Post::whereParent_id($val->id)->wherePost_type('faq-answer')->count();
					$arr_post_temp[$key]['content'] = Str::words($val->content, 6);
				}
			}
		}

		$this->objectRSort($arr_post_temp, 'latest_short_date');
		return $arr_post_temp;
	}

	// chua co tra loi
	public function getQuestionNoFeedBack(){
		$arr_post = Post::orderBy('updated_at', 'DESC')->wherePost_type('faq-question')->get();
		$arr_post_temp = array();
		foreach($arr_post as $key=>$val){
			$num = Post::whereParent_id($val->id)->wherePost_type('faq-answer')->count();
			if($num>0){break;}
			else{
				$arr_post_temp[] = $arr_post[$key];
				if(count($arr_post_temp)>4){ break;}
			}
		}

		if(count($arr_post_temp) > 0){
			foreach($arr_post_temp as $key=>$val){
				$arr_post_temp[$key]['user'] = User::find($val['user_id']);
				$arr_post_temp[$key]['user_url'] =  $arr_post_temp[$key]['user']->url();
				$arr_post_temp[$key]['content'] = Str::words($val->content, 6);
				$arr_post_temp[$key]['latest_date'] = $val->date();
			}
		}
		return $arr_post_temp;
	}

	// chua co tra loi
	public function getQuestionHotFeedBack(){
		$arr_post = Post::orderBy('updated_at', 'DESC')->wherePost_type('faq-question')->get();
		$arr_post_temp = array();

		foreach($arr_post as $key=>$val){
			$arr_post[$key]['total_answer'] = Post::whereParent_id($val->id)->wherePost_type('faq-answer')->count();
		}

		if(count($arr_post)>0) {
			$this->objectRSort($arr_post, 'total_answer');
			foreach ($arr_post as $key => $val) {
				$arr_post_temp[$key]['id'] = $val['id'];
				$arr_post_temp[$key]['title'] = $val['title'];
				$arr_post_temp[$key]['user'] = User::find($val['user_id']);
				$arr_post_temp[$key]['user_url'] =  $arr_post_temp[$key]['user']->url();
				$arr_post_temp[$key]['latest_date'] = $val->date();
				$arr_post_temp[$key]['content'] = Str::words($val->content, 6);
				$arr_post_temp[$key]['total_feedback'] = Post::whereParent_id($val->id)->wherePost_type('faq-answer')->count();
				if (count($arr_post_temp) > 4) {
					break;
				}
			}
		}
		return $arr_post_temp;
	}


	function objectRSort(&$object, $key){
		for ($i = count($object) - 1; $i >= 0; $i--) {
			for ($j = 0; $j < $i; $j++) {
				if ($object[$j]->$key < $object[$j + 1]->$key) {
					$tmp = $object[$j];
					$object[$j] = $object[$j + 1];
					$object[$j + 1] = $tmp;
				}
			}
		}
		return $object;
	}

}
