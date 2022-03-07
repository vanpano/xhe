<?php
namespace App\Model;

class Attendee extends Model {
	public $dbTable = 'attendees';	
	public $dbFields = Array(
		'projectId' => Array('int'),
		'crmId' => Array('int'),
		'email' => Array('text'),
		'createdAt' => Array('datetime'),
		'updatedAt' => Array('datetime'),
		'lastUsedAt' => Array('datetime'),
		'used' => Array('int'),
		'status' => Array('bool'),
	);
	
	protected $relations = Array (
        'project' => Array ("hasOne", "App\Model\Project", "projectId"),
    );

	
}