<!-- right -->
<div class="col-sm-12 col-md-3 col-lg-3 col-none-padding blog-item faq-sidebar">
    <div class="panel panel-primary">
        <div class="panel-body">
            <div class="btn btn-block default text-primary">Mới phản hồi</div>
            <div class="comments">
                @if(count($arr_question_latest_feedback)>0)
                    @foreach($arr_question_latest_feedback as $key=>$val)
                        <div class="media">
                            <a href="{{$val['user_url']}}" class="pull-left text-center font-weight-600">
                                @if($val['user']['avatar'])
                                    <img src="{{URL::to('/')}}{{$val['user']['avatar']}}" alt="" class="media-object">
                                @else
                                    <img src="{{URL::to('assets/global/img/no-image.png')}}" alt="" class="media-object">
                                @endif
                                <small>
                                    @if(empty($val['user']['fullname'])){{$val['user']['username']}}@else {{$val['user']['fullname']}}@endif
                                </small>
                            </a>
                            <div class="media-body">
                                <a class="font-weight-600" href="{{URL::to('faq/cau-hoi-'.$val['id'].'.html')}}">{{$val['title']}}</a>
                                <p>{{$val['content']}}</p>
                                <small class="grey italic">{{$val['total_feedback']}} phản hồi -  {{$val['latest_date']}}</small>
                            </div>
                        </div>
                    @endforeach
                @else
                    <div class="italic grey">
                        <i class="icon-folder-empty grey"></i>
                        Câu hỏi đang rỗng.
                    </div>
                @endif
            </div>
        </div>
        </div>
    <div class="panel panel-primary">
        <div class="panel-body">
            <div class="btn btn-block default text-primary">Chủ đề hot</div>
            <div class="comments">
                @if(count($arr_question_hot_feedback)>0)
                    @foreach($arr_question_hot_feedback as $key=>$val)
                        <div class="media">
                            <a href="{{$val['user_url']}}" class="pull-left text-center font-weight-600">
                                @if($val['user']['avatar'])
                                    <img src="{{URL::to('/')}}{{$val['user']['avatar']}}" alt="" class="media-object">
                                @else
                                    <img src="{{URL::to('assets/global/img/no-image.png')}}" alt="" class="media-object">
                                @endif
                                <small>
                                    @if(empty($val['user']['fullname'])){{$val['user']['username']}}@else {{$val['user']['fullname']}}@endif
                                </small>
                            </a>
                            <div class="media-body">
                                <a class="font-weight-600" href="{{URL::to('faq/cau-hoi-'.$val['id'].'.html')}}">{{$val['title']}}</a>
                                <p>{{$val['content']}}</p>
                                <small class="grey italic">{{$val['total_feedback']}} phản hồi -  {{$val['latest_date']}}</small>
                            </div>
                        </div>
                    @endforeach
                @else
                    <div class="italic grey">
                        <i class="icon-folder-empty grey"></i>
                        Câu hỏi đang rỗng.
                    </div>
                @endif

            </div>

        </div>
    </div>
    <div class="panel panel-primary">
        <div class="panel-body">
            <div class="btn btn-block default text-primary">Chưa có phản hồi</div>
            <div class="comments">
                @if(count($arr_question_no_feedback)>0)
                    @foreach($arr_question_no_feedback as $key=>$val)
                        <div class="media">
                            <a href="{{$val['user_url']}}" class="pull-left text-center font-weight-600">
                                @if($val['user']['avatar'])
                                    <img src="{{URL::to('/')}}{{$val['user']['avatar']}}" alt="" class="media-object">
                                @else
                                    <img src="{{URL::to('assets/global/img/no-image.png')}}" alt="" class="media-object">
                                @endif
                                <small>
                                    @if(empty($val['user']['fullname'])){{$val['user']['username']}}@else {{$val['user']['fullname']}}@endif
                                </small>
                            </a>
                            <div class="media-body">
                                <a class="font-weight-600" href="{{URL::to('faq/cau-hoi-'.$val['id'].'.html')}}">{{$val['title']}}</a>
                                <p>{{$val['content']}}</p>
                                <small class="grey italic">{{$val['latest_date']}}</small>
                            </div>
                        </div>
                    @endforeach
                @else
                    <div class="italic grey">
                        <i class="icon-folder-empty grey"></i>
                        Câu hỏi đang rỗng.
                    </div>
                @endif
            </div>

        </div>
    </div>
</div>
<!-- right end -->

