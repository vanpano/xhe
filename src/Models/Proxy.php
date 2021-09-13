<?php

namespace App\Model;

use \dbObject;

class Proxy extends \dbObject {
	protected $dbTable = "proxies";
	protected $primaryKey = "id";
	protected $dbFields = Array(
		'ip' => Array('text', 'required'),
		'port' => Array('int'),
		'login' => Array('text'),
		'password' => Array('text'),
		'language' => Array('text'),
		'createdAt' => Array('datetime'),
		'updatedAt' => Array('datetime'),
		'deactivatedAt' => Array('datetime'),
		'used' => Array('int'),
		'status' => Array('bool')
	);
	
	/*
	protected $relations = Array (
        'accounts' => Array ("hasMany", "GoogleAccount", 'proxyId')
    );
	*/
}
