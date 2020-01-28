<?php
class City{
	private $city;
	public function __construct($cityName){
		if(empty($cityName)){
			throw new Exception("No City given.");
		}
		$this->city = $cityName;
	}
	public function getCity(){
		return $this->city;
	}
}
?>