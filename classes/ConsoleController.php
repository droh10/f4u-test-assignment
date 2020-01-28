<?php
class ConsoleController{
	public function execute(){
		while( true ) {
			$this->printMenu();
			$choice = trim(fgets(STDIN));
			if( $choice == 999 ) {
				$this->exitProgram();
				break;
			}
			$this->userChoice($choice);
		}
	}
	public function printMenu(){
		echo "\n************ Shipping Address Manager ******************\n";
		echo "1 - Add Address\n";
		echo "2 - Update Address\n";
		echo "3 - Delete Address\n";
		echo "4 - View Address\n";
		echo "999 - Quit\n";
		echo "************ *********** ******************\n";
		echo "Enter your choice from 1 to 4 or 999 to Quit : ";
	}
	private function userChoice($choice){
		// Act based on user choice
		switch( $choice ) {
			case 1:
				$this->addAddressOption();
				break;
			case 2:
				$this->modifyAddressOption();
				break;
			case 3:
				$this->removeAddressOption();
				break;
			case 4:
				$this->viewAddress();
				break;
			default:
				echo "Invalid Choice. Please try again";
				break;
		}

	}
	private function modifyAddressOption(){
		$allClient = $this->getAllClients();
		$this->displayClientsMenu($allClient);
		$choice = trim(fgets(STDIN));
		if( $choice == 999 ) {
				$this->exitProgram();
		}else{
			$targetClientId = $allClient[$choice - 1];
			$this->displayClientAddressOption($targetClientId);
			$addressChoice = trim(fgets(STDIN));
			if( $addressChoice == 999 ) {
				$this->exitProgram();
			}else{
				$this->modifyAddress($targetClientId, $choice, $addressChoice);
			}
		}
	}
	private function removeAddressOption(){
		$allClient = $this->getAllClients();
		$this->displayClientsMenu($allClient);
		$choice = trim(fgets(STDIN));
		if( $choice == 999 ) {
				$this->exitProgram();
		}else{
			$targetClientId = $allClient[$choice - 1];
			$this->displayClientAddressOption($targetClientId);
			$addressChoice = trim(fgets(STDIN));
			if( $addressChoice == 999 ) {
				$this->exitProgram();
			}else{
				$control = new ShippingAddressManager();
				try{
					$status = $control->removeClientAddress($targetClientId['id'], $addressChoice);
				}catch(Exception $e){
					echo 'Message: ',  $e->getMessage(), "\n";
				}
			}
		}
		
	}
	private function displayClientAddressOption($targetClientId){
		$clientId = $targetClientId['id'];
		$control = new ShippingAddressManager();
		$allAddress = $control->viewClientAddressList($clientId);
		$this->displayClientsAddressMenu($allAddress, $targetClientId);
	}
	private function displayClientsAddressMenu($allAddress, $targetClientId){
		$i = 1;
		echo "\n************ ".$targetClientId['firstname']." ".$targetClientId['lastname']." registered address ******************\n";
		if(count($allAddress) > 0){
			foreach($allAddress as $address){
				echo $i." - ".$address['street']." ".$address['city']." ".$address['zipcode']." ".$address['country']."\n";
				$i++;
			}
			echo "999 - Return to main menu\n";
			echo "************ *********** ******************\n";
			echo "Enter your choice or 999 to Quit: ";
		}else{
			echo "No registered address yet\n";
			echo "999 - Return to main menu\n";
			echo "Enter  999 to return to main menu: ";
		}

	}
	private function addAddressOption(){
		$allClient = $this->getAllClients();
		$this->displayClientsMenu($allClient);
		$choice = trim(fgets(STDIN));
		if( $choice == 999 ) {
				$this->exitProgram();
		}else{
			$targetClientId = $allClient[$choice - 1];
			$this->addAddress($targetClientId);
		}
		
	}
	private function viewAddress(){
		$allClient = $this->getAllClients();
		$this->displayClientsMenu($allClient);
		$choice = trim(fgets(STDIN));
		if( $choice == 999 ) {
				$this->exitProgram();
		}else{
			$targetClientId = $allClient[$choice - 1];
			$this->viewClientAddress($targetClientId);
		}
	}
	private function getAllClients(){
		$control = new ShippingAddressManager();
		return $control->getAllClients();
	}
	private function displayClientsMenu($allClient){
		$i = 1;
		echo "************ Choose a Client ******************\n";
		foreach($allClient as $client){
			echo $i." - ".$client['firstname']." ".$client['lastname']."\n";
			$i++;
		}
		echo "999 - Return to Main Menu\n";
		echo "************ *********** ******************\n";
		echo "Enter your choice or 999 to Quit: ";

	}
	private function modifyAddress($targetClientId, $choice, $addressChoice){
		$clientId = $targetClientId['id'];
		$newAddsress = $this->setNewAddress();
		$control = new ShippingAddressManager();
		try{
			$status = $control->modifyClientAddress($newAddsress, $clientId, $addressChoice);
			echo "Modified Address\n";
		}catch(Exception $e){
			echo 'Message: ',  $e->getMessage(), "\n";
		}
	}
	private function addAddress($targetClientId){
		$clientId = $targetClientId['id'];
		try{
			$newAddsress = $this->setNewAddress();
			if($newAddsress){
				$control = new ShippingAddressManager();
				$status = $control->addClientShippingAddress($newAddsress, $clientId);
				echo "Added Address\n";
			}
		}catch(Exception $e){
			echo 'Message:',  $e->getMessage(), "\n";
		}

	}
	private function setNewAddress(){
		echo "************ Please provide the following ******************\n";
		echo "Country: ";
		$country = trim(fgets(STDIN, 150));
		echo "City: ";
		$city = trim(fgets(STDIN, 150));
		echo "Zipcode: ";
		$code = trim(fgets(STDIN, 150));
		echo "Street: ";
		$street = trim(fgets(STDIN, 150));
		try {
			$newAddsress = new ClientNewShippingAddress(
				new Country($country),
				new City($city),
				new ZipCode(intval($code)),
				new Street($street)
			);
			return $newAddsress;
		} catch (Exception $e) {
			echo 'Message:',  $e->getMessage(), "\n";
		}
	}
	private function viewClientAddress($targetClientId){
		$clientId = $targetClientId['id'];
		$control = new ShippingAddressManager();
		$allAddress = $control->viewClientAddressList($clientId);
		$this->displayClientAddressList($allAddress, $targetClientId);
	}
	private function displayClientAddressList($allAddress, $targetClientId){
		$i = 1;
		echo "\n************ ".$targetClientId['firstname']." ".$targetClientId['lastname']." registered address ******************\n";
		if(count($allAddress) > 0){
			foreach($allAddress as $address){
				echo $i." - ".$address['street']." ".$address['city']." ".$address['zipcode']." ".$address['country']."\n";
				$i++;
			}
		}else{
			echo "No registered address yet\n";
		}

	}
	private function exitProgram(){
		echo "Goodbye!!\n";
	}
}
?>