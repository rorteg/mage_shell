<?php
require_once 'abstract.php';

class Mage_Shell_Permissions extends Mage_Shell_Abstract
{
	
	protected function _getCommands(){
		$_commands = array(
			'cd ..',
			'sudo find . -type f \-exec chmod 644 {} \;',
			'sudo find . -type d \-exec chmod 755 {} \;',
			'sudo find ./var -type d \-exec chmod 777 {} \;',
			'sudo find ./var -type f \-exec chmod 666 {} \;',
			'sudo find ./media -type d \-exec chmod 777 {} \;',
			'sudo find ./media -type f \-exec chmod 666 {} \;',
			'sudo chmod 777 ./app/etc',
			'sudo chmod 644 ./app/etc/*.xml',
			'sudo chmod 777 js -Rf',
			'sudo chmod 777 skin -Rf '

		);
		$commands = implode(' && ', $_commands);
		return $commands;
	}

	public function run(){
		if($this->getArg('reset')){
			$output = shell_exec($this->_getCommands());
			echo $output;
			echo 'Reset all permissions of the Magento Folders.';
		}else{
			echo $this->usageHelp();
		}
	}

	public function usageHelp()
    {
        return <<<USAGE
Note: Requires administrator permissions.
Usage:  php -f permissions.php -- [options]
        php -f permissions.php -- reset

  reset             Reset all permissions of the Magento folders

USAGE;
    }
}

$shell = new Mage_Shell_Permissions();
$shell->run();