<tr data-id="{{$food->id}}" class="food-item">
    <td class="text-center control-label" >{{$key+1}}</td>
    <td class="control-label" >{{$food->food_name}}</td>
    <td>
        <a class="fancybox" rel="food" href=@if(empty($food->image)) /assets/global/img/no-image.png @else {{$food->image}} @endif>
        <img height="50"
             src= @if(empty($food->image)) /assets/global/img/no-image.png @else {{$food->image}} @endif />
        </a>
    </td>
    <td class="control-label">{{$food->price}}</td>
    @if(Auth::check())
        @if(Auth::user() == $location->owner)
            <td class="text-center">
                <a class="btn btn-xs btn-danger delete" data-action="delete" data-id="{{$food->id}}">
                    <i class="icon icon-trash"></i>
                </a>
                <a class="btn btn-xs btn-success edit"
                   data-action="edit"
                   data-type="{{$food->type}}"
                   data-image= @if(empty($food->image)) /assets/global/img/no-image.png @else {{$food->image}} @endif
                   data-name="{{$food->food_name}}"
                   data-key="{{$key}}"
                   data-price="{{$food->price}}">
                    <i class="icon icon-edit"></i>
                </a>
            </td>
        @endif
    @endif
</tr>