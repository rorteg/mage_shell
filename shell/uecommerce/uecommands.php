<?php

require_once __DIR__.'/../abstract.php';

class Mage_Shell_Uecommerce_Uecommands extends Mage_Shell_Abstract
{
	protected $_commands = array();
	protected $_successMessage;
	
	public function _createCommand($beforeMessage, $command, $afterMessage){
		$this->_commands[] = array('beforeMessage'=>$beforeMessage, 'command'=>$command, 'afterMessage' => $afterMessage);
	}

	public function execCommands(){
		if(count($this->_commands) >= 1 && is_array($this->_commands)){
				
			foreach($this->_commands as $command){

				echo $this->infoMessage($command['beforeMessage']);
				
				shell_exec($command['command']);
				echo $this->successMessage($command['afterMessage']);
				
			}
			$successMessage = $this->getSuccessMessage()?$this->getSuccessMessage():'';
			echo $this->successMessage($successMessage);
			echo "\n";
		}else{
			echo $this->errorMessage('There are commands to be executed');		
		}
	}

	public function setSuccessMessage($message){
		$this->_successMessage = $message;
	}

	public function getSuccessMessage(){
		return $this->_successMessage;
	}

	public function successMessage($message){
		return "\e[32m{$message}\n";
	}

	public function errorMessage($message){
		return "\e[31m{$message}\n";
	}

	public function alertMessage($message){
		return "\e[33m{$message}\n";
	}

	public function infoMessage($message){
		return "\e[34m{$message}\n";
	}

	public function run(){
		return $this;
	}
}