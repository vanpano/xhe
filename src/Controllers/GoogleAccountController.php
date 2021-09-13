<?php
namespace App\Controller;

class GoogleAccountController extends AccountController {
	
public function getEmail() {
		return $this->get()->email;
	}
	
	public function getPassword() {
		return $this->get()->password;
	}
	
	public function getReserveEmail() {
		return $this->get()->rEmail;
	}
	
	public function getData() {
		return [
			'email' => $this->getEmail(),
			'password' => $this->getPassword(),
			'reserveEmail' => $this->getReserveEmail()
		];
	}

	
}