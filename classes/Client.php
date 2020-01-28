<?php
	class Client{
		private $clientId;
		public function __construct(ClientId $id){
			$clientRepository  = new ClientRepository();
			$clientDetails = $clientRepository->find($id);
			if(empty($clientDetails)){
				throw new Exception("Client not found");
			}
			$this->clientId = $id;
		}
		public function addAddress(ClientNewShippingAddress $shippingAddress){
			//check max address
			$clientAddress = new ClientShippingAddress($this->clientId);
			if($clientAddress->howManyAddressStored() >= 3){
				throw new Exception("You can only register up to 3 address!!\n");
			}else{
				return $clientAddress->addShippingAddress($shippingAddress);
			}
		}
		public function modifyAddress(ClientNewShippingAddress $shippingAddress, ShippingAddressId $shippingId){
			$clientAddress = new ClientShippingAddress($this->clientId);
			return $clientAddress->modifyShippingAddress($shippingAddress, $shippingId);
			
		}
		public function removeAddress(ShippingAddressId $shippingId){
			//check if default address cannot delete
			$clientAddress = new ClientShippingAddress($this->clientId);
			if($shippingId->getShippingId() == 0){
				throw new Exception("Unable to delete default address");
			}else{
				return $clientAddress->removeShippingAddress($shippingId);
			}
		}
		public function getShippingAddress(){
			$clientAddress = new ClientShippingAddress($this->clientId);
			return $clientAddress->getShippingAddress();
		}
	}
?>