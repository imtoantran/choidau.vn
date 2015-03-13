<div class="table-responsive">
    <table class="table table-hover">
        <thead>
        <tr>
            <th width="20">STT</th>
            <th>Tên</th>
            <th>Hình ảnh</th>
            <th width="100">Giá</th>
            @if(Auth::check())
                @if(Auth::user() == $location->owner)
                    <th width="50" class="text-center"></th>
                @endif
            @endif
        </tr>
        </thead>
        <tbody>
        @foreach($location->foods()->get() as $key => $food)
            @include("site.location.food_item")
        @endforeach
        </tbody>
    </table>
</div>