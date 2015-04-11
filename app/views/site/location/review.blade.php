@foreach($reviews as $review)
    @include("site.location.review_item")
@endforeach
{{--$reviews->setBaseUrl("location/$location->id/reviews");--}}
<div class="paging">{{$reviews->links()}}</div>