@extends('site.layouts.default')

{{-- Content --}}
@section('content')
 <button>Media</button>
<ul class="menu-item-pictures">
    <div class="list_user_slide">

    </div>


    <li class="single-picture empty">
        <div id="iM_user_slide" class="single-picture-wrapper imageManager_openModal" style="position: relative;" data-toggle="modal" data-target="#imageManager_modal">
            <div class="add-picture vertically-centered" style="position: absolute; height: 34px; top: 50%; margin-top: -17px;">
                <div class="icon icons-plus3"></div>
                Thêm ảnh
            </div>
        </div>
    </li>
</ul>

<?php echo $_SERVER['SCRIPT_FILENAME']; ?>
@stop