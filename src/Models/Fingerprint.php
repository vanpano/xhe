<?php

namespace App\Model;

use \dbObject;

class Fingerprint extends \dbObject {
	protected $dbTable = "fingerprints";
	protected $jsonFields = Array('plugins', 'canvas', 'platform');
	protected $dbFields = Array(
		'useragent' => Array('text'),
		'language' => Array('text'),
		'timezone' => Array('text'),
		'plugins' => Array('text'),
		'canvas' => Array('text'),
		'platform' => Array('text'),
		'randi' => Array('text'),
		'used' => Array('int'),
		'status' => Array('bool'),		
	);
	
	
	
	
	
}
