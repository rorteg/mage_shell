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
require_once 'uecommerce/uecommands.php';

/**
 * Magento Permissions Shell Script
 *
 * @category    Uecommerce
 * @package     Mage_Shell
 * @author      Rafael Ortega Bueno
 */

class Uecommerce_Shell_Uepermissions extends Uecommerce_Shell_Uecommands
{

	/**
     * Run script
     *
     */
	public function run(){
		if($this->getArg('resetAll')){
			$this->resetAll();
		}else{
			echo $this->usageHelp();
		}
	}


	/**
     * Reset permissions for all Magento folders
     * @return void
     */
	public function resetAll(){
		$this->_commands = array();
		$this->_createCommand('Starting...', 'cd '.dirname(Mage::getRoot()), '');
		$this->_createCommand('sudo find . -type f \-exec chmod 644 {} \;','sudo find . -type f \-exec chmod 644 {} \;','Command executed successfully');
		$this->_createCommand('sudo find . -type d \-exec chmod 755 {} \;','sudo find . -type d \-exec chmod 755 {} \;','Command executed successfully');
		$this->_createCommand('sudo find ./var -type d \-exec chmod 777 {} \;','sudo find ./var -type d \-exec chmod 777 {} \;','Command executed successfully');
		$this->_createCommand('sudo find ./var -type f \-exec chmod 666 {} \;','sudo find ./var -type f \-exec chmod 666 {} \;','Command executed successfully');
		$this->_createCommand('sudo find ./media -type d \-exec chmod 777 {} \;','sudo find ./media -type d \-exec chmod 777 {} \;','Command executed successfully');
		$this->_createCommand('sudo find ./media -type f \-exec chmod 666 {} \;','sudo find ./media -type f \-exec chmod 666 {} \;','Command executed successfully');
		$this->_createCommand('sudo chmod 777 ./app/etc','sudo chmod 777 ./app/etc','Command executed successfully');
		$this->_createCommand('sudo chmod 644 ./app/etc/*.xml','sudo chmod 644 ./app/etc/*.xml','Command executed successfully');
		$this->_createCommand('sudo chmod 777 js -Rf','sudo chmod 777 js -Rf','Command executed successfully');
		$this->_createCommand('sudo chmod 777 skin -Rf','sudo chmod 777 skin -Rf','Command executed successfully');
		$this->setSuccessMessage('All commands executed!');
		$this->execCommands();
	}


	/**
     * Retrieve Usage Help Message
     *
     */

	public function usageHelp()
    {
        $help = <<<USAGE
Note: Requires administrator permissions.
Usage:  php -f permissions.php -- [options]
        php -f permissions.php -- resetAll

  reset             Reset all permissions of the Magento folders

USAGE;

	return $this->alertMessage($help);
    }
}

$shell = new Uecommerce_Shell_Uepermissions();
$shell->run();
