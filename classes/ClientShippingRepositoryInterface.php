<?php
interface ClientShippingRepositoryInterface{
	public function getAddress($shippingId, ClientId $id);
	public function getAllAddress(ClientId $id);
	public function removeAddress(ClientId $id, ShippingAddressId $shippingId);
	public function modifyAddress(ClientId $id, ShippingAddressId $shippingId, ClientNewShippingAddress $addressInfo);
	public function addAddress(ClientId $id, ClientNewShippingAddress $addressInfo);
}