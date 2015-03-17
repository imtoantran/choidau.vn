@foreach($review->comments()->orderBy("created_at","desc")->get()->reverse() as $key=>$comment)
    <div class="media @if($key<$review->comments()->count()-4) hidden more-{{$review->id}} @endif">
        @include("post.comment_item")
    </div>
@endforeach