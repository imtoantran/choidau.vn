<?php

use Illuminate\Support\Facades\URL;

class Province extends Eloquent {
	protected $table = "provinces";


    public static  function getName($id){

        if(Province::find($id)){
            return Province::find($id)->name;
        };

    }
    public function location(){
        return $this->hasMany("Location");
    }
    public function slug(){
        return isset($this->name)? Str::slug($this->name):"";
    }
}
