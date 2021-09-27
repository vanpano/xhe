<?php

$container = require(__DIR__ . '/../app/bootstrap.php');

$app = new Silly\Application();
$app->useContainer($container, $injectWithTypeHint = true);
$invoker = new Invoker\Invoker(null, $container);

$data = file('C:\Users\user741\Downloads\Proxy-27-09-2021-1.txt', FILE_IGNORE_NEW_LINES);

if (!is_array($data) || empty($data))
	die();

foreach($data as $row) {
	$cols = explode(":", $row);
	
	(App\Model\ProxyBuilder::buildWithData([
		'ip' => rtrim(trim($cols[0])),
		'port' => rtrim(trim($cols[1])),
		'login' => rtrim(trim($cols[2])),
		'password' => rtrim(trim($cols[3])),
		'language' => rtrim(trim('ru'))
	]));
}

$app->run();