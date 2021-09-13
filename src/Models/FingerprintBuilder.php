<?php

namespace App\Model;

use App\Model\Fingerprint as Fingerprint;

class FingerprintBuilder {
	public static function buildWithData($data) {
		$model = new Fingerprint;
		$model->save();
		$model->update($data);
		
		return $model;

	}
	
	public static function findUnused() {
		return Fingerprint::where('status', 1)::groupBy('used')::getOne();
	}
}
