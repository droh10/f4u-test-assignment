<?php
Class ZipCode{
	private $zipCode;
	public function __construct($code){
		if(empty($code) || !is_int($code)){
			throw new Exception("Invalid Zipcode");
		}
		$this->zipCode = $code;
	}
	public function getZipCode(){
		return $this->zipCode;
	}
}
?>