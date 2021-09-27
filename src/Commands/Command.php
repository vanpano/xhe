<?php
namespace App\Command;

class Command {
	public $container;
	
	public function __construct( $container) {
		$this->container = $container;
		$this->container->get('debug')->set_cur_script_path(__DIR__);
	}
	
	
}