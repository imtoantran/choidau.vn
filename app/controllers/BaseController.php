<?php

class BaseController extends Controller {

    /**
     * Initializer.
     *
     * @access   public
     * @return \BaseController
     */
    public   $_layout;
    public  $_style;
    public  $_script;
    public function __construct()
    {
        $this->beforeFilter('csrf', array('on' => 'post'));
    }

	/**
	 * Setup the layout used by the controller.
	 *
	 * @return void
	 */
	protected function setupLayout()
	{

		if ( ! is_null($this->layout))
		{
			$this->layout = View::make($this->layout);
		}
	}

   public   function Style($style){
       $style_string='';
       foreach ($style as  $key => $value){
          $style_string .=  HTML::style($value);
       }
       return $style_string;
    }

   public  function  JScript($jscript){
       $jscript_string='';
       foreach ($jscript as  $key => $value){
          $jscript_string .=  HTML::script($value);


       }
       return $jscript_string;
   }

}