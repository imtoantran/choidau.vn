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

    public function getDetailFaq($post_id){
        $post_question = Post::find($post_id);
        $post_question['user'] =  User::find($post_question['user_id']);
        $post_question['user_url'] = $post_question['user']->url();
        $post_question['latest_date'] =  $post_question->date();

        $arr_answer = Post::orderBy('updated_at', 'DESC')->wherePost_type('faq-answer')->whereParent_id($post_id);
        $post_question['total_answer'] =  $arr_answer->count();

        $arr_answer = $arr_answer->paginate(10);;
        foreach($arr_answer as $key=>$val){
            $arr_answer[$key]['user'] = User::whereId($val->user_id)->first();
            $arr_answer[$key]['user_url'] = $arr_answer[$key]['user']->url();
            $arr_answer[$key]['latest_date'] = $val->date();
        }
        return View::make("admin.faq.detail", compact('post_question','arr_answer'));
    }

    public function getData()
    {
        $faq = Post::select(array('posts.id','posts.status','posts.title', 'posts.user_id', 'posts.updated_at'))->wherePost_type('faq-question');

        return Datatables::of($faq)
            ->edit_column('title', '<span class="text-style">{{{$title}}}</span> <span class="badge badge-default">{{Post::whereParent_id($id)->wherePost_type("faq-answer")->count()}} phản hồi</span>')
            ->edit_column('user_id', '@if($user_id) <a href="{{User::find($user_id)->url()}}">{{User::find($user_id)->display_name()}}</a> @endif')
            ->add_column('actions',
                '<a href="#" class="btn btn-danger btn-xs btn-faq-delete pull-right" data-post-id="{{$id}}">Xóa</a>
                <a href="#" class="btn btn-warning btn-xs btn-faq-close pull-right" data-type="@if($status){{"open"}}@else{{"close"}}@endif" data-post-id="{{$id}}">@if($status){{"Mở"}}@else{{"Đóng"}}@endif</a>
                '
            )
            ->remove_column('id')
            ->remove_column('status')
            ->make();
    }

}