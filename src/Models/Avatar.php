<?php

namespace App\Model;

use \dbObject;

class Avatar extends \dbObject {
	protected $dbTable = "avatars";
	protected $dbFields = Array(
		'useragent' => Array('text'),
		'language' => Array('text'),
		'timezone' => Array('text'),
		'plugins' => Array('text'),
		'canvas' => Array('text'),
		'used' => Array('int'),
		'status' => Array('bool'),
		
	);
	
}
