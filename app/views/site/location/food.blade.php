@foreach($location->food()->get() as $food)
    <div class="food-item">
        {{$food}}
    </div>
@endforeach