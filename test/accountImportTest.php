<?php

$container = require(__DIR__ . '/../app/bootstrap.php');

$app = new Silly\Application();
$app->useContainer($container, $injectWithTypeHint = true);
$invoker = new Invoker\Invoker(null, $container);

if (isset($argv[1]))
	if (realpath($argv[1])) 
		$data = file($argv[1], FILE_IGNORE_NEW_LINES);

if (!isset($data) || @!is_array($data) || @empty($data))
	die('Empty data set...');

foreach($data as $row) {
	$cols = explode(":", $row);
	
	(App\Model\GoogleAccountBuilder::buildWithData([
		'email' => rtrim(trim($cols[0])),
		'password' => rtrim(trim($cols[1])),
		'rEmail' => (isset($cols[2]) ? trim($cols[2]) : NULL)
	]));
}

$app->run();