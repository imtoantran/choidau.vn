<?php
//luuhoabk
class AddressController extends BaseController {
 	protected $province;
 	protected $district;
    public function __construct(Province $province, District $district){
        parent::__construct();
		$this->province = $province;
		$this->district = $district;
    }

	public function loadProvince(){
		return json_encode($this->province->orderBy('name','ASC')->get());
	}

	public function loadDistrict(){
		if(Input::has('province_id')){
			$province_id = Input::get('province_id');
			return json_encode($this->district->where('province_id','=',$province_id)->orderBy('type', 'DESC')->orderBy('name','ASC')->get());
		}else{
			return json_encode($this->district->orderBy('name','ASC')->get());
		}
	}

	public function loadWard(){
		if(Input::has('district_id')){
			$district_id = Input::get('district_id');
			return json_encode($this->ward->where('district_id','=',$district_id)->orderBy('type', 'DESC')->orderBy('name','ASC')->get());
		}else{
			return json_encode($this->ward->orderBy('name','ASC')->get());
		}
	}
}
