<?php

namespace App\Model;

class GoogleAccount extends Model {
	protected $dbTable = "google_accounts";
	protected $dbFields = Array(
		'proxyId' => Array('int'),
		'cookieId' => Array('int'),
		'avatarId' => Array('int'),
		'email' => Array('text', 'required'),
		'password' => Array('text', 'required'),
		'rEmail' => Array('text'),
		'phone' => Array('text'),
		'loginAt' => Array('datetime'),
		'createdAt' => Array('datetime'),
		'updatedAt' => Array('datetime'),
		'deactivatedAt' => Array('datetime'),
		'used' => Array('int'),
		'working' => Array('bool'),
		'status' => Array('bool')
	);
	
	protected $relations = Array (
        'proxy' => Array ("hasOne", "App\Model\Proxy", "proxyId"),
        'cookie' => Array("hasOne", "App\Model\Cookie", "cookieId"),
        //'avatar' => Array ("hasOne", "avatar", "avatarId"),
    );
	
}
