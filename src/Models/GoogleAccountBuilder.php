<?php

namespace App\Model;

use App\Model\GoogleAccount as Account;

class GoogleAccountBuilder {
	public static function build() {
		$model = new Account;
		if ($model->save())
			return $model;
		
		return NULL;
	}
	
	public static function findUnused() {
		if (!is_null($model = Account::where('status', 1)::where('working', 0)::groupBy('used')::getOne()))
			return $model;
		return false;
	}
}