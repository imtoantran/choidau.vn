<?php
//luuhoabk
class PageController extends BaseController {

	public function __construct()
	{
		parent::__construct();
	}

	public function getIndex($page_id, $page_alias){
		$page = Page::whereId($page_id)->whereAlias($page_alias)->first();
		return View::make('site/page/index', compact('page'));
	}
}
