@extends('site.layouts.default')

{{-- Content --}}
@section('content')
 <button>Media</button>
<ul class="menu-item-pictures">
    <div class="list_user_slide">

    </div>


    <li class="single-picture empty">
        <div id="iM_user_slide" type_insert="insert_one_img" class="single-picture-wrapper imageManager_openModal insertMedia" style="position: relative;" data-toggle="modal" data-target="#imageManager_modal">
            <div class="add-picture vertically-centered" style="position: absolute; height: 34px; top: 50%; margin-top: -17px;">
                <div class="icon icons-plus3"></div>
                Thêm ảnh
            </div>
        </div>
    </li>

    <li class="single-picture empty">
        <div id="iM_user_slide1"  type_insert="insert_multi_img" class="single-picture-wrapper imageManager_openModal1 insertMedia" style="position: relative;" data-toggle="modal" data-target="#imageManager_modal">
            <div class="add-picture vertically-centered" style="position: absolute; height: 34px; top: 50%; margin-top: -17px;">
                <div class="icon icons-plus3"></div>
                Thêm ảnh
            </div>
        </div>
    </li>
</ul>
<button class="load-browser_media">hjhjhjhj</button>
<a href="#content-browser" class="btn btn-default fancybox-fast-view">View</a>
<?php echo $_SERVER['SCRIPT_FILENAME']; ?>
@stop