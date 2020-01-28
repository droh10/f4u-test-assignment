<?php
class ClientShippingAddress{
	private $shippingAddress;
	private $clientId;
	private $shippingRepo;
	public function __construct(ClientId $id){
		if(empty($id)){
			throw new Exception("No client id given");
		}
		$this->shippingRepo = new ClientShippingRepository();
		$this->clientId = $id;
		$this->shippingAddress = $this->shippingRepo->getAllAddress($this->clientId);
	}
	public function getShippingAddress(){
		return $this->shippingAddress;
	}
	public function isDefaultAddress($shippingId){
		return ($shippingId == 0);
	}
	public function howManyAddressStored(){
		return count($this->shippingAddress);
	}
	public function addShippingAddress(ClientNewShippingAddress $shippingAddress){
		$status = $this->shippingRepo->addAddress($this->clientId, $shippingAddress);
		if($status == "success"){
			$this->shippingAddress = $this->shippingRepo->getAllAddress($this->clientId);
		}
		return $status;
	}
	public function modifyShippingAddress(ClientNewShippingAddress $shippingAddress, ShippingAddressId $shippingId){
		$status = $this->shippingRepo->modifyAddress($this->clientId, $shippingId, $shippingAddress);
		if($status == "success"){
			$this->shippingAddress = $this->shippingRepo->getAllAddress($this->clientId);
		}
		return $status;
	}
	public function removeShippingAddress(ShippingAddressId $shippingId){
		$status = $this->shippingRepo->removeAddress($this->clientId, $shippingId);
		if($status == "success"){
			$this->shippingAddress = $this->shippingRepo->getAllAddress($this->clientId);
		}
		return $status;
	}
}
?>