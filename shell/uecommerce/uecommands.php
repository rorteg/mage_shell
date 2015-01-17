<?php
**
 * Author: Rafael Ortega Bueno
 * Date: Jan 17, 2015
 * Time: 14:53:29 PM
 *
 * Mage_Shell script that interfaces with the Magento permissions. 
 *
 *
 * @category    Uecommerce
 * @package     Mage_Shell
 * @copyright   Copyright (c) 2014 Uecommerce, Inc. (http://www.uecommerce.com.br)
 * @license     http://www.opensource.org/licenses/osl-3.0.php
 */

require_once __DIR__.'/../abstract.php';

/**
 * Magento Permissions Shell Script
 *
 * @category    Uecommerce
 * @package     Mage_Shell
 * @author      Rafael Ortega Bueno
 */

class Uecommerce_Shell_Uecommands extends Mage_Shell_Abstract
{
	protected $_commands = array();
	protected $_successMessage;
	
	/**
     * Creates the commands to be executed and their messages
     * @return array
     */
	public function _createCommand($beforeMessage, $command, $afterMessage){
		$this->_commands[] = array('beforeMessage'=>$beforeMessage, 'command'=>$command, 'afterMessage' => $afterMessage);
	}

	/**
     * Performs all previously prepared statements
     * @return void
     */
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

	/**
	* Last post after execution of all commands.
	* @param String $message
	* @return Uecommerce_Shell_Uecommands
	*/
	public function setSuccessMessage($message){
		$this->_successMessage = $message;
		return $this;
	}

	/**
	* 
	* @return String
	*/
	public function getSuccessMessage(){
		return $this->_successMessage;
	}


	/**
	* 
	* @return String
	*/
	public function successMessage($message){
		return "\e[32m{$message}\n";
	}

	/**
	* 
	* @return String
	*/
	public function errorMessage($message){
		return "\e[31m{$message}\n";
	}

	/**
	* 
	* @return String
	*/
	public function alertMessage($message){
		return "\e[33m{$message}\n";
	}

	/**
	* 
	* @return String
	*/
	public function infoMessage($message){
		return "\e[34m{$message}\n";
	}

	/**
     * Retrieve Usage run() script
     * @return Uecommerce_Shell_Uecommands
     */
	public function run(){
		return $this;
	}
}