<?php
namespace App\Model;

class GoogleAccount extends AccountModel {
	protected $dbTable = "google_accounts";
	protected $dbFields = [
		'email' => Array('text', 'required'),
		'password' => Array('text', 'required'),
		'rEmail' => Array('text'),
		'phone' => Array('text'),
	];
}