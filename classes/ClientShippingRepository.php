<?php
class ClientShippingRepository implements ClientShippingRepositoryInterface{
	private $data;
	private const JSONPATH = __dir__."/../data/ClientShippingAddress.json";
	public function __construct(){
		$jsonData = file_get_contents(self::JSONPATH);
		$this->data = json_decode($jsonData, true);
	}
	public function getAddress($shippingId, ClientId $id){

	}
	public function getAllAddress(ClientId $id){
		return (isset($this->data[$id->getClientId()]) && is_array($this->data[$id->getClientId()])  && count($this->data[$id->getClientId()])>0)?$this->data[$id->getClientId()]:array();
	}
	public function removeAddress(ClientId $id, ShippingAddressId $shippingId){
		//unset($this->data[$id->getClientId()][$shippingId->getShippingId()]);
		$temp = array();
		foreach($this->data[$id->getClientId()] as $index=>$shippingIdRow){
			if($index!=$shippingId->getShippingId()){
				$temp[] = $shippingIdRow;
			}
		}
		$this->data[$id->getClientId()] = $temp;
		return $this->save();
	}
	public function modifyAddress(ClientId $id, ShippingAddressId $shippingId, ClientNewShippingAddress $addressInfo){
		$this->data[$id->getClientId()][$shippingId->getShippingId()] = array(
													"country"=>$addressInfo->getCountry(),
													"city"=>$addressInfo->getCity(),
													"zipcode"=>$addressInfo->getZipcode(),
													"street"=>$addressInfo->getStreet(),
												);
		return $this->save();
	}
	public function addAddress(ClientId $id, ClientNewShippingAddress $addressInfo){
		$this->data[$id->getClientId()][] = array(
													"country"=>$addressInfo->getCountry(),
													"city"=>$addressInfo->getCity(),
													"zipcode"=>$addressInfo->getZipcode(),
													"street"=>$addressInfo->getStreet(),
												);
		return $this->save();
	}
	private function save(){
		$json = json_encode($this->data);
		$flag = "success";
		if(!file_put_contents(self::JSONPATH, $json)){
			$flag = "failed";
		}
		return $flag;
	}
}
?>