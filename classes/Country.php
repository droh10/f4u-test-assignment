<?php
class Country{
	private $country;
	public function __construct($countryName){
		if(empty($countryName)){
			throw new Exception("No Country given.");
		}
		$this->country = $countryName;
	}
	public function getCountry(){
		return $this->country;
	}
}
?>