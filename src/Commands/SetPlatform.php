<?php
namespace App\Command;

class SetPlatform extends Command {
	function __invoke($platform) {
		$this->container->get('browser')->set_platform($platform);
		$this->container->get('browser')->wait();
	}
}