<?php
class ClientId{
	private $clientId;
	public function __construct($id){
		if(empty($id) || $this->invalidClientId($id)){
			throw new Exception("No Client found");
		}
		$this->clientId = $id;
	}
	public function getClientId(){
		return $this->clientId;
	}
	private function invalidClientId($id){
		$clientRepo = new ClientRepository();
		$flag = true;
		if(count($clientRepo->find($id)) > 0){
			$flag = false;
		}
		return $flag;
	}
}