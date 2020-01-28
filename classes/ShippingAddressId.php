<?php
class ShippingAddressId{
	private $shippingId;
	public function __construct(ClientId $id, $shippingId){
		if($this->invalidShippingId($id, $shippingId)){
			throw new Exception("Invalid selected shipping id.");
		}
		$this->shippingId = $shippingId;
	}
	public function getShippingId(){
		return $this->shippingId;
	}
	private function invalidShippingId($id, $shippingId){

		$client = new Client($id);
		$all = $client->getShippingAddress();
		$flag = false;
		if(!isset($all[$shippingId])){
			$flag = true;
		}
		return $flag;
	}
}
?>