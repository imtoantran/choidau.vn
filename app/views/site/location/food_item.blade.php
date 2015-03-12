<tr class="food-item">
    <td class="text-center">{{$key+1}}</td>
    <td data-id="{{$food->id}}" data-name="name">{{$food->food_name}}</td>
    {{--<td>{{$food->food_name}}</td>--}}
    <td data-id="{{$food->id}}" data-name="price">{{$food->price}}</td>
    @if(Auth::check())
        @if(Auth::user() == $location->owner)
            <td class="text-center">
                <a class="btn btn-xs btn-danger delete" data-action="delete" data-id="{{$food->id}}"><i
                            class="icon icon-trash"></i></a>
                <a class="btn btn-xs btn-primary edit" data-type="{{$food->type_id}}" data-name="{{$food->food_name}}" data-price="{{$food->price}}" data-action="edit" data-id="{{$food->id}}"><i
                            class="icon icon-edit"></i></a>
            </td>
        @endif
    @endif
</tr>