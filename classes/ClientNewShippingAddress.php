<?php
class ClientNewShippingAddress{
	private $country;
	private $city;
	private $zipcode;
	private $street;

	public function __construct(Country $countryName, City $cityName, ZipCode $zipcodeNumber, Street $streetName){
		$this->country = $countryName;
		$this->city = $cityName;
		$this->zipcode = $zipcodeNumber;
		$this->street = $streetName;
	}
	public function getCountry(){
		return $this->country->getCountry();
	}
	public function getCity(){
		return $this->city->getCity();
	}
	public function getZipcode(){
		return $this->zipcode->getZipcode();
	}
	public function getStreet(){
		return $this->street->getStreet();
	}
}
?>