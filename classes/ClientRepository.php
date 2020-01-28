<?php
class ClientRepository implements ClientRepositoryInterface{
	private $data;
	public function __construct(){
		$jsonData = file_get_contents(__dir__."/../data/Client.json");
		$this->data = json_decode($jsonData, true);
		if(count($this->data) == 0){
			throw new Exception("No clients found");
		}
	}
	public function find($clientIdString){
		$idColumn = array_column($this->data, "id");
		return $this->data[array_search($clientIdString, $idColumn)];
	}
	public function getAllClients(){
		return $this->data;
	}
}
?>