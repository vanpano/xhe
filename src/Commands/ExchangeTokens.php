<?php
namespace App\Command;

class ExchangeTokens extends Command {
	public function __invoke() {
		$this->container->get('button')->get_by_id('exchangeCode')->click();
		$this->container->get('browser')->wait();
	}
}