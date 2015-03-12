<tr class="food-item">
    <td class="text-center control-label">{{$key+1}}</td>
    <td class="control-label" data-id="{{$food->id}}" data-name="food_name">{{$food->food_name}}</td>
    {{--<td>{{$food->food_name}}</td>--}}
    <td class="control-label" data-id="{{$food->id}}" data-name="price">{{$food->price}}</td>
    @if(Auth::check())
        @if(Auth::user() == $location->owner)
            <td class="text-center">
                <a class="btn btn-xs btn-danger delete" data-action="delete" data-id="{{$food->id}}"><i
                            class="icon icon-trash"></i></a>
            </td>
        @endif
    @endif
</tr>