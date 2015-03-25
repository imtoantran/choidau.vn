<?php

class FaqController extends BaseController {

	public function __construct()
    {
        parent::__construct();
    }

	public function getIndex()
	{
		$arr_question = Post::orderBy('updated_at', 'DESC')->wherePost_type('faq-question')->paginate(10);;
		foreach($arr_question as $key=>$val){
			$arr_question[$key]['user_question'] = User::whereId($val->user_id)->first();
			$arr_question[$key]['total_answer'] = Post::whereParent_id($val->id)->wherePost_type('faq-answer')->count();
			$arr_question[$key]['latest_date'] = $val->date();
		}
//		$arr_question_no_feedback = Post::
		return View::make('site/faq/index', compact('arr_question'));
	}

	public function loadQuestionDetail($postId)
	{
		$post_question = Post::find($postId);
		$arr_answer = Post::orderBy('updated_at', 'DESC')->wherePost_type('faq-question')->whereParent_id($postId)->get();
		foreach($arr_answer as $key=>$val){
			$arr_answer[$key]['user_answer'] = User::whereId($val->user_id)->first();
			$arr_answer[$key]['latest_date'] = $val->date();
		}
		return View::make('site/faq/question-detail', compact('post_question', 'arr_answer'));
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

	public function getQuestionNoFeedBack($postId){
		$arr_post = Post::orderBy('updated_at', 'DESC')->wherePost_type('faq-question')->get();
		$arr_post_temp = array();
		foreach($arr_post as $key=>$val){
			$num = Post::whereParent_id($val->id)->wherePost_type('faq-answer')->count();
			if($num>0){break;}
			else{
				$arr_post_temp[] = $arr_post[$key];
				if(count($arr_post_temp)>4){
					return $arr_post_temp;
				}
			}
		}
		return $arr_post_temp;
	}


}
