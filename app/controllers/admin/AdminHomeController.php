<?php
class AdminHomeController extends AdminController {

	/**
	 * Admin home
	 *
	 */
	public function getIndex()
	{
        $name_page='Dashboard';
        $detail_name_page='reports & statistics';
        $url_page='/#';

        return View::make('admin/home',compact('name_page','detail_name_page','url_page'));
	}

}