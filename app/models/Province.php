<?php

use Illuminate\Support\Facades\URL;

class Province extends Eloquent {
	protected $table = "provinces";


    public static  function getName($id){

        if($name=DB::table('provinces')
            ->find($id)){
            return $name->name;
        };

    }

}
