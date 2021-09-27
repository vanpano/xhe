<?php



namespace App\Model;

use App\Model\Profile as Profile;

class ProfileBuilder {
	public static function buildWithData() {
		$model = new Profile;
		@$model->save();
		$model->update([
			'canvas' => mt_rand(99999,999999),
			'audio' => json_decode(json_encode([
				'noise' => mt_rand(99999,999999),
				'frequency' => mt_rand(1,99)
			])),
			'bound' => mt_rand(99999,999999),
			'resolution' => json_decode(json_encode([
				'screenWidth' => mt_rand(1400,1600),
				'screenHeight' => mt_rand(1000,1224),
				'screenPixelDepth' => 24,
				'browserWidth' => mt_rand(1000,1300),
				'browserHeight' => mt_rand(800, 1000),
			])),
			'hardware' => json_decode(json_encode([
				'concurrency' => mt_rand(1,6) * 2,
				'deviceMemory' => mt_rand(1, 12),
				'devicePixelRatio' => 24
			])),
			'useragent' => 'Mozilla/5.0 (Windows NT 6.1; WOW64; rv:77.0) Gecko/20190101 Firefox/77.0',
			//'Mozilla/5.0 (Windows NT 6.1; rv:68.7) Gecko/20100101 Firefox/68.7',
			'language' => 'ru',
			'timezone' => '-3'
		]);
		
		return $model;
	}
}
