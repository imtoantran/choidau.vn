@foreach($comments as $key=>$comment)
    <div class="media @if($key<$comments->count()-4) hidden more-{{$post->id}} @endif">
        @include("site.blog.comment_item")
    </div>
@endforeach