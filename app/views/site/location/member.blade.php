<div class="row">
@foreach($location->members()->get() as $member)
    <div class="col-xs-3 col-sm-3 col-md-3 col-lg-3">
        <div class="thumbnail">
            <a href="{{$member->url()}}">
                <img src="@if(!empty($member->avatar)) {{$member->avatar}} @else /assets/global/img/no-image.png @endif"
                     alt="{{$member->display_name()}}">
                <div class="text-center"><i class="icon icon-user"></i>{{$member->display_name()}}</div>
            </a>
        </div>
    </div>
@endforeach
</div>