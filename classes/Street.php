<?php
class Street{
	private $street;
	public function __construct($streetName){
		if(empty($streetName)){
			throw new Exception("No street given");
		}
		$this->street = $streetName;
	}

	public function getStreet(){
		return $this->street;
	}

}
?>