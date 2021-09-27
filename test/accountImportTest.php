<?php

$container = require(__DIR__ . '/../app/bootstrap.php');

$app = new Silly\Application();
$app->useContainer($container, $injectWithTypeHint = true);
$invoker = new Invoker\Invoker(null, $container);

$data = file('C:\Users\user741\Downloads\order1705864.txt', FILE_IGNORE_NEW_LINES);

if (!is_array($data) || empty($data))
	die();

foreach($data as $row) {
	$cols = explode(":", $row);
	
	(App\Model\GoogleAccountBuilder::buildWithData([
		'email' => rtrim(trim($cols[0])),
		'password' => rtrim(trim($cols[1])),
		'rEmail' => (isset($cols[2]) ? trim($cols[2]) : NULL)
	]));
}

$app->run();