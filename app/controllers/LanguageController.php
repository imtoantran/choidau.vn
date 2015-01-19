<?php
Class LanguageController extends BaseController {

    public function select($lang)
    {
        Session::put('lang', $lang);

        return Redirect::to('/');
    }

}