<?php

namespace App\Command;

class Vanish extends Command {
	function __invoke() {
		$this->container->get('application')->clear();
	}
}