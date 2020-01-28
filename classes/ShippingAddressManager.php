<?php
class ShippingAddressManager{
	public function addClientShippingAddress(ClientNewShippingAddress $clientShippingAddress, $clientId){
			$client = new Client(new ClientId($clientId));
			return $client->addAddress($clientShippingAddress);
	}
	public function modifyClientAddress(ClientNewShippingAddress $clientShippingAddress, $clientId, $shippingId){
			$clientIdObject = new ClientId($clientId);
			$shippingIdObject = new ShippingAddressId($clientIdObject, $shippingId - 1);
			$client = new Client($clientIdObject);
			return $client->modifyAddress($clientShippingAddress, $shippingIdObject);
	}
	public function removeClientAddress($clientId, $shippingId){
			$clientIdObject = new ClientId($clientId);
			$shippingIdObject = new ShippingAddressId($clientIdObject, $shippingId - 1);
			$client = new Client($clientIdObject);
			return $client->removeAddress($shippingIdObject);
	}
	public function viewClientAddressList($clientId){
		$client = new Client(new ClientId($clientId));
		return $client->getShippingAddress();
	}
	public function getAllClients(){
		$clients = new ClientRepository();
		return $clients->getAllClients();
	}
	public function dummy(){
		echo "hello world";
	}
}
?>