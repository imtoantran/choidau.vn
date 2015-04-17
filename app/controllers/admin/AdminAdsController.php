<?php

/**
 * Created by PhpStorm.
 * User: luuhoabk
 * Date: 3/18/2015
 * Time: 11:16 AM
 */
class AdminAdsController extends \AdminController
{
    public function getIndex()
    {

        $page_name = 'Trang quảng cáo';
        $detail_name_page = 'Danh sách quảng cáo';
        $page_icon = 'icon-star-empty';
        $url_page='ads';
        $name_page='Quảng cáo';

        $script_ads = Advertisement::orderBy('id', 'ASC')->get();
        return View::make("admin.ads.index", compact('page_name','detail_name_page','page_icon','url_page', 'name_page','script_ads'));
    }
    public function adsUpdate(){
        $data = input::all();
            $update_script = Advertisement::whereId($data['ads_id'])->update(['content'=>$data['ads_content']]);
        echo $update_script;
    }

}