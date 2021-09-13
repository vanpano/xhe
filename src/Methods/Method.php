<?php

namespace App\Method;

abstract class Method {
	public $container;
	
	function __construct($container) {
		$this->container = $container;
		//$this->before();
	}
	
	function before() {
		$this->container->get('browser')->navigate('http://localhost/dashboard/');
		$this->container->get('browser')->wait();
	}
	
	abstract function method($data);
}